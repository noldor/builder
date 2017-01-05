<?php


namespace Noldors\Builder\Elements\Columns;


use Noldors\Builder\Contracts\ColumnInterface;
use Noldors\Builder\Elements\Fields\Field;
use Noldors\Builder\Exceptions\BuilderException;
use Noldors\Builder\Traits\HtmlAttributes;
use Noldors\Builder\Traits\Renderable;

/**
 * Class Column
 *
 * @package Noldors\Builder\Elements\Columns
 * @author  Dmitriy Romanov <romanov@noldor.pro>
 */
class Column implements ColumnInterface
{
    use HtmlAttributes, Renderable;

    /**
     * Blade template for column.
     *
     * @var string
     */
    protected $view = 'builder::elements.columns.column';

    /**
     * Column value.
     *
     * @var \Noldors\Builder\Elements\Fields\Field|string
     */
    protected $value;

    /**
     * Column name for column heading.
     *
     * @var string
     */
    protected $name;

    /**
     * Sortable column.
     *
     * @var bool
     */
    protected $sortable = true;

    /**
     * Column constructor.
     *
     * @param string                                        $name
     * @param \Noldors\Builder\Elements\Fields\Field|string $value
     *
     * @throws \Noldors\Builder\Exceptions\BuilderException
     */
    public function __construct(string $name, $value)
    {
        $this->name = $name;
        if (($value instanceof Field) || is_string($value)) {
            $this->value = $value;
        } else {
            throw new BuilderException('Culumn value must be a string or an instance of \Noldors\Builder\Elements\Fields\Field');
        }
    }

    /**
     * Create instance statically.
     *
     * @param string $name
     * @param        $value
     *
     * @return \Noldors\Builder\Elements\Columns\Column
     */
    public static function create(string $name, $value)
    {
        return new Column($name, $value);
    }

    /**
     * Disable sort by this column.
     *
     * @return $this
     */
    public function setUnSortable()
    {
        $this->sortable = false;

        return $this;
    }

    /**
     * Get sortable.
     *
     * @return bool
     */
    public function getSortable()
    {
        return $this->sortable;
    }

    /**
     * Get column name.
     *
     * @return string
     */
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
            'sortable' => $this->sortable,
            'value' => $this->getValue()
        ];
    }

    public function jsonSerialize()
    {
        return [
            'attributes' => $this->getHtmlAttributes(),
            'sortable' => $this->sortable,
            'value' => $this->getValue()
        ];
    }

    /**
     * Get column value.
     *
     * @return \Noldors\Builder\Elements\Fields\Field|string
     */
    public function getValue()
    {
        return $this->value;
    }

}