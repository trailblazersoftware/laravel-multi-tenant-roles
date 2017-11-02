<?php
namespace Trailblazer\MultiTenant\Contracts;
/**
 * The contract for permission.
 *
 * 
 * @author Kolado Sidibe <kolado.sidibe@olympuscloud.com>
 * @author Trailblazer Software <support@olympuscloud.com>
 * @license MIT
 * @package Trailblazer\MultiTenant
 */
interface IPermission
{
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
     * Many-to-Many relations user model.
     * 
     * All the users with the given permission.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users();
    /**
     * The roles to whom this permission is bound.
     * 
     * All the roles for the given permission.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles();

    /**
     * Query scope to limit the permissions returned to a specific tenant.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param int $tenantFilter id of the tenant to check user role on.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeForTenant($query, $tenantId);
}