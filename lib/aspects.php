<?php

namespace modules\hodaspect\lib;

use core\Loader;

class aspects
{

    function __construct()
    {
        Loader::loadClass("baseAspect","modules/hodaspect/lib/hodaspect");
    }

    function getAnnotationsForClass($class)
    {
        $r = new \ReflectionClass($class);
        $doc = $r->getDocComment();
        preg_match_all('#@(.*?)\n#s', $doc, $annotations);
        if (isset($annotations[1])) {
            return $annotations[1];
        }
        return array();
    }


    function getAnnotationsForMethod($class,$method)
    {

        $r = new \ReflectionMethod($class,$method);
        $doc = $r->getDocComment();
        preg_match_all('#@(.*?)\n#s', $doc, $annotations);
        if (isset($annotations[1])) {
            return array_merge($this->getAnnotationsForClass($class),$annotations[1]);
        }
        return array();
    }


    function getAnnotationsForField($class,$field)
    {

        $r = new \ReflectionProperty($class,$field);
        $doc = $r->getDocComment();
        preg_match_all('#@(.*?)\n#s', $doc, $annotations);
        if (isset($annotations[1])) {
            return array_merge($this->getAnnotationsForClass($class),$annotations[1]);
        }
        return array();
    }

    function run($method, $aspects, $data)
    {
        foreach ($aspects as $aspect) {
            if(substr($aspect,-1)){
                $aspect=substr($aspect,0,-1);
            }

            $exp = explode("(",$aspect);
            $instance = Loader::getSingleton($exp[0], "aspect");
            if ($instance) {
                if (count($exp) > 1) {
                    $parameters = explode(",", $exp[1]);
                } else {
                    $parameters = array();
                }
                $instance->$method($parameters,$data);
            }
        }
    }


}

?>