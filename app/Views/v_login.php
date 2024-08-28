<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <style>
    .password-container {
      position: relative;
      width: fit-content;
    }
    .password-container input {
      padding-right: 30px; /* Add space for the eye icon */
    }
    .password-container .fa-eye-slash {
      position: absolute;
      top: 50%;
      right: 10px;
      transform: translateY(-50%);
      cursor: pointer;
    }
  </style>
    <link rel="stylesheet" href="/css/style.css">
    <title>Login | PT. Olean</title>
    <link rel="icon" href="/img/logo.png">
</head>

<body>
  <div class="container" id="container">
      <div class="form-container sign-in">
          <form method="post" action="<?php echo base_url('/loginproses') ?>">
              <?= csrf_field()?>
              <h1>Login</h1>
              <span>Masukan username dan password</span>
              <br>
              <?php if(session()->getFlashdata('error')) : ?>
                  <div class="alert alert-denger alert-dismissible show fade">
                      <div class="alert-body">
                          <b>Error !</b>
                          <?= session()->getFlashdata('error')?>
                      </div>
                  </div>
                  <?php endif ?>
              <div class="username-container">
                  <input type="username" placeholder="Username" name="username" required>
              </div>
              <div class="password-container">
                  <input type="password" name="password" id="password" placeholder="Password" required>
                  <i class="fa fa-eye-slash" id="togglePassword" style="cursor: pointer;"></i>
              </div>
              <br>
              <button>Login</button>
          </form>
      </div>
      <div class="toggle-container">
          <div class="toggle">
              <div class="toggle-panel toggle-right">
                  <img src="/img/logo.png" alt="">
                  <br>
                  <h1>STOK BARANG</h1>
                  <span>PT. OLEAN PERMATA TELEMATIKA</span>
              </div>
          </div>
      </div>
  </div>

  <script src="/js/script.js"></script>
  <script>
    // Select the password input field and the toggle icon
    const password = document.querySelector('#password');
    const togglePassword = document.querySelector('#togglePassword');

    // Function to toggle the visibility of the password
    togglePassword.addEventListener('click', function () {
      // Toggle the type attribute of the password field
      const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
      password.setAttribute('type', type);

      // Toggle the icon class
      this.classList.toggle('fa-eye');
      this.classList.toggle('fa-eye-slash');
    });
  </script>
</body>

</html>
