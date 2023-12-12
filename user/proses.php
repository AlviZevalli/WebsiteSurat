<?php
// Mengambil data dari formulir HTML
$isi      = $_POST['message'];
$nama     = $_POST['name'];
$nim      = $_POST['NIM'];
$nomor    = $_POST['NoTelepon'];
$pilihan  = $_POST['surat'];
//Surat Berhenti Studi
$semester = isset($_POST['Semester1']) ? $_POST['Semester1'] : '';
$programstudi1 = isset($_POST['ProgramStudi1']) ? $_POST['ProgramStudi1']: '';
//Surat Cuti
$semester2 = isset($_POST['Semester2']) ? $_POST['Semester2'] : '';
$programstudi2 = isset($_POST['ProgramStudi2']) ? $_POST['ProgramStudi2']: '';
$cuti = isset($_POST['Cuti']) ? $_POST['Cuti'] : '';
//Surat Aktif Studi
$programstudi3 = isset($_POST['ProgramStudi3']) ? $_POST['ProgramStudi3']: '';
$semester3 = isset($_POST['Semester3']) ? $_POST['Semester3'] : '';

$newLetter = array(
    'nama' => $nama,
    'nim' => $nim,
    'isi' => $isi,
    'pilihan' => $pilihan,
    'status' => 'Menunggu',
    'Semester1'=> $semester,
    'ProgramStudi1' => $programstudi1, // Perhatikan perubahan di sini
    'Semester2' => $semester2, // Perhatikan perubahan di sini
    'ProgramStudi2' => $programstudi2, // Perhatikan perubahan di sini
    'Cuti' => $cuti, // Perhatikan perubahan di sini
    'ProgramStudi3' => $programstudi3, // Perhatikan perubahan di sini
    'Semester3' => $semester3, // Perhatikan perubahan di sini
);

$letters = []; // Menyiapkan array untuk menyimpan surat

// Membaca data yang sudah ada jika file JSON sudah ada
if (file_exists('surat-data.json')) {
    $letters = json_decode(file_get_contents('surat-data.json'), true);
}

$letters[] = $newLetter;

// Menyimpan data surat ke dalam file JSON
file_put_contents('surat-data.json', json_encode($letters));

// Mengirim nomor telepon ke API setelah menghasilkan surat
$curl = curl_init();

curl_setopt_array($curl, array(
   CURLOPT_URL => 'https://api.fonnte.com/send',
   CURLOPT_RETURNTRANSFER => true,
   CURLOPT_ENCODING => '',
   CURLOPT_MAXREDIRS => 10,
   CURLOPT_TIMEOUT => 0,
   CURLOPT_FOLLOWLOCATION => true,
   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
   CURLOPT_CUSTOMREQUEST => 'POST',
   CURLOPT_POSTFIELDS => array(
      'target' => $nomor,
      'message' => 'Halo ' . $nama . ', Surat sedang diurus'
   ),
   CURLOPT_HTTPHEADER => array(
      'Authorization: #!sUwuAe_f7DfW+XBsp2'
   ),
));

$response = curl_exec($curl);

curl_close($curl);

// Redirect ke halaman lain (contoh: user-dashboard.php)
header("Location: user-dashboard.php?pesan=permohonan_terkirim");
exit();
?>
