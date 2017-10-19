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
     * @param string|array $roles The role(s) to match against.
     * @param boolean $requireAll Optional parameter to indicate that user should have all the roles. Default is false..
     * @return boolean True if the user matches the role(s) requirement.
     */
    public function hasRoles($roles, $requireAll = false, $tenantId)
    {
        $roles = (array)$roles;
        if(empty($roles))
        {
            return false;
        }
        if($requireAll)
        {
            return $this->roles($tenantId)->whereIn('name', $roles)->count() == count($roles);
        }
        return $this->roles($tenantId)->whereIn('name', $roles)->count() > 0;
    }
    /**
     * Many-to-Many relations with Role.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles($tenantId = null)
    {
        if(empty($tenantId))
        {
            return $this->belongsToMany(Config::get('multitenant.role'), Config::get('multitenant.role_user_table'))->whereNull(Config::get('multitenant.role_user_table') . '.tenant_id');
        }
        return $this->belongsToMany(Config::get('multitenant.role'), Config::get('multitenant.role_user_table'))->where(Config::get('multitenant.role_user_table') . '.tenant_id', $tenantId);
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
