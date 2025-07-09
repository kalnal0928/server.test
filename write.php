<!--
원본 코드 (2025-07-09 이전):
<form method="post" action="write_ok.php">
    이름: <input type="text" name="name"><br>
    제목: <input type="text" name="title"><br>
    내용: <br><textarea name="content" rows="10" cols="50"></textarea><br>
    <input type="submit" value="글 작성">
</form>
-->

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>글쓰기</title>
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

        .page-title {
            font-size: 2.5em;
            margin-bottom: 15px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
            font-weight: 700;
        }

        .content-area {
            padding: 40px;
        }

        .write-form {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-label {
            display: block;
            margin-bottom: 10px;
            font-weight: 600;
            color: #333;
            font-size: 1.1em;
        }

        .form-input {
            width: 100%;
            padding: 15px;
            border: 2px solid #e1e5e9;
            border-radius: 10px;
            font-size: 1em;
            transition: all 0.3s ease;
            background: #f8f9fa;
        }

        .form-input:focus {
            outline: none;
            border-color: #4facfe;
            background: white;
            box-shadow: 0 0 0 3px rgba(79, 172, 254, 0.1);
        }

        .form-textarea {
            width: 100%;
            padding: 15px;
            border: 2px solid #e1e5e9;
            border-radius: 10px;
            font-size: 1em;
            resize: vertical;
            min-height: 200px;
            font-family: inherit;
            transition: all 0.3s ease;
            background: #f8f9fa;
        }

        .form-textarea:focus {
            outline: none;
            border-color: #4facfe;
            background: white;
            box-shadow: 0 0 0 3px rgba(79, 172, 254, 0.1);
        }

        .form-actions {
            display: flex;
            gap: 15px;
            justify-content: center;
            margin-top: 30px;
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

        .btn-submit {
            background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
            color: white;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(67, 233, 123, 0.3);
        }

        .btn-cancel {
            background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);
            color: #333;
        }

        .btn-cancel:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(168, 237, 234, 0.3);
        }

        .char-count {
            text-align: right;
            font-size: 0.9em;
            color: #666;
            margin-top: 5px;
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
                font-size: 2em;
            }

            .content-area {
                padding: 20px;
            }

            .write-form {
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
            <h1 class="page-title">✏️ 글쓰기</h1>
        </div>

        <div class="content-area">
            <form method="post" action="write_ok.php" class="write-form">
                <div class="form-group">
                    <label for="name" class="form-label">👤 이름</label>
                    <input type="text" id="name" name="name" class="form-input" required placeholder="이름을 입력하세요">
                </div>

                <div class="form-group">
                    <label for="title" class="form-label">📝 제목</label>
                    <input type="text" id="title" name="title" class="form-input" required placeholder="제목을 입력하세요">
                </div>

                <div class="form-group">
                    <label for="content" class="form-label">📄 내용</label>
                    <textarea id="content" name="content" class="form-textarea" required placeholder="내용을 입력하세요"></textarea>
                    <div class="char-count">
                        <span id="charCount">0</span> / 1000 characters
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-submit">
                        <span>📝</span>
                        <span>글 작성</span>
                    </button>
                    <a href="list.php" class="btn btn-cancel">
                        <span>📋</span>
                        <span>목록으로</span>
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script>
        // 글자 수 카운터
        const textarea = document.getElementById('content');
        const charCount = document.getElementById('charCount');
        
        textarea.addEventListener('input', function() {
            const count = this.value.length;
            charCount.textContent = count;
            
            if (count > 1000) {
                charCount.style.color = '#dc3545';
            } else {
                charCount.style.color = '#666';
            }
        });

        // 폼 유효성 검사
        document.querySelector('.write-form').addEventListener('submit', function(e) {
            const name = document.getElementById('name').value.trim();
            const title = document.getElementById('title').value.trim();
            const content = document.getElementById('content').value.trim();

            if (!name || !title || !content) {
                e.preventDefault();
                alert('모든 필드를 입력해주세요.');
                return;
            }

            if (content.length > 1000) {
                e.preventDefault();
                alert('내용은 1000자 이하로 작성해주세요.');
                return;
            }
        });
    </script>
</body>
</html>