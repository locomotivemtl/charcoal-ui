<?php

namespace Charcoal\Ui\FormInput;

use \Exception;
use \InvalidArgumentException;

/**
 * Provides an implementation of {@see \Charcoal\Ui\FormInput\FormInputAwareInterface}.
 */
trait FormInputAwareTrait
{
    /**
     * The form's display mode for handling multilingual fields.
     *
     * @var string|null
     */
    protected $l10nDisplayMode;

    /**
     * Retrieve the display mode for handling multilingual fields.
     *
     * @return string
     */
    public function l10nDisplayMode()
    {
        if ($this->l10nDisplayMode === null) {
            $this->setL10nDisplayMode($this->defaultL10nDisplayMode());
        }

        return $this->l10nDisplayMode;
    }

    /**
     * Set the display mode for handling multilingual fields.
     *
     * @param  string $mode The l10n display mode.
     * @throws InvalidArgumentException If the display mode is not a string.
     * @return FormInputAwareInterface
     */
    public function setL10nDisplayMode($mode)
    {
        if (!is_string($mode)) {
            throw new InvalidArgumentException(sprintf(
                'The l10n display mode must be a string, received %s',
                (is_object($mode) ? get_class($mode) : gettype($mode))
            ));
        }

        $this->l10nDisplayMode = $mode;

        return $this;
    }

    /**
     * Determine if an L10N display mode is set.
     *
     * @return booleam
     */
    public function hasL10nDisplayMode()
    {
        return !!$this->l10nDisplayMode;
    }

    /**
     * Retrieve the default display mode for handling multilingual fields.
     *
     * @return string
     */
    private function defaultL10nDisplayMode()
    {
        return 'loop_inputs';
    }



    // Satisfies backwards-compatibility
    // =========================================================================

    /**
     * Retrieve the display mode for handling multilingual fields.
     *
     * @deprecated In favor of {@see FormInputAwareInterface::l10nDisplayMode()}.
     * @return string
     */
    public function l10nMode()
    {
        return $this->l10nDisplayMode();
    }

    /**
     * Set the display mode for handling multilingual fields.
     *
     * @deprecated In favor of {@see FormInputAwareInterface::setL10nDisplayMode()}.
     * @param  string $mode The l10n display mode.
     * @return FormInputAwareInterface
     */
    public function setL10nMode($mode)
    {
        return $this->setL10nDisplayMode($mode);
    }
}
