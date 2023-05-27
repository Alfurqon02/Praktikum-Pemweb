<!DOCTYPE html>
<html>
<head>
    <title>Form Tambah Barang</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body >
    <div>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createModal">Tambah Barang</button>

    <h2 class="mt-4">Data Barang</h2>
    <table>
        <tr>
            <th>Nama Barang</th>
            <th>Jumlah Barang</th>
            <th>Tanggal Dibuat</th>
            <th>Aksi</th>
        </tr>
        <?php
        $host = "localhost";
        $username = "root";
        $password = "";
        $database = "barang";
        $conn = mysqli_connect($host, $username, $password, $database);
        if (!$conn) {
            die("Koneksi gagal: " . mysqli_connect_error());
        }

        $sql = "SELECT * FROM barang";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row["nama_barang"] . "</td>";
                echo "<td>" . $row["jumlah_barang"] . "</td>";
                echo "<td>" . $row["created_at"] . "</td>";
                echo "<td>";
                echo "<a style='color:black'class='text-decoration-none'href='edit.php?id=" . $row["id_barang"] . "'>Edit</a> || ";
                echo "<a onclick='confirmDelete(" . $row['id_barang'] . ")'>Hapus</a>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>Tidak ada data barang.</td></tr>";
        }

        mysqli_close($conn);
        ?>
    </table>
    </div>

    <!-- Modal Create -->
    <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Tambah Barang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="create.php">
                        <div class="form-group">
                            <label for="nama_barang">Nama Barang</label>
                            <input type="text" class="form-control" id="nama_barang" name="nama_barang" required>
                        </div>
                        <div class="form-group">
                            <label for="jumlah_barang">Jumlah Barang</label>
                            <input type="number" class="form-control" id="jumlah_barang" name="jumlah_barang" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit -->
    <!-- <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Barang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editForm" method="POST" action="edit.php">
                        <input type="hidden" id="editId" name="id">
                        <div class="form-group">
                            <label for="editNamaBarang">Nama Barang</label>
                            <input type="text" class="form-control" id="editNamaBarang" name="nama_barang" required>
                        </div>
                        <div class="form-group">
                            <label for="editJumlahBarang">Jumlah Barang</label>
                            <input type="number" class="form-control" id="editJumlahBarang" name="jumlah_barang" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div> -->

    <!-- Modal Delete-->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Penghapusan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
                    Apakah Anda yakin ingin menghapus data barang ini?
      </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Batal</button>
                    <button id="deleteButton" type="button" class="btn btn-danger" onclick="deleteData()">Hapus</button>
                </div>
      </div>
    </div>
  </div>
</div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        var deleteId;

        function confirmDelete(id) {
            deleteId = id;
            $('#exampleModal').modal('show');
        }

        function deleteData() {
            window.location = "delete.php?id=" + deleteId;
        }

        $('#exampleModal').on('hidden.bs.modal', function () {
            deleteId = null;
        });

        // function openEditModal(id, namaBarang, jumlahBarang) {
        //     document.getElementById('editId').value = id;
        //     document.getElementById('editNamaBarang').value = namaBarang;
        //     document.getElementById('editJumlahBarang').value = jumlahBarang;
        //     $('#editModal').modal('show');
        // }
    </script>
</body>
</html>