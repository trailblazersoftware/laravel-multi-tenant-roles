<?php

namespace Trailblazer\MultiTenant;

use Trailblazer\MultiTenant\Traits\TenantScopeTrait;
use Trailblazer\MultiTenant\Traits\PrivilegeDetailsTrait;
use Trailblazer\MultiTenant\Contracts\IPermission;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model implements IPermission
{
    use TenantScopeTrait, PrivilegeDetailTrait;
    protected $table;
    public function __construct(array $attributes = [])
    {
        parent::_construct($attributes);
        $this->table = Config::get('multitenant.permissions_table');
    }
}
