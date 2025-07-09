<?php
$conn = new mysqli("localhost", "sik", "an0928", "crudtest");
$idx = $_GET['idx'];
$conn->query("DELETE FROM contents WHERE idx = $idx");
header("Location: list.php");
?>