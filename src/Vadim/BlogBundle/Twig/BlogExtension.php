<?php

namespace Vadim\BlogBundle\Twig;

class BlogExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            'dotdotdot' => new \Twig_Filter_Method($this, 'dotdotdot')
        );
    }

    public function dotdotdot($string, $number=3)
    {
        if (strlen($string) <= $number)
            return $string;
        if($string != '') {
            $str = '';
            $aStr = explode(' ', $string);

            for ($i=0; $number>$i; $i++) {
                if (isset($aStr[$i]))
                    $str .= $aStr[$i].' ';
            }

            if (count($aStr) > $number)
                $str = rtrim($str).'...';
            return $str;
        }

    }

    public function getName()
    {
        return 'blog_extension';
    }
}