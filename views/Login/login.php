<?php
if (isset($_POST['submit'])) {
    [$response, $data] = EtudiantController::userConn();
    if ($response == 'ok') {
        Redirect::to('home');
    }
}
if (isset($_COOKIE['dataUser'])) {
    $dataUser = explode('-', $_COOKIE['dataUser']);
    $data = ['username' => $dataUser[0], 'user_password' => $dataUser[1]];
}
if (isset($_POST['id'])) {
?>
    <script>
        alert("Il y a un problème dans le server ce service n'est pas disponible actuellement ");
    </script>
<?php
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
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
                            <form method="POST">

                                <h3 class="text-center fw-bold mb-5">Connexion</h3>
                                <!-- user input -->
                                <div class="form-outline mb-4">

                                    <label class="form-label d-flex" for="form2Example1">Nom d'utilisateur</label>
                                    <input required type="text" class="form-control mb-2" type="text" name="username" id="username" value="<?php if (isset($data['username'])) {
                                                                                                                                                echo $data['username'];
                                                                                                                                            } ?>" />
                                    <span class="my-2" style="font-size:13px">
                                        <?php if (isset($response) && $response == "username") { ?>
                                            <div class="text-danger" role="alert">
                                                Nom d'utilisateur incorrect
                                            </div>
                                        <?php } ?>
                                    </span>
                                </div>

                                <!-- Password input -->
                                <div class="form-outline text-start mb-4 position-relative">

                                    <label class="form-label d-flex" for="form2Example2">Mot de passe</label>
                                    <input required type="password" class="form-control mb-2" name="password_user" id="password" value="<?php if (isset($data['user_password'])) {
                                                                                                                                            echo $data['user_password'];
                                                                                                                                        } ?>" />
                                    <div style=" right: 17px;top: 38px;" id="changeVisibility" class="position-absolute"><i class="bi bi-eye" style="cursor:pointer"></i></div>
                                    <span class="my-2" style="font-size:13px"><?php if (isset($response) && $response == "password") { ?>
                                            <div class="text-danger text-start" role="alert">
                                                mot de passe incorrecte
                                            </div>
                                        <?php } ?>
                                    </span>
                                </div>

                                <!-- Checkbox -->
                                <div class="form-check d-flex justify-content-between mb-4">
                                    <div>
                                        <input class="form-check-input me-2" type="checkbox" name="remember" value="" id="form2Example33" checked />
                                        <label class="form-check-label" for="form2Example33">
                                            Souviens-moi
                                        </label>
                                    </div>
                                    <a class=" text-primary" data-bs-toggle="modal" href="#exampleModalToggle" role="button">Mot de passe oubliée</a>

                                </div>


                                <!-- Submit button -->
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary w-50 mt-5 mb-4" name="submit">
                                        Se connecter
                                    </button>
                                </div>

                            </form>

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
                        <input required type="email" class="form-control mb-2" type="text" name="email" id="email" required />
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



    <script>
        let $eyes = document.querySelector('#changeVisibility i');
        let $password = document.querySelector('#password');
        if ($eyes != null) {
            $eyes.addEventListener('click', (e) => {
                // password is hidden
                if (e.currentTarget.classList.value == "bi bi-eye") {
                    e.currentTarget.classList.value = "bi bi-eye-slash";
                    $password.setAttribute('type', 'text');
                } else {
                    e.currentTarget.classList.value = "bi bi-eye";
                    $password.setAttribute('type', 'password');
                }

            })
        }
    </script>
</body>

</html>