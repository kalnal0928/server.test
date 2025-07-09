
<?php
$conn = new mysqli("localhost", "sik", "an0928", "crudtest");
$name = $_POST['name'];
$title = $_POST['title'];
$content = $_POST['content'];

$sql = "INSERT INTO contents (name, title, content) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $name, $title, $content);
$stmt->execute();
header("Location: list.php");
?>