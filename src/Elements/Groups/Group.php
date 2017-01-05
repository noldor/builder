<?php


namespace Noldors\Builder\Elements\Groups;

use Noldors\Builder\Contracts\ElementInterface;
use Noldors\Builder\Elements\Elements;
use Noldors\Builder\Traits\ElementsCollection;
use Noldors\Builder\Traits\HtmlAttributes;
use Noldors\Builder\Traits\Renderable;

/**
 * Class FormGroup
 *
 * @package Noldors\Builder\Groups
 * @author  Dmitriy Romanov <romanov@noldor.pro>
 */
class Group implements ElementInterface
{
    use HtmlAttributes, Renderable, ElementsCollection;
    /**
     * Blade template for group.
     *
     * @var string
     */
    protected $view = 'builder::elements.groups.tab';

    /**
     * Group name.
     *
     * @var
     */
    protected $name;

    /**
     * FormGroup constructor.
     *
     * @param $name
     */
    public function __construct($name)
    {
        $this->name = $name;
        $this->elements = new Collection();
    }

    /**
     * Create instance statically.
     *
     * @param $name
     *
     * @return \Noldors\Builder\Elements\Groups\Group
     */
    public static function create($name)
    {
        return new self($name);
    }

    /**
     * Get group name.
     *
     * @return mixed
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @return array
     */
    public function toArray():array
    {
        //dd($this->render());
        return [
            'name' => $this->getName(),
            'fields' => $this->getElements()
        ];
    }
}