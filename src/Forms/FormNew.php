<?php


namespace Noldors\Builder\Forms;


use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Noldors\Builder\Elements\Buttons\Buttons;
use Noldors\Builder\Elements\Groups\Group;
use Noldors\Builder\Elements\Groups\Groups;
use Noldors\Builder\Traits\HtmlAttributes;
use Noldors\Builder\Traits\Renderable;

/**
 * Class FormNew
 *
 * @package Noldors\Builder\Forms
 * @author  Dmitriy Romanov <romanov@noldor.pro>
 */
class FormNew
{
    use HtmlAttributes, Renderable;

    /**
     * @var string
     */
    protected $view = 'form::default';

    /**
     * @var string
     */
    protected $action = '';

    /**
     * @var string
     */
    protected $method = '';

    /**
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;

    /**
     * @var \Noldors\Builder\Elements\Groups\Groups
     */
    protected $groups;

    /**
     * @var \Noldors\Builder\Elements\Buttons\Buttons
     */
    protected $buttons;

    /**
     * FormNew constructor.
     *
     * @param \Illuminate\Database\Eloquent\Model       $model
     * @param \Noldors\Builder\Elements\Buttons\Buttons $buttons
     */
    public function __construct(Model $model, Buttons $buttons)
    {
        //parent::__construct($buttons, $elements);
        $this->buttons = $buttons;
        $this->model = $model;
        $this->groups = new Groups();
    }

    /**
     * @param $model
     * @param $buttons
     *
     * @return \Noldors\Builder\Forms\FormNew
     */
    public static function create($model, $buttons)
    {
        return new FormNew($model, $buttons);
    }

    /**
     * @return string
     */
    public function test()
    {
        return $this->model->getMorphClass();
    }

    /**
     * @return $this
     */
    public function makeGroups()
    {

        $this->groups->setGroup($this->model->getTable(), $this->model->getFields($this->model));

        $relations = $this->model->getRelations();
        if ($relations) {
            foreach ($relations as $key => $relation) {
                if ($relation instanceof Collection) {
                    $this->setFieldsGroupForRelation($key, $relation);
                } else {
                    $this->groups->setGroup($key, $relation->getFields($relation));
                }
            }
        }

        return $this;
    }

    /**
     * @param                                          $key
     * @param \Illuminate\Database\Eloquent\Collection $relation
     */
    public function setFieldsGroupForRelation($key, Collection $relation)
    {
        $this->groups->setGroup($key, new Group($key));
        $relation->each(function ($object) use ($key) {
            $this->groups->getGroup($key)->setElement(mt_rand(5, 15), $object->getPivotFields($object));
        });
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'method' => $this->getMethod(),
            'action' => $this->getAction(),
            'buttons' => $this->buttons->getElements(),
            'attributes' => $this->htmlAttributesToString(),
            'elements' => $this->groups->getGroups()
        ];
    }

    /**
     * Get form method.
     *
     * @return string
     */
    public function getMethod():string
    {
        return $this->method;
    }

    /**
     * Set form method.
     *
     * @param string $method
     *
     * @return $this
     */
    public function setMethod(string $method)
    {
        $this->method = $method;

        return $this;
    }

    /**
     * Get form action.
     *
     * @return string
     */
    public function getAction():string
    {
        return $this->action;
    }

    /**
     * Set form action.
     *
     * @param string $action
     *
     * @return $this
     */
    public function setAction(string $action)
    {
        $this->action = $action;

        return $this;
    }


}