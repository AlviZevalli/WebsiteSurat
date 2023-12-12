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

// Mengambil dokumen surat (contoh, menggunakan SuratBerhenti.rtf)
$documentPath = 'C:\xampp\htdocs\WebsiteSurat\admin\SuratCuti.rtf';
$document = file_get_contents($documentPath);

// Variabel untuk contoh data surat pertama dari JSON
$exampleLetter = reset($letters);

// Menggantikan placeholder dengan nilai yang benar
$document = str_replace("#NAMA", $exampleLetter['nama'], $document);
$document = str_replace("#NIM", $exampleLetter['nim'], $document);
$document = str_replace("#PROGRAMSTUDI", $exampleLetter['ProgramStudi2'], $document);
$document = str_replace("#SEMESTER", $exampleLetter['Semester2'], $document);
$document = str_replace("#CUTI", $exampleLetter['Cuti'], $document);
$document = str_replace("#ISI", $exampleLetter['isi'], $document);

// Header untuk membuka file yang dihasilkan dengan aplikasi Ms. Word
// Nama file yang dihasilkan adalah surat.doc
header("Content-type: application/msword");
header("Content-disposition: inline; filename=suratCuti.doc");
header("Content-length: " . strlen($document));
echo $document;
?>
