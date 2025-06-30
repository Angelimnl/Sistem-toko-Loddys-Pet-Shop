<?php
include 'config1.php';
session_start();
include "authcheckkasir.php";

$tanggal_waktu = date('Y-m-d H:i:s'); // Mendapatkan tanggal & waktu transaksi
$nomor = rand(111111,999999); // Membuat nomor transaksi acak
$total = $_POST['total']; // Mengambil total belanja dari form html (dengan method POST)
$bayar = preg_replace('/[^\d]/', '', $_POST['bayar']); // AMAN dari simbol
$bayar = intval($bayar);
$nama = $_SESSION['nama']; // Mengambil nama kasir dari sesi
$kembali = $bayar - $total; // Menghitung kembalian

// INSERT KE TABEL TRANSAKSI 
// NULL merupakan auto increment
mysqli_query($dbconnect, "INSERT INTO transaksi (
    id_transaksi, tanggal_waktu, nomor, total, nama, bayar, kembali) VALUES (NULL, '$tanggal_waktu', '$nomor', '$total', '$nama', '$bayar', '$kembali')");

// Mendapatkan ID transaksi baru
// mysqli_insert_id untuk mengambil ID (biasanya auto-increment terakhir) untuk ditaruh/disertakan di tabel transaksi_detail
$id_transaksi = mysqli_insert_id($dbconnect);

// Insert ke Detail Transaksi
// $_SESSION['cart'] adalah variabel sesi untuk menyimpan data keranjang belanja (shopping cart) jadi ketika pengguna berpindah halaman, data tetap tersimpan → Karena sesi masih aktif.
// Jika $_SESSION['cart'] adalah array asosiatif, $key akan berisi nama indeksnya.
// Contoh indeks array asosiatifnya adlh kode/id produk seperti "A100", "B200", dsb.
// $value berisi array detail produk seperti nama, harga, dan qty. Contoh $value['harga'] berisi elemen array harga produk
// Perulangan ini untuk menampilkan transaksi detail dalam tabel HTML.
// Looping dan diinisialisasi menjadi value
foreach ($_SESSION['cart'] as $key => $value) {

    $id_barang = $value['id'];
    $harga = $value['harga'];
    $qty = $value['qty'];
    $total = $harga*$qty;

    // insert into = perintah SQL untuk menambahkan/menyimpan data tabel trasaksi_detail ke database dan
    // value mengisi nilai-nilai ke dalam kolom tabel. Contoh 'Kolom id_transaksi diisi dengan nilai dari variabel PHP $id_transaksi.'
    mysqli_query($dbconnect, "INSERT INTO transaksi_detail (
        id_transaksi_detail, id_transaksi, id_barang, harga, qty, total) VALUES (NULL, '$id_transaksi', '$id_barang', '$harga', '$qty', '$total')");
        
    // $sum += $value['harga']*$value['qty'];
}

// Mengalihkan (redirect) pengguna ke halaman lain (transaksi_selesai.php) sambil mengirimkan data ID transaksi melalui URL.
// Untuk mendapatkan id transaksinya
header("location:transaksi_selesai.php?idtrx=$id_transaksi");

?>