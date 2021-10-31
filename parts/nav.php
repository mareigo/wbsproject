<?php
    $active_page = $active_page ?? '';
    $active_page2 = $active_page2 ?? '';
?>
  <nav class="clearfix">
    <div id="logo"><a title="Zur Startseite" href="index.html"></a></div>
        <a href="#show" class="open" id="show"><span class="hamb">&#9776;</span></a>
        <a href="#" class="close" id="close"><span class="hamb">&#10006;</span></a>
        <ul class="show">
          <li class="<?= $active_page === 'index' ? 'active' : '' ?>"><a title="Zur Startseite" href="<?= 'index.php' ?>">Über mich</a></li>
          <li class="<?= $active_page === 'logodesign' ? 'active' : '' ?>"><a title="Zum Logodesign" href="<?= 'logodesign.php' ?>">Logodesign</a></li>
          <li class="<?= $active_page === 'layout' ? 'active' : '' ?>"><a id="a_layout" title="Zu den Layoutdesigns" href=" <?= 'layout.php' ?>">Layout</a>
            <ul>
              <li class="<?= $active_page2 === 'anzeige' ? 'active' : '' ?>"><a title="Zum Anzeige-Design" href="anzeige.php">Anzeige</a></li>
              <li class="<?= $active_page2 === 'magazin' ? 'active' : '' ?>"><a title="Zum Magazin-Design" href="magazin.php">Magazin</a></li>
              <li class="<?= $active_page2 === 'karte' ? 'active' : '' ?>"><a title="Zum Karten-Design" href="karte.php">Karte</a></li>
              <li class="<?= $active_page2 === 'banner' ? 'active' : '' ?>"><a title="Zum Web-Banner-Design" href="banner.php">Web-Banner</a></li>
              <li class="<?= $active_page2 === 'gutschein' ? 'active' : '' ?>"><a title="Zum Gutschein-Design" href="gutschein.php">Gutschein</a></li>
            </ul>
          </li>
          <li class="<?= $active_page === 'blog' ? 'active' : '' ?>"><a title="Zum Blog" href="<?= 'blog.php' ?>">Art Blog</a></li>
          <li class="<?= $active_page === 'kontakt' ? 'active' : '' ?>"><a title="Nehmen Sie Kontakt auf" href="<?= 'kontakt.php' ?>">Kontakt</a></li>
          <li class="<?= $active_page === 'impressum' ? 'active' : '' ?>"><a title="Zum Impressum" href="<?= 'impressum.php' ?>">Impressum</a></li>
          <li class="<?= $active_page === 'login' ? 'active' : '' ?>"><a title="Zum Login" href="<?= 'login.php' ?>">Login</a></li>
        </ul>
  </nav>