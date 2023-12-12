<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css"
    />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="style.css" />
    <title>Surat Menyurat Sanata Dharma</title>
  </head>
  <body>
    <!-- top navigation bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark bg-red fixed-top">
      <div class="container-fluid">
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="offcanvas"
          data-bs-target="#sidebar"
          aria-controls="offcanvasExample"
        >
          <span class="navbar-toggler-icon" data-bs-target="#sidebar"></span>
        </button>
        <a class="navbar-brand me-auto ms-lg-0 ms-3 text-uppercase fw-bold" href="#">
          <img id="navbar-logo" src="logo_usd.png" alt="Logo" />
        </a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#topNavBar"
          aria-controls="topNavBar"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="topNavBar">
          <form class="d-flex ms-auto my-3 my-lg-0">
            <div class="input-group">
              <input
                class="form-control"
                type="search"
                placeholder="Search"
                aria-label="Search"
              />
              <button class="btn btn-primary" type="submit">
                <i class="bi bi-search"></i>
              </button>
            </div>
          </form>
          <ul class="navbar-nav">
            <li class="nav-item dropdown">
              <a
                class="nav-link dropdown-toggle ms-2"
                href="#"
                role="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
              >
                <i class="bi bi-person-fill"></i>
              </a>
              <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="#">Profil</a></li>
                <li><a class="dropdown-item" href="#">Setting</a></li>
                <li>
                  <a class="dropdown-item" href="/WebsiteSurat/login/"
                    >Logout</a
                  >
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- top navigation bar -->
    <!-- offcanvas -->
    <div
      class="offcanvas offcanvas-start sidebar-nav bg-dark"
      tabindex="-1"
      id="sidebar"
    >
      <div class="offcanvas-body p-0">
        <nav class="navbar-dark">
          <ul class="navbar-nav">
            <li>
              <a href="#" class="nav-link px-3 active">
                <span class="me-2"><i class="bi bi-speedometer2"></i></span>
                <span>Surat Permohonan</span>
              </a>
            </li>
            <li class="my-4"><hr class="dropdown-divider bg-light" /></li>
            <li>
              <div class="text-muted small fw-bold text-uppercase px-3 mb-3">
                Menu
              </div>
            </li>
            <li>
              <a
                class="nav-link px-3 sidebar-link"
                data-bs-toggle="collapse"
                href="#layouts"
              >
                <span class="me-2"><i class="bi bi-layout-split"></i></span>
                <span>Lacak</span>
                <span class="ms-auto">
                  <span class="right-icon">
                    <i class="bi bi-chevron-down"></i>
                  </span>
                </span>
              </a>
              <div class="collapse" id="layouts">
                <ul class="navbar-nav ps-3">
                  <li>
                    <a href="#" class="nav-link px-3">
                      <span class="me-2"
                        ><i class="bi bi-speedometer2"></i
                      ></span>
                      <span>Status Surat</span>
                    </a>
                  </li>
                </ul>
              </div>
            </li>
            <li>
              <a href="#" class="nav-link px-3">
                <span class="me-2"><i class="bi bi-book-fill"></i></span>
                <span>Riwayat Surat</span>
              </a>
            </li>
            <li class="my-4"><hr class="dropdown-divider bg-light" /></li>
            <li></li>
          </ul>
        </nav>
      </div>
    </div>
    <!-- offcanvas -->
    <div class="form-container">
  <h2>Form Permohonan</h2>
  <form action="proses.php" method="post" id="requestForm" onsubmit="return onSubmitForm()">
    <div class="form-group">
      <label for="name">Nama:</label>
      <input type="text" id="name" name="name" required>
    </div>

    <div class="form-group">
      <label for="NIM">NIM:</label>
      <input type="text" id="NIM" name="NIM" required>
    </div>

    <div class="form-group">
      <label for="NoTelepon">Nomor Telepon:</label>
      <input type="text" id="NoTelepon" name="NoTelepon" required>
    </div>

    <div class="form-group">
      <label for="surat">Pilihan Surat:</label>
      <select id="surat" name="surat" onchange="showAdditionalFields()" required>
        <option value="Surat Berhenti Studi">Surat Berhenti Studi</option>
        <option value="Surat Cuti">Surat Cuti</option>
        <option value="Surat Aktif Studi">Surat Aktif Studi</option>
      </select>
    </div>

    <div class="form-group" id="additionalFields" style="display: none;">
      <!-- Additional fields for Surat Berhenti Studi -->
      <div id="additionalFieldsSurat1">
        <label for="ProgramStudi1">Program Studi:</label>
        <input type="text" id="ProgramStudi1" name="ProgramStudi1">

        <label for="Semester1">Semester:</label>
        <input type="text" id="Semester1" name="Semester1">
      </div>

      <!-- Additional fields for Surat Cuti -->
      <div id="additionalFieldsSurat2" style="display: none;">
        <label for="Semester2">Semester:</label>
        <input type="text" id="Semester2" name="Semester2">

        <label for="Cuti">Cuti Studi Yang Ke:</label>
        <input type="text" id="Cuti" name="Cuti">
      </div>

      <!-- Additional fields for Surat Aktif Studi -->
      <div id="additionalFieldsSurat3" style="display: none;">
        <label for="ProgramStudi3">Program Studi:</label>
        <input type="text" id="ProgramStudi3" name="ProgramStudi3">

        <label for="Semester3">Semester:</label>
        <input type="text" id="Semester3" name="Semester3">
      </div>
    </div>

    <div class="form-group">
      <label for="message">Isi:</label>
      <textarea id="message" name="message" rows="4" required></textarea>
    </div>

    <div class="form-group">
      <button type="submit">Submit</button>
    </div>
  </form>
</div>

  <script>
    function showAdditionalFields() {
      var selectedSurat = document.getElementById("surat").value;
      var additionalFields = document.getElementById("additionalFields");

      // Hide all additional fields by default
      document.getElementById("additionalFieldsSurat1").style.display = "none";
      document.getElementById("additionalFieldsSurat2").style.display = "none";
      document.getElementById("additionalFieldsSurat3").style.display = "none";

      // Show additional fields based on selected option
      if (selectedSurat === "Surat Berhenti Studi") {
        document.getElementById("additionalFieldsSurat1").style.display = "block";
      } else if (selectedSurat === "Surat Cuti") {
        document.getElementById("additionalFieldsSurat2").style.display = "block";
      } else if (selectedSurat === "Surat Aktif Studi") {
        document.getElementById("additionalFieldsSurat3").style.display = "block";
      }

      // Show the container of additional fields
      additionalFields.style.display = "block";

          function onSubmitForm() {
      // Menampilkan notifikasi menggunakan alert
      alert("Permohonan telah dikirim. Terima kasih!");

      // Mengembalikan false agar formulir tidak ter-submit secara default
      return false;
    }
    }
  </script>

    <script src="./js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.2/dist/chart.min.js"></script>
    <script src="./js/jquery-3.5.1.js"></script>
    <script src="./js/script.js"></script>
  </body>
</html>
