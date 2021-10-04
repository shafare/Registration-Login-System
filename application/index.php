<?php

session_start();

if(isset($_SESSION['login'])){
  header("Location: login.php");
  exit;
}
    $server = "localhost";
    $user = "root";
    $pass = "";
    $database = "list_alumni";

    $koneksi = mysqli_connect($server, $user, $pass, $database) or die(mysqli_error($koneksi));
    
    //tombol submit
    if(isset($_POST['simpan'])){
      //data hasil edit atau baru
      if($_GET['hal']=="edit"){
        //data diedit
        $edit = mysqli_query($koneksi, "UPDATE iaicj set
                                        nama = '$_POST[nama]',
                                        lahir = '$_POST[lahir]',
                                        angkatan = '$_POST[angkatan]',
                                        pekerjaan = '$_POST[pekerjaan]',
                                        prodi = '$_POST[prodi]',
                                        alamat = '$_POST[alamat]'
                                        WHERE nomor = '$_GET[id]'
                                       ");
        if($edit){ //cek edit berhasil/tidak
          echo "<script>
                  alert('Edit Data Berhasil!');
                  document.location='index.php';
              </script>";
        }else{
          echo "<script>
                  alert('Edit Data GAGAL!');
                  document.location='index.php';
              </script>";
        }
      }else{
        //data simpan baru
        $simpan = mysqli_query($koneksi, "INSERT INTO iaicj(nama,lahir,angkatan,pekerjaan,prodi,alamat)
                                          VALUES ('$_POST[nama]',
                                                  '$_POST[lahir]',
                                                  '$_POST[angkatan]',
                                                  '$_POST[pekerjaan]',
                                                  '$_POST[prodi]',
                                                  '$_POST[alamat]')
                                         ");
        if($simpan){ //cek simpan berhasil/tidak
          echo "<script>
                  alert('Input Data Berhasil!');
                  document.location='index.php';
              </script>";
        }else{
          echo "<script>
                  alert('Input Data GAGAL!');
                  document.location='index.php';
              </script>";
        }
      }
      
    }

    //tombol edit data
    if(isset($_GET['hal'])){
      //jika pilih edit
      if($_GET['hal']=="edit"){
        //data ditampilkan untuk diedit
        $tampil = mysqli_query($koneksi,"SELECT * FROM iaicj WHERE nomor = '$_GET[id]' ");
        $data = mysqli_fetch_array($tampil);
        if($data){
          //jika data ditemukan, disimpan sementara dalam var
          $vnama = $data['nama'];
          $vlahir = $data['lahir'];
          $vangkatan = $data['angkatan'];
          $vpekerjaan = $data['pekerjaan'];
          $vprodi = $data['prodi'];
          $valamat = $data['alamat'];
        }
      }else if ($_GET['hal']=="hapus"){
        //persiapan hapus
        $hapus = mysqli_query($koneksi,"DELETE FROM iaicj WHERE nomor = '$_GET[id]' ");
        if($hapus){
          echo "<script>
                  alert('Hapus Data Berhasil!');
                  document.location='index.php';
              </script>";
        }else{
          echo "<script>
                  alert('Hapus Data GAGAL!');
                  document.location='index.php';
              </script>";
        }
      }
    }
?>

<!DOCTYPE html>
<html>
  <head>
    <title>IAICJ | Data Alumni</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />

    <!-- My CSS -->
    <link rel="stylesheet" href="style.css" />
  </head>

  <body>
    <!-- awal navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark shadow fixed-top" style="background-color: rgb(41, 76, 192)">
      <div class="container">
        <a class="navbar-brand">
          <img src="img/1.png" alt="" width="30" height="24" class="d-inline-block align-text-top" />
          <b>IAIC Jambi</b>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-9 ms-auto">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="logout.php">Logout</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- akhir navbar -->

    <!-- jumbotron -->
    <div class="container mt-5 mb-5 pt-5">
      <section class="jumbotron text-center">
        <img src="img/1.png" alt="Logo IAICJ" width="140" />
        <h1 class="display-4">Data Alumni</h1>
        <h4 class="lead"><b>Ikatan Alumni Insan Cendekia Jambi</b></h4>
      </section>
    </div>
    <!-- akhir jumbotron -->

    <!-- awal card form-->
    <div class="container">
      <div class="card">
        <h5 class="card-header text-white" style="background-color: rgb(41, 76, 192)">Form Input Data Alumni</h5>
        <div class="card-body">
          <form method="POST" action="">
            <div class="form-group mb-3">
              <label>Nama</label>
              <input type="text" name="nama" value="<?=@$vnama?>" class="form-control" placeholder="Input nama anda" required />
            </div>
            <div class="form-group mb-3">
              <label>Tanggal Lahir</label>
              <input type="date" name="lahir" value="<?=@$vlahir?>" class="form-control" required />
            </div>
            <div class="form-group mb-3">
              <label for="angkatan" class="form-label">Angkatan</label>
              <select class="form-select" id="angkatan" name="angkatan" required>
                <option value="<?=$vangkatan?>"><?=@$vangkatan?></option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
              </select>
            </div>
            <div class="form-group mb-3">
              <label>Pekerjaan - Instasi</label>
              <input type="text" name="pekerjaan" value="<?=@$vpekerjaan?>" class="form-control" placeholder="Input pekerjaan dan instansi anda" required />
            </div>
            <div class="form-group mb-3">
              <label>Program Studi/Keilmuan</label>
              <input type="text" name="prodi" value="<?=@$vprodi?>" class="form-control" placeholder="Input program studi/keilmuan anda" required />
            </div>
            <div class="form-group mb-3">
              <label>Alamat</label>
              <textarea class="form-control" name="alamat" placeholder="Input alamat anda" rows="3" required><?=@$valamat?></textarea>
            </div>
            <!-- button -->
            <button type="submit" class="btn btn-success" name="simpan">Submit</button>
            <button type="reset" class="btn btn-danger" name="clear">Clear</button>
          </form>
        </div>
      </div>
    </div>
    <!-- akhir card form -->

    <!-- awal card tabel -->
    <div class="container mt-5 mb-5">
      <div class="card">
        <h5 class="card-header text-white" style="background-color: rgb(41, 76, 192)">List Alumni</h5>
        <div class="card-body">
          <table class="table table-bordered table-striped">
            <tr>
              <th>No.</th>
              <th>Nama</th>
              <th>Tanggal Lahir</th>
              <th>Angkatan</th>
              <th>Pekerjaan - Instansi</th>
              <th>Program Studi/Keilmuan</th>
              <th>Alamat</th>
              <th>Action</th>
            </tr>

            <?php
            $no = 1;
              $tampil = mysqli_query($koneksi, "SELECT * from iaicj order by nomor desc");
              while($data = mysqli_fetch_array($tampil)) :

            ?>
            <tr>
              <td><?=$no++;?></td>
              <td><?=$data['nama'];?></td>
              <td><?=$data['lahir'];?></td>
              <td><?=$data['angkatan'];?></td>
              <td><?=$data['pekerjaan'];?></td>
              <td><?=$data['prodi'];?></td>
              <td><?=$data['alamat'];?></td>
              <td>
                <a href="index.php?hal=edit&id=<?=$data['nomor']?>" class="btn btn-warning">Edit</a>
                <a href="index.php?hal=hapus&id=<?=$data['nomor']?>" onclick="return confirm('Apakah anda yakin ingin menghapus data?')" class="btn btn-danger"> Delete</a>
              </td>
            </tr>

            <?php endwhile; ?>
            <!-- akhir while -->
          </table>
        </div>
      </div>
    </div>
    <!-- akhir card tabel -->
  </body>
</html>
