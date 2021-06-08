<nav class="navbar fixed-top navbar-expand-sm bg-light">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="nav nav-pills nav-fill">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
      </li>
      [menu]      
    </ul>
    <ul class="nav navbar-nav ml-auto">
	  <li><a class="nav-link" href="<?=hlien("database","creer")?>">Créer BDD</a></li>
	  <li><a class="nav-link" href='<?=hlien("database","dataset")?>'>Jeu de données</a></li>
	  <li><a class="nav-link" href="<?=hlien("authentification","deconnexion")?>">Déconnexion</a></li>
	  <li><a class="nav-link" href='<?=hlien("authentification","connexion")?>'>Connexion</a></li>
    </ul>
  </div>
</nav>