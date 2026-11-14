<?php
require __DIR__ . '/config.php';
$db = db_status();
?>
<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bun venit!</title>
    <style>
        * { box-sizing: border-box; }
        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: system-ui, -apple-system, "Segoe UI", sans-serif;
            background: linear-gradient(135deg, #0f172a, #1e3a8a 55%, #047857);
            color: #f8fafc;
        }
        .card {
            max-width: 560px;
            margin: 24px;
            padding: 40px 36px;
            text-align: center;
            background: rgba(255, 255, 255, .08);
            border: 1px solid rgba(255, 255, 255, .18);
            border-radius: 20px;
            backdrop-filter: blur(10px);
            box-shadow: 0 20px 50px rgba(0, 0, 0, .35);
        }
        .emoji { font-size: 56px; }
        h1 { margin: 12px 0 8px; font-size: 32px; }
        p { margin: 8px 0; line-height: 1.5; color: #e2e8f0; }
        .status {
            display: inline-block;
            margin-top: 20px;
            padding: 8px 16px;
            border-radius: 999px;
            font-size: 14px;
            font-weight: 600;
        }
        .ok  { background: #16a34a; }
        .bad { background: #dc2626; }
        .info { margin-top: 24px; font-size: 13px; color: #cbd5e1; }
        a { color: #93c5fd; }
    </style>
</head>
<body>
    <div class="card">
        <div class="emoji">🎉</div>
        <h1>Bun venit!</h1>
        <p>Ai reușit și ai ajuns aici cu succes.</p>
        <p>Serverul PHP <?= htmlspecialchars(PHP_VERSION) ?> funcționează corect.</p>

        <?php if ($db['ok']): ?>
            <span class="status ok">✔ Baza de date conectată: <?= htmlspecialchars($db['msg']) ?></span>
        <?php else: ?>
            <span class="status bad">✖ Baza de date nu răspunde încă</span>
            <p class="info">
                MySQL pornește mai lent la prima rulare. Reîncarcă pagina peste câteva secunde.<br>
                <small><?= htmlspecialchars($db['msg']) ?></small>
            </p>
        <?php endif; ?>

        <p class="info">
            Site: <a href="http://localhost:8080">localhost:8080</a> ·
            CloudBeaver: <a href="http://localhost:8978" target="_blank" rel="noopener">localhost:8978</a>
        </p>
    </div>
</body>
</html>
