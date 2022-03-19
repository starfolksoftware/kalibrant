<?php

namespace StarfolkSoftware\Kalibrant\Tests\Mocks;

use StarfolkSoftware\Kalibrant\Settings;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TestSettings extends Settings
{
    /**
     * The route to redirect to after update.
     * 
     * @var mixed
     */
    public $redirectRoute = null;

    /**
     * Constructor.
     *
     * @param mixed $id
     * @return void
     */
    public function __construct(
        protected $id
    )
    {
        parent::__construct();
    }

    /**
     * Configure the settings attributes
     * 
     * @param OptionsResolver $resolver
     * 
     * @return void
     */
    public function configureAttributes(OptionsResolver $resolver)
    {
        $resolver->define('attribute1')
           ->default('value1')
           ->allowedTypes('string')
           ->info('Holds the value of attribute1');


        $resolver->define('attribute2')
              ->default('value2')
              ->allowedTypes('string')
              ->info('Holds the value of attribute2');
    }

    /**
     * Returns the setable type
     * 
     * @return string
     */
    public static function setableType()
    {
        return TestUser::class;
    }

    /**
     * Returns the setable id
     * 
     * @return int
     */
    public function setableId()
    {
        return $this->id;
    }

    /**
     * Return the settings group
     * 
     * @return string
     */
    public static function group()
    {
        return 'test-settings';
    }
}