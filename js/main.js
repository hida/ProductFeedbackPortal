// Fonction pour afficher un message d'alerte
function showAlert(message) {
    alert(message);
  }
  
  // Fonction pour valider le formulaire d'ajout de commentaire
  function validateCommentForm() {
    var contenu = document.getElementById('contenu').value;
  
    if (contenu.trim() === '') {
      showAlert('Veuillez saisir un commentaire.');
      return false;
    }
  
    return true;
  }
  