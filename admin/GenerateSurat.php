<?php
// Path ke file surat-data.json
$filePath = 'C:\xampp\htdocs\WebsiteSurat\user\surat-data.json';

// Mengambil data surat dari file JSON
$letters = json_decode(file_get_contents($filePath), true) ?? [];

// Jika tidak ada surat yang diambil dari JSON, beri pesan dan hentikan eksekusi
if (empty($letters)) {
    echo 'Tidak ada data surat.';
    exit();
}

// Loop untuk memproses setiap surat
foreach ($letters as $exampleLetter) {
    // Mengambil dokumen surat berhenti studi, surat cuti, atau surat aktif studi (berdasarkan pilihan)
    $documentPath = '';

    if ($exampleLetter['pilihan'] == 'Surat Berhenti Studi') {
        $documentPath = 'C:\xampp\htdocs\WebsiteSurat\admin\SuratBerhentiStudi.rtf';
    } elseif ($exampleLetter['pilihan'] == 'Surat Cuti') {
        $documentPath = 'C:\xampp\htdocs\WebsiteSurat\admin\SuratCuti.rtf';
    } elseif ($exampleLetter['pilihan'] == 'Surat Aktif Studi') {
        $documentPath = 'C:\xampp\htdocs\WebsiteSurat\admin\SuratAktifStudi.rtf';
    } else {
        // Tambahkan logika untuk jenis surat lainnya jika diperlukan
        echo 'Jenis surat tidak dikenali.';
        continue; // Skip ke surat berikutnya jika jenis surat tidak dikenali
    }

    // Menggantikan placeholder dengan nilai yang benar
    $document = file_get_contents($documentPath);
    $document = str_replace("#NAMA", $exampleLetter['nama'], $document);
    $document = str_replace("#NIM", $exampleLetter['nim'], $document);

    if ($exampleLetter['pilihan'] == 'Surat Berhenti Studi') {
        $document = str_replace("#PROSTU", $exampleLetter['ProgramStudi1'], $document);
        $document = str_replace("#SEM", $exampleLetter['Semester1'], $document);
    } elseif ($exampleLetter['pilihan'] == 'Surat Cuti') {
        $document = str_replace("#PROGSTU", $exampleLetter['ProgramStudi2'], $document);
        $document = str_replace("#SEMES", $exampleLetter['Semester2'], $document);
        $document = str_replace("#CUTI", $exampleLetter['Cuti'], $document);
    } elseif ($exampleLetter['pilihan'] == 'Surat Aktif Studi') {
        $document = str_replace("#PROGRAMST", $exampleLetter['ProgramStudi3'], $document);
        $document = str_replace("#SEMEST", $exampleLetter['Semester3'], $document);
    }

    $document = str_replace("#ISI", $exampleLetter['isi'], $document);

    // Header untuk membuka file yang dihasilkan dengan aplikasi Ms. Word
    // Nama file yang dihasilkan disesuaikan dengan jenis surat
    if ($exampleLetter['pilihan'] == 'Surat Berhenti Studi') {
        header("Content-disposition: inline; filename=suratBerhentiStudi.doc");
    } elseif ($exampleLetter['pilihan'] == 'Surat Cuti') {
        header("Content-disposition: inline; filename=suratCuti.doc");
    } elseif ($exampleLetter['pilihan'] == 'Surat Aktif Studi') {
        header("Content-disposition: inline; filename=suratAktif.doc");
    }

    header("Content-type: application/msword");
    header("Content-length: " . strlen($document));
    echo $document;
}
?>
