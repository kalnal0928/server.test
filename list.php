
<?php
$conn = new mysqli("localhost", "sik", "an0928", "crudtest");
$result = $conn->query("SELECT idx, title, name, regdate, count FROM contents ORDER BY idx DESC");

echo "<a href='write.php'>[글쓰기]</a><br><br>";
echo "<table border='1'>";
echo "<tr><th>번호</th><th>제목</th><th>작성자</th><th>날짜</th><th>조회수</th></tr>";
while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>{$row['idx']}</td>";
    echo "<td><a href='view.php?idx={$row['idx']}'>{$row['title']}</a></td>";
    echo "<td>{$row['name']}</td>";
    echo "<td>{$row['regdate']}</td>";
    echo "<td>{$row['count']}</td>";
    echo "</tr>";
}
echo "</table>";
?>