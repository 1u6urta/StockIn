
<?php
    include '../assets/compos/database.php';
    include '../assets/compos/header.php';

    if(isset($_POST['logInadmin'])) { // Vérifier si le formulaire de connexion a été soumis
        $id = $_POST['username'];
        $mot_de_passe = $_POST['motdepasse_proprietaire'];
        $message="";

        // Requête pour sélectionner l'utilisateur avec l'email fourni
        $sql = "SELECT * FROM proprietaire WHERE username='$id'";
        $result = mysqli_query($conn, $sql);

        // Vérifier les erreurs SQL
        if (!$result) {
            printf("Erreur SQL: %s\n", mysqli_error($conn));
            exit();
        }

        if(mysqli_num_rows($result) == 1) { // Vérifier si l'utilisateur existe
            $row = mysqli_fetch_assoc($result);
            // Vérifier si les mots de passe correspondent
            if( md5($mot_de_passe) == $row['password'] ) {
                $_SESSION['admin'] = $row['id_proprietaire'];
                header("Location: dashboard.php");
                exit();
            } else {
                $message= "Mot de passe incorrect.";
            }
        } else {
            $message= "admin non trouvé.";
        }
    }
?>

<div class="container">
    <div class="log-in-form mt-3 mb-3">
    
        <!-- TITRE FORMULAIRE DE CONNEXION -->
        <h3 class="  mb-3 text-center">Connexion au compte proprietaire</h3>
        <?php if (!empty($message)) { ?>
            <div class="alert alert-danger mt-3">
                <?php echo $message; ?> 
            </div>
        <?php } ?>
        <!-- FORMULAIRE DE CONNEXION -->
        <form class="bg-light p-3 border container-login " method="POST">
            <div class="row">
                
                <!-- email du client -->
                <div class="col-12">
                    <div class="form-group">
                        <label for="email_client">ID *</label>
                        <input  class="form-control" id="username" name="username" value="" placeholder="Saisir votre adresse Username..." required>
                    </div>
                </div>

                <!-- mot de passe du client -->
                <div class="col-12">
                    <div class="form-group">
                        <label for="motdepasse_client">Mot de passe *</label>
                        <input type="password" class="form-control" id="motdepasse_proprietaire" name="motdepasse_proprietaire" placeholder="Saisir votre mot de passe..." required>
                    </div>
                </div>

                <!--boutton du formulaire  -->
                <div class="col-12 mt-3">
                    <input type="submit" class="btn btn-primary w-100" value="Connexion" name="logInadmin">
                </div>
            </div>
        </form>
    </div>
</div>

</body>
</html>
