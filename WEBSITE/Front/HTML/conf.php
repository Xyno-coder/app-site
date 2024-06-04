<?php
$host = getenv("MYSQL_HOST");
$user = getenv("MYSQL_USER");
$pass = getenv("MYSQL_PASSWORD");
$db = getenv("MYSQL_DATABASE");
$bdd = new PDO("mysql:host=$host;dbname=$db", $user, $pass);