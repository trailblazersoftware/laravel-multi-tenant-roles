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
     * @param int|array $tenantFilter If an int is provided, used as tenant_id. If an array is provided
     * then it should be in the form ['tenant_id' => 101, 'include_global' => true|false]
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeForTenant($query, $tenantFilter = null)
    {
        $tenantId = null;
        $includeGlobal = false;
        $tenantColumn = property_exists($this, 'tenantColumn') && !empty($this->tenantColumn) ? $this->tenantColumn : 'tenant_id';
        if(is_array($tenantFilter))
        {
            if(isset($tenantFilter[$tenantColumn]))
            {
                $tenantId = $tenantFilter[$tenantColumn];
            }
            if(isset($tenantFilter['include_global']))
            {
                $includeGlobal = $tenantFilter['include_global'];
            }
        }
        if(!empty($tenantId))
        {
            $query = $query->where($tenantColumn, $tenantId);
        }
        if($includeGlobal)
        {
            if(empty($tenantId))
            {
                $query = $query->whereNull($tenantColumn);
            }
            else
            {
                $query = $query->orWhereNull($tenantColumn);
            }
        }
        return $query;
    }
}
