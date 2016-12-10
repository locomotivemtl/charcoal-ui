<?php

namespace Charcoal\Ui\Form;

use \InvalidArgumentException;

// From 'charcoal-factory'
use \Charcoal\Factory\FactoryInterface;

// From 'charcoal-ui'
use \Charcoal\Ui\Form\FormInterface;

/**
 * Provides an implementation of {@see \Charcoal\Ui\Form\FormInterface}.
 */
trait FormTrait
{
    /**
     * The program that processes the form information.
     *
     * @var string
     */
    private $action = '';

    /**
     * The HTTP method that the browser uses to submit the form.
     *
     * @var string
     */
    private $method = FormInterface::HTTP_METHOD_POST;

    /**
     * Valid HTTP methods for a form.
     *
     * @var string[]
     */
    protected $validMethods = [
        FormInterface::HTTP_METHOD_POST => 1,
        FormInterface::HTTP_METHOD_GET  => 1,
    ];

    /**
     * The form's predefined data.
     *
     * @var array
     */
    private $formData = [];

    /**
     * Store the form's metadata instance.
     *
     * @var MetadataInterface
     */
    private $metadata;

    /**
     * Set the program that processes the form information.
     *
     * @param  string $action The form action, typically a URI.
     * @throws InvalidArgumentException If the action argument is not a string.
     * @return FormInterface Chainable
     */
    public function setAction($action)
    {
        if ($action === null || $action === '') {
            $this->action = '';
            return $this;
        }

        if (!is_string($action)) {
            throw new InvalidArgumentException(sprintf(
                'The form action must be a string, received %s',
                (is_object($action) ? get_class($action) : gettype($action))
            ));
        }

        $this->action = $action;

        return $this;
    }

    /**
     * Retrieve the program that processes the form information.
     *
     * @return string
     */
    public function action()
    {
        return $this->action;
    }

    /**
     * Set the HTTP method used to submit the form.
     *
     * Possible values are:
     * - {@see FormInterface::HTTP_METHOD_POST `post`}
     * - {@see FormInterface::HTTP_METHOD_GET `get`}
     *
     * @param  string $method The HTTP method, usually one of GET or POST.
     * @throws InvalidArgumentException If the method is invalid.
     * @throws InvalidArgumentException If the method is unsupported.
     * @return FormInterface Chainable
     */
    public function setMethod($method)
    {
        if ($method === null || $method === '') {
            $this->method = $this->defaultMethod();
            return $this;
        }

        if (!is_string($method)) {
            throw new InvalidArgumentException(sprintf(
                'The form method must be a string, received %s',
                (is_object($method) ? get_class($method) : gettype($method))
            ));
        }

        $method = strtolower($method);
        if (!isset($this->validMethods[$method])) {
            throw new InvalidArgumentException(sprintf(
                'Unsupported HTTP method "%s" provided',
                $method
            ));
        }

        $this->method = $method;

        return $this;
    }

    /**
     * Retrieve the default HTTP method.
     *
     * @return string
     */
    private function defaultMethod()
    {
        return FormInterface::DEFAULT_HTTP_METHOD;
    }

    /**
     * Retrieve the HTTP method used to submit the form.
     *
     * @return string
     */
    public function method()
    {
        return $this->method;
    }

    /**
     * Set the form's dataset.
     *
     * @param  array $data Key/value pairs representing form fields and their values.
     * @return FormInterface Chainable
     */
    public function setFormData(array $data)
    {
        $this->formData = $data;

        return $this;
    }

    /**
     * Append a new value, or merge a new array, onto the form's dataset.
     *
     * @param  string|array $key The name of the field whose data is contained in $value
     *     or an array of key/value pairs to merge with existing data.
     * @param  mixed        $val The field's value if $key is a string.
     * @throws InvalidArgumentException If the key argument is not a string.
     * @return FormInterface Chainable
     */
    public function addFormData($key, $val)
    {
        if (is_array($key)) {
            $this->formData = array_merge($this->formData, $key);
            return $this;
        }

        if (!is_string($key)) {
            throw new InvalidArgumentException(sprintf(
                'Form data key must be a string, received %s',
                (is_object($key) ? get_class($key) : gettype($key))
            ));
        }

        $this->formData[$key] = $val;

        return $this;
    }

    /**
     * Retrieve the form's dataset.
     *
     * @return array
     */
    public function formData()
    {
        return $this->formData;
    }
}
