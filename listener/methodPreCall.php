<?php namespace modules\hodaspect\listener;
class methodPreCall extends \lib\event\BaseListener
{
    function handle($data)
    {
        if (substr($data["method"], 0, 1) != "_") {
            $aspects = $this->annotation->getAnnotationsForMethod($data["class"], $data["method"]);
            $this->aspects->run("onMethodPreCall", $aspects, $data);
        }
    }
}