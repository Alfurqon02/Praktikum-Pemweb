<?php
// Koneksi ke database
$host = "localhost";
$username = "root";
$password = "";
$database = "barang";
$conn = mysqli_connect($host, $username, $password, $database);
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_barang = $_POST["id_barang"];
    $nama_barang = $_POST["nama_barang"];
    $jumlah_barang = $_POST["jumlah_barang"];

    $stmt = mysqli_prepare($conn, "UPDATE barang SET nama_barang = ?, jumlah_barang = ? WHERE id_barang = ?");
    mysqli_stmt_bind_param($stmt, "sii", $nama_barang, $jumlah_barang, $id_barang);
    $result = mysqli_stmt_execute($stmt);

    if ($result) {
        echo "Data barang berhasil diperbarui.";
        header("Location: index.php");
    } else {
        echo "Terjadi kesalahan: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>
