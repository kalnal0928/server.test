<?php
$conn = new mysqli("localhost", "sik", "an0928", "crudtest");
$idx = $_GET['idx'];
$result = $conn->query("SELECT * FROM contents WHERE idx = $idx");
$row = $result->fetch_assoc();
?>
<form method="post" action="edit_ok.php">
    <input type="hidden" name="idx" value="<?= $idx ?>">
    이름: <input type="text" name="name" value="<?= $row['name'] ?>"><br>
    제목: <input type="text" name="title" value="<?= $row['title'] ?>"><br>
    내용:<br><textarea name="content" rows="10" cols="50"><?= $row['content'] ?></textarea><br>
    <input type="submit" value="수정 완료">
</form>