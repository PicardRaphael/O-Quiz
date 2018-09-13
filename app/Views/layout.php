<!doctype html>
<html lang="fr">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <title>
            <?= $this->e($title); ?>
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- font-awesome -->    
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/solid.css">
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/fontawesome.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B"
        crossorigin="anonymous">

    <link rel="stylesheet" href="<?= $baseURL; ?>/assets/css/style.css">
    <script>
            // Astuce de sioux
            var BASE_URL = "<?= $baseURL; ?>";
            // !!! je viens de transmettre une donnée PHP à JS
            // => maintenant je peux utiliser cette variable dans mon fichier app.js pour les appels Ajax
    </script>
</head>

<body>
    
    <!-- Header -->
    <?php 
      if ($isConnected) {
          $this->insert('partials/connected');
      } else {
          $this->insert('partials/header');
      }?>

    <main>
        <?= $this->section('content'); ?>
    </main>

    <!-- Footer -->
    <?php $this->insert('partials/footer'); ?>

      <!-- Optional JavaScript -->
      <!-- jQuery first, then Popper.js, then Bootstrap JS -->
      <script src="https://code.jquery.com/jquery-3.3.1.min.js" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>

      <!-- Ajout de mon fichier jQueryUI -->
      <script type="text/javascript" src="<?= $baseURL; ?>/assets/js/jquery-ui.min.js"></script>

      <!-- Ajout de mon fichier de JS -->
      <script type="text/javascript" src="<?= $baseURL; ?>/assets/js/app.js"></script>
</body>

</html>