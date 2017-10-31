<?php

namespace Trailblazer\MultiTenant;

use Config;
use Trailblazer\MultiTenant\Contracts\IRole;
use Illuminate\Database\Eloquent\Model;
use Trailblazer\MultiTenant\Traits\TenantScopeTrait;
use Trailblazer\MultiTenant\Traits\GetLocalizedColumnTrait;

class Role extends Model  implements IRole
{
    use TenantScopeTrait, GetLocalizedColumnTrait;
    protected $table;
    protected $fillable = [
        'name',
        'display_name',
        'display_name_fr',
        'description',
        'description_fr',
    ];
    protected $appends = [
        'localized_display_name',
        'localized_description',
    ];
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = Config::get('multitenant.roles_table');
    }

    /**
     * Many-to-Many relations to user model.
     * 
     * All the users with the given role.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(Config::get('multitenant.user'));
    }

    /**
     * The permissions of this role.
     * 
     * The BelongsToMany relationship to the permission model
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function permissions()
    {
        return $this->belongsToMany(Config::get('multitenant.permission'), Config::get('multitenant.permission_role_table'), 'role_id', 'permission_id')->withPivot('tenant_id');;
    }

    /**
     * Attach permission to current role.
     *
     * @param object|array $permission
     * @param int|null $tenantId The id of the tenant 
     *
     * @return void
     */
    public function attachPermission($permission, $tenantId = null)
    {
        if(is_object($permission))
        {
            $permission = $permission->getKey();
        }
        if(is_array($permission))
        {
            return $this->attachPermissions($permission, $tenantId);
        }
        $this->permissions()->attach($permission, ['tenant_id' => $tenantId]);
    }

    /**
     * Detach permission from current role.
     *
     * @param object|array $permission
     *
     * @return void
     */
    public function detachPermission($permission)
    {
        if(is_object($permission))
        {
            $permission = $permission->getKey();
        }
        if(is_array($permission))
        {
            return $this->detachPermissions($permission);
        }
        $this->permissions()->detach($permission);
    }

    /**
     * Attach multiple permissions to current role.
     *
     * @param mixed $permissions
     * @param int|null $tenantId The id of the tenant 
     *
     * @return void
     */
    public function attachPermissions($permissions, $tenantId = null)
    {
        foreach($permissions as $aPermission)
        {
            $this->attachPermission($aPermission, $tenantId);
        }
    }
    /**
     * Detach multiple permissions from current role
     *
     * @param mixed $permissions
     *
     * @return void
     */
    public function detachPermissions($permissions = null)
    {
        if(empty($permissions))
        {
            $permissions = $this->permissions()->get();
        }
        foreach($permissions as $aPermission) {
            $this->detachPermission($aPermission);
        }
    }
}
