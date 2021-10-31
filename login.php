<?php 
declare(strict_types=1);
require 'bootstrap.php';

$active_page = 'login';
include 'parts/head.php'; 

$email = (isset($_GET['submit']) ? (request('email')) : '');
$password = (isset($_GET['submit']) ? (request('password')) : '');

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
            $errors['email'] = 'Ihre E-Mail-Adresse nicht korrekt.';
        }
    }

    if (!$errors) {
        if (!password_verify($password, $user['password'])) {
            $errors['password'] = 'Ihr Passwort ist nicht korrekt.';
        }
    }

    if (!$errors) {
        login($user);
        redirect('index.php');
    }
}

if (auth_user()) {
    $id = (auth_id());
    $sql = "SELECT * FROM `users` WHERE `id` = $id";
    $users = db_raw_select($sql);
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
          <?php  if (!auth_user()) : ?>
            <h2>Login</h2>
            <form action="<?= 'login.php' ?>" method="post">
              <div class="form-group">
								<?= error_for($errors, 'email') ?>
                <label for="email">E-Mail</label>
                <input type="text" name="email" id="email" value="<?= $email ?>">
              </div>
              <div class="form-group">
                <?= error_for($errors, 'password') ?>
                <label for="password">Passwort</label>
                <input type="password" name="password" id="password">
              </div>
              <div class="form-group">
                <button type="submit">Login</button>
              </div>
              <div>
                <p>Sie haben noch keinen Account? Dann gehen Sie zur <a class="textlink" href="<?= 'auth/register.php' ?>">Registrierung</a>.</p>
							</div>
          <?php endif; ?>    
              <?php  if (auth_user()) : ?>
                <h2>Login</h2>
                <div class="form-group">
                <?php foreach ($users as $user) : ?>
                  <p>Sie sind  als <?= $user['firstname'] . '  ' . $user['lastname'] ?> angemeldet.</p>
                <?php endforeach; ?>
                  <a class="btn" href="auth/logout.php">Abmelden</a>
                </div>
              <?php endif; ?> 
            </form>
        </div>   
      </article>  
    </div>
  </div> 
</body>
</html>