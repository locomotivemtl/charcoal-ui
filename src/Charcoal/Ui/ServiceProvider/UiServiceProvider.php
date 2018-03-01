<?php

namespace Charcoal\Ui\ServiceProvider;

// From Pimple
use Pimple\Container;
use Pimple\ServiceProviderInterface;

// From 'charcoal-user'
use Charcoal\User\ServiceProvider\AuthServiceProvider;

// From 'charcoal-ui'
use Charcoal\Ui\ServiceProvider\DashboardServiceProvider;
use Charcoal\Ui\ServiceProvider\FormServiceProvider;
use Charcoal\Ui\ServiceProvider\LayoutServiceProvider;
use Charcoal\Ui\ServiceProvider\MenuServiceProvider;

// From 'charcoal-view'
use Charcoal\View\DynamicTemplateRegistry;

/**
 *
 */
class UiServiceProvider implements ServiceProviderInterface
{
    /**
     * @param Container $container A Pimple DI container.
     * @return void
     */
    public function register(Container $container)
    {
        $container->register(new AuthServiceProvider());
        $container->register(new DashboardServiceProvider());
        $container->register(new FormServiceProvider());
        $container->register(new LayoutServiceProvider());
        $container->register(new MenuServiceProvider());

        $this->registerViewExtensions($container);
    }

    /**
     * Registers view service modifications.
     *
     * @param  Container $container The Pimple DI container.
     * @return void
     */
    protected function registerViewExtensions(Container $container)
    {
        /**
         * @param  Container $container A container instance.
         * @return DynamicTemplateRegistry
         */
        $container['view/loader/template-registry'] = function (Container $container) {
            return new DynamicTemplateRegistry();
        };
    }
}
