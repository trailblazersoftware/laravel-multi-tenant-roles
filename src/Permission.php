<?php

namespace Trailblazer\MultiTenant;

use Trailblazer\MultiTenant\Traits\GetLocalizedColumnTrait;
use Trailblazer\MultiTenant\Contracts\IPermission;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model implements IPermission
{
    use GetLocalizedColumnTrait;
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
        parent::_construct($attributes);
        $this->table = Config::get('multitenant.permissions_table');
    }
    /**
     * Query scope to limit the permissions returned to those the user holds on a specific tenant's space.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param int $tenantFilter id of the tenant to check user permission against.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeForTenant($query, $tenantId)
    {
        if(empty($tenantId))
        {
            return $query;
        }
        return $query->where(Config::get('multitenant.permission_user_table') . '.tenant_id', $tenantId);
    }
}
