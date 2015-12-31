<?php

namespace SkyLab\ThemeLayout;

use SkyLab\Config\Configuration;

/**
 * Layout
 *
 * @package SkyLab
 * @author codeBOX
 * @since 0.0.1
 */
class Layout
{
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
     * Layout constructor.
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @param Configuration $config
     */
    public function __construct(Configuration $config)
    {
        $this->config = $config;

        $this->load_layout_settings();

        return $this;
    }

    /**
     * Load Layout Settings
     *
     * @since 0.0.1
     * @version 0.0.1
     */
    private function load_layout_settings()
    {
        new ContentLayout($this->config, $this);
        new SidebarLayout($this->config, $this);
    }

    /**
     * Get Options
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @param bool $text_only
     * @return mixed
     */
    public function get_options($text_only = false)
    {
        if ($text_only)
        {
            return apply_filters('launchpad_layout_options_text_only',
                [
                    'content_sidebar' => 'Content, Sidebar',
                    'sidebar_content' => 'Sidebar, Content',
                    'sidebar_content_sidebar' => 'Sidebar, Content, Sidebar',
                    'content' => 'Content'
                ]
            );
        }
        else
        {
            return apply_filters('launchpad_layout_options',
                [
                    'content_sidebar' => '<img src="' . get_stylesheet_directory_uri() . '/images/content_sidebar.png" />',
                    'sidebar_content' => '<img src="' . get_stylesheet_directory_uri() . '/images/sidebar_content.png" />',
                    'sidebar_content_sidebar' => '<img src="' . get_stylesheet_directory_uri() . '/images/sidebar_content_sidebar.png" />',
                    'content' => '<img src="' . get_stylesheet_directory_uri() . '/images/content.png" />'
                ]
            );
        }

    }

    /**
     * Get Layout Settings
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @return array
     */
    public static function get_layout_setting()
    {
        global $post;

        if ( ! is_null($post))
        {
            if ( $layout_option = get_post_meta($post->ID, 'launchpad_default_layout', true))
            {
                return $layout_option;
            }
        }

        $layout_option = get_option('launchpad_default_layout', 'sidebar_content');

        return $layout_option;
    }

}
