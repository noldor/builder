<?php


namespace Noldors\Builder\Elements\Links;


use Illuminate\Support\Collection;
use Noldors\Builder\Contracts\ElementInterface;
use Noldors\Builder\Traits\ElementsCollection;
use Noldors\Builder\Traits\HtmlAttributes;
use Noldors\Builder\Traits\Renderable;

/**
 * Class MenuLink
 *
 * @package Noldors\Builder\Elements\Links
 * @author  Dmitriy Romanov <romanov@noldor.pro>
 */
class MenuLink extends Link implements ElementInterface
{
    use HtmlAttributes, Renderable, ElementsCollection;

    /**
     * @var string
     */
    protected $view = 'builder::elements.links.menu_link';

    /**
     * MenuLink constructor.
     *
     * @param string $text
     * @param string $url
     */
    public function __construct($text, $url)
    {
        parent::__construct($text, $url);
        $this->elements = new Collection();
    }

    /**
     * Create instance statically
     *
     * @param $text
     * @param $url
     *
     * @return \Noldors\Builder\Elements\Links\MenuLink
     */
    public static function create($text, $url)
    {
        return new self($text, $url);
    }

    /**
     * Set element with given key and element type.
     *
     * $element must implements \Noldors\Form\Contracts\ElementInterface.
     *
     * @param mixed                                       $key     new element key
     * @param \Noldors\Builder\Elements\Links\MenuLink $element new element
     *
     * @return $this
     */
    public function setElement($key, MenuLink $element)
    {
        $this->elements->put($key, $element);

        return $this;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $array = parent::toArray();
        $array['submenus'] = $this->getElements();

        return $array;
    }

}