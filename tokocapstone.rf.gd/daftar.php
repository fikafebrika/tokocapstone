<?php 
session_start();
include 'koneksi.php';
?>
<!doctype html>
<html lang="zxx">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>TOKO CAPSTONE</title>
    <link rel="icon" href="img/icon.jpg">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/themify-icons.css">
    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="css/slick.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include 'header.php'; ?>
    <section class="breadcrumb_part">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb_iner">
                        <h2>daftar</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="login_part" style="height: 650px;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-3 col-md-3"></div>
                <div class="col-lg-6 col-md-6">
                    <div class="login_part_form">
                        <div class="login_part_form_iner">
                            <h3 class="text-center" style="margin-bottom: 20px;">Selamat Datang !<br>Silakan Daftar</h3>
                            <form class="row contact_form" action="daftar.php" method="post">
                                <div class="col-md-12 form-group p_star">
                                    <input type="text" class="form-control" id="name" name="nama" placeholder="Nama Lengkap" required="" autocomplete="off">
                                </div>
                                <div class="col-md-12 form-group p_star">
                                    <input type="email" class="form-control" id="name" name="email" placeholder="Email" required="" autocomplete="off">
                                </div>
                                <div class="col-md-12 form-group p_star">
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required="" autocomplete="off">
                                </div>
                                <div class="col-md-12 form-group p_star">
                                    <input type="password" class="form-control" id="password2" name="password2" placeholder="Konfirmasi Password" required="" autocomplete="off">
                                </div>
                                <div class="col-md-12 form-group p_star">
                                    <input type="text" class="form-control" id="telepon" name="telepon" placeholder="Telp/HP" required="" autocomplete="off">
                                </div>
                                <div class="col-md-12 form-group p_star">
                                    <textarea class="form-control" name="alamat" required="" placeholder="Alamat Lengkap" autocomplete="off"></textarea>
                                </div>
                                <div class="col-md-12 form-group">
                                    <button type="submit" name="daftar" class="btn_3">daftar</button>
                                </div>
                            </form>
                            <?php
                            if (isset($_POST["daftar"])) {
                                $nama = filter_input(INPUT_POST, 'nama', FILTER_SANITIZE_SPECIAL_CHARS);
                                $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
                                $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);
                                $password2 = filter_input(INPUT_POST, 'password2', FILTER_SANITIZE_SPECIAL_CHARS);
                                $alamat = filter_input(INPUT_POST, 'alamat', FILTER_SANITIZE_SPECIAL_CHARS);
                                $telepon = filter_input(INPUT_POST, 'telepon', FILTER_SANITIZE_SPECIAL_CHARS);

                                $ambil = $dbh->prepare('SELECT * FROM pelanggan WHERE email_pelanggan = :email');
                                $ambil->bindParam(':email', $email, PDO::PARAM_STR);
                                $ambil->execute();

                                if ($ambil->fetch(PDO::FETCH_ASSOC)) {
                                    echo "<script>alert('Pendaftaran Gagal, Email Sudah Digunakan')</script>";
                                    echo "<script>location='daftar.php'</script>";
                                    return false;
                                }

                                if ( $password !== $password2) {
                                    echo "<script>alert('Konfirmasi Password Salah')</script>";
                                    echo "<script>location='daftar.php'</script>";
                                    return false;
                                }

                                $password = password_hash($password, PASSWORD_DEFAULT);
                                
                                $ambil = $dbh->prepare('INSERT INTO pelanggan (email_pelanggan, password_pelanggan, nama_pelanggan, telepon_pelanggan, alamat_pelanggan) VALUES (:email , :password, :nama, :telepon, :alamat)');
                                    $ambil->bindParam(':email', $email, PDO::PARAM_STR);
                                    $ambil->bindParam(':password', $password, PDO::PARAM_STR);
                                    $ambil->bindParam(':nama', $nama, PDO::PARAM_STR);
                                    $ambil->bindParam(':telepon', $telepon,  PDO::PARAM_STR);
                                    $ambil->bindParam(':alamat', $alamat, PDO::PARAM_STR);
                                    $ambil->execute();
                                    echo "<script>alert('Pendaftaran Berhasil, Silakan Login')</script>";
                                    echo "<script>location='login.php'</script>";
                            } 
                            ?>                      
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php include 'footer.php'; ?>
    <script src="js/jquery-1.12.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.magnific-popup.js"></script>
    <script src="js/swiper.min.js"></script>
    <script src="js/mixitup.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
    <script src="js/slick.min.js"></script>
    <script src="js/jquery.counterup.min.js"></script>
    <script src="js/waypoints.min.js"></script>
    <script src="js/contact.js"></script>
    <script src="js/jquery.ajaxchimp.min.js"></script>
    <script src="js/jquery.form.js"></script>
    <script src="js/jquery.validate.min.js"></script>
    <script src="js/mail-script.js"></script>
    <script src="js/custom.js"></script>
</body>    
</html>