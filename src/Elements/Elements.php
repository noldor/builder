<?php


namespace Noldors\Builder\Elements;

use Illuminate\Support\Collection;
use Noldors\Builder\Contracts\NamedElement;

/**
 * Class Elements.
 *
 * Basic class for form and tables elements, that allow to add, modify and remove elements from collections
 *
 * @package Noldors\Form
 * @author  Dmitriy Romanov <romanov@noldor.pro>
 */
class Elements
{
    /**
     * @var \Illuminate\Support\Collection
     */
    protected $elements;


    /**
     * Make elements a laravel collection.
     *
     */
    public function __construct()
    {
        $this->elements = new Collection();
    }

    /**
     * Insert element before specified key.
     *
     * $element must implements \Noldors\Form\Contracts\ElementInterface.
     *
     * @param mixed                                   $before  key before insert new element
     * @param \Noldors\Builder\Contracts\NamedElement $element new element
     *
     * @return $this
     */
    public function before(string $before, NamedElement $element)
    {
        $elements = $this->elements;
        if ($elements->has($before)) {
            $this->clear();
            $elements->each(function ($item, $itemKey) use ($before, $element) {
                if ($before == $itemKey) {
                    $this->put($element);
                }
                $this->put($item);
            });
        } else {
            $this->put($element);
        }

        return $this;
    }

    /**
     * Clear all existing elements.
     *
     * @return $this
     */
    public function clear()
    {
        $this->elements = new Collection;

        return $this;
    }

    /**
     * Set element with given key and element type.
     *
     * $element must implements \Noldors\Form\Contracts\ElementInterface.
     *
     * @param \Noldors\Builder\Contracts\NamedElement $element new element
     *
     * @return $this
     */
    public function put(NamedElement $element)
    {
        $this->elements->put($element->getName(), $element);

        return $this;
    }

    /**
     * Insert element after specified key.
     *
     * $element must implements \Noldors\Form\Contracts\ElementInterface.
     *
     * @param mixed                                   $after   key after insert new element
     * @param \Noldors\Builder\Contracts\NamedElement $element new element
     *
     * @return $this
     */
    public function after($after, NamedElement $element)
    {
        $elements = $this->elements;
        if ($elements->has($after)) {
            $this->clear();
            $elements->each(function ($item, $itemKey) use ($after, $element) {
                $this->put($item);
                if ($after == $itemKey) {
                    $this->put($element);
                }
            });
        } else {
            $this->put($element);
        }

        return $this;
    }

    /**
     * @param $key
     *
     * @return \Noldors\Builder\Contracts\NamedElement
     */
    public function get($key)
    {
        return $this->elements->get($key);
    }

    /**
     * Return all elements.
     *
     * @return \Illuminate\Support\Collection
     */
    public function all()
    {
        return $this->elements;
    }

    /**
     * Add an array of elements.
     *
     * @param array $elements array of new elements
     *
     * @return $this
     */
    public function putMany(array $elements)
    {
        foreach ($elements as $element) {
            $this->put($element);
        }

        return $this;
    }

    /**
     * Check if elements collection has element with specified key.
     *
     * @param mixed $key element key
     *
     * @return bool
     */
    public function has($key)
    {
        return $this->elements->has($key);
    }

    /**
     * Replace element with specified key.
     *
     * $element must implements \Noldors\Form\Contracts\ElementInterface.
     *
     * @see \Noldors\Builder\Forms\FormElements::put() Do the same thing.
     *
     * @param \Noldors\Builder\Contracts\NamedElement $element new element
     *
     * @return $this
     */
    public function replace(NamedElement $element)
    {
        $this->put($element);

        return $this;
    }

    /**
     * Remove element with specified key.
     *
     * @param mixed $key element key that should be removed
     *
     * @return $this
     */
    public function forget($key)
    {
        $this->elements->forget($key);

        return $this;
    }

    /**
     * Get elements without given keys.
     *
     * @param string|array $keys
     *
     * @return $this
     */
    public function except($keys)
    {
        $this->elements = $this->elements->except($keys);

        return $this;
    }

    /**
     * Get elements with specified keys only.
     *
     * @param $keys
     *
     * @return $this
     */
    public function only($keys)
    {
        $this->elements = $this->elements->only($keys);

        return $this;
    }

}