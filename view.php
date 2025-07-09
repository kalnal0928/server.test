<?php

$conn = new mysqli("localhost", "sik", "an0928", "crudtest");
$idx = $_GET['idx'];

// 조회수 증가
$conn->query("UPDATE contents SET count = count + 1 WHERE idx = $idx");

$result = $conn->query("SELECT * FROM contents WHERE idx = $idx");
$row = $result->fetch_assoc();

echo "<h2>{$row['title']}</h2>";
echo "작성자: {$row['name']} | 조회수: {$row['count']} | 날짜: {$row['regdate']}<br><hr>";
echo nl2br($row['content']) . "<hr>";
echo "<a href='edit.php?idx={$idx}'>수정</a> | ";
echo "<a href='delete.php?idx={$idx}' onclick='return confirm(\"정말 삭제하시겠습니까?\")'>삭제</a> | ";
echo "<a href='list.php'>목록</a>";
?>