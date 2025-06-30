<?php
include 'config1.php';
session_start();
include "authcheckkasir.php";

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = []; // Menghindari error jika cart belum ada
}

$barang = mysqli_query($dbconnect,"SELECT * FROM barang");
// print_r($_SESSION);

$sum = 0;

// <!-- foreach ($_SESSION['cart'] as $key => $value) Perulangan foreach untuk mengiterasi (melakukan looping) setiap elemen dalam array $_SESSION['cart']. 
// $_SESSION['cart'] adalah variabel sesi untuk menyimpan data keranjang belanja (shopping cart) pengguna saat mereka menjelajahi situs web. Saat berpindah halaman, data tetap tersimpan → Karena sesi masih aktif.
// $key → Menyimpan indeks (id)/kunci array (bisa numerik/string jika asosiatif).
// $value → Menyimpan nilai elemen array pada kunci tsb.
// $key sering digunakan dalam loop foreach untuk menyimpan indeks/kunci dari array.
if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {           
    foreach ($_SESSION['cart'] as $key => $value) {
        // Pastikan tidak ada nilai kosong sebelum perhitungan
        if (!empty($value['harga']) && !empty($value['qty'])) {
            $sum += $value['harga'] * $value['qty'];
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Kasir</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <style>
        .header {
            display: flex;
            align-items: center;
            justify-content: flex-start;
            padding: 8px 20px;
            background: #d895da;
            color: white;
            width: 100%;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
        }

        .container {
            margin-top: 110px;
        }

        .btn-custom1 {
        background-color: #5a9bd5;
        border-color: #5a9bd5;
        color: #fff; /* agar teksnya putih dan kontras */
        }
    </style>
</head>
<body>
    <div class="container">
                                <div class="header">
                                    <h1><strong>Kasir</strong></h1>
                                </div>
        <div class="row">
        <div class=col-md-8>
            <form method="post" action="keranjang_act.php" class="form-inline">
                
                <div class="input-group">  <!-- Kelas input-group untuk mengelompokkan elemen2 input form menjadi satu tampilan yang lebih rapi seperti tombol, ikon, atau teks.  -->
                    
                    <!-- <select> adalah elemen HTML yang membuat menu drop-down (pilihan daftar). -->    
                    <!-- form-control membuat tampilan elemen lebih rapi dan responsif. -->
                    <!-- name="id_barang" nilai yang dipilih dlm drop-down dengan nama id_barang dalam formulir.
                    Mengapa id_barang, bukan nama (pada list barang)? Karena id harus unik & merupakan kunci (key) list barang utk mengirim data melalui HTTP request (biasanya POST/GET).-->
                    <select class="form-control" name="id_barang">  
                    <option value="">Pilih Barang</option> <!-- <option> adalah elemen dalam <select> yg mewakili satu opsi pilihan. -->

                    <!-- mysqli_fetch_array Mengambil 1 baris hasil dari query database (barang) dan mengembalikannya sebagai array. satu baris per iterasi/perulangan/looping. -->
                    <!-- $row['id_barang'] dan $row['nama'] Mengisi atribut value dengan id_barang dan nama dari database. -->
                    <!-- <option> Pilihan yang dapat dipilih oleh pengguna dalam sebuah menu dropdown/combo box. -->
                    <?php while ($row = mysqli_fetch_array($barang)) { ?>  <!-- merupakan perulangan pada halaman kasir yang terdiri dari daftar2 barang yang kita pesan. -->
                        <option value="<?=$row['id_barang']?>"><?=$row['nama']?></option>
                        <!-- Mengirimkan id_barang agar server tahu barang yang dimaksud secara unik.
                        Menampilkan nama barang agar user tahu apa yang dipilih. -->
                    <?php } ?>
                    </select>
                </div>

                <div class="input-group">
                    <input type="number" name="qty" class="form-control">
                    <span class="input-group-btn">
                        <button class="btn btn-custom1" type="submit">Tambah</button>
                    </span> 
                </div>

                <!-- Tombol Reset Keranjang -->
                <a href="keranjang_reset.php" class="btn btn-danger" style="margin-left: 10px;">Reset Keranjang</a>
            </form>
            <br>

            <!-- Elemen <form> digunakan untuk mengirimkan data dari pengguna ke server. Atribut method="post" menentukan cara data dikirimkan. -->
            <form method="post" action="keranjang_update.php">   
                <button type="submit" class="btn btn-success">Perbarui</button>
                    <table class="table table-bordered">

                                <!-- tr/table row: mendefinisikan satu baris dalam tabel. 
                                th/table header: mendefinisikan judul kolom atau kepala tabel.
                                td/ table data: mendefinisikan sel dalam tabel (isi dari baris).-->
                        <tr>
                            <th>Nama</th>
                            <th>Harga</th>
                            <th>Qty</th>
                            <th>Subtotal</th>
                            <th></th>
                        </tr>

                        <!-- foreach ($_SESSION['cart']) Perulangan foreach untuk mengiterasi (melakukan looping) setiap elemen dalam array $_SESSION['cart']. 
                         
                        Elemen dlm array mksdnya adlh nilai-nilai yang disimpan di dalam array. Contoh array $buah = ["Apel", "Mangga", "Jeruk"];
                         Index  | Elemen (Value)
                        -----------------------
                        0      | "Apel"
                        1      | "Mangga"
                        2      | "Jeruk"

                        Output: echo $buah[1]; // Output: Mangga -->
                        <!-- $_SESSION['cart'] adalah variabel sesi untuk menyimpan data keranjang belanja (shopping cart) jadi ketika pengguna berpindah halaman, data tetap tersimpan → Karena sesi masih aktif. -->
                        <!-- Jika $_SESSION['cart'] adalah array asosiatif, $key akan berisi nama indeksnya.
                        Contoh indeks array asosiatifnya adlh kode/id produk seperti "A100", "B200", dsb. -->
                        <!-- $value berisi array detail produk seperti nama, harga, dan qty. Contoh $value['nama'] berisi elemen array nama produk -->
                        <!-- Perulangan kedua ini untuk menampilkan isi keranjang dalam tabel HTML. -->
                        <?php foreach ($_SESSION['cart'] as $key => $value) { ?>
                                <tr>
                                    <td><?=$value['nama']?></td>   <!--  $value['nama'] menampilkan data nama secara dinamis/berbeda2 dalam tabel HTML -->
                                    <!-- (?= dan ?>) adalah shorthand (versi singkat) dari < ?php echo ...?> -->
                                     
                                     <!-- jika qty[] dapat menginput dg nama yang sama (misal, daftar produk keranjang belanja) atau semua nilai dalam array, sedakangkan tanpa kurung siku hanya bisa menginput satu nilai saja/nilai terakhir -->
                                     <!-- Jika tidak ada value="" maka input akan kosong meskipun ada data -->
                                    <td class="col-md-2"><input type="number" name="qty[]" class="form-control" value="<?=$value['qty']?>"></td>
                                    <td align="right"><?= number_format((!empty($value['qty']) && !empty($value['harga'])) ? $value['qty'] * $value['harga'] : 0) ?></td>

                                    <td><a href="keranjang_hapus.php?id=<?=$value['id']?>" class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i></a></td>
                                </tr>
                        <?php } ?>
                    </table>
            </form>         
        </div>
                <div class="col-md-4">
                    <!-- number_format() untuk memformat angka agar lebih mudah dibaca. 
                     Bisa menyesuaikan pemisah ribuan dan desimal sesuai dengan format mata uang yang diinginkan -->
                    <h3>Total Rp. <?=number_format($sum)?></h3>
                    <!-- Form untuk mengirimkan data transaksi ke file transaksi_act.php menggunakan metode POST.
                     Data yang diisi dalam form akan dikirim ke transaksi_act.php untuk diproses. -->
                    <form action="transaksi_act.php"  method="POST">
                        <input type="hidden" name="total" value="<?=$sum?>">
                        
                            <!-- Input hidden untuk angka bersih -->
                        <input type="hidden" id="bayar_asli" name="bayar">
                        <div class="form-group">
                            <label>Bayar</label>
                            <!-- 
                                name="bayar" Digunakan dalam formulir agar PHP bisa membaca nilainya. Sprti $bayar = $_POST['bayar'];
                                class="form-control" Dari Bootstrap utk membuat tampilan input lebih rapi dan responsif.
                                
                                id="bayar" untuk identifikasi atau inisialiasi inputan di JavaScript / CSS.  
                                Contohnya document.getElementById("bayar").value = "100000";

                                type="text" Input berupa teks (pengguna bisa mengetikkan angka atau huruf).
                            -->
                            <input type="text" id="bayar" name="bayar" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-custom1">Selesai</button>
                    </form>
                </div>
        </div>

<script type="text/javascript">
    var bayar = document.getElementById('bayar');
    var bayarAsli = document.getElementById('bayar_asli');

    bayar.addEventListener('keyup', function (e) {
        // Ambil angka bersih (tanpa Rp. dan titik)
        var clean = this.value.replace(/[^,\d]/g, '').replace(',', '');
        
        // Simpan ke input hidden
        bayarAsli.value = clean;

        // Tampilkan format ke input teks
        this.value = formatRupiah(this.value, 'Rp. ');
    });

    // GENERATE DARI INPUTAN ANGKA MENJADI FORMAT RUPIAH
    // angka = Input berupa string angka yang ingin diformat sebagai Rupiah
    // prefix = Awalan (misalnya "Rp. ") untuk menampilkan format mata uang.

    // Analisis RegEx (Reguler Ekspression) [^,\d]
    // ^ → Negasi (artinya "bukan" atau "kecuali").
    // \d → Digit angka (0-9).
    // , → Koma (diperbolehkan dalam format mata uang untuk desimal).
    // Kesimpulan: Hanya angka (0-9) dan koma (,) yang dipertahankan, karakter lainnya akan dihapus.
    // g (global flag) → Memastikan pencarian dilakukan pada seluruh string, bukan hanya karakter pertama.
    // g (global flag) tidak perlu di preg_replace(), karena otomatis menggantikan semua kemunculan).
    // angka.replace(/[^,\d]/g, '') digunakan untuk membersihkan string dari karakter yang tidak diperlukan, hanya menyisakan angka (0-9) dan koma (,). 
    // Contoh format uang dari "Rp. 1.000.000,00" menjadi "1000000,00"

// Memastikan pencarian dilakukan pada seluruh string, bukan hanya karakter pertama.
    function formatRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            var separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix === undefined ? rupiah : (rupiah ? prefix + rupiah : '');
    }
</script>

</body> 
</html>
