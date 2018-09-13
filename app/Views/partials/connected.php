<header class="ml-3">
  <nav class="navbar navbar-expand-lg navbar-light">
    <a id='oquiz' class="navbar-brand" href="<?= $router->generate('main_home'); ?>">O'Quiz</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
      aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <ul class="navbar-nav menu">
        <li class="nav-item menu-li">
          <a class="nav-link" href="<?= $router->generate('main_home'); ?>">Bonjour 
            <?= $connectedUser->getFirst_name(); ?>
          </a>
        </li>
        <li class="nav-item menu-li">
          <a class="nav-link" href="<?= $router->generate('main_home'); ?>">
            <i class="fas fa-home"></i>&nbsp;Accueil</a>
        </li>
        <li class="nav-item menu-li">
          <a class="nav-link" href="<?= $router->generate('user_profil'); ?>">
            <i class="fas fa-user"></i>&nbsp;Mon compte</a>
        </li>
        <li class="nav-item menu-li">
          <a class="nav-link" href="<?= $router->generate('user_logout'); ?>">
            <i class="fas fa-user"></i>&nbsp;Déconnexion</a>
        </li>
      </ul>
    </div>
  </nav>
</header>