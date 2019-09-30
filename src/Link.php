<?php

namespace Carlson\NovaLinkField;

use Laravel\Nova\Fields\Field;

class Link extends Field
{
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'link';

    /**
     * The field's details given by the user.
     *
     * @var array
     */
    private $details;

    public function resolve($resource, $attribute = null)
    {
        parent::resolve($resource, $attribute);

        $details = array_merge([
            'text' => function () {
                return $this->value;
            },
            'newTab' => false,
        ], $this->details);

        $this->withMeta([
            'href' => is_callable($details['href']) ? call_user_func($details['href']) : $details['href'],
            'text' => is_callable($details['text']) ? call_user_func($details['text']) : $details['text'],
            'newTab' => is_callable($details['newTab']) ? call_user_func($details['newTab']) : $details['newTab'],
        ]);
    }

    public function details($details)
    {
        $this->details = $details;

        return $this;
    }
}
