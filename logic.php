<?php
require("db.php");

$title  = $_POST['title'];
$amount = $_POST['amount'];

if (isset($title) && isset($amount))
  header("index.php");
