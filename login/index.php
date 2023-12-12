<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css" />
    <title>Halaman Login</title>
  </head>
  <body>
    <div class="login-container">
      <h2>Masuk ke Akun Anda</h2>
      <form id="login-form">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required /><br />

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required /><br />

        <button type="submit">Login</button>
      </form>
      <p id="error-message"></p>
    </div>

    <script src="script.js"></script>
  </body>
</html>
