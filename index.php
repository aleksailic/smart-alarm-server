<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
  <title>SMART ALARM</title>

  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
<body>
  <a href="https://github.com/aleksailic"><img style="position: absolute; top: 0; left: 0; border: 0; z-index:5;" src="https://camo.githubusercontent.com/82b228a3648bf44fc1163ef44c62fcc60081495e/68747470733a2f2f73332e616d617a6f6e6177732e636f6d2f6769746875622f726962626f6e732f666f726b6d655f6c6566745f7265645f6161303030302e706e67" alt="Fork me on GitHub" data-canonical-src="https://s3.amazonaws.com/github/ribbons/forkme_left_red_aa0000.png"></a>
  <nav class="white" role="navigation">
    <div class="nav-wrapper container">
      <a id="logo-container" href="#" class="brand-logo"><img src="img/logo.png"</a>
      <ul class="right hide-on-med-and-down">
        <li><a href="login.php">Login</a></li>
        <li><a href="#">Help</a></li>
      </ul>

      <ul id="nav-mobile" class="side-nav">
        <li><a href="login.php">Login</a></li>
        <li><a href="#">Help</a></li>
      </ul>
      <a style="float:right;" href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
    </div>
  </nav>

  <div id="index-banner" class="parallax-container">
    <div class="section no-pad-bot">
      <div class="container">
        <br><br>
        <h1 class="header center red-text text-lighten-1">Smart Alarm</h1>
        <div class="row center">
          <h5 class="header col s12 light">Sistem za monitoring zvuka</h5>
        </div>
        <div class="row center">
          <a href="rad.pdf" id="download-button" class="btn-large waves-effect waves-light red lighten-1">Preuzmi rad</a>
        </div>
        <br><br>

      </div>
    </div>
    <div class="parallax"><img src="img/background1.png" alt="Unsplashed background img 1"></div>
  </div>


  <div class="container">
    <div class="section">
      <div class="row">
        <div class="col s12">
          <h4 class="center">O uređaju</h4>
          <p class="light">SmartAlarm jeste uređaj koji vrši monitoring zvuka i na osnovu analize trajanja njegove jačine, donosi odluku o promeni stanja, nakon čega preko servisa PushBullet obaveštava korisnika putem notifikacije na mobilnom telefonu ili desktop računaru. Ukoliko korisnik ne želi da koristi ovaj servis (za koji je neophodna besplatna apikacija), njemu će umesto notifikacije biti prosleđen mail. Uređaj je povezan sa centralnim web serverom koji pruža korisniku, kako direktnu kontrolu nad njim, tako i mogućnost analize poruka koje on odašilje. Svaki uređaj poseduje jedinstveni serijski broj, pa jedan korisnik može da poseduje više uređaja i da ih nesmetano koristi.
          <p class="light">Ovaj rad je osvojio drugu nagradu u kategoriji radova sa najboljom prakticnom realizacijom na 8. međunarodnoj IEEESTEC konferenciji održanoj novembra 2015. godine u Nišu. <a href="http://ieee.elfak.ni.ac.rs/">Link</a>
        </div>
      </div>
      <!--   Icon Section   -->
      <div class="row">
        <h4 class="center">Princip rada</h4>
        <div class="col s12 m4">
          <div class="icon-block">
            <h2 class="center brown-text"><img src="img/server.jpg" height="70"></h2>
            <h5 class="center">Server</h5>

            <p class="light">Centralni web server, napisan u PHP-u i povezan sa MySQL bazom podataka nudi svojevrstan API alarmu koji mu pristupa dok korisniku omogućava kontrolu nad SmartAlarmom preko administratorskog panela.</p>
          </div>
        </div>

        <div class="col s12 m4">
          <div class="icon-block">
            <h2 class="center brown-text"><img src="img/dashboard.jpg" height="70"></h2>
            <h5 class="center">Admin panel</h5>

            <p class="light">Administratorski panel pruža korisniku direktan uvid u stanje uređaja u realnom vremenu, a pritom mu omogućava da njime i upravlja. Izrađen u stilu Google-ovog <a class="astrip" href="https://www.google.com/design/spec/material-design/introduction.html">Material</a> dizajna, pruža fluidan interfejs na svim platformama.</p>
          </div>
        </div>

        <div class="col s12 m4">
          <div class="icon-block">
            <h2 class="center brown-text"><img src="img/client.jpg" height="70"></h2>
            <h5 class="center">SmartAlarm Klijent</h5>

            <p class="light">Kada SmartAlarm zaključi da je nivo zvuka kontinuirano viši od prosleđenog parametra, prosleđuje tu informaciju serveru i servisu <a class="astrip" href="http://www.pushbullet.com">PushBullet</a>, koji potom istu prosleđuje u vidu notifikacije ili putem elektronske pošte svim korisnicima.</p>
          </div>
        </div>
      </div>

    </div>
  </div>


  <div class="parallax-container valign-wrapper" >
    <div class="section no-pad-bot">
      <div class="container">
        <div class="row center">
          <h5 class="header col s12 dark">8th IEEESTEC Conference</h5>
        </div>
      </div>
    </div>
    <div  class="parallax"><img class="responsive-img" src="img\konferencija\P1160390.jpg" alt="Unsplashed background img 2"></div>
  </div>

  <div class="container">
      <div class="section">
        <div class="row">
          <div class="col s12 center">
            <br><h4>Slike sa konferencije</h4><br>
          </div>
        </div>
        <div class="row">
          <div class="col s12 center">
             <div class="row">
               <div style="padding: 8px 8px 0" class="col s12 m6 l4"><img class="responsive-img" src="img\konferencija\ASC_2821.jpg"></div>
               <div style="padding: 8px 8px 0" class="col s12 m6 l4"><img class="responsive-img" src="img\konferencija\ASC_2866.jpg"></div>
               <div style="padding: 8px 8px 0" class="col s12 m6 l4"><img class="responsive-img" src="img\konferencija\ASC_2825.jpg"></div>
               <div style="padding: 8px 8px 0" class="col s12 m6 l4"><img class="responsive-img" src="img\konferencija\ASC_3052.jpg"></div>
               <div style="padding: 8px 8px 0" class="col s12 m6 l4"><img class="responsive-img" src="img\konferencija\ASC_3053.jpg"></div>
               <div style="padding: 8px 8px 0" class="col s12 m6 l4"><img class="responsive-img" src="img\konferencija\ASC_2906.jpg"></div>
             </div>
                       
          </div>
        </div>

      </div>
    </div>

  <footer class="page-footer teal">
    <div class="footer-copyright">
      <div class="container">
      ©2015 <a class="brown-text text-lighten-3" href="http://aleksa.think.in.rs">Aleksa Ilić</a>. Posetite moju web prezentaciju klikom na moje ime ukoliko želite da se informišete o mom dosadašnjem radu.
      </div>
    </div>
  </footer>


  <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="js/materialize.js"></script>
  <script src="js/init.js"></script>

  </body>
</html>
