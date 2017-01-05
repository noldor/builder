<?php


namespace Noldors\Builder\Exceptions;


/**
 * Class BuilderException
 *
 * @package Noldors\Builder\Exceptions
 * @author  Dmitriy Romanov <romanov@noldor.pro>
 */
class BuilderException extends \TypeError
{
    public function __toString()
    {
        return $this->getMessage();
    }
}