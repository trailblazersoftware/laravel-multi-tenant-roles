<?php
namespace Trailblazer\MultiTenant\Traits;
/**
 * Trait implementing the query scope for limiting results to only records belonging a to a particular tenant.
 */
trait TenantScopeTrait
{
    /**
     * Query scope to limit the permissions returned to a specific tenant, and optionally global permissions.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param int $tenantFilter id of the tenant to check user role on.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeForTenant($query, $tenantId)
    {
        if(empty($tenantId))
        {
            return $query;
        }
        return $query->where($this->table . 'x.tenant_id', $tenantId);
    }
}
