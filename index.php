<?php
declare(strict_types=1);
require __DIR__ . '/../app/db.php';

$error = null;
$messages = [];
$dbVersion = null;

try {
    $pdo = db();
    $dbVersion = $pdo->getAttribute(PDO::ATTR_SERVER_VERSION);

    // Add a new message (POST)
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $author  = trim($_POST['author'] ?? '');
        $content = trim($_POST['content'] ?? '');

        if ($author === '' || $content === '') {
            $error = 'Please fill in both fields.';
        } elseif (mb_strlen($author) > 100 || mb_strlen($content) > 500) {
            $error = 'The text is too long.';
        } else {
            $stmt = $pdo->prepare('INSERT INTO messages (author, content) VALUES (?, ?)');
            $stmt->execute([$author, $content]);
            header('Location: /');   // prevents form resubmission on refresh
            exit;
        }
    }

    $messages = $pdo->query('SELECT id, author, content, created_at FROM messages ORDER BY id DESC')->fetchAll();
} catch (PDOException $ex) {
    $error = 'Could not connect to the database: ' . $ex->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome!</title>
    <style>
        * { box-sizing: border-box; }
        body {
            margin: 0; min-height: 100vh; padding: 32px 16px;
            font-family: system-ui, -apple-system, "Segoe UI", sans-serif;
            background: linear-gradient(135deg, #0f172a, #1e3a8a 55%, #047857);
            color: #f8fafc;
        }
        .wrap { max-width: 640px; margin: 0 auto; }
        .card {
            padding: 28px; margin-bottom: 20px;
            background: rgba(255,255,255,.08);
            border: 1px solid rgba(255,255,255,.18);
            border-radius: 18px;
            backdrop-filter: blur(10px);
        }
        .center { text-align: center; }
        h1 { margin: 8px 0; font-size: 30px; }
        h2 { margin: 0 0 16px; font-size: 20px; }
        p { color: #e2e8f0; line-height: 1.5; margin: 6px 0; }
        .badge { display: inline-block; margin-top: 12px; padding: 6px 14px;
                 border-radius: 999px; font-size: 13px; font-weight: 600; background: #16a34a; }
        .err { background: #dc2626; padding: 10px 14px; border-radius: 10px; margin-bottom: 14px; font-size: 14px; }
        input, textarea {
            width: 100%; padding: 10px 12px; margin-bottom: 10px;
            border: 1px solid rgba(255,255,255,.25); border-radius: 10px;
            background: rgba(0,0,0,.25); color: #fff; font: inherit;
        }
        button {
            padding: 10px 20px; border: 0; border-radius: 10px; cursor: pointer;
            background: #22c55e; color: #052e16; font-weight: 700; font-size: 15px;
        }
        button:hover { background: #4ade80; }
        .msg { padding: 12px 0; border-top: 1px solid rgba(255,255,255,.12); }
        .msg:first-child { border-top: 0; }
        .meta { font-size: 12px; color: #94a3b8; }
        a { color: #93c5fd; }
    </style>
</head>
<body>
<div class="wrap">

    <div class="card center">
        <div style="font-size:52px">🎉</div>
        <h1>Welcome!</h1>
        <p>You made it, and you arrived here successfully.</p>
        <p>PHP <?= e(PHP_VERSION) ?> is working correctly.</p>
        <?php if ($dbVersion): ?>
            <span class="badge">✔ MySQL <?= e($dbVersion) ?> connected</span>
        <?php endif; ?>
        <p class="meta" style="margin-top:14px">
            CloudBeaver: <a href="http://localhost:8978" target="_blank" rel="noopener">localhost:8978</a>
        </p>
    </div>

    <div class="card">
        <h2>Add a message to the database</h2>
        <?php if ($error): ?><div class="err"><?= e($error) ?></div><?php endif; ?>
        <form method="post" action="/">
            <input type="text" name="author" placeholder="Your name" maxlength="100" required>
            <textarea name="content" rows="3" placeholder="Your message" maxlength="500" required></textarea>
            <button type="submit">Save</button>
        </form>
    </div>

    <div class="card">
        <h2>Saved messages (<?= count($messages) ?>)</h2>
        <?php foreach ($messages as $m): ?>
            <div class="msg">
                <strong><?= e($m['author']) ?></strong>
                <span class="meta">· <?= e($m['created_at']) ?></span>
                <p><?= nl2br(e($m['content'])) ?></p>
            </div>
        <?php endforeach; ?>
        <?php if (!$messages && !$error): ?><p>No messages yet.</p><?php endif; ?>
    </div>

</div>
</body>
</html>
