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

async function envoyerDonneesVersPHP() {
    var panier = JSON.parse(localStorage.getItem('panier'));

    var sommesPrixParId = {};
    
    panier.forEach(function(produit) {
        var id = produit.id;
        var prix = produit.prix;

        if (id in sommesPrixParId) {
            sommesPrixParId[id] += prix;
        } else { 
            sommesPrixParId[id] = prix;
        }
    });

    var data = Object.entries(sommesPrixParId).map(([id, prix]) => ({ id, prix }));

    var options = {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    };

    // Retourner la promesse
    return fetch('assets/compos/traitement_commande.php', options);
}

// Lier la fonction à l'événement clic du bouton
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('envoyerDonnees').addEventListener('click', async function() {
        try {
            // Attendre la résolution de la promesse retournée par envoyerDonneesVersPHP
            const response = await envoyerDonneesVersPHP();
            console.log(response);

            // Vérifier si la réponse est OK
            if (response.ok) {
                // Traiter la réponse JSON
                const responseData = await response.json();
                console.log('Réponse du serveur:', responseData);

                // Effectuer des actions supplémentaires en fonction de la réponse
                // Par exemple, rediriger l'utilisateur vers une autre page
                // window.location.href = 'nouvelle_page.php';
            } else {
                // Si la réponse n'est pas OK, afficher un message d'erreur
                console.error('La requête a échoué avec le statut:', response.status);
            }
        } catch (error) {
            // Si une erreur se produit lors de l'envoi de la requête ou du traitement de la réponse
            console.error('Erreur lors de lenvoi des données:', error);
        }
    });
});

</script>
