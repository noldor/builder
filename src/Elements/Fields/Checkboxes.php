<?php


namespace Noldors\Builder\Elements\Fields;


class Checkboxes extends Field
{
    /**
     * Checkbox blade template.
     *
     * @var string
     */
    protected $view = 'builder::elements.fields.checkboxes';

    /**
     * Element in this case is array of checkboxes.
     *
     * @var array
     */
    protected $value = [];

    /**
     * Determine that checkboxes should render vertical.
     *
     * @var bool
     */
    protected $vertical = false;

    /**
     * Checkboxes constructor.
     *
     * @param string $name
     * @param array  $checkboxes
     * @param string $label
     */
    public function __construct(string $name, array $checkboxes, string $label = '')
    {
        $this->value = $checkboxes;
        parent::__construct($name, $label);
    }

    /**
     * Create instance statically.
     *
     * @param string $name
     * @param array  $checkboxes
     * @param string $label
     *
     * @return \Noldors\Builder\Elements\Fields\Checkboxes
     */
    public static function make(string $name, array $checkboxes, string $label = '')
    {
        return new self($name, $checkboxes, $label);
    }

    /**
     * Set checkboxes to vertical mode.
     *
     * @return $this
     */
    public function setVertical()
    {
        $this->vertical = true;

        return $this;
    }

    /**
     * @return array
     */
    public function toArray():array
    {
        $array = parent::toArray();

        $array['vertical'] = $this->vertical;

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

        $array['vertical'] = $this->vertical;

        return $array;
    }

}