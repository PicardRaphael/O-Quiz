<?php $this->layout('layout', ['title' => 'Connexion']); ?>
<form id="form-login" action="" method="post" class="col-12 col-md-6 offset-md-3">
      <h1>Connexion</h1>

      <div id="alerts" class="alert alert-danger alert-dismissible fade show" role="alert" style="display:none;">

            <div></div>

            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
            </button>
      </div>

      <div class="form-group">
            <label for="email">Email *</label>
            <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Adresse email" required>
      </div>
      <div class="form-group">
            <label for="password">Mot de passe *</label>
            <input type="password" class="form-control" id="password" name="password" aria-describedby="passwordHelp" placeholder="Choisissez votre mot de passe" required>
      </div>
      <div class="form-group">
            <small class="form-text text-muted">* champs obligatoires</small>
      </div>
      <button class="btn btn-block btn-primary">Valider</button>
</form>
<br>
