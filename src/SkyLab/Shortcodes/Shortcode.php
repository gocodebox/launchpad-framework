<?php

namespace SkyLab\Shortcodes;

/**
 * Shortcode
 *
 * @since 0.0.1
 * @package SkyLab
 * @author CodeBOX
 */
class Shortcode
{
    protected $name;

    /**
     * Get shortcode name
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @return string
     */
    public function get_name()
    {
        return $this->name;
    }
}