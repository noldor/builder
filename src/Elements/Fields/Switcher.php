<?php


namespace Noldors\Builder\Elements\Fields;


class Switcher extends Field
{

    /**
     * Input blade template.
     *
     * @var string
     */
    protected $view = 'builder::elements.fields.switcher';

    /**
     * Text on left.
     *
     * @var string|\Symfony\Component\Translation\TranslatorInterface
     */
    protected $textLeft = '';

    /**
     * Text on right.
     *
     * @var string|\Symfony\Component\Translation\TranslatorInterface
     */
    protected $textRight = '';

    /**
     * Switcher constructor.
     *
     * @param string $name
     * @param string $label
     */
    public function __construct(string $name, string $label = '')
    {
        parent::__construct($name, $label);
        $this->textLeft = trans('builder::fields.switcher_text_off');
        $this->textRight = trans('builder::fields.switcher_text_on');
    }

    /**
     * Create instance statically.
     *
     * @param string $name
     * @param string $label
     *
     * @return \Noldors\Builder\Elements\Fields\Switcher
     */
    public function make(string $name, $label = '')
    {
        return new self($name, $label);
    }

    /**
     * Set left and right text.
     *
     * @param $textLeft
     * @param $textRight
     *
     * @return $this
     */
    public function setText($textLeft, $textRight)
    {
        $this->textLeft = $textLeft;
        $this->textRight = $textRight;

        return $this;
    }

    /**
     * @return array
     */
    public function toArray():array
    {
        $array = parent::toArray();

        $array['textLeft'] = $this->textLeft;
        $array['textRight'] = $this->textRight;

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

        $array['textLeft'] = $this->textLeft;
        $array['textRight'] = $this->textRight;

        return $array;
    }

}