<?php
/**
 * Created by PhpStorm.
 * User: marknelson
 * Date: 1/22/16
 * Time: 8:27 PM
 */

namespace SkyLab\Fonts;


class FontOptions
{
    public function get_font_options()
    {
        $typography_mixed_fonts = array_merge(
            $this->get_os_fonts(),
            $this->get_google_fonts()
        );
        asort($typography_mixed_fonts);

        return $typography_mixed_fonts;
    }
    private function get_os_fonts() {

        $os_faces = apply_filters(
            'launchpad_font_options', [
                'Arial, sans-serif' => 'Arial',
                '"Avant Garde", sans-serif' => 'Avant Garde',
                'Cambria, Georgia, serif' => 'Cambria',
                'Copse, sans-serif' => 'Copse',
                'Garamond, "Hoefler Text", Times New Roman, Times, serif' => 'Garamond',
                'Georgia, serif' => 'Georgia',
                '"Helvetica Neue", Helvetica, sans-serif' => 'Helvetica Neue',
                'Tahoma, Geneva, sans-serif' => 'Tahoma'
            ]
        );

        return $os_faces;
    }

    private function get_google_fonts()
    {
        $google_faces = [];

        $dir = realpath(dirname(__FILE__)) . '/webfonts.json';
        $string = file_get_contents($dir);

        if ($string)
        {
            $json_a = json_decode($string, true);

            if ($json_a)
            {
                foreach ($json_a['items'] as $font)
                {
                    $google_faces['google_' . $font['family'] . ', ' . $font['category']] = $font['family'];
                }

            }
        }

        return $google_faces;
    }
}