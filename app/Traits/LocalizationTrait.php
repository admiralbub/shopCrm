<?php 
namespace App\Traits;

trait LocalizationTrait
{
    public function getNameAttribute()
    {
        return $this->getLocalizedAttr('name');
    }
    public function getDescriptionAttribute()
    {
        return $this->getLocalizedAttr('description');
    }
    public function getBodyAttribute()
    {
        return $this->getLocalizedAttr('body');
    }
    public function getH1Attribute()
    {
        return $this->getLocalizedAttr('h1');
    }
    public function getMetaTitleAttribute()
    {
        return $this->getLocalizedAttr('meta_title');
    }
    public function getMetaDescriptionAttribute()
    {
        return $this->getLocalizedAttr('meta_description');
    }
    public function getMetaKeywordsAttribute()
    {
        return $this->getLocalizedAttr('meta_keywords');
    }

    public function getLocalizedAttrName($name)
    {
        return $name . '_' . app()->getLocale();
    }
    public function getLocalizedAttr($name, $defaultLocaleWhenEmpty = false)
    {
        $attr = $this->getAttribute($this->getLocalizedAttrName($name));

        if (empty($attr) && $defaultLocaleWhenEmpty) {
            $attr = $this->getAttribute($name . '_' .app()->getLocale());
        }

        return $attr;
    }

        
}

?>