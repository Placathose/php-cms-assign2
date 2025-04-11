<?php

$connect = mysqli_connect( 
    "localhost", // Host
    "root", // Username
    "root", // Password
    "museum_management" // Database
);

mysqli_set_charset( $connect, 'UTF8' );