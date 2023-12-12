<?php
$filePath = 'C:/xampp/htdocs/WebsiteSurat/user/surat-data.json';

// Mengambil data surat dari file JSON
$letters = json_decode(file_get_contents($filePath), true) ?? [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Pastikan action yang diterima adalah 'approve' atau 'reject'
    $action = isset($_POST['action']) ? $_POST['action'] : '';

    if ($action === 'approve' || $action === 'reject') {
        // Ambil data yang dikirimkan dari halaman list-surat.php
        $nama = isset($_POST['nama']) ? $_POST['nama'] : '';
        $nim = isset($_POST['nim']) ? $_POST['nim'] : '';
        $pilihan = isset($_POST['pilihan']) ? $_POST['pilihan'] : '';

        // Tambahkan variabel nomor telepon
        $nomor = 'NomorTeleponPenerima'; // Ganti dengan nomor telepon yang valid

        // Lakukan tindakan sesuai dengan nilai $action
        if ($action === 'approve') {
            // Lakukan tindakan persetujuan
            kirimPesanWA($nomor, $nama, 'Surat disetujui', 'disetujui');
            // Misalnya, update status surat menjadi 'disetujui' di file JSON
            // dan lakukan tindakan lain yang diperlukan
            setujuiSurat($nama);
        } elseif ($action === 'reject') {
            // Kirim notifikasi WA
            kirimPesanWA($nomor, $nama, 'Surat ditolak', 'ditolak');
        
            // Lakukan tindakan penolakan
            tolakSurat($nama);
        }        

        // Redirect kembali ke halaman list-surat.php setelah melakukan tindakan
        header('Location: list.php');
        exit();
    }
}

// Jika tindakan tidak sesuai atau tidak ada data yang diterima
// Redirect kembali ke halaman list-surat.php dengan pesan error jika diperlukan
header('Location: list.php?error=1');
exit();

// Fungsi untuk menyetujui surat dan mengirim notifikasi WA
function setujuiSurat($nama) {
    // Path ke file JSON
    $filePath = 'C:/xampp/htdocs/WebsiteSurat/user/surat-data.json';

    // Mendapatkan data surat dari file JSON
    $letters = json_decode(file_get_contents($filePath), true) ?? [];

    // Inisialisasi variabel nomor
    $nomor = '';

    // Cari surat dengan nama yang sesuai
    foreach ($letters as $key => $letter) {
        if ($letter['nama'] === $nama) {
            // Set nomor telepon
            $nomor = $letter['nomor'];

            // Kirim notifikasi WA
            kirimPesanWA($nomor, $nama, 'Surat Anda telah disetujui', 'disetujui');

            // Hapus entri surat dari file JSON
            unset($letters[$key]);

            // Simpan kembali data yang telah diubah ke file JSON
            file_put_contents($filePath, json_encode($letters, JSON_PRETTY_PRINT));

            // Hentikan pencarian setelah menemukan surat
            break;
        }
    }
}
// Fungsi untuk menolak surat dan mengirim notifikasi WA
function tolakSurat($nama) {
    // Path ke file JSON
    $filePath = 'C:/xampp/htdocs/WebsiteSurat/user/surat-data.json';

    // Mendapatkan data surat dari file JSON
    $letters = json_decode(file_get_contents($filePath), true) ?? [];

    // Inisialisasi variabel nomor
    $nomor = '';

    // Cari surat dengan nama yang sesuai
    foreach ($letters as $key => $letter) {
        if ($letter['nama'] === $nama) {
            // Set nomor telepon
            $nomor = $letter['nomor'];

            // Kirim notifikasi WA
            kirimPesanWA($nomor, $nama, 'Surat ditolak', 'ditolak');

            // Hapus entri surat dari file JSON
            unset($letters[$key]);

            // Simpan kembali data yang telah diubah ke file JSON
            file_put_contents($filePath, json_encode($letters, JSON_PRETTY_PRINT));

            // Hentikan pencarian setelah menemukan surat
            break;
        }
    }
}

// Fungsi untuk mengirim pesan WA
function kirimPesanWA($nomor, $nama, $status, $jenis) {
    // Mengirim nomor telepon ke API setelah menghasilkan surat
    $curl = curl_init();

    // Pesan default
    $pesan = 'Halo ' . $nama . ', Surat sedang diurus. Status: ' . $status;

    // Menyesuaikan pesan berdasarkan jenis
    if ($jenis === 'disetujui') {
        $pesan = 'Halo ' . $nama . ', Surat Anda telah disetujui. Status: ' . $status;
    } elseif ($jenis === 'ditolak') {
        $pesan = 'Halo ' . $nama . ', Mohon maaf, surat Anda ditolak. Status: ' . $status;
    } 
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
            'message' => $pesan
        ),
        CURLOPT_HTTPHEADER => array(
            'Authorization: #!sUwuAe_f7DfW+XBsp2'
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
}
?>
