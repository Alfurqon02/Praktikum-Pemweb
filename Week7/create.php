<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "barang";
$conn = mysqli_connect($host, $username, $password, $database);
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_barang = $_POST["nama_barang"];
    $jumlah_barang = $_POST["jumlah_barang"];

    $stmt = mysqli_prepare($conn, "INSERT INTO barang (nama_barang, jumlah_barang, created_at) VALUES (?, ?, NOW())");
    mysqli_stmt_bind_param($stmt, "si", $nama_barang, $jumlah_barang);
    $result = mysqli_stmt_execute($stmt);

    if ($result) {
        echo "Barang berhasil ditambahkan.";
        header("Location: index.php");

    } else {
        echo "Terjadi kesalahan: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>
