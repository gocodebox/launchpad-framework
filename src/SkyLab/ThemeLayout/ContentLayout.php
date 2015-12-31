<?php

namespace SkyLab\ThemeLayout;

use SkyLab\Config\Configuration;

/**
 * Content Layout
 *
 * @package SkyLab
 * @author codeBOX
 * @since 0.0.1
 */
class ContentLayout
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
     * Instance of layout class
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @access private
     * @var array
     */
    private $main_layout;

    /**
     * ContentLayout constructor.
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @param Configuration $config
     * @param Layout $main_layout
     */
    public function __construct(Configuration $config, Layout $main_layout)
    {
        add_filter('launchpad_content_width', [$this, 'get_content_width'], 10);

        $this->config = $config;

        $this->main_layout = $main_layout;

        return $this;
    }

    /**
     * Get Content Width
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @param $width
     * @return string
     */
    public function get_content_width($width)
    {
        $layout = $this->main_layout->get_layout_setting();

        switch ($layout) {
            case 'content_sidebar' :
            case 'sidebar_content' :
                return 'eight';
                break;

            case 'content' :
                return 'twelve';
                break;

            case 'sidebar_content_sidebar' :
                return 'four';
                break;

            default :
                return 'twelve';
                break;
        }
    }
}