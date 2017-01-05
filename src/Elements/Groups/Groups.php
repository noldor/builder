<?php


namespace Noldors\Builder\Elements\Groups;


use Illuminate\Support\Collection;
use Noldors\Builder\Elements\ElementsCollection;

/**
 * Class FormGroups.
 *
 * Used to make form groups
 *
 * @package Noldors\Builder\Elements\Groups
 * @author  Dmitriy Romanov <romanov@noldor.pro>
 */
class Groups extends ElementsCollection
{
    /**
     * @var \Illuminate\Support\Collection
     */
    protected $elements;

    /**
     * FormGroups constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->elements = new Collection();
    }

    /**
     * Create instance statically.
     *
     * @return \Noldors\Builder\Elements\Groups\Groups
     */
    public static function create()
    {
        return new Groups();
    }

    /**
     * Set group with specified key.
     *
     * @param                                            $key
     * @param \Noldors\Builder\Elements\Groups\Group     $group
     *
     * @return $this
     */
    public function setGroup($key, Group $group)
    {
        $this->elements->put($key, $group);

        return $this;
    }

    /**
     * Get all groups.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getGroups()
    {
        return $this->elements;
    }

    /**
     * Get group with specified key.
     *
     * @param $key
     *
     * @return Group
     */
    public function getGroup($key)
    {
        return $this->elements->get($key);
    }
}