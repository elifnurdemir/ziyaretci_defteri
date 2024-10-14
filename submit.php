<?php
// submit.php
require 'config.php';

// Geliştirme sırasında hata raporlamasını aktifleştirin
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Sadece POST isteklerine izin ver
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Formdan gelen verileri al ve temizle
    $isim = trim($_POST['isim'] ?? '');
    $mesaj = trim($_POST['mesaj'] ?? '');

    // Basit doğrulama: Boş alanları kontrol et
    if (empty($isim) || empty($mesaj)) {
        // Boş alan varsa, kullanıcıyı geri yönlendir ve hata mesajı ekleyebilirsiniz
        header('Location: index.php?error=empty_fields');
        exit;
    }

    // Veritabanına eklemek için prepared statement kullan
    $stmt = $pdo->prepare('INSERT INTO mesajlar (isim, mesaj) VALUES (:isim, :mesaj)');
    $stmt->execute(['isim' => $isim, 'mesaj' => $mesaj]);

    // Başarılı eklemeden sonra ana sayfaya yönlendir
    header('Location: index.php?success=message_added');
    exit;
} else {
    // POST isteği değilse, erişimi engelle
    header('HTTP/1.1 403 Forbidden');
    echo 'Erişim engellendi.';
    exit;
}
?>
<?php
// Bağlantı ayarları
$dsn = "mysql:host=localhost;dbname=ziyaretci_defteri;charset=utf8";
$username = "root"; // XAMPP varsayılan kullanıcı adı
$password = ""; // XAMPP varsayılan şifre

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $kullanici_adi = $_POST['kullanici_adi'];
        $mesaj = $_POST['mesaj'];

        // Mesajı veritabanına ekleme
        $stmt = $pdo->prepare("INSERT INTO mesajlar (kullanici_adi, mesaj) VALUES (?, ?)");
        $stmt->execute([$kullanici_adi, $mesaj]);

        header("Location: index.php"); // Başarılıysa anasayfaya yönlendir
        exit();
    }
} catch (PDOException $e) {
    echo "Hata: " . $e->getMessage();
}
?>

