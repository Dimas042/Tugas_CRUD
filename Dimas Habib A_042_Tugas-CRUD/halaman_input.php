<?php include("inc_header.php")?>

<?php
$nama       = "";
$nim        = "";
$kelas      = "";
$jurusan    = "";
$prodi      = "";
$error      = "";
$sukses     = "";

if(isset($_GET['id'])){
    $id = $_GET['id'];
}else{
    $id = "";
}

if($id != ""){
    $sql1   = "select * from halaman where id = '$id'";
    $q1     = mysqli_query($koneksi,$sql1);
    $r1     = mysqli_fetch_array($q1);
    $nama   = $r1['nama'];
    $nim    = $r1['nim'];
    $jurusan    = $r1['jurusan'];
    $prodi      = $r1['prodi'];
    $image      = $r1['image'];

    if($image == ''){
        $error  = "Data tidak ditemukan";
    }
}

if (isset($_POST['simpan'])) {
    $nama       = $_POST['nama'];
    $nim        = $_POST['nim'];
    $jurusan    = $_POST['jurusan'];
    $prodi      = $_POST['prodi'];

    $msg = "";
    $image      = $_FILES['image']['name'];
	$target = "img/".basename($image);

    if ($nama == '' or $nim == '' or $jurusan == '' or $prodi == '') {
        $error     = "Silakan masukkan semua data.";
    }

    if (empty($error)) {
        if($id != ""){
            $sql1   = "update halaman set nama = '$nama',nim='$nim',jurusan='$jurusan',prodi='$prodi' ,tgl_isi=now() where id = '$id'";
        }else{
            $sql1   = "insert into halaman(nama,nim,jurusan,prodi,image) values ('$nama','$nim','$jurusan','$prodi','$image')";
        }
        
        $q1         = mysqli_query($koneksi, $sql1);
        if ($q1) {
            $sukses     = "Sukses memasukkan data";
        } else {
            $error      = "Gagal memasukkan data";
        }
    }
}
?>

<h1>Halaman Input Data</h1>

<div class="mb-3 row">
    <a href="halaman.php"><< Kembali ke halaman data</a>
</div>

<?php
if ($error) {
?>
    <div class="alert alert-danger" role="alert">
        <?php echo $error ?>
    </div>
<?php
}
?>
<?php
if ($sukses) {
    ?>
    <div class="alert alert-primary" role="alert">
        <?php echo $sukses ?>
    </div>
    <?php
}
?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="mb-3 row">
        <label for="judul" class="col-sm-2 col-form-label">Nama</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="nama" value="<?php echo $nama ?>" name="nama">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="kutipan" class="col-sm-2 col-form-label">NIM</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="nim" value="<?php echo $nim ?>" name="nim">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="kutipan" class="col-sm-2 col-form-label">Jurusan</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="jurusan" value="<?php echo $jurusan ?>" name="jurusan">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="kutipan" class="col-sm-2 col-form-label">Prodi</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="prodi" value="<?php echo $prodi ?>" name="prodi">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="file" class="col-sm-2 col-form-label">Foto anda</label>
        <div class="col-sm-10">
            <input type="file" class="form-control" name="image" id="image" accept=".jpg, .jpeg, .png" value="">
        </div>
    </div>
    </div>
    <div class="mb-3 row">
        <div class="col-sm-2"></div>
        <div class="col-sm-10">
            <input type="submit" name="simpan" value="Simpan Data" class="btn btn-primary">    
        </div>
    </div>

</form>

<?php include("inc_footer.php")?>