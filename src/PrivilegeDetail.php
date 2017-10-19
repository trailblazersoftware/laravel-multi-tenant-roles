<?php
namespace Trailblazer\MultiTenant;
use Config;
use Illuminate\Database\Eloquent\Model;
/**
 * The PrivilegeDetail model used to store extra details about a role or permission.
 * 
 * Two example of details are The display_name, and description properties of a role or permission.
 * 
 * @author Kolado Sidibe <kolado.sidibe@olympuscloud.com>
 * @author Trailblazer Software <support@olympuscloud.com>
 * @license MIT
 * @package Trailblazer\MultiTenant
 */
class PrivilegeDetail extends Model
{
    protected $table;
    public $timestamps = false;
    protected $fillable = [
        'lang',
        'key',
        'value'
    ];
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = Config::get('multitenant.privilege_details_table');
    }

    /**
     * The privilege (role or permission) to whom this detail belongs.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function owner()
    {
        return $this->morphTo();
    }

    /**
     * Set the key attribute of this model.
     * The method first trims the value passed, then if it is empty, the attribute is set to null.
     * If not empty, the attribute is set to the trimed value.
     *
     * @param mixed $value
     * @return void
     */
    public function setKeyAttribute($value)
    {
        $value = trim($value);
        $this->attributes['key'] = empty($value) ? null : $value;
    }

    /**
     * Set the value attribute of this model.
     * The method first trims the value passed, then if it is empty, the attribute is set to null.
     * If not empty, the attribute is set to the trimed value.
     *
     * @param mixed $value
     * @return void
     */
    public function setValueAttribute($value)
    {
        $value = trim($value);
        $this->attributes['value'] = empty($value) ? null : $value;
    }
    /**
     * Set the value attribute of this model.
     * The method first trims the value passed, then if it is empty, the attribute is set to null.
     * If not empty, the attribute is set to the trimed value.
     *
     * @param mixed $value
     * @return void
     */
    public function setLangAttribute($value)
    {
        $value = trim($value);
        $this->attributes['lang'] = empty($value) ? null : $value;
    }

    public function scopeLang($query, $lang)
    {
        return $query->where('lang', $lang);
    }
}
