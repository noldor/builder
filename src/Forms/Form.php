<?php


namespace Noldors\Builder\Forms;

use Noldors\Builder\Elements\Elements;
use Noldors\Builder\Traits\HtmlAttributes;
use Noldors\Builder\Traits\Renderable;
use Noldors\Builder\Contracts\Renderable as RenderableInterface;


/**
 * Class Form
 *
 * @package Noldors\Form
 * @author  Dmitriy Romanov <romanov@noldor.pro>
 */
class Form implements RenderableInterface
{
    use HtmlAttributes, Renderable;

    /**
     * Blade template for form.
     *
     * @var string
     */
    protected $view = 'builder::forms.default';

    /**
     * Form action.
     *
     * @var string
     */
    protected $action = '';

    /**
     * Form method.
     *
     * @var string
     */
    protected $method = '';

    /**
     * Form buttons.
     *
     * @var \Noldors\Builder\Elements\Elements
     */
    protected $buttons;

    /**
     * Form fields.
     *
     * @var \Noldors\Builder\Elements\Elements
     */
    protected $elements;

    /**
     * Form constructor.
     *
     * @param \Noldors\Builder\Elements\Elements $buttons
     * @param \Noldors\Builder\Elements\Elements $elements
     */
    public function __construct(Elements $buttons, Elements $elements)
    {
        $this->buttons = $buttons;
        $this->elements = $elements;
        $this->setHtmlAttributes(config('builder.form_default_attributes'));
    }

    /**
     * Create instance statically.
     *
     * @param \Noldors\Builder\Elements\Elements $buttons
     * @param \Noldors\Builder\Elements\Elements $elements
     *
     * @return \Noldors\Builder\Forms\Form
     */
    public static function make(Elements $buttons, Elements $elements)
    {
        return new Form($buttons, $elements);
    }

    /**
     * Get form method.
     *
     * @return string
     */
    public function getMethod():string
    {
        return $this->method;
    }

    /**
     * Set form method.
     *
     * @param string $method
     *
     * @return $this
     */
    public function setMethod(string $method)
    {
        $this->method = $method;

        return $this;
    }

    /**
     * Get form action.
     *
     * @return string
     */
    public function getAction():string
    {
        return $this->action;
    }

    /**
     * Set form action.
     *
     * @param string $action
     *
     * @return $this
     */
    public function setAction(string $action)
    {
        $this->action = $action;

        return $this;
    }

    /**
     * Get all form elements. Fields or groups.
     * @return \Noldors\Builder\Elements\Elements
     */
    public function getElements()
    {
        return $this->elements;
    }

    /**
     * Get all form buttons.
     *
     * @return \Noldors\Builder\Elements\Elements
     */
    public function getButtons()
    {
        return $this->buttons;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'method'     => $this->getMethod(),
            'action'     => $this->getAction(),
            'buttons'    => $this->buttons->all(),
            'attributes' => $this->htmlAttributesToString(),
            'fields'     => $this->elements->all()
        ];
    }

    /**
     * Array for json response.
     *
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'method'     => $this->getMethod(),
            'action'     => $this->getAction(),
            'buttons'    => $this->buttons->all(),
            'attributes' => $this->getHtmlAttributes(),
            'fields'     => $this->elements->all()
        ];
    }
}