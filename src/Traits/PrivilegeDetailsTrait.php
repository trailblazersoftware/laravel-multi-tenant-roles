<?php
namespace Trailblazer\MultiTenant\Traits;
/**
 * Trait implementing the query scope for limiting results to only records belonging a to a particular tenant.
 */
trait PrivilegeDetailsTrait
{
    /**
     * The description of this role.
     *
     * @param mixed $value
     * @return string The description of this role.
     */
    public function getDescriptionAttribute($value)
    {
        $description = $this->description()->first();
        return empty($description) ? '' : $description->value;
    }
    // /**
    //  * The description in the language code defined by $lang of this role.
    //  *
    //  * @param string|null The two letter language code for the language for which you wish to retrieve the description. For example,
    //  * English would be en, French would fr, and spanish would be es.
    //  * @return string|null The description of this role in the language $lang.
    //  */
    // public function getLangDescription(string $lang = null)
    // {
        
    // }
    /**
     * The description of this role.
     *
     * @param mixed $value
     * @return string The description of this role.
     */
    public function getDisplayNameAttribute($value)
    {
        $displayName = $this->displayName()->first();
        return empty($displayName) ? '' : $displayName->value;
    }


    /**
     * All the PrivilegeDetail models that belong to this role.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function details()
    {
        return $this->morphMany('Trailblazer\MultiTenant\PrivilegeDetail', 'owner');
    }
    
    /**
     * The description (PrivilegeDetail where key==description) that belong to this privilege in the given language.
     * 
     * If the $lang param is not provided, the method will use the application's current language code from Config
     *
     * @param string $lang the 2 char language code for the description we want to retrieve. i.e. en, fr, es.
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany Description models
     */
    public function description($lang = null)
    {
        $lang ?? Config::get('local', 'en');
        return ($this->allDescriptions())->lang($lang);
    }

    /**
     * All the descriptions (PrivilegeDetail where key==description) that belong to this privilege.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany Description models
     */
    public function allDescriptions()
    {
        return $this->morphMany('Trailblazer\MultiTenant\Description', 'owner');
    }

    /**
     * The display name (PrivilegeDetail where key==display_name) that belong to this privilege in the given language.
     * 
     * If the $lang param is not provided, the method will use the application's current language code from Config
     *
     * @param string $lang the 2 char language code for the display name we want to retrieve. i.e. en, fr, es.
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany Description models
     */
    public function displayName($lang = null)
    {
        $lang ?? Config::get('local', 'en');
        return ($this->allDisplayNames())->lang($lang);
    }
    
    /**
     * All the descriptions (PrivilegeDetail where key==description) that belong to this privilege.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany Description models
     */
    public function allDisplayNames()
    {
        return $this->morphMany('Trailblazer\MultiTenant\DisplayName', 'owner');
    }
}
