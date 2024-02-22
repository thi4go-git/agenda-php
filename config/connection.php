<?php

$host = "127.0.0.1";
$dbname = "agenda";
$user = "postgres";
$pass = "895674";

/*
-Qualquer conexão com o banco deverá ser liberada no php.ini
-Para conexão com mysql:
$conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
*/

try {
  //Conexão com MySql
  //$conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);

  //Conexão com PostgreSQL
  $conn = new PDO("pgsql:host=$host;dbname=$dbname;user=$user;password=$pass");

  // Ativar o modo de erros
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  $error = $e->getMessage();
  echo "Erro: $error";
}

