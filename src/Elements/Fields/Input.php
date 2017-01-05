<?php


namespace Noldors\Builder\Elements\Fields;


/**
 * Class Input
 *
 * @package Noldors\Builder\Elements
 * @author  Dmitriy Romanov <romanov@noldor.pro>
 */
class Input extends Field
{
    /**
     * Input blade template.
     *
     * @var string
     */
    protected $view = 'builder::elements.fields.input';
    /**
     * Input type.
     *
     * @var string
     */
    protected $type;

    /**
     * Input icon.
     *
     * @var string
     */
    protected $icon;

    /**
     * Right icon.
     *
     * @var string
     */
    //protected $iconRight;

    /**
     * Maximum character in input.
     *
     * @var bool|int
     */
    protected $limit = false;

    /**
     * Addon text before.
     *
     * @var string
     */
    //protected $addonBefore = false;

    /**
     * Addon text after.
     *
     * @var string
     */
    //protected $addonAfter = false;

    /**
     * Input constructor.
     *
     * @param string $type
     * @param string $name
     * @param mixed  $value
     * @param string $label
     */
    public function __construct(string $type, string $name, string $label = '')
    {
        $this->type = $type;
        parent::__construct($name, $label);
        $this->setHtmlAttributes('field', config('builder.field_input_default_attributes'));
        if ($type == 'textarea') {
            $this->setHtmlAttributes('field', config('builder.textarea_default_attributes'));
        }
        //$this->setHtmlAttribute('field', 'placeholder', trans("builder::fields.placeholder_{$name}"));
    }

    /**
     * Create instance statically.
     *
     * @param $type
     * @param $name
     * @param $value
     * @param $label
     *
     * @return \Noldors\Builder\Elements\Fields\Input
     */
    public static function make($type, $name, $value = '', $label = false)
    {
        return new self($type, $name, $value, $label);
    }

    /**
     * Get input type.
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Get field icon.
     *
     * @return string
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * Get right icon.
     *
     * @return string
     */
//    public function getIconRight()
//    {
//        return $this->iconRight;
//    }

    /**
     * Set field icon on left.
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
     * Set field icon on right.
     *
     * @param string $icon
     *
     * @return $this
     */
//    public function setIconRight(string $icon)
//    {
//        $this->iconRight = $icon;
//
//        return $this;
//    }

    /**
     * Set maximum number of characters in input.
     *
     * @param int $limit
     *
     * @return $this
     */
    public function setLimit(int $limit)
    {
        $this->limit = $limit;

        $this->setHtmlAttribute('field', 'maxlength', $limit);

        return $this;
    }

    /**
     * Set maximum number of characters in input.
     *
     * @return bool|int
     */
    public function getLimit()
    {
        return $this->limit;
    }

    /**
     * Get addon text before input.
     *
     * @return mixed
     */
//    public function getAddonBefore()
//    {
//        return $this->addonBefore;
//    }

    /**
     * Set addon text before input.
     *
     * @param string $content
     *
     * @return $this
     */
//    public function setAddonBefore($content)
//    {
//        $this->addonBefore = $content;
//
//        return $this;
//    }

    /**
     * Get addon text after input.
     *
     * @return mixed
     */
//    public function getAddonAfter()
//    {
//        return $this->addonAfter;
//    }

    /**
     * Set addon text after input.
     *
     * @param string $content
     *
     * @return $this
     */
//    public function setAddonAfter($content)
//    {
//        $this->addonAfter = $content;
//
//        return $this;
//    }

    /**
     * @return array
     */
    public function toArray():array
    {
        $array = parent::toArray();

        $array['icon'] = $this->getIcon();
        //$array['iconRight'] = $this->getIconRight();
        //$array['addonBefore'] = $this->getAddonBefore();
        //$array['addonAfter'] = $this->getAddonAfter();
        $array['type'] = $this->getType();
        $array['limit'] = $this->getLimit();

        return $array;
    }

    /**
     * Specify data which should be serialized to JSON.
     *
     * @return array
     */
    public function jsonSerialize()
    {
        $array = parent::jsonSerialize();

        $array['icon'] = $this->getIcon();
        //$array['iconRight'] = $this->getIconRight();
        //$array['addonBefore'] = $this->getAddonBefore();
        //$array['addonAfter'] = $this->getAddonAfter();
        $array['type'] = $this->getType();
        $array['limit'] = $this->getLimit();

        return $array;
    }
}