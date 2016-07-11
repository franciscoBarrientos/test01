<?php
/**
 * Created by PhpStorm.
 * User: Francisco
 * Date: 08-07-16
 * Time: 05:50 PM
 */

function connect(){

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "test";

// Create connection
    $conn = new mysqli($servername, $username, $password, $database);

// Check connection
    if ($conn->connect_errno) {
        die("No se pudo conectar a la base de datos: " . $conn->connect_error);
    }
    //echo "Connected successfully";

    //mysql_query("SET NAMES 'utf8'",$conn);

    //@mysql_query("SET NAMES 'utf8'",$conn);

    return $conn;
}

?>