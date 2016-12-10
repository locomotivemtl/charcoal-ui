<?php

namespace Charcoal\Ui\Form;

// Intra-module (`charcoal-ui`) dependencies
use \Charcoal\Ui\AbstractUiItem;
use \Charcoal\Ui\Form\FormInterface;
use \Charcoal\Ui\Form\FormTrait;
use \Charcoal\Ui\FormGroup\FormGroupAwareInterface;
use \Charcoal\Ui\FormGroup\FormGroupAwareTrait;
use \Charcoal\Ui\FormInput\FormInputAwareInterface;
use \Charcoal\Ui\FormInput\FormInputAwareTrait;
use \Charcoal\Ui\Layout\LayoutAwareInterface;
use \Charcoal\Ui\Layout\LayoutAwareTrait;

/**
 * A Basic Form
 *
 * Abstract implementation of {@see \Charcoal\Ui\Form\FormInterface}.
 */
abstract class AbstractForm extends AbstractUiItem implements
    FormInterface,
    FormInputAwareInterface,
    FormGroupAwareInterface,
    LayoutAwareInterface
{
    use FormTrait;
    use FormInputAwareTrait;
    use FormGroupAwareTrait;
    use LayoutAwareTrait;

    /**
     * Returns a new form.
     *
     * @param array|\ArrayAccess $data The class dependencies.
     */
    public function __construct($data = null)
    {
        /** Satisfies {@see \Charcoal\Ui\Form\FormTrait} */
        $this->setFormGroupFactory($data['form_group_factory']);

        /** Satisfies {@see \Charcoal\Ui\Layout\LayoutAwareInterface} */
        $this->setLayoutBuilder($data['layout_builder']);
    }

    /**
     * Retrieve the default form group class name.
     *
     * @return string
     */
    public function defaultGroupType()
    {
        return 'charcoal/ui/form-group/generic';
    }
}
