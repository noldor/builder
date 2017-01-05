<?php


namespace Noldors\Builder\Forms;


use Noldors\Builder\Elements\Buttons\Buttons;
use Noldors\Builder\Elements\Groups\Groups;

/**
 * Class FormTabbed
 *
 * @package Noldors\Builder\Forms
 * @author  Dmitriy Romanov <romanov@noldor.pro>
 */
class FormTabbed extends Form
{
    /**
     * Blade template for form.
     *
     * @var string
     */
    protected $view = 'form::tabbed';

    /**
     * Elements groups.
     *
     * @var \Noldors\Builder\Elements\Groups\Groups
     */
    protected $groups;

    /**
     * FormTabbed constructor.
     *
     * @param \Noldors\Builder\Elements\Buttons\Buttons $buttons
     * @param \Noldors\Builder\Elements\Groups\Groups   $groups
     */
    public function __construct(Buttons $buttons, Groups $groups) {
        parent::__construct($buttons, $groups);
        $this->groups = $groups;
    }

    /**
     * Create instance statically.
     *
     * @param \Noldors\Builder\Elements\Buttons\Buttons $buttons
     * @param \Noldors\Builder\Elements\Groups\Groups       $elements
     *
     * @return \Noldors\Builder\Forms\Form
     */
    public static function create(Buttons $buttons, $elements)
    {
        return new FormTabbed($buttons, $elements);
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $array = parent::toArray();

        $array['groups'] = $this->groups->getGroups();

        return $array;
    }
}