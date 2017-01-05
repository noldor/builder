<?php


namespace Noldors\Builder\Traits;


/**
 * Class RenderableContract
 *
 * @package Noldors\Builder\Contracts
 * @author  Dmitriy Romanov <romanov@noldor.pro>
 */
trait Renderable
{
    /**
     * Set blade template.
     *
     * @param string $view
     *
     * @return $this
     */
    public function setView(string $view)
    {
        $this->view = $view;

        return $this;
    }

    /**
     * @return string
     */
    public function __toString():string
    {
        return (string)$this->render();
    }

    /**
     * Render.
     *
     * @return string
     */
    public function render():string
    {
        return view($this->getView(), $this->toArray());
    }

    /**
     * Get blade template.
     *
     * @return string
     */
    public function getView():string
    {
        return $this->view;
    }

}