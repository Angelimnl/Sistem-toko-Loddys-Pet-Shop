<?php
include 'config1.php';
session_start();
include "authcheckkasir.php";

// Ambil nilai dari URL (parameter id_trx) dan simpan ke dalam variabel PHP $id_trx. FUNGSINYAA:
// Mengambil data dari database berdasarkan ID transaksi
// Menampilkan tanggal_waktu transaksi, nomor, total, nama, bayar, dan kembali.
// Melanjutkan proses dari halaman sebelumnya
$id_trx = $_GET['idtrx'];

// Mengambil data dari tabel transaksi berdasarkan kolom id_transaksi. FUNGSI QUERY INI ADALAH AGAR NAMA DAN TANGGAL_WAKTU PADA NOTA SESUAI
$data = mysqli_query($dbconnect,"SELECT * FROM transaksi WHERE id_transaksi='$id_trx'"); 

// Mengambil satu baris query dari database dan diubah menjadi array asosiatif dimana indeks arraynya berdasarkan nama kolom di tabel.
$trx = mysqli_fetch_assoc($data);

$detail = mysqli_query($dbconnect,"SELECT * FROM transaksi_detail WHERE id_transaksi = '$id_trx'");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Kasir Selesai</title>
    <style type="text/css">
        body{
            color: #a7a7a7
        }
    </style>
</head>

<body>

    <div align="center">
        <table width="500" border="0" cellpadding="1" cellspacing="0">
            <tr>
                <th>Toko Loddy's Pet Shop <br>
                    Jl. Kasepuhan No.10 D, Kesepuhan <br>
                Kota Cirebon, Jawa Barat 45114</th>
            </tr>
            <tr align="center"><td><hr></td></tr>
            <tr>
                <td>#<?=$trx['nomor']?> | <?=date('d-m-Y H:i:s', strtotime($trx['tanggal_waktu']))?> | <?=$trx['nama']?></td>
            </tr>
            <tr><td><hr></td></tr>
        </table>
        <table width="500" border="0" cellpadding="3" cellspacing="0">
            <?php while($row = mysqli_fetch_array($detail)) { ?>
            <tr>
                <td><?=$row['id_barang']?></td>
                <td>1</td>
                <td align="right">1000</td>
                <td align="right">1000</td>
            </tr>
            <?php } ?>
            <tr>
                <td colspan="4"><hr></td>
            </tr>
            <tr>
                <td Align="right" colspan="3">Total</td>
                <td Align="right">10000</td>
            </tr>
            <tr>
                <td Align="Right" colspan="3">Bayar</td>
                <td Align="right">10000</td>                
            </tr>
            <tr>
                <td Align="Right" colspan="3">Kembali</td>
                <td Align="right">10000</td>
            </tr>
        </table>
        <table width="500" border="0" cellpadding="1" cellspacing="0">
            <tr><td><hr></td></tr>
            <tr>
                <th>Terima kasih, Selamat Belanja Kembali</th>
            </tr>
            <tr>
                <th>===== Layanan Konsumen ====</th>
            </tr>
            <tr>
                <th>SMS/CALL 085156689190</th>   
            </tr>
        </table>
 
</body>
</html>

<!-- ALT+SHIFT+KEY DOWN -->