<!-- list-surat.php -->
<?php
$filePath = 'C:\xampp\htdocs\WebsiteSurat\user\surat-data.json';

// Mengambil data surat dari file JSON
$letters = json_decode(file_get_contents($filePath), true) ?? [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="css/bootstrap.min.css" />
   <title>List Daftar Surat</title>
</head>
<body>

<div class="container mt-5">
   <h2>List Daftar Surat</h2>

   <table class="table table-bordered">
      <thead>
         <tr>
            <th>Nama</th>
            <th>NIM</th>
            <th>Isi Surat</th>
            <th>Status</th>
            <th>Preview Dokumen</th>
         </tr>
      </thead>
      <tbody>
         <?php foreach ($letters as $letter): ?>
            <tr>
               <td><?= $letter['nama']; ?></td>
               <td><?= $letter['nim']; ?></td>
               <td><?= $letter['pilihan']; ?></td>
               <td><?= $letter['status']; ?></td>
               <td>
                  <!-- Menampilkan tautan untuk melihat dokumen -->
                  <a href="preview-document.php?document=<?= base64_encode($letter['dokumen']); ?>" target="_blank">Preview Dokumen</a>
               </td>
            </tr>
         <?php endforeach; ?>
      </tbody>
   </table>
</div>

<script src="./js/bootstrap.bundle.min.js"></script>
</body>
</html>
