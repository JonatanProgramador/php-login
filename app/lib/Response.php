<?php

class Response
{
    public static $message;
    public static  $code;
    public static  $data;
    public static  $error;

    public static function send()
    {
        
        print(json_encode([
            "message" => Response::$message,
            "code" => Response::$code,
            "data" => Response::$data,
            "error" => Response::$error
        ]));
    }

    public static function empty()
    {
        Response::$message = null;
        Response::$code = null;
        Response::$data = null;
        Response::$error = null;
    }
}
