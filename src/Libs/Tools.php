<?php
namespace Trailblazer\MultiTenant\Libs;

/**
 * A utility class that contains a set of helper statuc methods.
 *
 * @author Kolado Sidibe <kolado.sidibe@olympuscloud.com>
 * @author Trailblazer Software <support@olympuscloud.com>
 * @license MIT
 * @package Trailblazer\MultiTenant
 */
class Tools
{
    /**
     * Get the suffix to be used to get the local column name in a database.
     *
     * @param string $languageCode
     * @return string Example: '' for english (note the absence of suffix), _fr (for french)
     */
    public static function getLocalizationColumnSuffix($languageCode)
	{
		$languageCode = (empty($languageCode) || strcasecmp($languageCode, 'en') == 0) ? '' : '_' . $languageCode;
		return $languageCode;
    }
    /**
     * Get the column name with suffix of the local column in a database.
     *
     * @param string $languageCode
     * @return string Example: display_name for english (note the absence of suffix), display_name_fr (for french)
     */
    public static function getLocalizedColumnName($columnName, $languageCode = null)
    {
		$languageCode = empty($languageCode) ?  config('locale') : $languageCode;
		return empty($columnName) ? $columnName : $columnName . Tools::getLocalizationColumnSuffix($languageCode);
	}
}
