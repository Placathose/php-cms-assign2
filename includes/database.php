<?php

$connect = mysqli_connect( 
    "localhost", // Host
    "root", // Username
    "root", // Password
    "museumtour_db" // Database
);

mysqli_set_charset( $connect, 'UTF8' );