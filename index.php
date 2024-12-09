<?php
require_once 'Barang.php';
require_once 'BarangManager.php';

$barangManager = new BarangManager();

//menangani form tambah barang
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tambah'])) {
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $barangManager->tambahBarang($nama, $harga, $stok);
    header('Location: index.php');
}

//Menangani Penghapusan Barang
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $barangManager->hapusBarang($id);
    header('Location: index.php');//Redirect Setelah Menghapus
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pencatatan Barang</title>
    <link rel="stylesheet" href="style.css?<?= time() ?>">
</head>
<body>
    <nav>
        <a href="home.php">Home</a>
        <a href="index.php">Barang</a>
        <a href="TabelCustomer.php">Customer</a>
    </nav>
    <div class="container">
        <h1>Pencatatan Barang</h1>
        <form method="POST" action="">
            <div>
                <label for="nama">Nama Barang</label>
                <input type="text" id="nama" name="nama" required></input>
            </div>
            <div>
                <label for="harga">Harga Barang</label>
                <input type="text" id="harga" name="harga" required></input>
            </div>
            <div>
                <label for="stok">Stok Barang</label>
                <input type="text" id="stok" name="stok" required></input>
            </div>
            <button type="submit" name="tambah" class="btn btn-add">Tambah Barang</button>
        </form>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($barangManager->getBarang() as $barang):?>
                    <tr>
                        <td><?= $barang['id'] ?></td>
                        <td><?= $barang['nama'] ?></td>
                        <td><?= $barang['harga'] ?></td>
                        <td><?= $barang['stok'] ?></td>
                        <td>
                            <a href="?hapus=<?= $barang['id'] ?>" class="btn btn-delete">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>

