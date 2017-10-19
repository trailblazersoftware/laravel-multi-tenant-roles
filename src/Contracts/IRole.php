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
     * All the PrivilegeDetail models that belong to this permission.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function details();
    
        /**
         * The description (PrivilegeDetail where key==description) that belong to this permission in the given language.
         * 
         * If the $lang param is not provided, the method will use the application's current language code from Config
         *
         * @param string $lang the 2 char language code for the description we want to retrieve. i.e. en, fr, es.
         * @return \Illuminate\Database\Eloquent\Relations\MorphMany Description models
         */
        public function description($lang = null);
    
        /**
         * All the descriptions (PrivilegeDetail where key==description) that belong to this permission.
         *
         * @return \Illuminate\Database\Eloquent\Relations\MorphMany Description models
         */
        public function allDescriptions();
    
        /**
         * The display name (PrivilegeDetail where key==display_name) that belong to this permission in the given language.
         * 
         * If the $lang param is not provided, the method will use the application's current language code from Config
         *
         * @param string $lang the 2 char language code for the display name we want to retrieve. i.e. en, fr, es.
         * @return \Illuminate\Database\Eloquent\Relations\MorphMany Description models
         */
        public function displayName($lang = null);
        
        /**
         * All the descriptions (PrivilegeDetail where key==description) that belong to this permission.
         *
         * @return \Illuminate\Database\Eloquent\Relations\MorphMany Description models
         */
        public function allDisplayNames();

    /**
     * The description of this role.
     *
     * @param mixed $value
     * @return string The description of this role.
     */
    public function getDescriptionAttribute($value);

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
     * Query scope to limit the roles returned to a specific tenant, and optionally global roles.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param int|array $tenantFilter If an int is provided, used as tenant_id. If an array is provided
     * then it should be in the form ['tenant_id' => 101, 'include_global' => true|false]
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeForTenant($query, $tenantFilter);
}