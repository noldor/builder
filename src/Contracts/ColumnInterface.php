<?php


namespace Noldors\Builder\Contracts;

use Illuminate\Contracts\Support\Arrayable;


/**
 * Interface ColumnInterface
 *
 * @package Noldors\Builder\Contracts
 * @author  Dmitriy Romanov <romanov@noldor.pro>
 */
interface ColumnInterface extends ElementInterface
{
    public function getName();

    public function getValue();
}