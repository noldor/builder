<?php


namespace Noldors\Builder\Traits;


trait FieldHtmlAttributes
{
    /**
     * Element html attributes.
     *
     * @var array
     */
    private $htmlAttributes = [
        'label' => [],
        'wrapper' => [],
        'field' => []
    ];

    /**
     * Get element html attributes.
     *
     * @return array
     */
    public function getHtmlAttributes($group)
    {
        $attributes = [];
        foreach ($this->htmlAttributes[$group] as $key => $attribute) {
            $attributes[$key] = $this->prepareHtmlAttributeValue($attribute);
        }

        return $attributes;
    }

    /**
     * Get html attribute by key.
     *
     * @param string $key
     * @param string $default
     *
     * @return string|null
     */
    public function getHtmlAttribute($group, $key, $default = null)
    {
        return array_get($this->getHtmlAttributes($group), $key, $default);
    }

    /**
     * Set html attribute.
     *
     * @param string       $key
     * @param string|array $attribute
     *
     * @return $this
     */
    public function setHtmlAttribute($group, $key, $attribute)
    {
        $attribute = $this->prepareHtmlAttributeValue($attribute);

        if ($key == 'class') {
            $this->htmlAttributes[$group][$key][] = $attribute;
        } else {
            $this->htmlAttributes[$group][$key] = $attribute;
        }

        return $this;
    }

    /**
     * Set html attributes.
     *
     * @param array $attributes
     *
     * @return $this
     */
    public function setHtmlAttributes($group, array $attributes)
    {
        foreach ($attributes as $key => $attribute) {
            if (is_numeric($key)) {
                $key = $attribute;
            }

            $this->setHtmlAttribute($group, $key, $attribute);
        }

        return $this;
    }

    /**
     * Replace html attribute.
     *
     * @param string       $key
     * @param string|array $attribute
     *
     * @return $this
     */
    public function replaceHtmlAttribute($group, $key, $attribute)
    {
        //$attribute                  = $this->attributeHtmlElement($attribute);
        $this->htmlAttributes[$group][$key] = $attribute;

        return $this;
    }

    public function replaceClassAttribute($group, $old, $new)
    {
        unset($this->htmlAttributes[$group]['class'][array_search($old, $this->htmlAttributes[$group]['class'])]);

        $this->setHtmlAttribute($group, 'class', $new);
    }

    /**
     * Check if element has class.
     *
     * @param string $class
     *
     * @return bool
     */
    public function hasClassProperty($group, $class)
    {
        if (! is_array($class)) {
            $class = func_get_args();
        }

        if (isset($this->htmlAttributes[$group]['class']) && is_array($this->htmlAttributes[$group]['class'])) {
            foreach ($this->htmlAttributes[$group]['class'] as $i => $string) {
                foreach ($class as $className) {
                    if (strpos($string, $className) !== false) {
                        return true;
                    }
                }
            }
        }

        return false;
    }

    /**
     * Check if element has html attribute.
     *
     * @param string $key
     *
     * @return bool
     */
    public function hasHtmlAttribute($group, $key)
    {
        return isset($this->htmlAttributes[$group][$key]);
    }

    /**
     * Remove html attribute by key.
     *
     * @param string $key
     *
     * @return $this
     */
    public function removeHtmlAttribute($group, $key)
    {
        unset($this->htmlAttributes[$group][$key]);

        return $this;
    }

    /**
     * Remove all html attributes from element.
     *
     * @return $this
     */
    public function clearHtmlAttributes($group)
    {
        $this->htmlAttributes[$group] = [];

        return $this;
    }

    public function clearAllHtmlAttributes()
    {
        $this->htmlAttributes = [];

        return $this;
    }

    /**
     * Convert all html attributes to string.
     *
     * @return string
     */
    public function htmlAttributesToString($group)
    {
        $html = [];

        $prepareAttributeValue = function ($key, $value) {
            if (is_numeric($key)) {
                $key = $value;
            }

            if (! is_null($value)) {
                return $key.'="'.e($value).'"';
            }

            return false;
        };

        foreach ((array) $this->getHtmlAttributes($group) as $key => $value) {
            $element = $prepareAttributeValue($key, $value);

            if (! is_null($element)) {
                $html[] = $element;
            }
        }

        return count($html) > 0
            ? ' '.implode(' ', $html)
            : '';
    }

    /**
     * @param string|array $value
     *
     * @return string
     */
    protected function prepareHtmlAttributeValue($value)
    {
        if (is_array($value)) {
            $value = implode(' ', $value);
        }

        return $value;
    }
}