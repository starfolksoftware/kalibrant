<?php

namespace StarfolkSoftware\Kalibrant;

use JsonSerializable;
use Symfony\Component\OptionsResolver\OptionsResolver;

abstract class Settings implements JsonSerializable
{
    /**
     * The model's attributes.
     *
     * @var array
     */
    protected $attributes = [];

    /**
     * The settings values' resolver.
     *
     * @var \Symfony\Component\OptionsResolver\OptionsResolver
     */
    protected OptionsResolver $resolver;

    /**
     * The route to redirect to after update.
     *
     * @var mixed
     */
    public $redirectRoute;

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
                    $attributes,
                    $this->attributes,
                )
            );
        }

        $this->resolver = new OptionsResolver();

        $this->configureAttributes($this->resolver);

        $this->attributes = $this->resolver->resolve($this->attributes);
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
     * Fill the model with an array of attributes.
     *
     * @param  array  $attributes
     * @return $this
     */
    public function fill(array $attributes)
    {
        foreach ($attributes as $key => $value) {
            $this->setAttribute($key, $value);
        }

        return $this;
    }

    /**
     * Set a given attribute on the model.
     *
     * @param  string  $key
     * @param  mixed  $value
     * @return $this
     */
    public function setAttribute($key, $value)
    {
        $this->attributes[$key] = $value;

        return $this;
    }

    /**
     * Get all of the current attributes on the model.
     *
     * @return array
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * Dynamically retrieve attributes on the model.
     *
     * @param  string  $key
     * @return mixed
     */
    public function __get($key)
    {
        return $this->getAttribute($key);
    }

    /**
     * Get an attribute from the model.
     *
     * @param  string  $key
     * @return mixed
     */
    public function getAttribute($key)
    {
        return $this->getAttributeValue($key);
    }

    /**
     * Get a plain attribute (not a relationship).
     *
     * @param  string  $key
     * @return mixed
     */
    protected function getAttributeValue($key)
    {
        $value = $this->getAttributeFromArray($key);

        return $value;
    }

    /**
     * Get an attribute from the $attributes array.
     *
     * @param  string  $key
     * @return mixed
     */
    protected function getAttributeFromArray($key)
    {
        if (array_key_exists($key, $this->attributes)) {
            return $this->attributes[$key];
        }
    }

    /**
     * Dynamically set attributes on the model.
     *
     * @param  string  $key
     * @param  mixed  $value
     * @return void
     */
    public function __set($key, $value)
    {
        $this->setAttribute($key, $value);
    }

    /**
     * Determine if an attribute exists on the model.
     *
     * @param  string  $key
     * @return bool
     */
    public function __isset($key)
    {
        return isset($this->attributes[$key]);
    }

    /**
     * Unset an attribute on the model.
     *
     * @param  string  $key
     * @return void
     */
    public function __unset($key)
    {
        unset($this->attributes[$key]);
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

    /**
     * To array.
     *
     * @return array
     */
    public function toArray()
    {
        return $this->attributes;
    }

    /**
     * Get the JSON serializable representation of the object.
     *
     * @return array
     */
    #[\ReturnTypeWillChange]
    public function jsonSerialize()
    {
        return $this->attributes;
    }
}
