<?php

namespace Charcoal\Ui;

use \InvalidArgumentException;

// PSR-3 (logger) dependencies
use \Psr\Log\LoggerAwareInterface;
use \Psr\Log\LoggerAwareTrait;
use \Psr\Log\NullLogger;

// Module `pimple` dependencies
use \Pimple\Container;

// Module `charcoal-config` dependencies
use \Charcoal\Config\AbstractEntity;

// Module `charcoal-core` dependencies
use \Charcoal\Translation\TranslationString;

// Module `charcoal-view` dependencies
use \Charcoal\View\ViewableInterface;
use \Charcoal\View\ViewableTrait;

// Intra-module (`charcoal-ui`) dependencies
use \Charcoal\Ui\UiItemInterface;
use \Charcoal\Ui\UiItemTrait;

/**
 *
 */
abstract class AbstractUiItem extends AbstractEntity implements
    LoggerAwareInterface,
    UiItemInterface
{
    use LoggerAwareTrait;
    use ViewableTrait;
    use UiItemTrait;

    /**
     * @param array $data Constructor options.
     */
    public function __construct(array $data=null)
    {
        if (!isset($data['logger'])) {
            $data['logger'] = new NullLoger;
        }
        $this->setLogger($data['logger']);

        if (isset($data['container'])) {
            $this->setDependencies($data['container']);
        }
    }

    /**
     * @param Container $container Pimple DI Container
     */
    public function setDependencies(Container $container)
    {
        // Void
    }
}
