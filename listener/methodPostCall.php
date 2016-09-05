<?php namespace modules\hodaspect\listener;
class methodPostCall extends \lib\event\BaseListener
{
    function handle($data)
    {
        if(substr($data["method"],0,1)!="_") {
            $aspects = $this->aspects->getAnnotationsForMethod($data["class"], $data["method"]);
            $this->aspects->run("onMethodPostCall", $aspects, $data);
        }
    }
}