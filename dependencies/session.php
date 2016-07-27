<?php
session_start();
if ($_SESSION['role'] != 1) header('Location: /OPTS2/index.php');
$sql = new mysqli('localhost', 'root', 'root', 'opts');