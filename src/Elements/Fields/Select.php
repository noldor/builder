<?php


namespace Noldors\Builder\Elements\Fields;


class Select extends Field
{
    /**
     * Checkbox blade template.
     *
     * @var string
     */
    protected $view = 'builder::elements.fields.select';

    /**
     * Determines that select have multiple attribute.
     *
     * @var bool
     */
    protected $multiple = false;

    /**
     * If true it would be select2 styled.
     *
     * @var bool
     */
    protected $searchable = false;

    /**
     * Select options.
     *
     * @var
     */
    protected $options;

    /**
     * Input constructor.
     *
     * @param string $name
     * @param        $options
     * @param string $label
     */
    public function __construct(string $name, $options, string $label = '')
    {
        parent::__construct($name, $label);
        $this->options = $options;
        //$this->setHtmlAttributes('field', config('builder.field_checkbox_default_attributes'));
        $this->setHtmlAttribute('field', 'class', config('builder.select_default_class'));
    }

    /**
     * Determine if select is multiple.
     *
     * @return bool
     */
    public function getMultiple()
    {
        return $this->multiple;
    }

    /**
     * Set multiple attribute.
     *
     * @return $this
     */
    public function setMultiple()
    {
        $this->setHtmlAttribute('field', 'multiple', '');
        $this->multiple = true;

        return $this;
    }

    /**
     * Make select2 styled.
     *
     * @return $this
     */
    public function setSearchable()
    {
        $this->searchable = true;
        $this->replaceClassAttribute('field', config('builder.select_default_class'), config('builder.select2_default_class'));
        //Fix for select2 width.
        $this->setHtmlAttribute('field', 'style', 'width:100%');

        return $this;
    }

    /**
     * @return array
     */
    public function toArray():array
    {
        $array = parent::toArray();

        $array['multiple'] = $this->getMultiple();
        $array['options'] = $this->options;

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

        $array['multiple'] = $this->getMultiple();
        $array['options'] = $this->options;

        return $array;
    }
}