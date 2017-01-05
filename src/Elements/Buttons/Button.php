<?php


namespace Noldors\Builder\Elements\Buttons;

use Noldors\Builder\Contracts\NamedElement;
use Noldors\Builder\Traits\HtmlAttributes;
use Noldors\Builder\Traits\Renderable;

/**
 * Class Button
 *
 * @package Noldors\Builder\Buttons
 * @author  Dmitriy Romanov <romanov@noldor.pro>
 */
class Button implements NamedElement
{
    use HtmlAttributes, Renderable;

    /**
     * Blade template for button.
     *
     * @var string
     */
    protected $view = 'builder::elements.buttons.button';

    /**
     * Button unique name.
     *
     * @var string
     */
    protected $name = '';

    /**
     * Button text.
     *
     * @var string
     */
    protected $text = '';

    /**
     * Button type.
     *
     * @var string
     */
    protected $type = 'button';

    /**
     * Button link.
     *
     * @var string
     */
    protected $url = '';

    /**
     * Button icon.
     *
     * @var string
     */
    protected $icon = '';

    /**
     * Icon position.
     *
     * @var string
     */
    protected $iconPosition = 'left';

    /**
     * Button constructor.
     *
     * @param string $name
     * @param string $text
     * @param string $type
     * @param string $url
     */
    public function __construct(string $name, string $text, string $type = 'button', string $url = '')
    {
        $this->name = $name;
        $this->text = $text;
        $this->type = $type;
        $this->url = $url;
        $this->setHtmlAttributes(config('builder.button_default_attributes'));
    }

    /**
     * Create instance statically.
     *
     * @param string $name unique button name
     * @param string $text
     * @param string $type
     * @param string $link
     *
     * @return \Noldors\Builder\Elements\Buttons\Button
     */
    public static function make(string $name, string $text, string $type = 'button', string $link = '')
    {
        return new self($name, $text, $type, $link);
    }

    /**
     * Get button unique name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set icon and place it to right.
     *
     * @param string $icon
     *
     * @return $this
     */
    public function setIconRight(string $icon)
    {
        $this->iconPosition = 'right';

        $this->icon = $icon;

        return $this;
    }

    /**
     * @return array
     */
    public function toArray():array
    {
        return [
            'attributes'   => $this->htmlAttributesToString(),
            'type'         => $this->getType(),
            'icon'         => $this->getIcon(),
            'iconPosition' => $this->iconPosition,
            'text'         => $this->text,
            'url'          => $this->getUrl()
        ];
    }

    /**
     * Get button type.
     *
     * @return string
     */
    public function getType():string
    {
        return $this->type;
    }

    /**
     * Get button icon.
     *
     * @return string;
     */
    public function getIcon():string
    {
        return $this->icon;
    }

    /**
     * Set icon for button.
     *
     * @param string $icon
     *
     * @return $this
     */
    public function setIcon(string $icon)
    {
        $this->icon = $icon;

        return $this;
    }

    /**
     * Get link
     *
     * @return string
     */
    public function getUrl():string
    {
        return $this->url;
    }

    /**
     * Set link
     *
     * @param string $url
     *
     * @return Button
     */
    public function setUrl(string $url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Array for json response.
     *
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'attributes'   => $this->getHtmlAttributes(),
            'type'         => $this->getType(),
            'icon'         => $this->getIcon(),
            'iconPosition' => $this->iconPosition,
            'text'         => $this->text,
            'url'          => $this->getUrl()
        ];
    }
}