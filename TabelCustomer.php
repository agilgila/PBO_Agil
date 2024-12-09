<?php
require_once 'Customer.php';
require_once 'CustomerManager.php';

$customerManager = new CustomerManager();

// Menangani form tambah customer
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tambah'])) {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $telepon = $_POST['telepon'];
    $customerManager->tambahCustomer($nama, $email, $telepon);
    header('Location: TabelCustomer.php');
}

// Menangani penghapusan customer
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $customerManager->hapusCustomer($id);
    header('Location: TabelCustomer.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Customer</title>
    <link rel="stylesheet" href="style.css?<?= time() ?>">
</head>
<body>
    <nav>
        <a href="home.php">Home</a>
        <a href="index.php">Barang</a>
        <a href="TabelCustomer.php">Customer</a>
    </nav>
    <div class="container">
        <h1>Daftar Customer</h1>
        <form method="POST" action="">
            <div>
                <label for="nama">Nama Customer</label>
                <input type="text" id="nama" name="nama" required></input>
            </div>
            <div>
                <label for="email">Email</label>
                <input type="text" id="email" name="email" required></input>
            </div>
            <div>
                <label for="telepon">Telepon</label>
                <input type="text" id="telepon" name="telepon" required></input>
            </div>
            <button type="submit" name="tambah" class="btn btn-add">Tambah Barang</button>
        </form>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Telepon</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($customerManager->getCustomers() as $customer): ?>
                    <tr>
                        <td><?= $customer['id'] ?></td>
                        <td><?= $customer['nama'] ?></td>
                        <td><?= $customer['email'] ?></td>
                        <td><?= $customer['telepon'] ?></td>
                        <td>
                            <a href="TabelCustomer.php?hapus=<?= $customer['id'] ?>" class="btn btn-delete">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="home.php" class="btn btn-back">Kembali ke Home</a>
    </div>
</body>
</html>
