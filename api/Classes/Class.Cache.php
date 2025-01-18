<?php

    function GetCache($key) {
        $memcaches_obj = new Memcached();
        $memcaches_obj->addServer('127.0.0.1', 11211);
        $value = $memcaches_obj->get($key);
        $memcaches_obj->Quit();
        return $value;
        
    }

    function SetCache($key, $value) {
        $memcaches_obj = new Memcached();
        $memcaches_obj->addServer('127.0.0.1', 11211);
        $memcaches_obj->set($key, $value, 86400);
        $memcaches_obj->Quit();
        return true;
    }

?>