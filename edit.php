<?php

require_once 'bootstrap.php';

$active_page = 'blog';
include 'parts/head.php'; 


if ((auth_id() !== 1)) {
  redirect('auth/login.php');
}

$id = (int) query('id');

if (!$id) {
  redirect('index.php');
}

$sql = "SELECT * FROM `blog` WHERE `id` = $id";
$blog_entries1 = db_raw_first($sql);



if (request_is('post')) {
  $new_img_name = request('img_name');
  $new_img_src = 'img/'. request('img_src');
  $new_text_entry = request('text_entry');
  $new_headline = request('headline');


  if ($new_img_name === '') {
      $errors['img_name'] = 'Bitte geben Sie einen Bildnamen ein.';
  }

  if ($new_img_src === 'img/'.''){
    $errors['img_src'] = 'Bitte geben Sie einen Bildpfad an.';
  }

  if ($new_headline === '') {
    $errors['headline'] = 'Bitte geben Sie eine Überschrift.';
}  

  if ($new_text_entry === '') {
      $errors['text_entry'] = 'Bitte geben Sie einen Text an.';
  }  

    if (!$errors) {
        db_update('blog', $id,[
          'img_name' => $new_img_name,
          'img_src' => $new_img_src,
          'headline' => $new_headline,
          'text_entry' => $new_text_entry,
        ]);

        redirect('blog.php');
    }
}

db_disconnect();

include 'parts/head.php';
?>
</head>
<body>
  <div class="wrap">
    <?php 
    include 'parts/nav.php'; ?>
    <article class="content">
      <h2>Editieren: <?= e($blog_entries1['headline']) ?></h2>

      <?php  if ((auth_id() === 1)) : ?>
        <form action="<?= 'edit.php?id='.$id ?>" method="post">

        <?= error_for($errors, 'img_name') ?>
        <label for="img_name">Bildname eingeben: </label>
        <input type="text" name="img_name" id="img_name" value="<?= e($blog_entries1['img_name']) ?>"><br>
        
        <?= error_for($errors, 'img_src') ?>
        <label for="img_src">Bildpfad angeben: </label>
        <input type="text" name="img_src" id="img_src" value="<?= substr(e($blog_entries1['img_src']),4) ?>"><br>

        <?= error_for($errors, 'headline') ?>
        <label for="headline">Überschrift: </label>
        <input type="text"  id="headline" name="headline" value="<?= e($blog_entries1['headline']) ?>"></input><br>

        <?= error_for($errors, 'text_entry') ?>
        <label for="text_entry">Texteintrag: </label>
        <textarea id="text_entry" name="text_entry" rows="5" cols="30" ><?= e($blog_entries1['text_entry']) ?></textarea>

        <div class="form-group">
        <button type="submit">Änderungen speichern</button>
        <a href="<?= 'blog.php' ?>"><button type="button">Abbrechen</button></a>
        </div>
        </form>
      <?php endif; ?>
      </article>
  </div>  
</body>
</html>