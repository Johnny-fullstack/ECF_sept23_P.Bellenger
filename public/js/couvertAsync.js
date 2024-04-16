// nombres de couvert sélectionné
var unePers = document.getElementById('1pers')
var deuxPers = document.getElementById('2pers')
var troisPers = document.getElementById('3pers')
var quatrePers = document.getElementById('4pers')
var cinqPers = document.getElementById('5pers')
var sixPers = document.getElementById('6pers')

// date 
var date = document.getElementById('date_resa')

//déjeuner ou diner
var dej = document.getElementById('dej')
var diner = document.getElementById('diner')
var heure = document.getElementById('heures')

// Écouteurs d'événements pour les éléments de sélection des couverts
unePers.addEventListener('change', verifierEtExecuter);
deuxPers.addEventListener('change', verifierEtExecuter);
troisPers.addEventListener('change', verifierEtExecuter);
quatrePers.addEventListener('change', verifierEtExecuter);
cinqPers.addEventListener('change', verifierEtExecuter);
sixPers.addEventListener('change', verifierEtExecuter);

// Écouteurs d'événement pour la date
date.addEventListener('input', verifierEtExecuter)

// Écouteurs d'événements pour les boutons de sélection du repas
dej.addEventListener('change', verifierEtExecuter);
diner.addEventListener('change', verifierEtExecuter);

// Fonction pour vérifier si les deux critères sont remplis et exécuter la fonction asynchrone
function verifierEtExecuter() {
    
    var dateAsync = date.value;

    // Vérifie si à la fois la période de la journée et le nombre de couverts sont sélectionnés
    if ((dej.checked || diner.checked) && (unePers.checked || deuxPers.checked || troisPers.checked || quatrePers.checked || cinqPers.checked || sixPers.checked) && dateAsync) {
        
        // Déterminer la période de la journée sélectionnée
        let periode = dej.checked ? 'dej' : 'diner';

        // Déterminer le nombre de couverts sélectionné
        let nbCouverts = unePers.checked ? 1 :
                         deuxPers.checked ? 2 :
                         troisPers.checked ? 3 :
                         quatrePers.checked ? 4 :
                         cinqPers.checked ? 5 :
                         sixPers.checked ? 6 : 0;

        couvertsRestant(dateAsync, periode, nbCouverts); // Exécuter la fonction asynchrone
    }
}

//fonction async vérifiant le nombre de couvert restant 
async function couvertsRestant(date, periode, nbCouverts) {
    try {
        //valeurs à anvoyer dans la requête async
        const valeurs = {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json'
            },
            body: JSON.stringify({ param1: date, param2: periode, param3: nbCouverts })
          };

        //envoi de la requête async à l'url indiqué avec valeurs
        const response = await fetch('../../src/couvertAsync.php', valeurs);

        //si response ne renvoi rien
        if (!response.ok) {
            throw new Error('Erreur lors de la récupération des données');
        }
        //extraction de la resposne json de response
        const data = await response.json();

        if(data == 0) {
            document.getElementById('places_restantes').innerHTML = "Nous sommes désolé, il n'y a plus de place pour ces horaires. Essayez un autre jour ou une autre période de la journée."
        } else if(data - nbCouverts >= 0) {
            //affichage du nombre de couvert restant
            document.getElementById('places_restantes').innerHTML = "il reste " + data + " couverts pour ces horaires";
            affichHeure();
        } else if(data - nbCouverts < 0) {
            document.getElementById('places_restantes').innerHTML = "Nous sommes désolé, il semble que nous n'avons plus assez de place pour le nombre de couverts demandé. Essayez un autre jour ou une autre période de la journée.";
            viderContenu()
        }
    } catch (error) {
        //erreur de try
        console.error('Une erreur est survenue :', error);
    }
  }

function affichHeure() {
    if(dej.checked) {                          
        heure.innerHTML = 
        '<div class="radio"><input type="radio" id="11h30" name="heure_dej" value="11h30"><label for="11h30">11h30</label></div> <div class="radio"><input type="radio" id="11h45" name="heure_dej" value="11h45"><label for="11h45">11h45</label></div>  <div class="radio"><input type="radio" id="12h00" name="heure_dej" value="12h00"><label for="12h00">12h00</label></div>  <div class="radio"><input type="radio" id="12h15" name="heure_dej" value="12h15"><label for="12h15">12h15</label></div> <div class="radio"><input type="radio" id="12h30" name="heure_dej" value="12h30"><label for="12h30">12h30</label></div> <div class="radio"><input type="radio" id="12h45" name="heure_dej" value="12h45"><label for="12h45">12h45</label></div> <div class="radio"><input type="radio" id="13h00" name="heure_dej" value="13h00"><label for="13h00">13h00</label></div> <div class="radio"> <input type="radio" id="13h15" name="heure_dej" value="13h15"><label for="13h15">13h15</label></div> <div class="radio"><input type="radio" id="13h30" name="heure_dej" value="13h30"><label for="13h30">13h30</label></div>';
        heure.classList.add('active');
        } else if(diner.checked) {  
        heure.innerHTML = 
        '<div class="radio"><input type="radio" id="19h30" name="heure_diner" value="19h30"><label for="19h30">19h30</label></div> <div class="radio"><input type="radio" id="19h45" name="heure_diner" value="19h45"><label for="19h45">19h45</label></div> <div class="radio"><input type="radio" id="20h00" name="heure_diner" value="20h00"><label for="20h00">20h00</label></div> <div class="radio"><input type="radio" id="20h15" name="heure_diner" value="20h15"><label for="20h15">20h15</label></div> <div class="radio"><input type="radio" id="20h30" name="heure_diner" value="20h30"><label for="20h30">20h30</label></div> <div class="radio"><input type="radio" id="20h45" name="heure_diner" value="20h45"><label for="20h45">20h45</label></div> <div class="radio"><input type="radio" id="21h00" name="heure_diner" value="21h00"><label for="21h00">21h00</label></div> <div class="radio"><input type="radio" id="21h15" name="heure_diner" value="21h15"><label for="21h15">21h15</label></div> <div class="radio"><input type="radio" id="21h30" name="heure_diner" value="21h30"><label for="21h30">21h30</label></div> ';
        heure.classList.add('active');    
        }
}

function viderContenu() {
    heure.innerHTML = '';
}