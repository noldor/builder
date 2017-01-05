<?php


namespace Noldors\Builder\Elements\Links;

use Noldors\Builder\Contracts\NamedElement;
use Noldors\Builder\Traits\HtmlAttributes;
use Noldors\Builder\Traits\Renderable;

class Text implements NamedElement
{
    use HtmlAttributes, Renderable;

    protected $view = 'builder::elements.links.text';

    /**
     * Name.
     * 
     * @var string
     */
    protected $name;

    protected $text;

    public function __construct(string $name, string $text)
    {
        $this->name = $name;
        $this->text = $text;
    }

    public function getName()
    {
        return $this->name;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'attributes' => $this->htmlAttributesToString(),
            'name' => $this->name,
            'text' => $this->text
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
            'attributes' => $this->htmlAttributesToString(),
            'name' => $this->name,
            'text' => $this->text
        ];
    }

}