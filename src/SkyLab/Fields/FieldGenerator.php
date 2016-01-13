<?php

namespace SkyLab\Fields;

use SkyLab\Foundation\Application;

/**
 * Generates Fields
 *
 * @package SkyLab
 * @author codeBOX
 * @since 0.0.1
 */
class FieldGenerator
{
    /**
     * Array of fields to output
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @var array
     */
    private $fields;

    public function __construct($fields)
    {
        $this->fields = $fields;
    }

    /**
     * Output fields to screen
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @return echo html
     */
    public function output()
    {
        foreach ($this->fields as $value) {

            $type_class = Application::$config->get_fields_namespace() . ucfirst($value['type']);
            $field = new $type_class($value);
            echo $field->output();

        }
    }

    /**
     * Save Fields to Database
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @return bool
     */
    public function save()
    {
        if (empty($_POST))
        {
            return false;
        }

        // Loop options and get values to save
        foreach ($this->fields as $value) {

            if (!isset($value['id'])) {
                continue;
            }

            $type = isset($value['type']) ? sanitize_title($value['type']) : '';

            // Get the option name
            $option_value = null;

            // we do nothing for button
            $type_class = Application::$config->get_fields_namespace() . ucfirst($type);
            $field = new $type_class($value);
            //$field = new Text($value);
            $field->save();


        }
    }

}
