<?php


namespace Noldors\Builder\Contracts;


use Illuminate\Contracts\Support\Arrayable;

/**
 * Interface ElementInterface
 *
 * You can use trait \Noldor\Builder\Traits\Renderable
 *
 * @package Noldors\Builder\Contracts
 * @author  Dmitriy Romanov <romanov@noldor.pro>
 */
interface Renderable extends Arrayable, \JsonSerializable
{
    /**
     * Set blade template.
     *
     * @param string $view
     *
     * @return $this
     */
    public function setView(string $view);

    /**
     * Get blade template.
     *
     * @return string
     */
    public function getView():string;

    /**
     * Render.
     *
     * @return string
     */
    public function render():string;

    /**
     * @return string
     */
    public function __toString():string;

}