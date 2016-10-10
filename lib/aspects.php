<?php

namespace modules\hodaspect\lib;

use core\Loader;

class aspects
{

    function __construct()
    {
        Loader::loadClass("baseAspect","modules/hodaspect/lib/hodaspect");
    }


    function run($method, $aspects, $data)
    {
        foreach ($aspects as $aspect) {
            if (substr($aspect, -1)) {
                $aspect = substr($aspect, 0, -1);
            }

            $exp = explode("(", $aspect);
            $instance = Loader::getSingleton($exp[0], "aspect");
            if ($instance) {
                if (count($exp) > 1) {
                    $parameters = explode(",", $exp[1]);
                } else {
                    $parameters = array();
                }
                $instance->$method($parameters, $data);
            }
        }
    }


}

?>