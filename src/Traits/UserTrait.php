<?php
namespace Trailblazer\MultiTenant\Traits;

/**
 * A Trait implementing a few handy methods for a multi-tenant user roles/permissions functionalities.
 *
 * 
 * @author Kolado Sidibe <kolado.sidibe@olympuscloud.com>
 * @author Trailblazer Software <support@olympuscloud.com>
 * @license MIT
 * @package Trailblazer\MultiTenant
 */
use Config;
trait UserTrait
{
    /**
     * Check to see if a user has the given role(s).
     * 
     * If any of the given roles is matched, true is returned.
     * You may optionally pass false as the second parameter to indicate that you want the user to have all the roles.
     *
     * @param string|array $roles The role(s) to match against. Pass '*' to check if the user has any role at all.
     * @return boolean True if the user matches the role(s) requirement.
     */
    public function hasRoles($roles, $tenantId = null)
    {
        $roles = (array)$roles;
        if(empty($roles))
        {
            return false;
        }
        $query = $this->roles();
        if(!empty($tenantId))
        {
            $query = $query->forTenant($tenantId);
        }
        if(in_array('*', $roles))
        {
            return $query->count() > 0;
        }
        return $query->whereIn('name', $roles)->count() > 0;
    }

    /**
     * Roles on specific Tenant.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function rolesOnTenant(int $tenantId)
    {
        $tenantId ?? Config::get('multitenant.tenant_id');
        return $this->roles()->forTenant($tenantId);
    }
    /**
     * Checks to see if the user has any role o
     *
     * @param int $tenantId
     * @return boolean
     */
    public function hasAnyRole(int $tenantId)
    {
        return $this->hasRoles('*', false, $tenantId);
    }
    /**
     * Many-to-Many relations with Role.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Config::get('multitenant.role'), Config::get('multitenant.role_user_table'))->withPivot('tenant_id');
    }


    /**
     * Alias to eloquent many-to-many relation's attach() method.
     *
     * @param mixed $role The Role model or just the id of the role.
     * @param int|null $tenantId The id of the tenant (client) on whose space to grant the given role.
     */
    public function attachRole($role, $tenantId = null)
    {
        if(is_object($role))
        {
            $role = $role->getKey();
        }
        if(is_array($role))
        {
            $role = $role['id'];
        }
        $this->roles()->attach($role, ['tenant_id' => $tenantId]);
    }
}
