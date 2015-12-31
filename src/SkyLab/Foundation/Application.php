<?php

namespace SkyLab\Foundation;

use SkyLab\ThemeLayout\Layout;
use SkyLab\Menus\MenuGenerator;
use SkyLab\Config\Configuration;
use SkyLab\Settings\SettingsMenu;
use SkyLab\Metaboxes\MetaboxLoader;
use SkyLab\Sidebars\SidebarGenerator;
use SkyLab\Customizer\CustomizeSectionLoader;

/**
 * Base Application Class
 *
 * @package SkyLab
 * @author codeBOX
 * @since 0.0.1
 */
class Application
{
    /**
     * The LaunchPad Framework Version
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @var string
     */
    const VERSION = '0.0.1';

    /**
     * The base path for the LaunchPad installation
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @var string
     */
    protected $base_path;

    /**
     * Indicates if the theme has been bootstrapped before.
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @var bool
     */
    protected $has_been_bootstrapped = false;

    /**
     * Instance of Configuration class
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @access private
     * @var array
     */
    public static $config;

    /**
     * Application constructor.
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @param Configuration $config
     */
    public function __construct(Configuration $config)
    {
        self::$config = $config;


        $this->add_actions();
    }

    /**
     * Add Actions
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @return void
     */
    private function add_actions()
    {
        $this->initialize_objects();

        $this->initialize_admin_only_objects();

        $this->initialize_layout_settings();
    }

    /**
     * Initialize Objects
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @return void
     */
    public function initialize_objects()
    {
        new SidebarGenerator(self::$config);
        new MenuGenerator(self::$config);
    }

    /**
     * Initialize admin only objects
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @return void
     */
    public function initialize_admin_only_objects()
    {
        if (is_admin())
        {
            new SettingsMenu(self::$config);
            new MetaboxLoader(self::$config);
            new CustomizeSectionLoader(self::$config);
        }
    }

    /**
     * Initialize layout settings
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @return void
     */
    private function initialize_layout_settings()
    {
        new Layout(self::$config);
    }

}
