<?php

abstract class GlobalController{


    public static function alert($type,$message){
        $_SESSION['alert'] = [
            "type" => $type,
            "msg" => $message
        ];
        $_SESSION['alert']['msg'] = str_replace('</p>', '<i class="fas fa-times"></i></p>', $_SESSION['alert']['msg']);
        return $_SESSION['alert'];
    }

    public static function sendJson($data){
        header("Access-Control-Allow-Origin: * ");
        header("Content-Type: application/json");
        echo htmlspecialchars(json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
    }
}