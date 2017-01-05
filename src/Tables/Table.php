<?php


namespace Noldors\Builder\Tables;


use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Collection;
use Noldors\Builder\Elements\Columns\Column;
use Noldors\Builder\Elements\Columns\Columns;
use Noldors\Builder\Traits\HtmlAttributes;
use Noldors\Builder\Traits\Renderable;

/**
 * Class Table
 *
 * @package Noldors\Builder\Tables
 * @author  Dmitriy Romanov <romanov@noldor.pro>
 */
class Table implements Arrayable
{
    use HtmlAttributes, Renderable;

    /**
     * Blade template for table.
     *
     * @var string
     */
    protected $view = 'form::table';

    /**
     * Blade template for table headings.
     * @var string
     */
    protected $headingView = 'form::elements.columns.column_head';

    /**
     * List of columns.
     *
     * @var \Noldors\Builder\Elements\Columns\Columns
     */
    protected $columns;

    /**
     * Table constructor.
     *
     * @param $columns
     */
    public function __construct(Columns $columns)
    {
        $this->columns = $columns;
    }

    /**
     * Create instance statically.
     *
     * @param \Noldors\Builder\Elements\Columns\Columns $columns
     *
     * @return \Noldors\Builder\Tables\Table
     */
    public static function create(Columns $columns)
    {
        return new Table($columns);
    }

    /**
     * Set blade template for table headings.
     *
     * @param string $view
     *
     * @return $this
     */
    public function setHeadingView(string $view)
    {
        $this->headingView = $view;

        return $this;
    }

    /**
     * Get blade template for table headings.
     *
     * @return string
     */
    public function getHeadingView()
    {
        return $this->headingView;
    }

    /**
     * Get all columns headings.
     *
     * @return Collection
     */
    public function getHeadings()
    {
        $headings = $this->columns->getElements()->map(function (Column $column, $key) {
            return ['text' => $column->getName(), 'sortable' => $column->getSortable()];
        });

        return $headings;
    }

    /**
     * Render table headings.
     *
     * @return string
     */
    public function renderHeadings()
    {
        $headings = '';
        foreach ($this->getHeadings() as $heading) {
            $headings .= view($this->getHeadingView(), $heading);
        }
        return (string)$headings;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'headings' => $this->renderHeadings(),
            'columns' => $this->columns->getElements()
        ];
    }
}