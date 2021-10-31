<?php 
  declare(strict_types=1);
  require 'bootstrap.php';

  $active_page = 'index';
  include 'parts/head.php'; 
?>
</head>
<body>
  <div class="wrap">
    <?php 
    include 'parts/nav.php'; ?>
    <div class="content">
      <article class="content_text clearfix">
        <img src="img/mareike_foto.jpg" alt="Mareike Damm Foto" id="mareike_foto" class="col33 mar fl-l">
        <div class="col66 fl-l">
          <h2>Über mich</h2>
          <p>Mein Name ist Mareike Damm, Grafikdesignerin und Web-Entwicklerin.</p>
          <p>Er hörte leise Schritte hinter sich. Das bedeutete nichts Gutes. Wer würde ihm schon folgen, spät in der Nacht und dazu noch in dieser engen Gasse mitten im übel beleumundeten Hafenviertel? Gerade jetzt, wo er das Ding seines Lebens gedreht hatte und mit der Beute verschwinden wollte!<br> 
          <p>Hatte einer seiner zahllosen Kollegen dieselbe Idee gehabt, ihn beobachtet und abgewartet, um ihn nun um die Früchte seiner Arbeit zu erleichtern? </p>
          <p>Er konnte die Aufforderung stehen zu bleiben schon hören. Gehetzt sah er sich um. Plötzlich erblickte er den schmalen Durchgang. Blitzartig drehte er sich nach rechts und verschwand zwischen den beiden Gebäuden.</p> 
        </div>  
        <?php  if (auth_user()) : ?>
          <div class="col100 clear">
            <h2>Lebenslauf</h2>
            <p>Hier ist mein sehr toller Lebenslauf.</p>
            <p>Er hörte leise Schritte hinter sich. Das bedeutete nichts Gutes. Wer würde ihm schon folgen, spät in der Nacht und dazu noch in dieser engen Gasse mitten im übel beleumundeten Hafenviertel? Gerade jetzt, wo er das Ding seines Lebens gedreht hatte und mit der Beute verschwinden wollte!<br> 
            Hatte einer seiner zahllosen Kollegen dieselbe Idee gehabt, ihn beobachtet und abgewartet, um ihn nun um die Früchte seiner Arbeit zu erleichtern? Oder gehörten die Schritte hinter ihm zu einem der unzähligen Gesetzeshüter dieser Stadt, und die stählerne Acht um seine Handgelenke würde gleich zuschnappen? </p>
            <p>Er konnte die Aufforderung stehen zu bleiben schon hören. Gehetzt sah er sich um. Plötzlich erblickte er den schmalen Durchgang. Blitzartig drehte er sich nach rechts und verschwand zwischen den beiden Gebäuden.<br> 
            Beinahe wäre er dabei über den umgestürzten Mülleimer gefallen, der mitten im Weg lag. Er versuchte, sich in der Dunkelheit seinen Weg zu ertasten und erstarrte: Anscheinend gab es keinen anderen Ausweg aus diesem kleinen Hof als den Durchgang, durch den er gekommen war. </p> 
          </div>
        <?php endif; ?>
      </article>
    </div>
  </div>  
</body>
</html>