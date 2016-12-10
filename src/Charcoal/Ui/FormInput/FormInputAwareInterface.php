<?php

namespace Charcoal\Ui\FormInput;

use \RuntimeException;
use \InvalidArgumentException;

// From 'charcoal-factory'
use \Charcoal\Factory\FactoryInterface;

// From 'charcoal-ui'
use \Charcoal\Ui\Form\FormInterface;
use \Charcoal\Ui\FormGroup\FormGroupInterface;

/**
 * Defines a UI that manages {@see FormInputInterface form controls}.
 *
 * Implementation, as trait, provided by {@see \Charcoal\Ui\FormInput\FormInputAwareTrait}.
 */
interface FormInputAwareInterface
{
    // Layout
    // =========================================================================

    /**
     * Retrieve the display mode for handling multilingual fields.
     *
     * @return string
     */
    public function l10nDisplayMode();

    /**
     * Set the display mode for handling multilingual fields.
     *
     * @param  string $mode The l10n display mode.
     * @return FormInputAwareInterface
     */
    public function setL10nDisplayMode($mode);
}
