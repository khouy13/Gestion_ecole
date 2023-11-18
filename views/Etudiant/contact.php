<?php $title = "Modules";
$demandes = ServiceController::getDemandes();

if (isset($_POST['message'])) {
    if ($_POST['message'] == 'contact') {
        $isSended = true;
    } else if ($_POST['message'] == 'service') {
        if ($_POST['success'] == false) {
            $demandeSended = false;
        } else {
            $demandeSended = true;
        }
    }
}

?>

<?php ob_start(); ?>
<div class="container">

    <style>
        .main-h1::after {
            content: "";
            position: absolute;
            border: 2px solid var(--main-color);
            width: 100px;
            bottom: -10px;
            left: calc(50% - 50px);
        }

        .block-service {
            width: 400px;
        }

        .active-router {
            border-bottom: 4px solid #6495ED;
        }

        .router {
            cursor: pointer;
        }

        .disabled-block {
            display: none;
        }
    </style>

    <div class="d-flex justify-content-center m-0 mt-5 pt-5">
        <div class="heading  mx-2">
            <h3 class="router rter1 active-router fw-bold mt-5 mb-0 text-center position-relative">Nos services</h3>

        </div>
        <div class="heading mx-2">
            <h3 class="router rter2  fw-bold mt-5 mb-0 text-center position-relative">Vos Demandes</h3>
        </div>
        <!-- <p class="router rter1 fw-bold fs-5 p-2 m-0 active-router " style="color: var(--dark-blue);">Cours</p>
        <p class="router rter2 fw-bold fs-5 p-2 m-0 " style="color: var(--dark-blue);">Devoirs Et Nouveaux</p> -->
    </div>
    <section class="overflow-hidden lesson-block rounded " style="background-color: #eeeeee;">

        <div class="container px-4 px-md-5 text-center text-lg-start my-5">
            <div class="row mb-5 lesson-block">

                <div class="col-12">
                    <div>
                        <?php if (isset($isSended)) {
                            if ($isSended) { ?>
                                <div class="alert alert-success text-center" role="alert">
                                    Votre message est envoyée avec succes
                                </div>
                            <?php } else { ?>
                                <div class="alert alert-danger text-center" role="alert">
                                    Il y'a u probleme Essayez de renvoyer votre message
                                </div>
                        <?php }
                        } ?>
                        <?php if (isset($demandeSended)) {
                            if ($demandeSended) { ?>
                                <div class="alert alert-success text-center" role="alert">
                                    Votre demande est envoyée avec succes
                                </div>
                            <?php } else { ?>
                                <div class="alert alert-danger text-center" role="alert">
                                    Vous avez déja demander ce service
                                </div>
                        <?php }
                        } ?>
                    </div>
                    <p class="text-center w-75 mx-auto my-3">Avec notre service, c'est aussi simple qu'un clic. Demandez votre document aujourd'hui et soyez assuré qu'il vous sera entre vos mains en seulement 24 heures.</p>
                    <div class="d-flex justify-content-center flex-wrap">
                        <div class="mb-3">
                            <div class="service rounded">
                                <div class="header">
                                    <h1 class="title">Attestation scolaire</h1>
                                </div>
                                <form action="AddService" method="post" class="content">
                                    <input type="hidden" name="type" value="1">
                                    <button type="submit">Demander</button>
                                </form>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="service rounded">
                                <div class="header">
                                    <h1 class="title">Relvé de note</h1>
                                </div>
                                <form action="AddService" method="post" class="content">
                                    <input type="hidden" name="type" value="2">
                                    <button type="submit">Demander</button>
                                </form>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="service rounded">
                                <div class="header">
                                    <h1 class="title">Attestation de stage</h1>
                                </div>
                                <form action="AddService" method="post" class="content">
                                    <input type="hidden" name="type" value="3">
                                    <button type="submit">Demander</button>
                                </form>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="service rounded">
                                <div class="header">
                                    <h1 class="title">Changement de filiére</h1>
                                </div>
                                <form action="AddService" method="post" class="content">
                                    <input type="hidden" name="type" value="4">
                                    <button type="submit">Demander</button>
                                </form>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="service rounded">
                                <div class="header">
                                    <h1 class="title">Demande de Transfert</h1>
                                </div>
                                <form action="AddService" method="post" class="content">
                                    <input type="hidden" name="type" value="5">
                                    <button type="submit">Demander</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-8 offset-2 position-relative p-0">
                    <div class="card">
                        <div class="card-body px-4 py-5 px-md-5">
                            <div>
                                <h3 class="text-center fw-bold mb-2" style="color:var(--dark-blue);">Contactez-nous</h3>
                                <p class="text-center w-75 mx-auto mb-5">Votre satisfaction envers nos services académiques est importante pour nous. S'il y a quelque chose que vous voulez et que nous n'offrons pas actuellement, dis nous juste.</p>
                                <form class="container bg-white py-5 px-3 mb-5" action="AddService" method="POST">

                                    <div class="mb-3">
                                        <label for="message" class="form-label">Message</label>
                                        <textarea style="height: 200px" type="text" class="form-control" name="message" id="message" aria-describedby="emailHelp" required><?php if (isset($message)) {
                                                                                                                                                                                echo $message;
                                                                                                                                                                            } ?></textarea>
                                    </div>
                                    <!-- Submit button -->
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary mt-5 mb-4" name="send" style="width: 40%;">
                                            Envoyer
                                        </button>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="nv-block col-12 p-5 rounded border disabled-block overflow-hidden lesson-block " style="background-color: #eeeeee;">
        <div class="row m-0 container-fluid rounded">
            <div class="col-4 col-lg-4 offset-lg-1 bdr ps-3 fw-bold bg-light fs-5">Type de Demande</div>
            <div class="col-4 col-lg-3 text-center bdr fw-bold bg-light fs-5">Date de Demande</div>
            <div class="col-4 col-lg-3 text-center bdr fw-bold bg-light fs-5">Etat</div>
        </div>
        <div class="row m-0 container-fluid">
            <?php foreach ($demandes as $service) { ?>
                <div class="col-4 col-lg-4 offset-lg-1 bg-white  bdr ps-3"><?= $service['service_type'] ?></div>
                <div class="col-4 col-lg-3 bg-white text-center bdr"><?=ActivityController::formatDateString($service['service_date'])?></div>
                <?php if ($service['service_statut'] == '1') { ?>
                    <div class="col-4 col-lg-3 text-center bdr" style="background-color: #5ced73;">Traité</div>
                <?php } else { ?>
                    <div class="col-4 col-lg-3 text-center bdr bg-warning">Non Traité</div>
                <?php } ?>
            <?php } ?>
        </div>
    </section>


</div>


<?php $content = ob_get_clean(); ?>
<?php include('views/includes/layout.php'); ?>