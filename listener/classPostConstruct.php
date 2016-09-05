<?php namespace modules\hodaspect\listener;
class ClassPostConstruct extends \lib\event\BaseListener
{
    function handle($data)
    {

        $aspects=$this->aspects->getAnnotationsForClass($data["class"]);
        $this->aspects->run("onClassPostConstruct",$aspects,$data);
    }
}