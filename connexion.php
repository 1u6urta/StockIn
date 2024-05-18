<?php
    session_start();
    include 'assets/compos/database.php';
    include 'assets/compos/header.php';

    if(isset($_POST['logIn'])) { // Vérifier si le formulaire de connexion a été soumis
        $email = $_POST['email_client'];
        $mot_de_passe = $_POST['motdepasse_client'];
        $message="";

        // Requête pour sélectionner l'utilisateur avec l'email fourni
        $sql = "SELECT * FROM client WHERE email='$email'";
        $result = mysqli_query($conn, $sql);

        // Vérifier les erreurs SQL
        if (!$result) {
            printf("Erreur SQL: %s\n", mysqli_error($conn));
            exit();
        }

        if(mysqli_num_rows($result) == 1) { // Vérifier si l'utilisateur existe
            $row = mysqli_fetch_assoc($result);
            // Vérifier si les mots de passe correspondent
            if( md5($mot_de_passe) == $row['mot_de_passe'] ) {
                $_SESSION['id'] = $row['id_client'];
                header("Location: index.php");
                exit();
            } else {
                $message= "Mot de passe incorrect.";
            }
        } else {
            $message= "Utilisateur non trouvé.";
        }
    }
?>

<div class="container">
    <div class="log-in-form mt-3 mb-3">
    
        <!-- TITRE FORMULAIRE DE CONNEXION -->
        <h3 class="  mb-3 text-center">Connexion au compte client</h3>
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
                        <label for="email_client">Email *</label>
                        <input type="email" class="form-control" id="email_client" name="email_client" value="" placeholder="Saisir votre adresse email..." required>
                    </div>
                </div>

                <!-- mot de passe du client -->
                <div class="col-12">
                    <div class="form-group">
                        <label for="motdepasse_client">Mot de passe *</label>
                        <input type="password" class="form-control" id="motdepasse_client" name="motdepasse_client" placeholder="Saisir votre mot de passe..." required>
                    </div>
                </div>

                <!--boutton du formulaire  -->
                <div class="col-12 mt-3">
                    <input type="submit" class="btn btn-primary w-100" value="Connexion" name="logIn">
                </div>

                <!-- lien vers incription -->
                <div class="col-12 mt-3">
                    <p>Vous ne disposez pas de compte ? <a href="inscription.php">Inscrivez-vous...</a></p>
                </div>

            </div>
        </form>
    </div>
</div>

</body>
</html>
