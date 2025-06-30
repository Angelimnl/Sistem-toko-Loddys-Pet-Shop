<?php
include 'config1.php';
session_start();
include "authcheckkasir.php";

// Isset() adalah mengecek apakah variabel id_barang sudah ada/didefinisikan dan tidak bernilai NULL, jika ada if dijalankan/dieksekusi. Untuk mencegah error jika form belum dikirim.
// $_POST['id_barang'] adalah data yang dikirim dari form HTML dengan metode POST, jika pengguna mengisi form dan mengirimkannya, maka id_barang akan memiliki nilai.
// Setelah id_barang dikirim melalui form (dan tidak NULL), maka nilainya akan disimpan dalam variabel $id_barang.
// Pastikan id_barang dikirim melalui POST atau GET
if (isset($_POST['id_barang'])) 
{
    $id_barang = $_POST['id_barang'];
    $qty = $_POST['qty'];

    //mysqli_query = Digunakan untuk mengambil data dari hasil query database.
    $data = mysqli_query($dbconnect,"SELECT * FROM barang WHERE id_barang='$id_barang'");

    // Array asosiatif menyimpan dan mengakses data menggunakan nama kunci seperti di bwh ini. Jika array biasa menggunakan indeks angka (0, 1, 2, ...).
    // Mengambil satu baris hasil query dalam bentuk array asosiatif, di mana kolom database menjadi kunci (key) dalam array.
    $b = mysqli_fetch_assoc($data);

    // Variabel $barang adalah array asosiatif yang menyimpan informasi dari hasil query database.
    $barang = [
        'id' => $b['id_barang'],
        'nama' => $b['nama'],
        'harga' => $b['harga'],
        'qty' => $qty
    ];

    $_SESSION['cart'][]=$barang;
    krsort($_SESSION['cart']);

    header('location:kasir.php');
}
?>