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
   <style>
      .container-header {
         background-color: #f8f9fa;
         padding: 20px;
         border-radius: 10px;
      }

      .table-hover tbody tr:hover {
         background-color: #e2e6ea;
      }

      footer {
         margin-top: 20px;
      }
   </style>
   <title>List Daftar Surat</title>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
   <div class="container">
      <!-- Mengubah posisi tombol kembali ke kiri -->
      <a class="navbar-brand mr-auto" href="/WebsiteSurat/admin/admin-dashboard.php">
         <i class="fa-solid fa-arrow-left" style="color: #0080c0;"></i> Back
      </a>
   </div>
</nav>

<div class="container mt-5 mb-4 container-header">
   <h2 class="text-center">List Daftar Surat</h2>
   
   <div class="table-responsive">
      <table class="table table-bordered table-hover">
         <thead>
            <tr>
               <th>Nama</th>
               <th>NIM</th>
               <th>Isi Surat</th>
               <th>Status</th>
               <th>Preview Dokumen</th>
               <th>Action</th> <!-- Menambahkan kolom Action -->
            </tr>
         </thead>
         <tbody>
            <?php foreach ($letters as $letter): ?>
               <tr class="table-light">
                  <td><?= $letter['nama']; ?></td>
                  <td><?= $letter['nim']; ?></td>
                  <td><?= $letter['pilihan']; ?></td>
                  <td><?= $letter['status']; ?></td>
                  <td>
                     <!-- Form to submit data to GenerateSurat.php -->
                     <form action="GenerateSurat.php" method="post">
                        <input type="hidden" name="nama" value="<?= $letter['nama']; ?>">
                        <input type="hidden" name="nim" value="<?= $letter['nim']; ?>">
                        <input type="hidden" name="pilihan" value="<?= $letter['pilihan']; ?>">
                        <button type="submit" class="btn btn-success"><i class="fa-solid fa-eye"></i></button>
                     </form>
                  </td>
                  <td>
                     <!-- Tombol Menyetujui Surat -->
                     <form action="aksiSurat.php" method="post" style="display:inline;">
                        <input type="hidden" name="action" value="approve">
                        <input type="hidden" name="nama" value="<?= $letter['nama']; ?>">
                        <input type="hidden" name="nim" value="<?= $letter['nim']; ?>">
                        <input type="hidden" name="pilihan" value="<?= $letter['pilihan']; ?>">
                        <button type="submit" class="btn btn-success"><i class="fa-solid fa-check fa-fade" style="color: #00ff00;"></i></button>
                     </form>

                     <!-- Tombol Menolak Surat -->
                     <form action="aksiSurat.php" method="post" style="display:inline;">
                        <input type="hidden" name="action" value="reject">
                        <input type="hidden" name="nama" value="<?= $letter['nama']; ?>">
                        <input type="hidden" name="nim" value="<?= $letter['nim']; ?>">
                        <input type="hidden" name="pilihan" value="<?= $letter['pilihan']; ?>">
                        <button type="submit" class="btn btn-danger"><i class="fa-solid fa-xmark" style="color: #000000;"></i></button>
                     </form>
                  </td>
               </tr>
            <?php endforeach; ?>
         </tbody>
      </table>
   </div>
</div>
<footer class="text-center mt-5 mb-3 text-muted">
   &copy; 2023 Sanata Dharma - WebsiteSurat
</footer>

<script src="./js/bootstrap.bundle.min.js"></script>
<script src="https://kit.fontawesome.com/cc52547201.js" crossorigin="anonymous"></script>
</body>
</html>