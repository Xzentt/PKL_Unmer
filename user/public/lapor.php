<?php
?>
<?php
require_once("../private/database.php");
$statement = $db->query("SELECT id FROM `laporan` ORDER BY id DESC LIMIT 1");
// $cekk = $statement->fetch(PDO::FETCH_ASSOC);
if ($statement->rowCount() > 0) {
    foreach ($statement as $key) {
        // get max id from tabel laporan
        $max_id = $key['id'] + 1;
    }
}
if ($statement->rowCount() < 1) {
    $max_id = 100;
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>Lapor</title>
    <link rel="shortcut icon" href="images/iconic.ico">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.css">
    <!-- font Awesome CSS -->
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <!-- Main Styles CSS -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>

    <div class="shadow">
        <nav class="navbar navbar-fixed navbar-inverse form-shadow">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="home">
                        <img alt="Brand" src="images/rajawali.png" width="200" style="margin-top: -5px;" alt="">
                    </a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right" style="margin-right: 40px;">
                        <li><a href="home">HOME</a></li>
                        <li class="active"><a href="lapor">LAPOR</a></li>
                        <li><a href="lihat">LIHAT PENGADUAN</a></li>
                        <li><a href="cara">CARA</a></li>
                        <li class="dropdown">
                            <a href="profildinas" class="dropdown-toggle" data-toggle="dropdown">PROFIL <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="profildinas">Profil Perusahaan</a></li>
                                <li class="divider"></li>
                                <li><a href="profildinas">Struktur Organisasi</a></li>
                                <li class="divider"></li>
                            </ul>
                        </li>
                        <li><a href="faq">FAQ</a></li>
                        <li><a href="bantuan">BANTUAN</a></li>
                        <li><a href="kontak">KONTAK</a></li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>


        <!-- content -->
        <div class="main-content">
            <h3>Buat Laporan</h3>
            <hr />
            <div class="row">
                <div class="col-md-8 card-shadow-2 form-custom">
                    <form class="form-horizontal" role="form" method="post" action="../private/validasi" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="nomor" class="col-sm-3 control-label">Nomor Pengaduan</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <div class="input-group-addon"><span class="glyphicon glyphicon-exclamation-sign"></span></div>
                                    <input type="text" class="form-control" id="nomor" name="nomor" value="<?php echo $max_id; ?>" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nama" class="col-sm-3 control-label">Nama</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>
                                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Lengkap" value="<?= @$_GET['nama'] ?>" required>
                                </div>
                                <p class="error"><?= @$_GET['namaError'] ?></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-sm-3 control-label">Email</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <div class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></div>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="example@domain.com" value="<?= @$_GET['email'] ?>" required>
                                </div>
                                <p class="error"><?= @$_GET['emailError'] ?></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="telpon" class="col-sm-3 control-label">Telpon</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <div class="input-group-addon"><span class="glyphicon glyphicon-phone"></span></div>
                                    <input type="text" class="form-control" id="telpon" name="telpon" placeholder="087123456789" value="<?= @$_GET['telpon'] ?>" required>
                                </div>
                                <p class="error"><?= @$_GET['telponError'] ?></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="alamat" class="col-sm-3 control-label">Alamat</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <div class="input-group-addon"><span class="glyphicon glyphicon-home"></span></div>
                                    <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat" value="<?= @$_GET['alamat'] ?>" required>
                                </div>
                                <p class="error"><?= @$_GET['alamatError'] ?></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="tujuan" class="col-sm-3 control-label">Tujuan Pengaduan</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <div class="input-group-addon"><span class="glyphicon glyphicon-random"></span></div>
                                    <select class="form-control" name="tujuan">
                                        <option value="1">Pelayanan Pelanggan</option>
                                        <option value="2">Infrastruktur dan Sarana Prasarana</option>
                                        <option value="3">Pengelolaan Sumber Daya</option>
                                        <option value="4">Kesehatan Masyarakat</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- Add image upload field -->
                        <div class="form-group">
                            <label for="gambar" class="col-sm-3 control-label">Upload Gambar</label>
                            <div class="col-sm-9">
                                <input type="file" name="gambar" id="gambar" accept="image/*">
                                <p class="help-block">Unggah foto terkait pengaduan (opsional)</p>
                                <p class="error"><?= @$_GET['gambarError'] ?></p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="pengaduan" class="col-sm-3 control-label">Isi Pengaduan</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <div class="input-group-addon"><span class="glyphicon glyphicon-pencil"></span></div>
                                    <textarea class="form-control" rows="4" name="pengaduan" placeholder="Tuliskan Isi Pengaduan" required><?= @$_GET['pengaduan'] ?></textarea>
                                </div>
                                <p class="error"><?= @$_GET['pengaduanError'] ?></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-10 col-sm-offset-3">
                                <input id="submit" name="submit" type="submit" value="Kirim Pengaduan" class="btn btn-primary-custom form-shadow">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-10 col-sm-offset-2">
                                <p class="error"><em>* Catat Nomor Pengaduan Untuk Melihat Status Pengaduan</em></p>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-4"></div>
            </div>
            <!-- link to top -->
            <a id="top" href="#" onclick="topFunction()">
                <i class="fa fa-arrow-circle-up"></i>
            </a>
            <script>
                // When the user scrolls down 100px from the top of the document, show the button
                window.onscroll = function() {
                    scrollFunction()
                };

                function scrollFunction() {
                    if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
                        document.getElementById("top").style.display = "block";
                    } else {
                        document.getElementById("top").style.display = "none";
                    }
                }
                // When the user clicks on the button, scroll to the top of the document
                function topFunction() {
                    document.body.scrollTop = 0;
                    document.documentElement.scrollTop = 0;
                }
            </script>
            <!-- link to top -->
        </div>





        <!-- Footer -->
        <footer class="footer text-center">
            <div class="row">
                <div class="col-md-4 mb-5 mb-lg-0">
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item">
                            <i class="fa fa-top fa-map-marker"></i>
                        </li>
                        <li class="list-inline-item">
                            <h4 class="text-uppercase mb-4">Kantor</h4>
                        </li>
                    </ul>
                    <p class="mb-0">
                        PG Krebet Baru, Jl. Raya Krebet
                        <br>No. 10 Malang 65171
                    </p>
                </div>
                <div class="col-md-4 mb-5 mb-lg-0">
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item">
                            <i class="fa fa-top fa-rss"></i>
                        </li>
                        <li class="list-inline-item">
                            <h4 class="text-uppercase mb-4">Sosial Media</h4>
                        </li>
                    </ul>
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item">
                            <a class="btn btn-outline-light btn-social text-center rounded-circle" href="https://www.facebook.com/pgkrebetbaru">
                                <i class="fa fa-fw fa-facebook"></i>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a class="btn btn-outline-light btn-social text-center rounded-circle" href="https://x.com/PgKrebetbaru?t=705wsLepSnoFtyBDVPIqhQ&s=09">
                                <i class="fa fa-fw fa-twitter"></i>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item">
                            <i class="fa fa-top fa-envelope-o"></i>
                        </li>
                        <li class="list-inline-item">
                            <h4 class="text-uppercase mb-4">Kontak</h4>
                        </li>
                    </ul>
                    <p class="mb-0">
                        0341 - 833176, 833185 <br>
                        pgkrebet@yahoo.com <br>
                    </p>
                </div>
            </div>
        </footer>
        <!-- /footer -->

        <div class="copyright py-4 text-center text-white">
            <!-- <div class="container"> -->
            <small>PKL UNMER | 2024 &copy; PG Krebet Baru</small>
            <!-- </div> -->
        </div>
        <!-- shadow -->
    </div>


    <!-- jQuery -->
    <script src="js/jquery.min.js"></script>
    <!-- Bootstrap JavaScript -->
    <script src="js/bootstrap.js"></script>

</body>

</html>