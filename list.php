
<!--
원본 코드 (2025-07-09 이전):
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
-->

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>게시판 목록</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            backdrop-filter: blur(10px);
        }

        .header {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            padding: 30px;
            text-align: center;
            color: white;
        }

        .page-title {
            font-size: 2.5em;
            margin-bottom: 15px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
            font-weight: 700;
        }

        .content-area {
            padding: 40px;
        }

        .write-button {
            text-align: center;
            margin-bottom: 30px;
        }

        .btn {
            padding: 12px 25px;
            border: none;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 600;
            font-size: 1em;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .btn:hover::before {
            left: 100%;
        }

        .btn-write {
            background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
            color: white;
        }

        .btn-write:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(67, 233, 123, 0.3);
        }

        .table-container {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .post-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 1em;
        }

        .post-table th {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            color: white;
            padding: 20px 15px;
            text-align: left;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .post-table td {
            padding: 15px;
            border-bottom: 1px solid #eee;
            vertical-align: middle;
        }

        .post-table tr:hover {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            transform: scale(1.01);
            transition: all 0.3s ease;
        }

        .post-table tr:last-child td {
            border-bottom: none;
        }

        .post-link {
            color: #333;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .post-link:hover {
            color: #4facfe;
            text-shadow: 0 2px 4px rgba(79, 172, 254, 0.3);
        }

        .post-id {
            font-weight: 600;
            color: #666;
            text-align: center;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-radius: 8px;
            padding: 8px;
            width: 60px;
        }

        .post-author {
            color: #666;
            font-style: italic;
        }

        .post-date {
            color: #999;
            font-size: 0.9em;
        }

        .post-count {
            text-align: center;
            color: #4facfe;
            font-weight: 600;
            background: rgba(79, 172, 254, 0.1);
            border-radius: 15px;
            padding: 5px 10px;
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #666;
            font-size: 1.1em;
        }

        .empty-state .icon {
            font-size: 4em;
            margin-bottom: 20px;
        }

        @media (max-width: 768px) {
            .container {
                margin: 10px;
                border-radius: 15px;
            }

            .header {
                padding: 20px;
            }

            .page-title {
                font-size: 2em;
            }

            .content-area {
                padding: 20px;
            }

            .post-table {
                font-size: 0.9em;
            }

            .post-table th,
            .post-table td {
                padding: 10px 8px;
            }

            .post-table th:nth-child(4),
            .post-table td:nth-child(4) {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1 class="page-title">📋 게시판</h1>
        </div>

        <div class="content-area">
            <div class="write-button">
                <a href="write.php" class="btn btn-write">
                    <span>✏️</span>
                    <span>글쓰기</span>
                </a>
            </div>

            <div class="table-container">
                <?php
                $conn = new mysqli("localhost", "sik", "an0928", "crudtest");
                $result = $conn->query("SELECT idx, title, name, regdate, count FROM contents ORDER BY idx DESC");

                if ($result->num_rows > 0) {
                    echo "<table class='post-table'>";
                    echo "<thead>";
                    echo "<tr>";
                    echo "<th>번호</th>";
                    echo "<th>제목</th>";
                    echo "<th>작성자</th>";
                    echo "<th>날짜</th>";
                    echo "<th>조회수</th>";
                    echo "</tr>";
                    echo "</thead>";
                    echo "<tbody>";
                    
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td><div class='post-id'>{$row['idx']}</div></td>";
                        echo "<td><a href='view.php?idx={$row['idx']}' class='post-link'>" . htmlspecialchars($row['title']) . "</a></td>";
                        echo "<td><span class='post-author'>" . htmlspecialchars($row['name']) . "</span></td>";
                        echo "<td><span class='post-date'>{$row['regdate']}</span></td>";
                        echo "<td><span class='post-count'>" . number_format($row['count']) . "</span></td>";
                        echo "</tr>";
                    }
                    echo "</tbody>";
                    echo "</table>";
                } else {
                    echo "<div class='empty-state'>";
                    echo "<div class='icon'>📝</div>";
                    echo "<p>아직 작성된 게시글이 없습니다.</p>";
                    echo "<p>첫 번째 글을 작성해보세요!</p>";
                    echo "</div>";
                }
                ?>
            </div>
        </div>
    </div>
</body>
</html>