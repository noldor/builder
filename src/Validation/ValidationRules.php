<?php


namespace Noldors\Builder\Validation;


use Illuminate\Support\Collection;

class ValidationRules
{
    /**
     * Rules collection.
     *
     * @var array|\Illuminate\Support\Collection
     */
    protected $rules = [];

    /**
     * Make elements a laravel collection.
     */
    public function __construct()
    {
        $this->rules = new Collection();
    }

    /**
     * Create instance statically.
     *
     * @return ValidationRules
     */
    public static function make()
    {
        return new self();
    }

    /**
     * Return all rules.
     *
     * @return array
     */
    public function all()
    {
        return $this->rules->toArray();
    }

    /**
     * Add an array of rules.
     *
     * @param array $rules
     *
     * @return $this
     */
    public function putMany(array $rules)
    {
        foreach ($rules as $key => $rule) {
            $this->put($key, $rule);
        }

        return $this;
    }

    /**
     * Add rule.
     *
     * @param        $key
     * @param string $rule
     *
     * @return $this
     */
    public function put($key, string $rule)
    {
        $this->rules->put($key, $rule);

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
        return $this->rules->has($key);
    }

    /**
     * Replace element with specified key.
     *
     * $element must implements \Noldors\Form\Contracts\ElementInterface.
     *
     * @see \Noldors\Builder\Validation\ValidationRules::put() Do the same thing.
     *
     * @param        $key
     * @param string $rule new rule
     *
     * @return $this
     */
    public function replace($key, string $rule)
    {
        $this->put($key, $rule);

        return $this;
    }

    /**
     * Remove rule with specified key.
     *
     * @param mixed $key rule key that should be removed
     *
     * @return $this
     */
    public function forget($key)
    {
        $this->rules->forget($key);

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
        $this->rules =  $this->rules->except($keys);

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
        $this->rules = $this->rules->only($keys);

        return $this;
    }

}