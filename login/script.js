document.getElementById("login-form").addEventListener("submit", function(event) {
  event.preventDefault();

  var username = document.getElementById("username").value;
  var password = document.getElementById("password").value;
  var errorMessage = document.getElementById("error-message");

  // Array of user objects with their credentials
  var users = [
      { username: "admin", password: "admin", role: "admin" },
      { username: "user", password: "user", role: "user" }
      // Add more user objects as needed
  ];

  // Check if the entered username and password match any user object in the array
  var user = users.find(function(user) {
      return user.username === username && user.password === password;
  });

  if (user) {
      if (user.role === "admin") {
          window.location.href = "/WebsiteSurat/admin/admin-dashboard.php";
      } else if (user.role === "user") {
          window.location.href = "/WebsiteSurat/user/user-dashboard.php";
      }

      errorMessage.textContent = "Login berhasil!";
      errorMessage.style.color = "green";
  } else {
      errorMessage.textContent = "Username atau password salah. Silakan coba lagi.";
      errorMessage.style.color = "red";
  }
});
