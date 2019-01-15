<?php
/**
 * Created by PhpStorm.
 * User: hamzabana
 * Date: 2019-01-14
 * Time: 14:59
 */
//mysql://b8bf691a2d6f07:3d6e7d60@us-cdbr-iron-east-01.cleardb.net/heroku_46764fcc10616c8?reconnect=true

    //heroku database connection information
    $dbhost = "us-cdbr-iron-east-01.cleardb.net";
    $dbuser = "b8bf691a2d6f07";
    $dbpass = "3d6e7d60";
    $dbname = "heroku_46764fcc10616c8";
    $mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);