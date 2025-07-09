
<?php
$conn = new mysqli("localhost", "sik", "an0928", "crudtest");
$idx = $_POST['idx'];
$name = $_POST['name'];
$title = $_POST['title'];
$content = $_POST['content'];

$sql = "UPDATE contents SET name=?, title=?, content=? WHERE idx=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssi", $name, $title, $content, $idx);
$stmt->execute();
header("Location: view.php?idx=$idx");
?>