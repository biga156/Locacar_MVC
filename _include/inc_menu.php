<nav class="navbar fixed-top navbar-expand-sm bg-light">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="nav nav-pills nav-fill">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
      </li>

      <?php if (isset($_SESSION["uti_id"])) {
        if ($_SESSION["profil"] == 1) {  ?>
          <li><a class='nav-link' href='<?= hlien("agence", "index") ?>'>Agence</a></li>
          <li><a class='nav-link' href='<?= hlien("vehicule", "index") ?>'>Vehicule</a></li>
          <li><a class='nav-link' href='<?= hlien("utilisateur", "index") ?>'>Utilisateur</a></li>
          <li><a class='nav-link' href='<?= hlien("locations", "index") ?>'>Locations</a></li>
          <li><a class='nav-link' href='<?= hlien("categorie", "index") ?>'>Categorie</a></li>
          <li><a class='nav-link' href='<?= hlien("options", "index") ?>'>Options</a></li>
          <li><a class='nav-link' href='<?= hlien("profil", "index") ?>'>Profil</a></li>
          <li><a class='nav-link' href='<?= hlien("definir", "index") ?>'>Definir</a></li>
          <li><a class='nav-link' href='<?= hlien("equiper", "index") ?>'>Equiper</a></li>
          <li><a class='nav-link' href='<?= hlien("plage_horaire", "index") ?>'>Plage_horaire</a></li>
          <li><a class='nav-link' href='<?= hlien("departement", "index") ?>'>Departement</a></li>
          <li><a class='nav-link' href='<?= hlien("statistique", "index") ?>'>Statistique</a></li>
        <?php } else if ($_SESSION["profil"] == 2) { ?>
          <li><a class='nav-link' href='<?= hlien("agence", "index") ?>'>Agence</a></li>
          <li><a class='nav-link' href='<?= hlien("departement", "index") ?>'>Departement</a></li>
          <li><a class='nav-link' href='<?= hlien("locations", "index") ?>'>Locations</a></li>
          <li><a class='nav-link' href='<?= hlien("utilisateur", "index") ?>'>Utilisateur</a></li>
          <li><a class='nav-link' href='<?= hlien("statistique", "index") ?>'>Statistique</a></li>
        <?php } else if ($_SESSION["profil"] == 3) { ?>
          <li><a class='nav-link' href='<?= hlien("utilisateur", "index") ?>'>Utilisateur</a></li>
          <li><a class='nav-link' href='<?= hlien("vehicule", "index") ?>'>Vehicule</a></li>
          <li><a class='nav-link' href='<?= hlien("locations", "index") ?>'>Locations</a></li>
        <?php } else { ?>
          <li><a class='nav-link' href='<?= hlien("locations", "index") ?>'>Locations</a></li>
        <?php }
      } else { ?>
        <a>
          <a class="btn btn-primary" href="<?= hlien("inscription", "edit", "id", 0) ?>">Créer un compte</a>
        </a>
      <?php
      } ?>
    </ul>

    <ul class="nav navbar-nav ml-auto">
      <?php if (isset($_SESSION["uti_id"])) { ?>
        <li><a class='nav-link' href='<?= hlien("utilisateur", "edit", "id", $_SESSION['uti_id']) ?>'>Mon profil</a></li>
        <li><a class="nav-link" href=""><?= $_SESSION["utilisateur"] . "-" ?>&nbsp;<span class="badge badge-info">[<?= $_SESSION["profil_name"] ?>]</span></a></li>
      <?php } ?>
     <!--<li><a class="nav-link" href="<?= hlien("database", "creer") ?>">Créer BDD</a></li>
      <li><a class="nav-link" href='<?= hlien("database", "dataset") ?>'>Jeu de données</a></li> -->
      <?php if (isset($_SESSION["uti_id"])) { ?>
        <li><a class="nav-link" href="<?= hlien("authentification", "deconnexion") ?>">Déconnexion</a></li>
      <?php } else { ?>
        <li><a class="nav-link" href='<?= hlien("authentification", "connexion") ?>'>Connexion</a></li>
      <?php } ?>
    </ul>
  </div>
</nav>
