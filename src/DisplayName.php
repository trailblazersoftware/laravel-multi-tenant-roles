<?php
namespace Trailblazer\MultiTenant;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Config;
/**
 * Model for storing descriptions for roles and permissions.
 * 
 * @author Kolado Sidibe <kolado.sidibe@olympuscloud.com>
 * @author Trailblazer Software <support@olympuscloud.com>
 * @license MIT
 * @package Trailblazer\MultiTenant
 */
class DisplayName extends PrivilegeDetail
{
    public function __construct(array $attributes = [])
    {
        if(empty($attributes))
        {
            $attributes = [];
        }
        $attributes['key'] = 'display_name';
        parent::__construct($attributes);
        // $this->table = Config::get('multitenant.privilege_details_table');
    }
    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('displayName', function (Builder $builder) {
            $builder->where('key', 'display_name');
        });
    }

    public function setKeyAttribute($value)
    {
        $this->attributes['key'] = 'display_name';
    }
}
