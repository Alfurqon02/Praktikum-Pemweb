<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    </style>
</head>
<body>
<div class="container position-absolute top-50 start-50 translate-middle">
<?php
        // Cek apakah form registrasi sudah disubmit
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Simpan data yang diinputkan
            $nama = $_POST["nama"];
            $username = $_POST["username"];
            $password = $_POST["password"];

            // Cek ke dalam database untuk validasi
            // Misalnya, jika menggunakan database MySQL
            $host = "localhost";
            $db_username = "root";
            $db_password = "";
            $database = "pemweb-week8";

            // Buat koneksi ke database
            $conn = mysqli_connect($host, $db_username, $db_password, $database);
            if (!$conn) {
                die("Koneksi gagal: " . mysqli_connect_error());
            }

            // Query untuk memeriksa apakah username sudah terdaftar
            $query = "SELECT * FROM user WHERE username='$username'";
            $result = mysqli_query($conn, $query);

            // Jika username belum terdaftar, lakukan proses registrasi
            if (mysqli_num_rows($result) == 0) {
                // Query untuk menyimpan data ke database
                $insertQuery = "INSERT INTO user (nama, username, password) VALUES ('$nama', '$username', '$password')";
                $insertResult = mysqli_query($conn, $insertQuery);

                // Jika proses registrasi berhasil
                if ($insertResult) {
                    echo '<div class="alert alert-success" role="alert">Registrasi berhasil!</div>';
                    // Lakukan aksi setelah registrasi berhasil, misalnya redirect ke halaman login
                    // header("Location: login.php");
                } else {
                    echo '<div class="alert alert-danger" role="alert">Terjadi kesalahan saat registrasi.</div>';
                }
            } else {
                echo '<div class="alert alert-danger" role="alert">Username sudah terdaftar. Silakan gunakan username lain.</div>';
            }

            // Tutup koneksi database
            mysqli_close($conn);
        }
        ?>

        <div class="card card-compact">
            <div class="card-body">
                <h2 class="card-title">Registrasi</h2>
                <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                    <div class="form-group">
                        <label for="nama">Nama:</label>
                        <input type="text" class="form-control" name="nama" required>
                    </div>

                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" class="form-control" name="username" required>
                    </div>

                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" class="form-control" name="password" required>
                    </div>

                    <button type="submit" class="btn btn-primary mt-2 ">Register</button>

                    <div class="mt-2">Sudah memiliki akun? <a href="http://localhost:8080/pemweb-week8/login.php">Masuk</a></div>
                </form>
            </div>
        </div>
</div>
</body>
</html>


