<?php


namespace Noldors\Builder\Elements\Fields;

use Illuminate\Container\Container;
use Illuminate\Http\Request;
use Illuminate\Translation\Translator;
use Noldors\Builder\Contracts\NamedElement;
use Noldors\Builder\Traits\FieldHtmlAttributes;
use Noldors\Builder\Traits\Renderable;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class FormElement
 *
 * @package Noldors\Form\Elements
 * @author  Dmitriy Romanov <romanov@noldor.pro>
 */
abstract class Field implements NamedElement
{
    use FieldHtmlAttributes, Renderable;

    /**
     * Container.
     *
     * @var static
     */
    protected $app;
    /**
     * Request object.
     *
     * @var \Illuminate\Http\Request
     */
    protected $request;
    /**
     * Model object.
     *
     * @var \Illuminate\Database\Eloquent\Model|null
     */
    protected $model;
    /**
     * Localization file.
     *
     * @var bool|string
     */
    protected $localization = false;
    /**
     * Blade template for element.
     *
     * @var string
     */
    protected $view = '';
    /**
     * Element name.
     *
     * @var string
     */
    protected $name = '';
    /**
     * Element value.
     *
     * @var mixed
     */
    protected $value = '';
    /**
     * Element label.
     *
     * @var
     */
    protected $label = false;
    /**
     * Help text.
     *
     * @var bool|string
     */
    protected $help = false;
    /**
     * Is element required.
     * @var bool
     */
    protected $required = false;
    /**
     * Default width of field.
     *
     * @var string
     */
    protected $width = '';
    /**
     * Translator object.
     *
     * @var \Illuminate\Translation\Translator|mixed
     */
    private $translator;

    /**
     * FormElement constructor.
     *
     * @param string      $name
     * @param bool|string $label
     */
    public function __construct(string $name, $label = false)
    {
        $this->app = Container::getInstance();
        $this->translator = Container::getInstance()->make(Translator::class);
        $this->request = Container::getInstance()->make(Request::class);
        $this->retrieveModel();
        $this->retrieveLocalization();
        $this->name = $name;
        $this->value = $this->getValue();
        $this->makeLabel($name, $label);
        $this->makeHelp($name);
        $this->setDefaults();
    }

    /**
     * Try to get model, where data stored.
     */
    protected function retrieveModel()
    {
        if (Container::getInstance()->offsetExists('builder.model')) {
            $this->model = $this->app->make('builder.model');
        } else {
            $this->model = null;
        }
    }

    /**
     * Try to get localization name.
     */
    protected function retrieveLocalization()
    {
        if ($this->app->offsetExists('builder.localization')) {
            $this->localization = $this->app->make('builder.localization');
        }
    }

    /**
     * Get value for element.
     *
     * @return array|mixed|string
     */
    protected function getValue()
    {
        if ($this->request->old($this->name)) {
            return $this->request->old($this->name);
        }

        if (!is_null($this->model) && $this->model->getAttribute($this->name)) {
            return $this->model->getAttribute($this->name);
        }

        return '';
    }

    /**
     * Make label for field.
     *
     * @param string $name
     * @param bool   $label
     */
    protected function makeLabel(string $name, $label = false)
    {
        if ($label) {
            $this->label = $label;
        } elseif ($this->localization) {
            $this->label = $this->translation('field', $name);
            //$this->label = trans("{$this->localization}.field_{$name}");
        }
    }

    protected function translation($type, $name)
    {
        return $this->translator->has("{$this->localization}.{$type}_{$name}") ? $this->translator->trans("{$this->localization}.{$type}_{$name}") : false;
    }

    protected function makeHelp($name)
    {
        $this->help = $this->translation('help', $name);
        if ($this->help) {
            $this->setHtmlAttributes('field', ['class' => 'tooltip', 'title' => $this->help]);
            if ($this instanceof Input) {
                $this->setIcon('live_help');
            }
        }
    }

    protected function setDefaults()
    {
        $this->setHtmlAttributes('label', config('builder.field_label_default_attributes'));
        $this->setHtmlAttributes('wrapper', config('builder.field_wrapper_default_attributes'));
        //$this->setHtmlAttribute('wrapper', 'class', $this->width);
        $this->setHtmlAttribute('field', 'id', "form-field-{$this->name}");
    }

    /**
     * Set required element.
     *
     * @return $this
     */
    public function require ()
    {
        $this->required = true;

        $this->setHtmlAttributes('field', config('builder.required_field_default_attribute'));

        return $this;
    }

    /**
     * Set width for field.
     *
     * @param string $width
     *
     * @return $this
     */
    public function setWidth(string $width)
    {
        $this->replaceClassAttribute('wrapper', $this->width, $width);

        return $this;
    }

    /**
     * @return array
     */
    public function toArray():array
    {
        return [
            'name'              => $this->getName(),
            'label'             => $this->getLabel(),
            'fieldAttributes'   => $this->htmlAttributesToString('field'),
            'labelAttributes'   => $this->htmlAttributesToString('label'),
            'wrapperAttributes' => $this->htmlAttributesToString('wrapper'),
            'help'              => $this->getHelp(),
            'required'          => $this->isRequired(),
            'value'             => $this->getValue()
        ];
    }

    /**
     * Get element name.
     *
     * @return string
     */
    public function getName():string
    {
        return $this->name;
    }

    /**
     * Set element name.
     *
     * @param string $name
     *
     * @return $this
     */
    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get element label.
     *
     * @return bool|string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * Set element label.
     *
     * @param string $label
     *
     * @return $this
     */
    public function setLabel(string $label)
    {
        $this->label = $label;

        return $this;
    }

    /**
     * Get element help text.
     *
     * @return bool|string
     */
    public function getHelp():string
    {
        return $this->help;
    }

    /**
     * Set element help text
     *
     * @param $help
     *
     * @return $this
     */
    public function setHelp(string $help)
    {
        $this->help = $help;

        return $this;
    }

    /**
     * Check if element is required.
     *
     * @return bool
     */
    public function isRequired():bool
    {
        return $this->required;
    }

    /**
     * Specify data which should be serialized to JSON.
     *
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'name'              => $this->getName(),
            'label'             => $this->getLabel(),
            'fieldAttributes'   => $this->htmlAttributesToString('field'),
            'labelAttributes'   => $this->htmlAttributesToString('label'),
            'wrapperAttributes' => $this->htmlAttributesToString('wrapper'),
            'help'              => $this->getHelp(),
            'required'          => $this->isRequired(),
            'value'             => $this->getValue()
        ];
    }

}