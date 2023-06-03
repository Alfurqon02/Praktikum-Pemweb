<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Koneksi ke database
    $host = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbName = "pemweb-week8";
    $conn = mysqli_connect($host, $dbUsername, $dbPassword, $dbName);
    if (!$conn) {
        die("Koneksi gagal: " . mysqli_connect_error());
    }

    // Query untuk memeriksa data login
    $query = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        // Login berhasil
        $_SESSION["username"] = $username;

        // Redirect ke halaman utama setelah login berhasil
        header("Location: index.php");
        exit();
    } else {
        // Jika login gagal, tampilkan pesan error
        $error_message = "Username atau password salah.";
    }

    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Process</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="alert alert-danger" role="alert">
            <?php echo $error_message; ?>
        </div>
        <a href="login.php" class="btn btn-primary">Kembali ke Halaman Login</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
