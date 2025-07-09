<!--
원본 코드 (2025-07-09 이전):
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
-->

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>게시글 보기</title>
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
            max-width: 800px;
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

        .post-title {
            font-size: 2.5em;
            margin-bottom: 15px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
            font-weight: 700;
        }

        .post-meta {
            background: rgba(255, 255, 255, 0.2);
            padding: 15px;
            border-radius: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 10px;
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .meta-icon {
            width: 20px;
            height: 20px;
            opacity: 0.8;
        }

        .content-area {
            padding: 40px;
        }

        .post-content {
            line-height: 1.8;
            font-size: 1.1em;
            color: #333;
            background: #f8f9fa;
            padding: 30px;
            border-radius: 15px;
            border-left: 5px solid #4facfe;
            margin-bottom: 30px;
            box-shadow: inset 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .action-buttons {
            display: flex;
            gap: 15px;
            justify-content: center;
            flex-wrap: wrap;
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

        .btn-edit {
            background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
            color: white;
        }

        .btn-edit:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(67, 233, 123, 0.3);
        }

        .btn-delete {
            background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
            color: white;
        }

        .btn-delete:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(250, 112, 154, 0.3);
        }

        .btn-list {
            background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);
            color: #333;
        }

        .btn-list:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(168, 237, 234, 0.3);
        }

        .divider {
            height: 2px;
            background: linear-gradient(90deg, transparent, #4facfe, transparent);
            margin: 20px 0;
        }

        @media (max-width: 600px) {
            .container {
                margin: 10px;
                border-radius: 15px;
            }

            .header {
                padding: 20px;
            }

            .post-title {
                font-size: 2em;
            }

            .content-area {
                padding: 20px;
            }

            .post-meta {
                flex-direction: column;
                align-items: flex-start;
            }

            .action-buttons {
                flex-direction: column;
            }

            .btn {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <?php
        $conn = new mysqli("localhost", "sik", "an0928", "crudtest");
        $idx = $_GET['idx'];

        // 조회수 증가
        $conn->query("UPDATE contents SET count = count + 1 WHERE idx = $idx");

        $result = $conn->query("SELECT * FROM contents WHERE idx = $idx");
        $row = $result->fetch_assoc();
        ?>

        <div class="header">
            <h1 class="post-title"><?= htmlspecialchars($row['title']) ?></h1>
            <div class="post-meta">
                <div class="meta-item">
                    <span>✍️</span>
                    <span>작성자: <?= htmlspecialchars($row['name']) ?></span>
                </div>
                <div class="meta-item">
                    <span>👁️</span>
                    <span>조회수: <?= number_format($row['count']) ?></span>
                </div>
                <div class="meta-item">
                    <span>📅</span>
                    <span>날짜: <?= $row['regdate'] ?></span>
                </div>
            </div>
        </div>

        <div class="content-area">
            <div class="post-content">
                <?= nl2br(htmlspecialchars($row['content'])) ?>
            </div>

            <div class="divider"></div>

            <div class="action-buttons">
                <a href="edit.php?idx=<?= $idx ?>" class="btn btn-edit">
                    <span>✏️</span>
                    <span>수정</span>
                </a>
                <a href="delete.php?idx=<?= $idx ?>" 
                   class="btn btn-delete" 
                   onclick="return confirm('정말 삭제하시겠습니까?')">
                    <span>🗑️</span>
                    <span>삭제</span>
                </a>
                <a href="list.php" class="btn btn-list">
                    <span>📋</span>
                    <span>목록</span>
                </a>
            </div>
        </div>
    </div>
</body>
</html>