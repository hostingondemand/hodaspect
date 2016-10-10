<?php namespace modules\hodaspect\listener;
class fieldPreSet extends \lib\event\BaseListener
{
    function handle($data)
    {
        if(substr($data["field"],0,1)!="_") {
            $aspects = $this->annotation->getAnnotationsForField($data["class"], $data["field"]);
            $this->aspects->run("onFieldPreSet", $aspects, $data);
        }
    }
}