<?php
$host="localhost";
$user="root";
$password="";
$db="hospitalproject";
$data=new mysqli($host,$user,$password,$db);

if ($data->connect_errno){

    echo "nema povezivanja ".$data->connect_error;
    exit();
}
