<?php
    include "database.php";
    
    // Assurez-vous que la méthode de la requête est POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Récupérez les données JSON envoyées depuis le client
        $donnees = json_decode(file_get_contents("php://input"), true);
        
        // Vérifiez si les données JSON ont été correctement décodées
        if ($donnees !== null) {
            // Traitez les données et effectuez les opérations nécessaires
            // Par exemple, enregistrez-les dans la base de données
            // et renvoyez une réponse JSON en cas de succès
            $response = ['success' => true];
            echo json_encode($response);
            exit; // Arrêtez l'exécution du script après avoir renvoyé la réponse
        } else {
            // Si les données JSON ne sont pas valides, renvoyez une réponse JSON d'erreur
            $response = ['success' => false, 'error' => 'Invalid JSON data'];
            echo json_encode($response);
            exit; // Arrêtez l'exécution du script après avoir renvoyé la réponse
        }
    } else {
        // Si la méthode de la requête n'est pas POST, renvoyez une réponse JSON d'erreur
        $response = ['success' => false, 'error' => 'Only POST requests are allowed'];
        echo json_encode($response);
        exit; // Arrêtez l'exécution du script après avoir renvoyé la réponse
    }
?>

<?php
echo $donnees;
?>