<?php 
  require 'bootstrap.php';

  $active_page = 'kontakt';
  include 'parts/head.php'; 

  $errors = [];

  $firstname = (isset($_GET['submit']) ? (request('firstname')) : '');
  $lastname = (isset($_GET['submit']) ? (request('lastname')) : '');
  $email = (isset($_GET['submit']) ? (request('email')) : '');
  $textarea = (isset($_GET['submit']) ? (request('textarea')) : '');


  $agb = false;
  $company = false;
  $private = false;
  $logodesign = false;
  $layout = false;
  $sonstiges = false;
  $success_message = 'display:none;';
  $shadow = '';


if (request_is('post')) {

    $title = request('title');
    $firstname = request('firstname');
    $lastname = request('lastname');
    $email = request('email');
    $anliegen = request('anliegen');
    $textarea = request('textarea');
    $extra_info = request ('extra_info');
    $agb = request ('agb');


    /* Checkbox Werte wieder einfügen */
    if (is_array($extra_info)) {
     
      if (in_array('company', $extra_info)) {
        $company = true;
      }
      if (in_array('private', $extra_info)) {
        $private = true;
      }
    }
    

    /* Dropdown Werte wieder einfügen*/
    if (is_array($anliegen)) {

      if (in_array('logodesign', $anliegen)) {
        $logodesign = true;
      }
      if (in_array('layout', $anliegen)) {
        $layout = true;
      }
      if (in_array('sonstiges', $anliegen)) {
        $sonstiges = true;
      }
    }


    /* Validierung */
    if ($title === '') {
      $errors['title'] = 'Bitte wählen Sie eine Anrede aus.';
    }

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

    if ($anliegen === '') {
      $errors['anliegen'] = 'Bitte wählen Sie Ihr Anliegen.';
    }

    if ($textarea === '') {
      $errors['textarea'] = 'Bitte geben Sie eine Nachricht ein.';
    }

    if ($extra_info === '') {
      $errors['company'] = 'Bitte mindestens eine Antwort auswählen.';
    }

    if ($agb === '') {
      $errors['agb'] = 'Sie müssen die AGB akzeptieren.';
    }


    /* Formular wird abgeschickt */
    if (!$errors) {
      $success_message = 'display:block;';
      $shadow = 'shadow';
      header('refresh:5; url=index.php');
    }
}


?>
  <script src="js/kontakt.js"></script>
</head>
<body>
  <div class="wrap">
    <?php 
    include 'parts/nav.php'; 
    ?>
    <article class="content kontakt <?= $shadow ?>">
      <h2>Kontakt</h2>
      <form method="POST" enctype="multipart/form-data">

        <div>
          <?php if (isset($errors['title'])) : ?>
            <div class="alert"><?= $errors['title'] ?></div>
          <?php endif; ?>
          <p class="required">Bitte wählen Sie eine Anrede aus.</p>
          <input type="radio" id="no_title" name="title" value="no_title" checked>
          <label for="no_title">Keine Angabe</label>
          <input type="radio" id="title_fem" name="title" value="title_fem">
          <label for="title_fem">Frau</label>
          <input type="radio" id="title_male" name="title" value="title_male">
          <label for="title_male">Herr</label>
        </div>
      
        <div class="required">
          <?php if (isset($errors['firstname'])) : ?>
            <div class="alert"><?= $errors['firstname'] ?></div>
          <?php endif; ?>
          <label for="firstname">Vorname</label><br>
          <input type="text" name="firstname" value="<?= $firstname ?>" id="firstname" required>
        </div>

        <div class="required">
          <?php if (isset($errors['lastname'])) : ?>
            <div class="alert"><?= $errors['lastname'] ?></div>
          <?php endif; ?>
          <label for="lastname">Nachname</label><br>
          <input type="text" name="lastname" value="<?= $lastname ?>" id="lastname" required>
        </div>

        <div class="required">
          <?php if (isset($errors['email'])) : ?>
            <div class="alert"><?= $errors['email'] ?></div>
          <?php endif; ?>
          <label for="email">E-Mail</label><br>
          <input type="text" type="email" name="email" value="<?= $email ?>" id="email" required> 
        </div>

        <div class="required">
          <?php if (isset($errors['anliegen'])) : ?>
            <div class="alert"><?= $errors['anliegen'] ?></div>
          <?php endif; ?>
          <label for="anliegen">Grund der Kontaktaufnahme (mehrere Antworten möglich):</label><br>
          <select id="anliegen" multiple size="4" name="anliegen[]" required>
            <option name="anliegen[]" value=""  disabled>Bitte wählen</option>
            <option name="anliegen[]" value="logodesign" <?= ($logodesign ? 'selected="selected"' : '' ) ?>>Fragen zum Logodesign</option>
            <option name="anliegen[]" value="layout" <?= ($layout ? 'selected="selected"' : '' ) ?>>Fragen zum Layoutdesign</option>
            <option name="anliegen[]" value="sonstiges" <?= ($sonstiges ? 'selected="selected"' : '' ) ?>>Sonstiges</option>
          </select> 
        </div>

        <div class="required">
          <?php if (isset($errors['company'])) : ?>
            <div class="alert"><?= $errors['company'] ?></div>
          <?php endif; ?>
          <label for="company">Anfrage als Unternehmen oder Privatperson:</label><br>
          <input type="checkbox" id="company" data-check="extra_info" name="extra_info[]" value="company" <?= ($company ? 'checked="checked"' : '' ) ?> ><span>Unternehmen</span><br>
          <input type="checkbox" id="private" data-check="extra_info" name="extra_info[]" value="private" <?= ($private ? 'checked="checked"' : '' ) ?>>Privatperson<br>
        </div>    

        <div class="required">
          <?php if (isset($errors['textarea'])) : ?>
            <div class="alert"><?= $errors['textarea'] ?></div>
          <?php endif; ?>
          <label for="textarea">Ihre Nachricht</label><br>
          <textarea id="textarea" name="textarea" rows="5" cols="30" required><?= $textarea ?></textarea>
        </div>

        <div>
          <?php if (isset($errors['agb'])) : ?>
            <div class="alert"><?= $errors['agb'] ?></div>
          <?php endif; ?>
          <input type="checkbox" id="agb" name="agb" value="agb" <?= ($agb ? 'checked="checked"' : '' ) ?> required><span class="required"><strong>AGB</strong> akzeptieren</span><br>
        </div>
        <button id="btn_contact" name="submit" type="submit">absenden</button>
      </form> 
    </article>
    <div id="php_success" style="<?= $success_message ?>"><strong>Ihre Nachricht wird versendet.</strong></div>
  </div>  
</body>