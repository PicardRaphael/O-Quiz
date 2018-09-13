<?php $this->layout('layout', ['title' => 'Home-Accueil']); ?>
<div class="container-fluide ml-3">
      <h1>Bienvenue sur O'Quiz</h1>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
</div>
<div class="container-fluide ml-3">
    <div class="row justify-content-between">
        <?php foreach ($quizzesList as $quiz): ?>
        <div class="col-4 quiz">
          <h3><a href="<?= $router->generate('quiz_quiz', ['id' => $quiz->getId()]); ?>"><?= $quiz->getTitle(); ?></a></h3>
            <h5><?= $quiz->getDescription(); ?></h5>
            <p>by <?= $userFirstName[$quiz->getId_author()].' '.$userLastName[$quiz->getId_author()]; ?></p>
        </div>
        <?php endforeach; ?>
    </div>
</div>