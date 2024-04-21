<?php
?>

<?php
session_start();
require_once("database.php");

// Atasi Undefined
$nama = $email = $telpon = $alamat = $pengaduan = $captcha = $is_valid = "";
$namaError = $emailError = $telponError = $alamatError = $pengaduanError = $captchaError = "";

if (isset($_POST['submit'])) {
    // Cek apakah file gambar telah dipilih
    if (!empty($_FILES['gambar']['name']) && $_FILES['gambar']['error'] === UPLOAD_ERR_OK) {
        $file_name = $_FILES['gambar']['name'];
        $file_size = $_FILES['gambar']['size'];
        $file_tmp = $_FILES['gambar']['tmp_name'];
        $file_type = $_FILES['gambar']['type'];

        // Validasi jenis file gambar
        $allowed_types = array('image/jpeg', 'image/png', 'image/gif');
        if (!in_array($file_type, $allowed_types)) {
            $error = "Hanya file gambar JPG, JPEG, PNG, dan GIF yang diperbolehkan.";
            header("Location: ../public/lapor.php?gambarError=" . $error);
            exit;
        }

        // Validasi ukuran file gambar (contoh: maksimum 2MB)
        $max_size = 2 * 1024 * 1024; // 2MB
        if ($file_size > $max_size) {
            $error = "Ukuran file gambar terlalu besar. Maksimum 2MB.";
            header("Location: ../public/lapor.php?gambarError=" . $error);
            exit;
        }

        // Pindahkan file gambar ke lokasi yang diinginkan (contoh: folder uploads)
        $upload_dir = "../public/image_laporan/";
        $upload_path = $upload_dir . basename($file_name);
        if (move_uploaded_file($file_tmp, $upload_path)) {
            // File gambar berhasil diunggah, lakukan proses lain
            // Set path relatif atau absolut ke gambar
            $gambar_path = "image_laporan/" . basename($file_name);
        } else {
            $error = "Gagal mengunggah file gambar.";
            header("Location: ../public/lapor.php?gambarError=" . $error);
            exit;
        }
    } elseif (!empty($_FILES['gambar']['name']) && $_FILES['gambar']['error'] !== UPLOAD_ERR_OK) {
        // Jika file gambar dipilih tetapi terjadi kesalahan saat mengunggah
        $error = "Terjadi kesalahan saat mengunggah file gambar.";
        header("Location: ../public/lapor.php?gambarError=" . $error);
        exit;
    } else {
        // Jika tidak ada file gambar yang dipilih, lanjutkan proses tanpa mengunggah gambar
        // ...
    }
}

// Proses input data ke database setelah validasi
$nomor     = $_POST['nomor'];
$nama      = $_POST['nama'];
$email     = $_POST['email'];
$telpon    = $_POST['telpon'];
$alamat    = $_POST['alamat'];
$tujuan    = $_POST['tujuan'];
$pengaduan = $_POST['pengaduan'];
$captcha   = $_POST['captcha'];
$is_valid  = true;
validate_input();

if ($is_valid) {
    // Query untuk menyimpan data laporan ke database
    $sql = "INSERT INTO `laporan` (`id`, `nama`, `email`, `telpon`, `alamat`, `tujuan`, `isi`, `tanggal`, `status`, `gambar_path`) VALUES (:nomor, :nama, :email, :telpon, :alamat, :tujuan, :isi, CURRENT_TIMESTAMP, :status, :gambar_path)";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':nomor', $nomor);
    $stmt->bindValue(':nama', $nama);
    $stmt->bindValue(':email', $email);
    $stmt->bindValue(':telpon', $telpon);
    $stmt->bindValue(':alamat', htmlspecialchars($alamat));
    $stmt->bindValue(':tujuan', $tujuan);
    $stmt->bindValue(':isi', htmlspecialchars($pengaduan));
    $stmt->bindValue(':status', "Menunggu");
    $stmt->bindValue(':gambar_path', $gambar_path); // Path relatif atau absolut ke gambar

    // Jalankan pernyataan SQL
    $stmt->execute();

    // Setelah data disimpan, arahkan pengguna ke halaman beranda
    header("Location: ../public/home?status=success");
    exit;
} elseif (!$is_valid) {
    // Jika validasi gagal, arahkan pengguna kembali ke halaman lapor.php
    header("Location: ../public/lapor.php?nomor=$nomor&nama=$nama&namaError=$namaError&email=$email&emailError=$emailError&telpon=$telpon&telponError=$telponError&alamat=$alamat&alamatError=$alamatError&pengaduan=$pengaduan&pengaduanError=$pengaduanError&captcha=$captcha&captchaError=$captchaError");
    exit;
}

// Fungsi untuk melakukan validasi input
function validate_input()
{
    global $nama, $email, $telpon, $alamat, $pengaduan, $captcha, $is_valid;
    cek_nama($nama);
    cek_email($email);
    cek_telpon($telpon);
    cek_alamat($alamat);
    cek_pengaduan($pengaduan);
    cek_captcha($captcha);
}

// Validasi nama
function cek_nama($nama)
{
    global $nama, $is_valid, $namaError;
    if (!preg_match("/^[a-zA-Z ]*$/", $nama)) { // Cek nama hanya huruf dan spasi
        $namaError = "Nama Hanya Boleh Huruf dan Spasi";
        $is_valid = false;
    } else {
        $namaError = "";
    }
}

// Validasi email
function cek_email($email)
{
    global $email, $is_valid, $emailError;
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { // Cek format email
        $emailError = "Email Tidak Valid";
        $is_valid = false;
    } else {
        $emailError = "";
    }
}

// Validasi telpon
function cek_telpon($telpon)
{
    global $telpon, $telponError, $is_valid;
    if (!preg_match("/^[0-9]*$/", $telpon)) { // Cek telpon hanya angka
        $telponError = "Telpon Hanya Boleh Angka";
        $is_valid = false;
    } elseif (strlen($telpon) != 12) { // Cek panjang telpon
        $telponError = "Panjang Telpon Harus 12 Digit";
        $is_valid = false;
    } else {
        $telponError = "";
    }
}

// Validasi alamat
function cek_alamat($alamat)
{
    global $alamat, $is_valid, $alamatError;
    if (!preg_match("/^[a-zA-Z0-9 ]*$/", $alamat)) { // Cek alamat hanya huruf dan angka
        $alamatError = "Alamat Hanya Boleh Huruf dan Angka";
        $is_valid = false;
    } else {
        $alamatError = "";
    }
}

// Validasi pengaduan
function cek_pengaduan($pengaduan)
{
    global $pengaduan, $is_valid, $pengaduanError;
    if (strlen($pengaduan) > 2048) { // Cek panjang pengaduan
        $pengaduanError = "Isi Pengaduan Tidak Boleh Lebih Dari 2048 Karakter";
        $is_valid = false;
    } else {
        $pengaduanError = "";
    }
}

// Validasi captcha
function cek_captcha($captcha)
{
    global $captcha, $is_valid, $captchaError;
    echo "cek_captcha   : ", $captcha, "<br>";
    if ($captcha != $_SESSION['bilangan']) { // cek fullname bukan huruf
        $captchaError = "Captcha Salah atau Silahkan Reload Browser Anda";
        $is_valid = false;
    } else { // jika pengaduan valid kosongkan error
        $captchaError = "";
    }
}
?>
