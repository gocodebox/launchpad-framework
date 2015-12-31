<?php

namespace SkyLab\ThemeLayout;

use SkyLab\Sidebars\Sidebar;
use SkyLab\Sidebars\SidebarGenerator;
use SkyLab\Config\Configuration;

/**
 * Layout
 *
 * @package SkyLab
 * @author codeBOX
 * @since 0.0.1
 */
class SidebarLayout
{
    /**
     * Instance of Configuration class
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @access private
     * @var object
     */
    private $config;

    /**
     * Instance of Layout Class
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @access private
     * @var object
     */
    private $main_layout;

    /**
     * SidebarLayout constructor.
     * Add actions for sidebars and sidebar width
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @param Configuration $config
     * @param Layout $main_layout
     */
    public function __construct(Configuration $config, Layout $main_layout)
    {
        add_filter('launchpad_sidebar_width', [$this, 'get_sidebar_width'], 10);

        add_action('launchpad_before_content', [$this, 'get_left_sidebar'], 10);
        add_action('launchpad_after_content', [$this, 'get_right_sidebar'], 10);

        $this->config = $config;

        $this->main_layout = $main_layout;

        return $this;
    }

    /**
     * Get Left Sidebar
     *
     * @since 0.0.1
     * @version 0.0.1
     */
    public function get_left_sidebar()
    {
        if ( ! isset($_POST['left_sidebar_applied'])) {
            $layout = $this->main_layout->get_layout_setting();

            switch ($layout) {
                case 'sidebar_content' :
                case 'sidebar_content_sidebar' :

                    $_POST['left_sidebar_applied'] = true;

                    return (new SidebarGenerator($this->config))->get_sidebar(
                        apply_filters('launchpad_get_primary_sidebar',
                            $this->config->get_primary_sidebar()
                        )
                    );

                    break;
            }
        }
    }

    /**
     * Get right sidebar
     *
     * @since 0.0.1
     * @version 0.0.1
     */
    public function get_right_sidebar()
    {
        if ( ! isset($_POST['right_sidebar_applied']))
        {
            $layout = $this->main_layout->get_layout_setting();

            switch ($layout) {
                case 'content_sidebar' :

                    $_POST['right_sidebar_applied'] = true;

                    return (new SidebarGenerator($this->config))->get_sidebar(
                        apply_filters('launchpad_get_primary_sidebar',
                            $this->config->get_primary_sidebar()
                        )
                    );

                    break;

                case 'sidebar_content_sidebar' :

                    $_POST['right_sidebar_applied'] = true;

                    return (new SidebarGenerator)->get_sidebar(
                        apply_filters('launchpad_get_secondary_sidebar',
                            $this->config->get_secondary_sidebar()
                        )
                    );

                    break;
            }
        }
    }

    /**
     * Get Sidebar width
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @param $width
     * @return string
     */
    public function get_sidebar_width($width)
    {
        $layout = $this->main_layout->get_layout_setting();

        switch ($layout) {
            case 'content_sidebar' :
            case 'sidebar_content' :
                return 'four';
                break;

            case 'content' :
                return 'twelve';
                break;

            case 'sidebar_content_sidebar' :
                return 'four';
                break;

            default :
                return 'four';
                break;
        }
    }
}