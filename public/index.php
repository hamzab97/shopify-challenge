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
    echo "Shopify challenge <br>";
    echo "enter path /index.php/books to retrieve information on all items <br>";
    echo "enter path /index.php/book/{name} to retrieve info on book 'name' <br>";
    echo "enter path /index.php/purchase/{name} to purchase book 'name' <br>";
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

$app->get('/book/{name}', function ($request) {
    require_once ('connectdb.php');
    $name = $request->getAttribute('name');
//    echo $name;
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

$app->get('/purchase/{name}', function ($request) {
    require_once ('connectdb.php');
    $name = $request->getAttribute('name');
    $query = 'SELECT * FROM Product WHERE title = "' . $name . '"'; //get price of book
    $result = $mysqli->query($query); //execute query and obtain result

    if (!$result){//if query fails means that there was no such book in stock
        die ("No more quantity left for book");
    }
    $row = mysqli_fetch_assoc($result);
    echo $row;
    $data = json_decode($row, true);
    echo $data->inventory_count;
    echo PHP_EOL;
    echo $data;
    echo PHP_EOL;
    echo "hello";
//    $quantity = $result - 1;
//
//    if ($quantity == 0){
//        $query = 'DELETE FROM Product WHERE title = "'. $name .'"';
//        $result = $mysqli->query($query);
//        if (!$result){//if query fails means that there was no such book in stock
//            die ("delete from db query failed to execute");
//        }
//        else{
//            echo PHP_EOL;
//            echo "product removed from database. no more quantity left";
//        }
//    }
//    else{
//        $query = 'UPDATE Product SET inventory_count = "'. $quantity. '" WHERE title ="'. $name .'"';
//        $result = $mysqli->query($query);
//        if (!$result){//if query fails means that there was no such book in stock
//            die ("update product inventory count query failed");
//        }
//        else{
//            echo PHP_EOL;
//            echo "product quantity was updated in the database. remaining: ";
//            echo $quantity;
//        }
//    }
});

$app->run();