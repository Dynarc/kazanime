<?php

abstract class GlobalController{


    public static function alert($type,$message){
        $_SESSION['alert'] = [
            "type" => $type,
            "msg" => $message
        ];
        return $_SESSION['alert'];
    }

    public static function sendJson($data){
        header("Access-Control-Allow-Origin: * ");
        header("Content-Type: application/json");
        echo json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
}