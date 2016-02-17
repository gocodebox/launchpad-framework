<?php

namespace SkyLab\Shortcodes;

use SkyLab\Config\Configuration;

/**
 * Shortcode Generator
 *
 * @package SkyLab
 * @author codeBOX
 * @since 0.0.1
 */
class ShortcodeGenerator
{
    /**
     * Shortcodes array
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @access private
     * @var array
     */
    private static $shortcodes = [];

    /**
     * Instance of Configuration class
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @access private
     * @var array
     */
    private $config;

    /**
     * ShortocdeGenerator constructor.
     * Initializes shortcodes
     *
     * @since 0.0.1
     * @version 0.0.1
     */
    public function __construct(Configuration $config)
    {
        $this->config = $config;

        $this->add_shortcodes();
    }

    /**
     * Add Shortcode
     * applies add_shortcode method to shortcode
     *
     * @since 0.0.1
     * @version 0.0.1
     */
    private function add_shortcodes()
    {
        $shortcodes = $this->get_shortcodes();

        foreach($shortcodes as $shortcode)
        {
            add_shortcode($shortcode['name'], [$shortcode['file'], 'output']);
        }
    }

    /**
     * Get Shortcodes
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @return array
     */
    private function get_shortcodes()
    {
        if (empty(self::$shortcodes))
        {
            $shortcodes = [];

            $files = glob(trailingslashit(get_template_directory())
                . $this->config->get_shortcodes_directory() . '*.php');

            foreach ($files as $file)
            {
                $file = $this->config->get_shortcodes_namespace() . str_replace('.php', '', basename($file));

                $name = (new $file)->get_name();

                $shortcodes[] = ['name' => $name, 'file' => $file];
            }

            self::$shortcodes = apply_filters('launchpad_add_shortcodes', $shortcodes);

        }

        $shortcodes = apply_filters('launchpad_shortcodes', self::$shortcodes);

        return $shortcodes;
    }
}