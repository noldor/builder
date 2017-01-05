<?php


namespace Noldors\Builder\Elements\Rows;


use Noldors\Builder\Contracts\ElementInterface;
use Noldors\Builder\Elements\Elements;
use Noldors\Builder\Traits\HtmlAttributes;
use Noldors\Builder\Traits\Renderable;

class Row extends Elements implements ElementInterface
{
    use HtmlAttributes, Renderable;
    /**
     * Blade template for group.
     *
     * @var string
     */
    protected $view = 'builder::elements.rows.row';

    /**
     * Group name.
     *
     * @var
     */
    protected $key;

    /**
     * FormGroup constructor.
     *
     * @param $key
     */
    public function __construct($key)
    {
        parent::__construct();
        $this->key = $key;
    }

    /**
     * Create instance statically.
     *
     * @param $key
     *
     * @return \Noldors\Builder\Elements\Rows\Row
     */
    public static function create($key)
    {
        return new Row($key);
    }

    /**
     * Get group name.
     *
     * @return mixed
     */
    public function getKey() {
        return $this->key;
    }

    /**
     * @return array
     */
    public function toArray():array
    {
        return [
            'key' => $this->getKey(),
            'fields' => $this->getElements()
        ];
    }

    public function jsonSerialize():array
    {
        return [
            'key' => $this->getKey(),
            'fields' => $this->getElements()
        ];
    }

    public function getElement($key)
    {
        return $this->elements->get($key);
    }
}