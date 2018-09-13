var app = {
  init: function () {
    console.log('init');

    //J'écoute l'evt submit sur mon formulaire signup
    $('#form-signup').on('submit', app.signup);

    //J'écoute l'evt submit sur mon formulaire login
    $('#form-login').on('submit', app.signin);

    //J'évout l'evt submit sur mon formulaire quizz
    $('#form-quiz').on('submit', app.quiz);
   
    //J'écoute l'evt click sur mon bouton rejouer
    $('#rejouer').on('click', app.replay);
  },
  /* ---Inscription--- */
  signup: function (evt) {
    console.log('submit Signup');
    evt.preventDefault();
  
    var dataToSend = $(this).serialize();
    $.ajax({
      url: BASE_URL+'/signup',
      method: 'POST',
      datatype: 'json',
      data: dataToSend
    }).done(function (response) {
      console.log(response);
      if (response.code == 0) {
        window.location.replace(response.url);
      }else{
          $('#error-message').removeClass('d-none').prepend(response.errorMsg);
      }
    }).fail(function () {
      alert('Une erreur est survenue...');
    });
  },
  /* ---Login--- */
  signin: function(evt) {
    console.log('loginform soumis');
    // Réflexe, je commence par annuler le comportement par défaut de l'évènement
    evt.preventDefault();
    
    
    // Je récupère les données à envoyer, déjà formatées
    // "dataToSend" est au format "Query String"
    var dataToSend = $(this).serialize();
    

    // Je cache la div contenant les alertes
    $('#alerts').hide();
    
    // Appel ajax
    $.ajax({
      url: BASE_URL+'/signin',
      method: 'POST',
      dataType: 'json',
      data: dataToSend
    }).done(function(response) {
      console.log(response);
      
      // Si ok => je redirige
      if (response.code == 1) {
        
        // Je change ma div alert en mode "succès"
        $('#alerts').removeClass('alert-danger').addClass('alert-success').html('Connexion réussie').show();
        
        // Je redirige après 2 secondes
        window.setTimeout(function() {
          location.href = response.redirect+'?first_name='+response.first_name;
        }, 2000);
      }
      // Sinon, il y a une erreur => affichage des erreurs
      else {
        // Je cible la div des alertes
        var $alertsDiv = $('#alerts');
        // Je change le contenu HTML par la liste des erreurs retournées
        $alertsDiv.empty();
        // foreach made in jQuery (ressemble au foreach de PHP)
        $.each(response.errors, function(index, value) {
          $alertsDiv.append(value+'<br>');
        });
        // J'affiche les alertes
        $alertsDiv.show();
      }
    }).fail(function() {
      alert('Ajax failed');
    });
  },
  /* ---Quiz--- */
  quiz: function (evt) {
    console.log('submit quiz');
    evt.preventDefault();
  
    var dataToSend = $(this).serialize();
    var idQuiz = $('#idQuiz').val();
    
    $.ajax({
      url: BASE_URL+'/quiz/'+idQuiz,
      method: 'POST',
      datatype: 'json',
      data: dataToSend
    }).done(function (response) {

      if (response.code == 1) {
        var $answerDiv = $('#answer');
        $('#game').hide();
        $answerDiv.removeClass('alert-primary').addClass('alert-success');
        $answerDiv.prepend('<p>Votre score: '+response.nbrAnswers.goodAnswers+' / 10 </p>');
        $('#rejouer').show();
        $url = "https://fr.wikipedia.org/wiki/Wikipédia:";
        
        $.each(response.resultat, function(index, value){
          
          console.log(response);
          if(value.resultat === 'Bonne reponse'){
            $('#'+value.question).children('.card-header').addClass('alert alert-success');
            $('#'+value.question).children('.card-footer').show().html('<p>'+value.anecdote+'</p><br><a href="'+$url+value.wikipedia+'">'+value.wikipedia+'</a');
            
          }else if(value.resultat === 'Mauvaise reponse'){
            $('#'+value.question).children('.card-header').addClass('alert alert-danger');
            $('#'+value.question).children('.card-footer').show().html('<p>'+value.anecdote+'</p><br><a href="'+$url+value.wikipedia+'">'+value.wikipedia+'</a');
          }
        });
      }
    }).fail(function () {
      alert('Une erreur est survenue...');
    });
  },
  replay: function(){
    console.log('rejouer');
    window.location.reload();
  }
};

$(app.init);