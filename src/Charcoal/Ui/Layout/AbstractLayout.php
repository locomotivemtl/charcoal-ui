<?php

namespace Charcoal\Ui\Layout;

// From 'charcoal-config'
use Charcoal\Config\AbstractEntity;

// Intra-module (`charcoal-ui`) dependencies
use Charcoal\Ui\Layout\LayoutInterface;
use Charcoal\Ui\Layout\LayoutTrait;

/**
 * A Basic Layout
 *
 * Abstract implementation of {@see \Charcoal\Ui\Layout\LayoutInterface}.
 */
abstract class AbstractLayout extends AbstractEntity implements
    LayoutInterface
{
    use LayoutTrait;
}
