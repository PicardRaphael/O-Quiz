<?php $this->layout('layout', ['title' => 'Quiz']); ?>
<div class="container-fluide ml-3">
    
    <h1>
        <?= $quiz->getTitle(); ?>
        <span class="nbr-questions"><?= $nbrQuestion['nombre_questions']; ?> questions</span>
    </h1>
    <h3>
        <?= $quiz->getDescription(); ?>
    </h3>
    <p>by <?= $author->getFirst_name().' '.$author->getLast_name(); ?>
    </p>
</div>
<?php if (!$isConnected) : ?> 
<div class="container-fluide ml-3">
    <div class="row justify-content-between">
        
        <?php foreach ($questions as $value => $question):
        $questionsTb[] = $question->getProp1();
        $questionsTb[] = $question->getProp2();
        $questionsTb[] = $question->getProp3();
        $questionsTb[] = $question->getProp4();
        shuffle($questionsTb);

        ?>
        <div class="card bg-light col-sm-4">
            <div class="card-header">
            <p id="level" class="<?= $levelName[$question->getId_level()]; ?>"><?= $levelName[$question->getId_level()]; ?></p>
                <h5><?= $question->getQuestion(); ?></h5>
            </div>
            <div class="card-body">
                <ol>
                    <?php foreach ($questionsTb as $value => $reponse):
                        ?>
                        <li><?= $reponse; ?></li>
                    <?php 
                $questionsTb = [];
                endforeach; ?>
                </ol>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>
<?php else : ?>
<div id="answer" class="alert alert-primary fade show" role="alert">
    <span id="game">Nouveau jeux : Répondez au maximum de questions avant de valider :</span>
    <button id ="rejouer" style="display: none;">Rejouer</button>
</div>
<form id="form-quiz" method="post">
    <!-- Recup ID quiz -->
    <input id="idQuiz" type="hidden" name="id" class="inputCardId" value="<?= $quiz->getId(); ?>">

    <div class="container-fluide ml-3">
        <div class="row justify-content-between">
            
            <?php foreach ($questions as $valueQ => $question):
            $questionsTb[] = $question->getProp1();
            $questionsTb[] = $question->getProp2();
            $questionsTb[] = $question->getProp3();
            $questionsTb[] = $question->getProp4();
            shuffle($questionsTb);

            ?>
            <div id="<?= $question->getId(); ?>" class="card bg-light col-sm-4">
                <div class="card-header">
                    <p id="level" class="<?= $levelName[$question->getId_level()]; ?>"><?= $levelName[$question->getId_level()]; ?></p>
                    <h5><?= $question->getQuestion(); ?></h5>
                </div>
                <div class="card-body">
                        <?php foreach ($questionsTb as $value => $reponse):
                            ?>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input class="form-check-input" type="radio" name="question_<?=$question->getId(); ?>" value="<?=$reponse; ?>" id"<?=$reponse; ?>">
                                <?= $reponse; ?>
                            </label>
                        </div>
                        <?php 
                    $questionsTb = [];
                    endforeach; ?>
                </div>
                <div class="card-footer" style="display:none;"></div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
        <button type="submit" class="btn btn-block btn-primary">Valider</button>
</form>
<?php endif; ?>
