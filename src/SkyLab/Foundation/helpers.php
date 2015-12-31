<?php

if ( ! function_exists('is_lifterlms_enabled')) {

    /**
     * Check if LifterLMS plugin is enabled
     *
     * @return bool
     */
    function is_lifterlms_enabled()
    {
        return class_exists('\LifterLMS');
    }

}