<?php include("inc_header.php") ?>
<?php
$sukses = "";
$katakunci = (isset($_GET['katakunci'])) ? $_GET['katakunci'] : "";
if (isset($_GET['op'])){
    $op = $_GET['op'];
}else{
    $op = "";
}
if($op == 'delete'){
    $id = $_GET['id'];
    $sql1 = "delete from halaman where id = '$id'";
    $q1 = mysqli_query($koneksi,$sql1);
    if($q1){
        $sukses = "Berhasil menghapus data";
    }
}
?>
<h1>Halaman Data</h1>
<p>
    <a href="halaman_input.php">
        <input type="button" class="btn btn-primary" value="Buat data baru">
    </a>
</p>

<?php
if ($sukses) {
    ?>
    <div class="alert alert-success" role="alert">
        <?php echo $sukses ?>
    </div>
    <?php
}
?>

<form class="row g-3" method="get">
    <div class="col-auto">
        <input type="text" class="form-control" placeholder="Masukkan kata kunci" name="katakunci" value="<?php echo $katakunci?>"/>
    </div>
    <div class="col-auto">
        <input type="submit" name="cari" value="cari tulisan" class="btn btn-secondary">
    </div>
</form>
<table class="table table-striped">
    <thead>
        <tr>
            <th class="col-1">#</th>
            <th>Nama</th>
            <th>NIM</th>
            <th>Jurusan</th>
            <th>Prodi</th>
            <th>Foto</th>
            <th class="col-2">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $sqltambahan = "";
        if($katakunci != ''){
            $array_katakunci = explode(" ",$katakunci);
            for($x=0;$x < count($array_katakunci);$x++){ 
                $sqlcari[] = "(nama like '%".$array_katakunci[$x]."%' or nim like '%".$array_katakunci[$x]."%' or jurusan like '%".$array_katakunci[$x]."%' or prodi like '%".$array_katakunci[$x]."%')";
            }
            $sqltambahan = " where ".implode(" or ",$sqlcari);
        }
        $sql1   = "select * from halaman $sqltambahan order by id desc";
        $q1     = mysqli_query($koneksi, $sql1);
        $nomor  = 1;
        while($r1 = mysqli_fetch_array($q1)) {
            ?>
                <tr>
                    <td><?php echo $nomor++?></td>
                    <td><?php echo $r1['nama']?></td>
                    <td><?php echo $r1['nim']?></td>
                    <td><?php echo $r1['jurusan']?></td>
                    <td><?php echo $r1['prodi']?></td>
                    <td><img src="img/<?php echo $r1['image']; ?>" width=200 title="<?php echo $r1['image']; ?>">
                    </td>
                    <td>
                        <a href="halaman_input.php?id=<?php echo $r1['id'] ?>">
                            <span class="badge bg-warning text-dark">Edit</span>
                        </a>
                        
                        <a href="halaman.php?op=delete&id=<?php echo $r1['id']?>" onclick="return confirm('Apakah yakin ingin menghapus data ?')">
                            <span class="badge bg-danger">Delete</span>
                        </a>
                    </td>
                </tr>
            <?php
        }
        ?>
        
    </tbody>
</table>
<?php include("inc_footer.php")?>