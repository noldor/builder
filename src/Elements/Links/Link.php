<?php


namespace Noldors\Builder\Elements\Links;


use Noldors\Builder\Contracts\NamedElement;
use Noldors\Builder\Traits\HtmlAttributes;
use Noldors\Builder\Traits\Renderable;

/**
 * Class Link
 *
 * @package Noldors\Builder\Elements\Links
 * @author  Dmitriy Romanov <romanov@noldor.pro>
 */
class Link implements NamedElement
{
    use HtmlAttributes, Renderable;

    /**
     * Blade template for link.
     *
     * @var string
     */
    protected $view = 'builder::elements.links.link';

    /**
     * Link text.
     *
     * @var string
     */
    protected $text;

    /**
     * Link url.
     *
     * @var string
     */
    protected $url;

    /**
     * Link icon.
     *
     * @var string
     */
    protected $icon = '';

    /**
     * Link name.
     *
     * @var string
     */
    protected $name;

    /**
     * Link constructor.
     *
     * @param string $name
     * @param string $text
     * @param string $url
     */
    public function __construct(string $name, string $text, string $url)
    {
        $this->text = $text;
        $this->url = $url;
    }

    /**
     * Create instance statically.
     *
     * @param string $name
     * @param string $text
     * @param string $url
     *
     * @return \Noldors\Builder\Elements\Links\Link
     */
    public static function create(string $name, string $text, string $url)
    {
        return new self($name, $text, $url);
    }

    /**
     * Get link name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set icon for link.
     *
     * @param $icon
     *
     * @return $this
     */
    public function setIcon(string $icon)
    {
        $this->icon = $icon;

        return $this;
    }

    /**
     * Get icon for link.
     *
     * @return string
     */
    public function getIcon():string
    {
        return $this->icon;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'attributes' => $this->htmlAttributesToString(),
            'icon' => $this->getIcon(),
            'text' => $this->text,
            'url' => $this->url
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
            'icon' => $this->getIcon(),
            'text' => $this->text,
            'url' => $this->url
        ];
    }


}