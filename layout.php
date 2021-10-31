<?php 
  $active_page = 'layout';
  include 'parts/head.php'; 
?>
</head>
<body>
  <div class="wrap">
    <?php 
    include 'parts/nav.php'; ?>
    <article class="content">
      <h2>Layout</h2>
      <ul id="unterseite_auswahl" class="clearfix">
        <li>
          <a title="Zum Anzeige-Design" href="anzeige.php">Anzeige<img src="img/maretimus_anzeige.jpg" alt="Maretimus Anzeige"></a>
        </li>
        <li>
          <a title="Zum Magazin-Design" href="magazin.php">Magazin<img src="img/erlebnisbahn_1.jpg" alt="Magazin Erlebnisbahn Seite 1"></a>
        </li>
        <li>
          <a title="Zum Karten-Design" href="karte.php">Karte<img src="img/ingame_karte_1.png" alt="Ingame Weihnachtskarte Seite 1" id="img_card"></a>
        </li>
        <li>
          <a title="Zum Web-Banner-Design" href="banner.php">Web-Banner<img src="img/treuerabatt_banner.jpg" alt="all4golf Treuerabatt Banner" id="img_banner"></a>
        </li>
        <li>
          <a title="Zum Gutschein-Design" href="gutschein.php">Gutschein<img src="img/travelcover_gutschein.png" alt="all4golf Travelcover Gutschein"></a>
        </li>
     </ul>
    </article>
  </div>  
</body>