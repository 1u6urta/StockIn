<?php
    session_start();
    include 'assets/compos/database.php';
    include 'assets/compos/header.php';
    if ( ! isset($_SESSION['id'])) {
        header("Location: index.php");
        exit();
    }
    $id = $_SESSION["id"];
    $sql = "SELECT * FROM client WHERE id_client='$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
?>

<div class="container">
        <div class="row">
            <div class="col-12">
                <div class="presentation-title text-center">
                    <h3>Bienvenue  <span class="title-voyager"><?php echo $row["nom_client"]?></span></h3>
                </div>
            </div>
        </div>
        <table class="table ">
    <thead>
        <tr>
            <th>Image</th>
            <th>Produit</th>
            <th>Libelle</th>
            <th>Prix</th>
            <th></th>
        </tr>
    </thead>
    <tbody id="panier">
    </tbody>
</table>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="text-center mt-5 mb-5">
                    <a href="" class="btn btnop text-uppercase btn-afficher" id="envoyerDonnees">commande<i class="fas fa-angle-right ml-2"></i></a>
                </div>
            </div>
</div>




<script>
var panierRecupereJSON = localStorage.getItem('panier');
var panierRecupere = JSON.parse(panierRecupereJSON);
console.log(panierRecupere);

// Vérifier si le panier existe dans le localStorage
if (panierRecupere && panierRecupere.length > 0) {
    // Parcourir le panier
    for (var i = 0; i < panierRecupere.length; i++) {
        var produit = panierRecupere[i];

        var newRow = document.createElement('tr');

        var imageCell = document.createElement('td');
        var imageElement = document.createElement('img');
        imageElement.setAttribute('src', 'img/produit/' + produit.id + '.png');
        imageElement.setAttribute('alt', produit.nom);
        imageElement.style.width = '100px';
        imageCell.appendChild(imageElement);
        newRow.appendChild(imageCell);

        var nomCell = document.createElement('td');
        nomCell.textContent = produit.nom;
        newRow.appendChild(nomCell);

        var libelleCell = document.createElement('td');
        libelleCell.textContent = produit.libelle;
        newRow.appendChild(libelleCell);

        var prixCell = document.createElement('td');
        prixCell.textContent = produit.prix + "DA";
        newRow.appendChild(prixCell);

        var supprimerCell = document.createElement('td');
        var supprimerLink = document.createElement('a');
        supprimerLink.setAttribute('class', 'nav-link btn btn-light btn-sm text-dark btn-sing-in-navbar');
        supprimerLink.setAttribute('href', '#');
        supprimerLink.textContent = 'Supprimer';

        (function(produit) {
            supprimerLink.addEventListener('click', function() {
                var index = panierRecupere.indexOf(produit);
                if (index !== -1) {
                    panierRecupere.splice(index, 1);
                    localStorage.setItem('panier', JSON.stringify(panierRecupere));
                    window.location.reload();
                }
            });
        })(produit);

        supprimerCell.appendChild(supprimerLink);
        newRow.appendChild(supprimerCell);

        document.getElementById('panier').appendChild(newRow);
    }
}
</script>
<script>
    function envoyerDonneesVersPHP() {
        var panier = JSON.parse(localStorage.getItem('panier'));
        var sommesPrixParId = [];

        let aggregatedArray = {};

        // Iterate over the original array
        panier.forEach(item => {
            // Check if the ID already exists in the aggregated array
            if (aggregatedArray[item.id]) {
                // If it exists, add the price to the existing total
                aggregatedArray[item.id].prix += item.prix;
            } else {
                // If it doesn't exist, create a new entry with the ID and price
                aggregatedArray[item.id] = {
                    id: item.id,
                    prix: item.prix
                };
            }
        });
        
        // panier.forEach(function(produit) {
        //     var id = produit.id;
        //     var prix = produit.prix;

        //     if (id in sommesPrixParId) {
        //         sommesPrixParId[id] += prix;
        //     } else { 
        //         sommesPrixParId[id] = prix;
        //     }
        // });
       
        aggregatedArray = Object.values(aggregatedArray)
        console.log(aggregatedArray);
        
        // Envoyer les données à votre serveur PHP pour traitement
        fetch('assets/compos/traitement_commande.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(aggregatedArray)
        }).then(response => {
            if (!response.ok) {
                console.log(response)
                throw new Error('Erreur lors de l\'envoi des données.');
            }
            console.log(response)
            return response.json();
        })
        .then(data => {
            console.log('Réponse du serveur :', data);
            localStorage.removeItem('panier');
            window.location.reload();
        })
        .catch(error => {
            console.error('Erreur:', error);
        });

    }

    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById("envoyerDonnees").addEventListener("click", function(event) {
            event.preventDefault(); // Empêche le comportement par défaut du lien
            
            envoyerDonneesVersPHP(); // Appelle la fonction pour envoyer les données vers PHP
        });
    });
</script>
