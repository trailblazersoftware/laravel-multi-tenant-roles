<?php
namespace Trailblazer\MultiTenant\Contracts;
/**
 * The contract for Role.
 *
 * 
 * @author Kolado Sidibe <kolado.sidibe@olympuscloud.com>
 * @author Trailblazer Software <support@olympuscloud.com>
 * @license MIT
 * @package Trailblazer\MultiTenant
 */
interface IRole
{
    /**
     * Many-to-Many relations to user model.
     * 
     * All the users with the given role.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users();

    /**
     * Accessor method to get the localized display_name.
     * 
     * The language returned is that set in config('locale)
     *
     * @param string|null $value
     * @return string
     */
    public function getLocalizedDisplayNameAttribute($value);

    /**
     * Accessor method to get the localized description.
     * 
     * The language returned is that set in config('locale)
     *
     * @param string|null $value
     * @return string
     */
    public function getLocalizedDescriptionAttribute($value);

    /**
     * Many-to-Many relations to permission model.
     * 
     * All the permissions for the given role.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function permissions();

     /**
     * Attach permission to current role.
     *
     * @param object|array $permission
     *
     * @return void
     */
    public function attachPermission($permission);
    
    /**
     * Detach permission form current role.
     *
     * @param object|array $permission
     *
     * @return void
     */
    public function detachPermission($permission);

    /**
     * Attach multiple permissions to current role.
     *
     * @param mixed $permissions
     *
     * @return void
     */
    public function attachPermissions($permissions);
    
    /**
     * Detach multiple permissions from current role
     *
     * @param mixed $permissions
     *
     * @return void
     */
    public function detachPermissions($permissions);

    /**
     * Query scope to limit the roles returned to those the user has on a specific tenant.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param int $tenantId The ID of the tenant
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeForTenant($query, $tenantId);
}