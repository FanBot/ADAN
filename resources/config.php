<?php
 
/*
	In this files we put all de congifiduration of the proyect like de databases acces and the paths to the libraries, functions and media.
*/
// Facebook app id $config["fbApp"]["appId"];
// Facebook app secret $config["fbApp"]["appSecret"];
// Base url id $config["urls"]["baseUrl"];
// Facebook app secret $config["fbApp"]["appSecret"];
 
$config = array(
    "db" => array(
        "fanbot" => array(
            "dbname" => "fanbot_db",
            "username" => "Dev",
            "password" => "\"TRFBMIsCWh{19",
            "host" => "localhost",
        )
    ),
    "fbApp" => array(
            "appId" => "1645168355707000",
            "appSecret" => "3e5c77fee5087278e2f04d8a7fffbd7f",
        ),
    "urls" => array(
        "baseUrl" => "http://ec2-52-26-183-244.us-west-2.compute.amazonaws.com"
    ),
    "paths" => array(
        "facebook-sdk" => "resources/library/facebook/php-sdk-v4/",
        "images" => array(
            "content" => $_SERVER["DOCUMENT_ROOT"] . "/images/content",
            "layout" => $_SERVER["DOCUMENT_ROOT"] . "/images/layout"
        )
    )
);

defined("LIBRARY_PATH")
    or define("LIBRARY_PATH", realpath(dirname(__FILE__) . '/library'));
    
defined('FACEBOOK_SDK_V4_SRC_DIR')
    or define('FACEBOOK_SDK_V4_SRC_DIR', realpath(dirname(__FILE__) . '/library/facebook/facebook-php-sdk-v4/src/Facebook/'));