<?php

namespace StarfolkSoftware\Setting;

use Symfony\Component\OptionsResolver\OptionsResolver;

abstract class Settings extends Model
{
    /**
     * The settings values' resolver.
     *
     * @var \Symfony\Component\OptionsResolver\OptionsResolver
     */
    protected OptionsResolver $resolver;

    /**
     * Creates a new Eloquent model instance.
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
     * Configures the settings attributes
     * 
     * @param OptionsResolver $resolver
     * 
     * @return void
     */
    abstract public function configureAttributes(OptionsResolver $resolver);

    /**
     * Returns the setable type
     * 
     * @return string
     */
    abstract public static function setableType();

    /**
     * Returns the setable id
     * 
     * @return int
     */
    abstract public function setableId();

    /**
     * Returns the settings group
     * 
     * @return string
     */
    abstract public static function group();

    /**
     * Validation rules.
     * 
     * @return array
     */
    public function rules(): array
    {
        return [];
    }

    /**
     * Returns resolver.
     * 
     * @return \Symfony\Component\OptionsResolver\OptionsResolver
     */
    public function getResolver(): OptionsResolver
    {
        return $this->resolver;
    }

    /**
     * Updates settings
     * 
     * @return void
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
}
