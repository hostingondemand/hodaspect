<?php namespace modules\hodaspect\listener;
class fieldPreGet extends \lib\event\BaseListener
{
    function handle($data)
    {
        if(substr($data["field"],0,1)!="_") {
            $aspects = $this->aspects->getAnnotationsForField($data["class"], $data["field"]);
            $this->aspects->run("onFieldPreGet", $aspects, $data);
        }
    }
}