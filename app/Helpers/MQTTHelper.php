<?php


namespace App\Helpers;


class MQTTHelper {

    protected $mqtt;

    function connect($server, $port, $username, $password) {
        $client_id = str_random(10); // make sure this is unique for connecting to sever - you could use uniqid()
        $this->mqtt = new MQTT($server, $port, $client_id);
        if ($this->mqtt->connect(true, NULL, $username, $password)) {
            return true;
        } else {
            return false;
        }
    }

    function publish($topic, $data) {
        $this->mqtt->publish($topic, json_encode($data));
    }

    function subscribe($topic) {
        $this->mqtt->subscribe($topic);
    }

    function onMessage() {
        return $this->mqtt->proc(true);
    }

}
