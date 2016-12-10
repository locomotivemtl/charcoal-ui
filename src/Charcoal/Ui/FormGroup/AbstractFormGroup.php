<?php

namespace Charcoal\Ui\FormGroup;

// From 'charcoal-ui'
use \Charcoal\Ui\AbstractUiItem;
use \Charcoal\Ui\FormInput\FormInputAwareInterface;
use \Charcoal\Ui\FormInput\FormInputAwareTrait;
use \Charcoal\Ui\FormGroup\FormGroupInterface;
use \Charcoal\Ui\FormGroup\FormGroupTrait;
use \Charcoal\Ui\Layout\LayoutAwareInterface;
use \Charcoal\Ui\Layout\LayoutAwareTrait;

/**
 * A Basic Form Group
 *
 * Abstract implementation of {@see \Charcoal\Ui\FormGroup\FormGroupInterface}.
 */
abstract class AbstractFormGroup extends AbstractUiItem implements
    FormGroupInterface,
    FormInputAwareInterface,
    LayoutAwareInterface
{
    use FormGroupTrait;
    use FormInputAwareTrait;
    use LayoutAwareTrait;

    /**
     * Returns a new form group.
     *
     * @param array|\ArrayAccess $data The class depdendencies.
     */
    public function __construct($data)
    {
        parent::__construct($data);

        if (isset($data['form'])) {
            $this->setForm($data['form']);
        }

        /** Satisfies {@see \Charcoal\Ui\FormGroup\FormGroupTrait} */
        $this->setFormInputBuilder($data['form_input_builder']);

        /** Satisfies {@see \Charcoal\Ui\Layout\LayoutAwareInterface} */
        $this->setLayoutBuilder($data['layout_builder']);
    }

    /**
     * @param  array|\ArrayAccess $data Widget data.
     * @return self
     */
    public function setData($data)
    {
        if (isset($data['permissions'])) {
            $this->setRequiredAclPermissions($data['permissions']);
            unset($data['permissions']);
        }

        parent::setData($data);

        return $this;
    }
}
