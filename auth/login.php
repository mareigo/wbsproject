<?php 
  declare(strict_types=1);
  require 'bootstrap.php';

  $active_page = 'login';
  include 'parts/head.php'; 

  if (request_is('post')) {

    $email = request('email');
    $password = request('password');

    if ($email === '') {
        $errors['email'] = 'Bitte geben Sie Ihre E-Mail-Adresse ein.';
    }

    if ($password === '') {
        $errors['password'] = 'Bitte geben Sie Ihr Passwort ein.';
    }

    if (!$errors) {
        $user = db_raw_first(
            "SELECT * FROM `users` WHERE `email` = " . db_prepare($email)
        );

        if (!$user) {
            $errors['email'] = 'Ihre Login-Daten sind nicht korrekt.';
        }
    }

    if (!$errors) {
        if (!password_verify($password, $user['password'])) {
            $errors['email'] = 'Ihre Login-Daten sind nicht korrekt.';
        }
    }

    if (!$errors) {
        login($user);
        redirect('index.php');
    }
}
?>
</head>
<body>
  <div class="wrap">
    <?php 
    include 'parts/nav.php'; ?>
    <div class="content">
      <article class="content_text clearfix">
        <div class="col66 fl-l">
        <h2>Login</h2>

        <form action="<?= 'auth/login.php' ?>" method="post">
            <div class="form-group">
                <?= error_for($errors, 'email') ?>
                <label for="email">E-Mail</label>
                <input type="text" name="email" id="email">
            </div>

            <div class="form-group">
                <?= error_for($errors, 'password') ?>
                <label for="password">Passwort</label>
                <input type="text" name="password" id="password">
            </div>

            <div class="form-group">
                <button type="submit">Login</button>
            </div>
        </form>
        </div>  
      </article>
    </div>
  </div>  
</body>
</html>