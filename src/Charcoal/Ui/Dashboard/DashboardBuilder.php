<?php

namespace Charcoal\Ui\Dashboard;

use \Pimple\Container;

use \Charcoal\Factory\FactoryInterface;

/**
 *
 */
class DashboardBuilder
{
    const DEFAULT_TYPE = 'charcoal/ui/dashboard/generic';

    /**
     * @var FactoryInterface $factory
     */
    protected $factory;

    /**
     * A Pimple dependency-injection container to fulfill the required services.
     * @var Container $container
     */
    protected $container;

    /**
     * @param FactoryInterface $factory   An object factory.
     * @param Container        $container The DI container.
     */
    public function __construct(FactoryInterface $factory, Container $container)
    {
        $this->factory = $factory;
        $this->container = $container;
    }

    /**
     * @param array|\ArrayAccess $options The form group build options / config.
     * @return FormGroupInterface
     */
    public function build($options)
    {
        $objType = isset($options['type']) ? $options['type'] : self::DEFAULT_TYPE;

        $obj = $this->factory->create($objType);
        $obj->setData($options);
        return $obj;
    }
}