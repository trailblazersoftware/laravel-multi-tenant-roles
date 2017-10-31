<?php

namespace Trailblazer\MultiTenant\Traits;

/**
 * A Trait implementing a few handy methods for a multi-tenant user roles/permissions functionalities.
 *
 * 
 * @author Kolado Sidibe <kolado.sidibe@olympuscloud.com>
 * @author Trailblazer Software <support@olympuscloud.com>
 * @license MIT
 * @package Trailblazer\MultiTenant
 */

use Trailblazer\MultiTenant\Libs\Tools;

trait GetLocalizedColumnTrait
{
    /**
     * Accessor method to get the localized display_name.
     * 
     * The language returned is that set in config('locale)
     *
     * @param string|null $value
     * @return string
     */
    public function getLocalizedDisplayNameAttribute($value)
    {
        $temp = Tools::getLocalizedColumnName('display_name');
        return $this->{Tools::getLocalizedColumnName('display_name')};
    }

    /**
     * Accessor method to get the localized description.
     * 
     * The language returned is that set in config('locale)
     *
     * @param string|null $value
     * @return string
     */
    public function getLocalizedDescriptionAttribute($value)
    {
        $temp = Tools::getLocalizedColumnName('description');
        return $this->{Tools::getLocalizedColumnName('description')};
    }
}
