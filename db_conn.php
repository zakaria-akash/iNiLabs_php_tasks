<?php

$sName = "localhost";
$uName = "root";
$pss = "";
$db_name = "to_do_list";

try {
  $conn = new PDO("mysql:host=$sName; dbname=$db_name", $uName, $pss);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}