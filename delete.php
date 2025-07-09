<!--
원본 코드 (2025-07-09 이전):
<?php
$conn = new mysqli("localhost", "sik", "an0928", "crudtest");
$idx = $_GET['idx'];
$conn->query("DELETE FROM contents WHERE idx = $idx");
header("Location: list.php");
?>
-->

<?php
$conn = new mysqli("localhost", "sik", "an0928", "crudtest");
$idx = $_GET['idx'];

if (isset($_POST['confirm_delete'])) {
    // 삭제 확인이 된 경우
    $conn->query("DELETE FROM contents WHERE idx = $idx");
    header("Location: list.php");
    exit;
}

// 삭제할 게시글 정보 가져오기
$result = $conn->query("SELECT title, name FROM contents WHERE idx = $idx");
$row = $result->fetch_assoc();

if (!$row) {
    echo "<script>alert('존재하지 않는 게시글입니다.'); location.href='list.php';</script>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>글 삭제</title>
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
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .container {
            max-width: 500px;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            backdrop-filter: blur(10px);
        }

        .header {
            background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
            padding: 30px;
            text-align: center;
            color: white;
        }

        .page-title {
            font-size: 2em;
            margin-bottom: 10px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
            font-weight: 700;
        }

        .warning-icon {
            font-size: 3em;
            margin-bottom: 15px;
        }

        .content-area {
            padding: 40px;
            text-align: center;
        }

        .delete-warning {
            background: #fff3cd;
            border: 1px solid #ffeaa7;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 30px;
        }

        .post-info {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 30px;
            text-align: left;
        }

        .post-info h3 {
            color: #333;
            margin-bottom: 10px;
            font-size: 1.2em;
        }

        .post-detail {
            color: #666;
            line-height: 1.6;
        }

        .form-actions {
            display: flex;
            gap: 15px;
            justify-content: center;
        }

        .btn {
            padding: 15px 30px;
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

        .btn-delete {
            background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
            color: white;
        }

        .btn-delete:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(250, 112, 154, 0.3);
        }

        .btn-cancel {
            background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);
            color: #333;
        }

        .btn-cancel:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(168, 237, 234, 0.3);
        }

        @media (max-width: 600px) {
            .container {
                margin: 10px;
                border-radius: 15px;
            }

            .header {
                padding: 20px;
            }

            .page-title {
                font-size: 1.8em;
            }

            .content-area {
                padding: 20px;
            }

            .form-actions {
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
        <div class="header">
            <div class="warning-icon">⚠️</div>
            <h1 class="page-title">글 삭제</h1>
        </div>

        <div class="content-area">
            <div class="delete-warning">
                <strong>⚠️ 주의:</strong> 삭제된 게시글은 복구할 수 없습니다.
            </div>

            <div class="post-info">
                <h3>📝 삭제할 게시글 정보</h3>
                <div class="post-detail">
                    <strong>제목:</strong> <?= htmlspecialchars($row['title']) ?><br>
                    <strong>작성자:</strong> <?= htmlspecialchars($row['name']) ?>
                </div>
            </div>

            <p style="margin-bottom: 30px; color: #666; font-size: 1.1em;">
                정말로 이 게시글을 삭제하시겠습니까?
            </p>

            <form method="post" class="form-actions">
                <button type="submit" name="confirm_delete" class="btn btn-delete">
                    <span>🗑️</span>
                    <span>삭제</span>
                </button>
                <a href="view.php?idx=<?= $idx ?>" class="btn btn-cancel">
                    <span>↩️</span>
                    <span>취소</span>
                </a>
            </form>
        </div>
    </div>
</body>
</html>