<?php


namespace Noldors\Builder\Contracts;


interface NamedElement extends Renderable
{
    /**
     * Get the element unique name.
     *
     * @return mixed
     */
    public function getName();
}