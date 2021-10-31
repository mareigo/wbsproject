<?php 
  declare(strict_types=1);
  require 'bootstrap.php';

  $active_page = 'blog';
  include 'parts/head.php'; 

  $action = request('action');

  $sqlsearch = "SELECT * FROM `blog`";
  $blog_entries1 = db_raw_select($sqlsearch);
  

  $showlist = false;
  $no_entry_message = '';

  if ($blog_entries1 == NULL) {
    $no_entry_message = "Es gibt noch keine Einträge.";
  } else {
    $showlist = true;
  }


  if (request_is('post')) {

    if (!auth_user()) {
        redirect(BASE_URL.'auth/login.php');
    }

    if ($action === 'create') {
        $new_img_name = request('img_name');
        $new_img_src = 'img/' . request('img_src');
        $new_headline = request('headline');
        $new_text_entry = request('text_entry');

        if ($new_img_name === '') {
            $errors['img_name'] = 'Bitte geben Sie einen Bildnamen ein.';
        }

        if ($new_img_src === 'img/'.''){
          $errors['img_src'] = 'Bitte geben Sie einen Bildpfad an.';
        }

        if ($new_headline === ''){
          $errors['headline'] = 'Bitte geben Sie eine Überschrift ein.';
        }

        if ($new_text_entry === '') {
            $errors['text_entry'] = 'Bitte geben Sie einen Text an.';
        }

        if (!$errors) {
            db_insert('blog', [
                'img_name' => $new_img_name,
                'img_src' => $new_img_src,
                'headline' => $new_headline,
                'text_entry' => $new_text_entry, 
            ]);
            redirect('blog.php');  
        }
    }

    if ($action === 'delete' && (auth_id() === 1)) {
      $id = (int) request('id');

      $sql = "SELECT * FROM `blog` WHERE `id` = $id";
      $blog = db_raw_first($sql);

      db_delete('blog', $id);
    }
    redirect('blog.php');  
}

?>

</head>
<body>
  <div class="wrap">
    <?php 
    include 'parts/nav.php'; ?>
    <article class="content">
      <h2>Blog</h2>

      <?php  if ((auth_id() === 1)) : ?>
        <form action="<?= 'blog.php' ?>" method="post">

        <input type="text" name="old_img_name" id="old_img_name" value="<?= $old_img_name = request('img_name') ?>">

        <?= error_for($errors, 'img_name') ?>
        <label for="img_name">Bildname eingeben: </label>
        <input type="text" name="img_name" id="img_name" value="<?= $old_img_name ?>"><br>

        <input type="text" name="old_img_src" id="old_img_src" value="<?= $old_img_src = request('img_src') ?>">
        
        <?= error_for($errors, 'img_src') ?>
        <label for="img_src">Bildpfad angeben: </label>
        <input type="text" name="img_src" id="img_src" value="<?= $old_img_src ?>"><br>


        <input type="text" name="old_headline" id="old_headline" value="<?= $old_headline = request('headline') ?>">

        <?= error_for($errors, 'headline') ?>
        <label for="headline">Überschrift: </label>
        <input type="text"  id="headline" name="headline" value="<?= $old_headline ?>"></input><br>


        <input type="text" name="old_text_entry" id="old_text_entry" value="<?= $old_text_entry = request('text_entry') ?>">

        <?= error_for($errors, 'text_entry') ?>
        <label for="text_entry">Texteintrag: </label>
        <textarea id="text_entry" name="text_entry" rows="5" cols="30" value="<?= $old_text_entry ?>"></textarea>

        <button type="submit" name="action" id="new_entry_button" value="create">Eintrag erstellen</button>
        </form>
      <?php endif; ?>

      <div id="no_entry"><?= $no_entry_message ?></div>

      <?php if($showlist) : ?>
      <?php foreach ($blog_entries1 as $blog_entry) : ?>
        <div class="entry col100 mar"> 
          <img src="<?= e($blog_entry['img_src']) ?>" alt="<?= e($blog_entry['img_name']) ?>" class="blogimg">
          <h3><?= e($blog_entry['headline']) ?></h3>
          <p><?= e($blog_entry['text_entry']) ?></p>
          <span class="date"><?= ($blog_entry['created_at'])?></span>  
          <?php if($blog_entry['updated_at'] !== $blog_entry['created_at']) : ?> 
            <span class="updated"><?= 'Editiert: '. ($blog_entry['updated_at'])?></span>
          <?php endif; ?>
        </div>
        <?php  if ((auth_id() === 1)) : ?>
          <a href="<?= 'edit.php?id='.$blog_entry['id'] ?>"><button type="button">Editieren</button></a>
          <form action="<?= 'blog.php' ?>" method="post" style="display: inline-block; margin-bottom: 3px">
              <input type="hidden" name="id" value="<?= $blog_entry['id'] ?>">
              <button type="submit" name="action" value="delete">X</button> 
          </form>
        <?php endif; ?>
      <?php endforeach; ?>
      <?php endif; ?>  
    </article>
  </div>  
</body>
</html>