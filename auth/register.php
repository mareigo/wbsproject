<?php
declare(strict_types=1);

require '../bootstrap.php';

$active_page = $active_page ?? '';
$active_page2 = $active_page2 ?? '';

$active_page = 'register';


$firstname = (isset($_GET['submit']) ? (request('firstname')) : '');
$lastname = (isset($_GET['submit']) ? (request('lastname')) : '');
$email = (isset($_GET['submit']) ? (request('email')) : '');
$password = (isset($_GET['submit']) ? (request('password')) : '');


if (request_is('post')) {
  $firstname = request('firstname');
  $lastname = request('lastname');
  $email = request('email');
  $password = request('password');
  $password_confirm = request('password_confirm');

  if ($firstname === '') {
      $errors['firstname'] = 'Bitte geben Sie Ihren Vornamen ein.';
  }

  if ($lastname === '') {
      $errors['lastname'] = 'Bitte geben Sie Ihren Nachnamen ein.';
  }

  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $errors['email'] = 'Bitte geben Sie eine gültige E-Mail-Adresse ein.';
  }

  if ($email === '') {
      $errors['email'] = 'Bitte geben Sie Ihre E-Mail-Adresse ein.';
  }

  if ($password !== $password_confirm) {
      $errors['password'] = 'Das Passwort stimmt nicht.';
  }

  if (mb_strlen($password) < 6) {
      $errors['password'] = 'Das Passort muss mindestens 6 Zeichen lang sein.';
  }

  if ($password === '') {
      $errors['password'] = 'Bitte geben Sie ein Passwort ein.';
  }

  if (!$errors) {
    $user = db_raw_first(
      "SELECT * FROM `users` WHERE `email` = " . db_prepare($email)
    );

    if ($user) {
      $errors['email'] = 'This email already exists in our database.';
      }
  }

  if (!$errors) {
      db_insert('users', [
        'firstname' => $firstname,
				'lastname' => $lastname,
        'email' => $email,
        'password' => password_hash($password, PASSWORD_DEFAULT)
      ]);

      redirect('../login.php');
  }
}

?>
<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mareike Damm Portfolio</title>
  <link rel="stylesheet" href="<?= '../css/global.css' ?>">
  <link rel="stylesheet" href="<?= '../css/helper.css' ?>">
  <link rel="stylesheet" href="<?= '../css/style.css' ?>">
  <link rel="stylesheet" href="<?= '../css/media.css' ?>">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script>
    window.jQuery || document.write('<script src="../js/jquery/jquery-3.5.1.js"><\/script>');
  </script>
  <script src="../js/jquery/validate/jquery.validate.min.js"></script>
  <script src="../js/jquery/validate/additional-methods.min.js"></script>
  <script src="../js/jquery/validate/localization/messages_de.js"></script>
  <script src="../js/register.js"></script>
</head>
<body>
  <div class="wrap">
  <nav class="clearfix">
    <div id="logo"><a title="Zur Startseite" href="../index.html"></a></div>
      <a href="#show" class="open" id="show"><span class="hamb">&#9776;</span></a>
      <a href="#" class="close" id="close"><span class="hamb">&#10006;</span></a>
      <ul class="show">
        <li class="<?= $active_page === 'index' ? 'active' : '' ?>"><a title="Zur Startseite" href="<?= '../index.php' ?>">Über mich</a></li>
        <li class="<?= $active_page === 'logodesign' ? 'active' : '' ?>"><a title="Zum Logodesign" href="<?= '../logodesign.php' ?>">Logodesign</a></li>
        <li class="<?= $active_page === 'layout' ? 'active' : '' ?>"><a id="a_layout" title="Zu den Layoutdesigns" href=" <?= '../layout.php' ?>">Layout</a>
          <ul>
            <li class="<?= $active_page2 === 'anzeige' ? 'active' : '' ?>"><a title="Zum Anzeige-Design" href="../anzeige.php">Anzeige</a></li>
            <li class="<?= $active_page2 === 'magazin' ? 'active' : '' ?>"><a title="Zum Magazin-Design" href="../magazin.php">Magazin</a></li>
            <li class="<?= $active_page2 === 'karte' ? 'active' : '' ?>"><a title="Zum Karten-Design" href="../karte.php">Karte</a></li>
            <li class="<?= $active_page2 === 'banner' ? 'active' : '' ?>"><a title="Zum Web-Banner-Design" href="../banner.php">Web-Banner</a></li>
            <li class="<?= $active_page2 === 'gutschein' ? 'active' : '' ?>"><a title="Zum Gutschein-Design" href="../gutschein.php">Gutschein</a></li>
          </ul>
        </li>
        <li class="<?= $active_page === 'kontakt' ? 'active' : '' ?>"><a title="Nehmen Sie Kontakt auf" href="<?= '../kontakt.php' ?>">Kontakt</a></li>
        <li class="<?= $active_page === 'impressum' ? 'active' : '' ?>"><a title="Zum Impressum" href="<?= '../impressum.php' ?>">Impressum</a></li>
        <li class="<?= $active_page === 'login' ? 'active' : '' ?>"><a title="Zum Impressum" href="<?= '../login.php' ?>">Login</a></li>
      </ul>
  </nav>
    <div class="content">
      <article class="content_text clearfix">
        <h2>Registrierung</h2>
        <form action="<?= 'register.php' ?>" method="post">
          <div class="form-group">
            <?= error_for($errors, 'firstname') ?>
            <label for="firstname">Vorname</label>
            <input type="text" name="firstname" id="firstname" value="<?= $firstname ?>">
          </div>

          <div class="form-group">
            <?= error_for($errors, 'lastname') ?>
            <label for="lastname">Nachname</label>
            <input type="text" name="lastname" id="lastname" value="<?= $lastname ?>">
          </div>

          <div class="form-group">
            <?= error_for($errors, 'email') ?>
            <label for="email">Email</label>
            <input type="text" name="email" id="email" value="<?= $email ?>">
          </div>

          <div class="form-group">
            <?= error_for($errors, 'password') ?>
            <label for="password">Passwort</label>
            <input type="password" name="password" id="password" value="<?= $password ?>">
          </div>

          <div class="form-group">
            <label for="conf-password">Passwort <br>wiederholen</label>
            <input type="password" name="conf-password" id="conf-password">
          </div>

          <div class="form-group">
            <button type="submit">Register</button>
          </div>
        </form>
        <br>
        <div>
          Haben Sie schon einen Account? Gehen Sie zum <a class="textlink" href="<?= '../login.php' ?>">Login</a>.
        </div>
      </article>
    </div>
  </div>  
</body>
</html>
