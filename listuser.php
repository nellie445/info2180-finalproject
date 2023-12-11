<?php

    session_start();

    $host = 'localhost';
    $username = 'FinalProject_user';
    $password = 'password123';
    $dbname = 'dolphin_crm';
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

