<?php
// index.php
require 'config.php';

// Mesajları veritabanından çek
$stmt = $pdo->query('SELECT isim, mesaj, tarih FROM mesajlar ORDER BY tarih DESC');
$mesajlar = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Ziyaretçi Defteri</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Ziyaretçi Defteri</h1>

    <form action="submit.php" method="post">
        <label for="isim">İsim:</label><br>
        <input type="text" id="isim" name="isim" required><br><br>
        <label for="mesaj">Mesaj:</label><br>
        <textarea id="mesaj" name="mesaj" rows="4" cols="50" required></textarea><br><br>
        
        <button type="submit">Gönder</button>
    </form>

    <h2>Mesajlar</h2>
    <?php if ($mesajlar): ?>
        <?php foreach ($mesajlar as $mesaj): ?>
            <div class="mesaj">
                <h3><?php echo htmlspecialchars($mesaj['isim'], ENT_QUOTES, 'UTF-8'); ?></h3>
                <p><?php echo nl2br(htmlspecialchars($mesaj['mesaj'], ENT_QUOTES, 'UTF-8')); ?></p>
                <span><?php echo $mesaj['tarih']; ?></span>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Henüz mesaj yok.</p>
    <?php endif; ?>
</body>
</html>
