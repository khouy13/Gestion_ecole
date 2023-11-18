<?php
$code = $_SESSION['code_verification'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mot de passe Oublié</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <!-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./style/style.css">
</head>

<body>
    <!-- Section: Design Block -->
    <section class="background-gradient overflow-auto">


        <div class="container px-4 py-5 px-md-5  text-lg-start my-5">
            <div class="row gx-lg-5 align-items-center mb-5">

                <div class="col-12 col-lg-8 offset-lg-2 col-xl-6 offset-xl-3 mb-5 mb-lg-0 position-relative">

                    <div class="card bg-glass">
                        <div class="card-body px-4 py-5 px-md-5">
                            <?php

                            // Vérifier si le jeton de réinitialisation est valide
                            if (isset($_GET['token'])) {
                                $token = $_GET['token'];

                                // Vérifier la validité du jeton dans la base de données
                                // Code de vérification de la validité du jeton

                                if ($token) {
                                    // Afficher le formulaire de réinitialisation du mot de passe
                                    echo '
                                        <form method="POST" action="process_reset_password.php">
                                            <input type="hidden" name="token" value="' . $token . '">
                                            <label for="new_password">Nouveau mot de passe :</label>
                                            <input type="password" name="new_password" required>
                                            <button type="submit" name="reset_password">Réinitialiser le mot de passe</button>
                                        </form>
                                        ';
                                } else {
                                    // Afficher un message d'erreur si le jeton est invalide
                                    echo "Le lien de réinitialisation du mot de passe est invalide.";
                                }
                            }
                            ?>





                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section: Design Block -->

    <!-- modal for forget passworrd -->
    <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content container">
                <form action="forgetPassword" method="post">
                    <div class="form-outline mb-4">

                        <label class="form-label d-flex mt-3" for="form2Example1">Votre email</label>
                        <input required type="email" class="form-control mb-2" type="text" name="email" id="username" required />
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary w-50 mt-5 mb-4">
                                Envoyer Code de vérification
                            </button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>




</body>

</html>