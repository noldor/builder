<?php


namespace Noldors\Builder\Breadcrumbs;


use Noldors\Builder\Contracts\ElementInterface;
use Noldors\Builder\Elements\Elements;
use Noldors\Builder\Elements\Links\Links;
use Noldors\Builder\Traits\HtmlAttributes;
use Noldors\Builder\Traits\Renderable;

class Breadcrumbs implements ElementInterface
{
    use HtmlAttributes, Renderable;

    protected $view = 'builder::breadcrumbs';

    protected $elements;

    public function __construct(Elements $elements)
    {
        $this->elements = $elements;
    }

    public static function create(Elements $elements)
    {
        return new self($elements);
    }

    public function toArray()
    {
        return [
            'attributes' => $this->htmlAttributesToString(),
            'breadcrumbs' => $this->elements->all()
        ];
    }

}