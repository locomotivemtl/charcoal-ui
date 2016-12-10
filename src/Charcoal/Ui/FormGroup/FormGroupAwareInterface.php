<?php

namespace Charcoal\Ui\FormGroup;

use \RuntimeException;
use \InvalidArgumentException;

// From 'charcoal-factory'
use \Charcoal\Factory\FactoryInterface;

// From 'charcoal-ui'
use \Charcoal\Ui\Form\FormInterface;
use \Charcoal\Ui\FormGroup\FormGroupInterface;

/**
 * Defines a UI that manages {@see FormGroupInterface form groups}.
 *
 * Implementation, as trait, provided by {@see \Charcoal\Ui\FormGroup\FormGroupAwareTrait}.
 */
interface FormGroupAwareInterface
{
    /**
     * Set the form group factory.
     *
     * @param  FactoryInterface $factory A factory, to create customized form gorup objects.
     * @return FormGroupAwareInterface
     */
    public function setFormGroupFactory(FactoryInterface $factory);

    /**
     * Retrieve the form group factory.
     *
     * @return FactoryInterface
     */
    public function formGroupFactory();

    /**
     * Set the form group callback.
     *
     * @param  mixed $callback The callback routine.
     * @return FormGroupAwareInterface
     */
    public function setGroupCallback($callback);

    /**
     * Set the object's form groups.
     *
     * @param array $groups A collection of group structures.
     * @return FormGroupAwareInterface
     */
    public function setGroups(array $groups);

    /**
     * Add a form group.
     *
     * @param string                   $groupIdent The group identifier.
     * @param array|FormGroupInterface $group      The group object or structure.
     * @return FormGroupAwareInterface
     */
    public function addGroup($groupIdent, $group);

    /**
     * Retrieve the form groups.
     *
     * @param callable $groupCallback Optional callback applied to each form group.
     * @return FormGroupInterface[]|Generator
     */
    public function groups(callable $groupCallback = null);

    /**
     * Determine if the form has any groups.
     *
     * @return boolean
     */
    public function hasGroups();

    /**
     * Determine if the form has a given group.
     *
     * @param string $groupIdent The group identifier to look up.
     * @return boolean
     */
    public function hasGroup($groupIdent);

    /**
     * Count the number of form groups.
     *
     * @return integer
     */
    public function numGroups();


    // Layout
    // =========================================================================

    /**
     * Retrieve the display mode for handling field groups.
     *
     * @return string
     */
    public function groupDisplayMode();

    /**
     * Set the display mode for handling field groups.
     *
     * @param  string $mode The group display mode.
     * @return FormGroupAwareInterface
     */
    public function setGroupDisplayMode($mode);
}
