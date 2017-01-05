<?php


namespace Noldors\Builder\Menus;


use Noldors\Builder\Contracts\ElementsCollectionInterface;
use Noldors\Builder\Traits\HtmlAttributes;
use Noldors\Builder\Traits\Renderable;

class Menu
{
    use HtmlAttributes, Renderable;

    protected $view = 'builder::menu';

    protected $links;

    public function __construct(ElementsCollectionInterface $links)
    {
        $this->links = $links;
    }

    public static function create(ElementsCollectionInterface $links)
    {
        return new self($links);
    }

    public function toArray()
    {
        return [
            'attributes' => $this->htmlAttributesToString(),
            'links' => $this->links->getElements()
        ];
    }

}