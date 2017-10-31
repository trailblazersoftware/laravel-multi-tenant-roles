<?php

namespace Trailblazer\MultiTenant;

use Trailblazer\MultiTenant\Traits\TenantScopeTrait;
use Trailblazer\MultiTenant\Traits\GetLocalizedColumnTrait;
use Trailblazer\MultiTenant\Contracts\IPermission;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model implements IPermission
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
        parent::_construct($attributes);
        $this->table = Config::get('multitenant.permissions_table');
    }
}
