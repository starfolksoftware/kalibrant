<?php

namespace StarfolkSoftware\Setting;

use Symfony\Component\OptionsResolver\OptionsResolver;

abstract class SettingAbstract extends ModelAbstract
{
    protected $hidden = [];

    protected $guarded = [];

    protected $casts = [];

    protected $resolver;

    /**
     * Create a new Eloquent model instance.
     *
     * @return void
     */
    public function __construct()
    {
        $attributes = Setting::attributesInGroup(
            static::setableType(), 
            static::setableId(), 
            static::group()
        );

        if (! empty($attributes)) {
            $this->fill(
                array_merge(
                    $this->attributes,
                    $attributes
                )
            );
        }

        $this->resolver = new OptionsResolver();
        
        $this->configureAttributes($this->resolver);

        $this->attributes = $this->resolver->resolve($this->attributes);

        parent::__construct($this->attributes);
    }

    /**
     * Configure the settings attributes
     * 
     * @param OptionsResolver $resolver
     * 
     * @return void
     */
    abstract public function configureAttributes(OptionsResolver $resolver);

    /**
     * Return the settings group
     * 
     * @return string
     */
    abstract public static function setableType();

    /**
     * Return the team id
     * 
     * @return int
     */
    abstract public static function setableId();

    /**
     * Return the settings group
     * 
     * @return string
     */
    abstract public static function group();

    /**
     * Update settings
     * 
     */
    public function save()
    {
        collect($this->attributes)->each(function ($attribute, $key) {
            Setting::updateOrCreate(
                [
                    'setable_type' => static::setableType(), 
                    'setable_id' => static::setableId(), 
                    'group' => static::group(),
                    'key' => $key,
                ],
                ['value' => json_encode($attribute)]
            );
        });
    }

    /**
     * Get defined attributes
     * 
     * @return array
     */
    public function getDefinedAttributes()
    {
        return $this->resolver->getDefinedOptions();
    }
}
