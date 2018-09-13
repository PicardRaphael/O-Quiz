<form id="form-signup" action="" method="post">
    <div class="container-fluide ml-3">
        <div class="row justify-content-between">
            
            <?php foreach ($questions as $value => $question):
            $questionsTb[] = $question->getProp1();
            $questionsTb[] = $question->getProp2();
            $questionsTb[] = $question->getProp3();
            $questionsTb[] = $question->getProp4();
            shuffle($questionsTb);

            ?>
            <div class="card card-body bg-light col-sm-4">
            <p><?= $levelName[$question->getId_level()]; ?></p>
                <h5><?= $question->getQuestion(); ?></h5>
                <form>
                    <?php foreach ($questionsTb as $value => $reponse):
                        ?>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" name="reponse" value="<?=$reponse; ?>" id"<?=$reponse; ?>">
                            <?= $reponse; ?>
                        </label>
                    </div>
                    <?php 
                $questionsTb = [];
                endforeach; ?>
                </form>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
        <button type="submit" class="btn btn-block btn-primary">Valider</button>
</form>