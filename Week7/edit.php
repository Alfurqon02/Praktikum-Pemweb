<!DOCTYPE html>
<html>
<head>
    <title>Form Edit Barang</title>
</head>
<body>
    <h2>Edit Barang</h2>
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

        $stmt = mysqli_prepare($conn, "SELECT * FROM barang WHERE id_barang = ?");
        mysqli_stmt_bind_param($stmt, "i", $id_barang);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            ?>
            <form method="POST" action="update.php">
                <input type="hidden" name="id_barang" value="<?php echo $row["id_barang"]; ?>">

                <label for="nama_barang">Nama Barang:</label>
                <input type="text" name="nama_barang" value="<?php echo $row["nama_barang"]; ?>" required><br><br>

                <label for="jumlah_barang">Jumlah Barang:</label>
                <input type="number" name="jumlah_barang" value="<?php echo $row["jumlah_barang"]; ?>" required><br><br>

                <input type="submit" value="Update Barang">
            </form>
            <?php
        } else {
            echo "Data barang tidak ditemukan.";
        }

        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    } else {
        echo "ID barang tidak diberikan.";
    }
    ?>
</body>
</html>
