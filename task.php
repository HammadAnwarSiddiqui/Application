<?php
$host = '127.0.0.1';
$db   = 'telephone_directory';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    echo "Database connection failed: " . $e->getMessage();
}
?>

<?php
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
    $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$username, $password]);
        echo "User registered successfully!";
    } catch (PDOException $e) {
        echo "Registration failed: " . $e->getMessage();
    }
}
?>
