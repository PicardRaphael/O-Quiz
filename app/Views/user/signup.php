<?php $this->layout('layout', ['title' => 'Inscription']); ?>
<form id="form-signup" action="" method="post" class="col-12 col-md-6 offset-md-3">

      <h1>Inscription</h1>

      <div id="error-message" class="alert alert-danger alert-dismissible fade show d-none" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
            </button>
      </div>
      <div class="form-group">
            <label for="username">Nom *</label>
            <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Nom" value="<?= $fieldValues['first_name']; ?>" required>
      </div>
      <div class="form-group">
            <label for="presentation">Prénom *</label>
            <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Prénom" value="<?= $fieldValues['last_name']; ?>" required>
      </div>
      <div class="form-group">
            <label for="email">Email *</label>
            <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Adresse email" value="<?= $fieldValues['email']; ?>" required>
            <small id="emailHelp" class="form-text text-muted">votre adresse email restera secrète. Elle ne sera rendue publique qu'aux inscrits à un évènement dont vous seriez l'organisateur</small>
      </div>
      <div class="form-group">
            <label for="password">Mot de passe *</label>
            <input type="password" class="form-control" id="password" name="password" aria-describedby="passwordHelp" placeholder="Choisissez votre mot de passe" required>
            <small id="passwordHelp" class="form-text text-muted">8 caractères minimum, et avec au moins une lettre et un chiffre</small>
      </div>
      <div class="form-group">
            <label for="password2">Confirmation *</label>
            <input type="password" class="form-control" id="password2" name="password2" placeholder="Confirmation du mot de passe" required>
      </div>

      <div class="form-group">
            <small class="form-text text-muted">* champs obligatoires</small>
      </div>
      <button type="submit" class="btn btn-block btn-primary">Valider</button>
</form>
<br>
