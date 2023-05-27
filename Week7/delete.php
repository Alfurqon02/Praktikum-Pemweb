<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "barang";
$conn = mysqli_connect($host, $username, $password, $database);
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

if (isset($_GET["id"])) {
    $id_barang = $_GET["id"];

    $stmt = mysqli_prepare($conn, "DELETE FROM barang WHERE id_barang = ?");
    mysqli_stmt_bind_param($stmt, "i", $id_barang);
    $result = mysqli_stmt_execute($stmt);

    if ($result) {
        echo "Data barang berhasil dihapus.";
        header("Location: index.php");
    } else {
        echo "Terjadi kesalahan: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>
