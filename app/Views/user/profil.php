<?php $this->layout('layout', ['title' => 'Profil']);
?>
<div class="container-fluide ml-3">
<div class="row justify-content-between">
    <?php foreach ($quizList as $quiz): ?>
    <div class="col-4 quiz">
      <h3><a href="<?= $router->generate('quiz_quiz', ['id' => $quiz->getId()]); ?>"><?= $quiz->getTitle(); ?></a></h3>
        <h5><?= $quiz->getDescription(); ?></h5>
    </div>
    <?php endforeach; ?>
</div>
</div>
