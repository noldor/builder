<?php


namespace Noldors\Builder\Elements;

use Noldors\Builder\Contracts\NamedElement;
use Noldors\Builder\Traits\HtmlAttributes;
use Noldors\Builder\Traits\Renderable;


class Group implements NamedElement
{
    use HtmlAttributes, Renderable;

    /**
     * Elements in group.
     *
     * @var Elements
     */
    protected $elements;

    /**
     * Group name.
     *
     * @var string
     */
    protected $name;
    /**
     * Blade template for button group.
     *
     * @var string
     */
    protected $view = 'builder::elements.group';

    /**
     * ElementsGroup constructor.
     *
     * @param string                             $name
     * @param \Noldors\Builder\Elements\Elements $elements
     */
    public function __construct(string $name, Elements $elements)
    {
        $this->elements = $elements;
        $this->name = $name;
    }

    /**
     * Create instance statically.
     *
     * @param string                             $name
     * @param \Noldors\Builder\Elements\Elements $elements
     *
     * @return \Noldors\Builder\Elements\ElementsGroup
     */
    public function make(string $name, Elements $elements)
    {
        return new self($name, $elements);
    }

    /**
     * Get group name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get all group elements.
     *
     * @return \Noldors\Builder\Elements\Elements
     */
    public function getElements()
    {
        return $this->elements;
    }

    /**
     * @return array
     */
    public function toArray():array
    {
        return [
            'attributes' => $this->htmlAttributesToString(),
            'elements'  => $this->elements->all(),
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
            'attributes' => $this->getHtmlAttributes(),
            'elements'  => $this->elements->all(),
        ];
    }

}