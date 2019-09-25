<?php

// koneksi ke databse
$konek=mysqli_connect("localhost", "root", "", "kodeunik");

// membaca kode barang terbesar
$query = "SELECT max(kode_barang) as maxKode FROM tbl_barang";
$hasil = mysqli_query($konek, $query);
$data  = mysqli_fetch_array($hasil);
$kodeBarang = $data['maxKode'];

// mengambil angka atau bilangan dalam kode anggota terbesar,
// dengan cara mengambil substring mulai dari karakter ke-1 diambil 6 karakter
// misal 'BRG001', akan diambil '001'
// setelah substring bilangan diambil lantas dicasting menjadi integer
$noUrut = (int) substr($kodeBarang, 3, 3);

// bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
$noUrut++;

// membentuk kode anggota baru
// perintah sprintf("%03s", $noUrut); digunakan untuk memformat string sebanyak 3 karakter
// misal sprintf("%03s", 12); maka akan dihasilkan '012'
// atau misal sprintf("%03s", 1); maka akan dihasilkan string '001'
$char = "BRG";
$newID = $char . sprintf("%03s", $noUrut);

//Memasukkan data textbox ke database
if (isset($_POST['submit'])) { 
 $kode = $_POST['kode_barang'];
 $nama = $_POST['nama_barang'];

 $query2 = "INSERT INTO tbl_barang VALUES ('$kode', '$nama')";
 $hasil2 = mysqli_query($konek, $query2);

 if ($hasil2) {  
  header("Location: index.php");
  echo "Berhasil";
  exit();
 }else{
  echo "gagal";
 }
}

?>

<h1>Tambah Barang Baru</h1>

<form method="post" action="index.php">
<table border="0">
  <tr><td>Kode Barang</td><td>:</td><td><input type="text" readonly="" name="kode_barang" value="<?php echo $newID; ?>"></td></tr>
  <tr><td>Nama Barang</td><td>:</td><td><input type="text" name="nama_barang"></td></tr>
  <tr><td></td><td></td><td><input type="submit" name="submit" value="Submit"></td></tr>
</table>
</form>