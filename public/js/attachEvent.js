// Pour que cliquer sur la div dans laquelle se trouve l'input active l'input
function attachEventListeners() {
    // Sélection toutes les div avec la classe .radio
    var radios = document.querySelectorAll('.radio');

    // Parcour chaque div .radio
    radios.forEach(function(radio) {
        // Ajoute d'événement de clic à chaque div .radio
        radio.addEventListener('click', function() {
            // Sélection de l'input associé
            var input = this.querySelector('input[type="radio"]');
            // Vérifie si l'input existe
            if (input) {
                // déclenche le clic sur l'input
                input.click();
            }
        });
    });
}

attachEventListeners();

