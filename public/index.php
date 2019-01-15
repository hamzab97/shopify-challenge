<?php
/**
 * Created by PhpStorm.
 * User: hamzabana
 * Date: 2019-01-14
 * Time: 14:50
 */

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';
//require 'connectdb.php';

$configuration = [
    'settings' => [
        'displayErrorDetails' => true,
    ],
];
$c = new \Slim\Container($configuration);

$app = new \Slim\App($c);

$app->get('/', function(){
    echo "Shopify challenge";
});

$app->get('/books', function () {
    require_once ('connectdb.php');
    $query = "SELECT * FROM Product";
    $result = $mysqli->query($query); //execute query and obtain result
    if (!$result){
        die ("database query failed");
    }
    while ($row = mysqli_fetch_assoc($result)){ //store result in array
        $data[] = $row;
    }

    echo json_encode($data); //display array in json format

});

$app->get('/book/{name}', function (array $args) {
    require_once ('connectdb.php');

    $name = $args['name'];
    echo $name;
    $query = 'SELECT * FROM Product WHERE title = "' . $name . '"';
    $result = $mysqli->query($query); //execute query and obtain result
    if (!$result){
        die ("database query failed");
    }
    while ($row = mysqli_fetch_assoc($result)){ //store result in array
        $data[] = $row;
    }

    echo json_encode($data); //display array in json format
});

//$app->get('/purchase/{name}', function (array $args) {
//    require_once ('connectdb.php');
//
//    $name = $args['name'];
//    $query = 'SELECT * FROM Product WHERE title = "' . $name . '"';
//    $result = $mysqli->query($query); //execute query and obtain result
//    if (!$result){
//        die ("database query failed");
//    }
//    while ($row = mysqli_fetch_assoc($result)){ //store result in array
//        $data[] = $row;
//    }
//
//    echo json_encode($data); //display array in json format
//});

$app->run();