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

$dbhost = "us-cdbr-iron-east-01.cleardb.net";
$dbuser = "b8bf691a2d6f07";
$dbpass = "3d6e7d60";
$dbname = "heroku_46764fcc10616c8";
$mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

$configuration = [
    'settings' => [
        'displayErrorDetails' => true,
    ],
];
$c = new \Slim\Container($configuration);

$app = new \Slim\App($c);

$app->get('/', function(){
    echo "Shopify challenge";
    $query = 'SELECT * FROM Product';
    $result = $mysqli->query($query); //execute query and obtain result
    if (!$result){
        die ("database query failed");
    }
    while ($row = mysqli_fetch_assoc($result)){ //store result in array
        $data[] = $row;
    }

    echo json_encode($data); //display array in json format
});

$app->get('/books', function () {
    $query = 'SELECT * FROM Product';
    $result = $mysqli->query($query); //execute query and obtain result
    if (!$result){
        die ("database query failed");
    }
    while ($row = mysqli_fetch_assoc($result)){ //store result in array
        $data[] = $row;
    }

    echo json_encode($data); //display array in json format

});

//$app->get('/api/{name}', function (array $args) {
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
//
//$app->get('/api/purchase', function (array $args) {
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