<?php $title = "Services" ?>
<?php ob_start();
[$servicesStudents, $servicesProfs] = ServiceController::getServices();
[$messagesProf, $messagesStudents] = ContactController::getAllMessage();
?>
<div class="d-flex justify-content-center m-0">
    <div class="heading  mx-2">
        <h3 class="router rter1 active-router fw-bold mt-5 mb-0 text-center position-relative">Etudiants</h3>

    </div>
    <div class="heading mx-2">
        <h3 class="router rter2  fw-bold mt-5 mb-0 text-center position-relative">Enseignants</h3>
    </div>
</div>

<div class="details-table p-0 px-2">
    <div class="activities pt-0 lesson-block m-0 mx-3 my-0">
        <h2 class="fw-bold mt-5 mb-0 text-center">Demandes</h2>
        <table class="border-top">
            <thead>
                <tr>
                    <td>Nom</td>
                    <td class="text-start">Type de Demande</td>
                    <td>Etat</td>
                    <td class="text-center">Action</td>
                </tr>
            </thead>

            <tbody id="">
                <?php foreach ($servicesStudents as $service) { ?>
                    <tr>
                        <td><?= $service['fullname'] ?></td>
                        <td class="text-start"><?= $service['service_type'] ?></td>
                        <?php if ($service['service_statut'] == '1') { ?>
                            <td class=" py-1 m-1 px-2 ">Traité</td>
                            <td class="d-flex justify-content-evenly py-2">
                                <form action="SupprimerDemande" method="post">
                                    <input type="hidden" name="service_id" value="<?= $service['service_id'] ?>">
                                    <button type="submit" class="status btn return border-none" onclick="return confirm('Êtes-vous sûr de vouloir Supprimer ce demande ?');">Supprimer</button>
                                </form>
                            </td>
                        <?php } else { ?>
                            <td class=" py-1 m-1 px-2 ">Non Traité</td>
                            <td class="d-flex justify-content-evenly py-2">
                                <form action="TraiterDemande" method="post">
                                    <input type="hidden" name="service_id" value="<?= $service['service_id'] ?>">
                                    <button type="submit" class="btn btn-warning text-white border-none" onclick="return confirm('Êtes-vous sûr de vouloir Traiter ce demande ?');">Traiter</button>
                                </form>
                            </td>
                        <?php } ?>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <!-- messages Students -->
        <h2 class="fw-bold mt-5 mb-0 text-center">Boite de reception</h2>
        <table class="border-top">
            <thead>
                <tr>
                    <td>Nom</td>
                    <td class="text-start">Message</td>
                    <td class="text-center">Action</td>
                </tr>
            </thead>

            <tbody id="">
                <?php foreach ($messagesStudents as $message) { ?>
                    <tr>
                        <td><?= $message['message_user'] ?></td>
                        <td class="text-start"><?= $message['message_content'] ?></td>
                        <td class="d-flex justify-content-evenly py-2">
                            <?php if ($message['message_statut'] == 0) { ?>
                                <form action="updateMessage" method="post" class="mx-2">
                                    <input type="hidden" name="message_id" value="<?= $message['message_id'] ?>">
                                    <button type="submit" class="status btn delivered border-none" style="width: 70px;">Recu <i class="bi bi-check-lg"></i></button>
                                </form>
                            <?php } ?>
                            <form action="deleteMessage" method="post">
                                <input type="hidden" name="message_id" value="<?= $message['message_id'] ?>">
                                <button type="submit" class="status btn return border-none" onclick="return confirm('Êtes-vous sûr de vouloir Supprimer ce message ?');">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>


    <div class="activities nv-block disabled-block pt-0 my-0">
        <h2 class="fw-bold mt-5 mb-0 text-center">Demandes</h2>
        <table class="border-top">
            <thead>
                <tr>
                    <td>Nom</td>
                    <td class="text-start">Type de Demande</td>
                    <td>Etat</td>
                    <td class="text-center">Action</td>
                </tr>
            </thead>

            <tbody id="">
                <?php foreach ($servicesProfs as $service) { ?>
                    <tr>

                        <td><?= $service['fullname'] ?></td>
                        <td class="text-start"><?= $service['service_type'] ?></td>
                        <?php if ($service['service_statut'] == '1') { ?>
                            <td class=" py-1 m-1 px-2 ">Traité</td>
                            <td class="d-flex justify-content-evenly py-2">
                                <form action="SupprimerDemande" method="post">
                                    <input type="hidden" name="service_id" value="<?= $service['service_id'] ?>">
                                    <button type="submit" class="status btn return border-none" onclick="return confirm('Êtes-vous sûr de vouloir Supprimer ce demande ?');">Supprimer</button>
                                </form>
                            </td>
                        <?php } else { ?>
                            <td class=" py-1 m-1 px-2 ">Non Traité</td>
                            <td class="d-flex justify-content-evenly py-2">
                                <form action="TraiterDemande" method="post">
                                    <input type="hidden" name="service_id" value="<?= $service['service_id'] ?>">
                                    <button type="submit" class="btn btn-warning text-white border-none" onclick="return confirm('Êtes-vous sûr de vouloir Traiter ce demande ?');">Traiter</button>
                                </form>
                            </td>
                        <?php } ?>
                    </tr>
                <?php } ?>

            </tbody>
        </table>

        <!-- messages Profs -->
        <h2 class="fw-bold mt-5 mb-0 text-center">Boite de reception</h2>
        <table class="border-top">
            <thead>
                <tr>
                    <td>Nom</td>
                    <td class="text-start">Message</td>
                    <td class="text-center">Action</td>
                </tr>
            </thead>

            <tbody id="">
                <?php foreach ($messagesProf as $message) { ?>
                    <tr>
                        <td><?= $message['message_user'] ?></td>
                        <td class="text-start"><?= $message['message_content'] ?></td>
                        <td class="d-flex justify-content-evenly py-2">
                            <?php if ($message['message_statut'] == 0) { ?>
                                <form action="updateMessage" method="post" class="mx-2">
                                    <input type="hidden" name="message_id" value="<?= $message['message_id'] ?>">
                                    <button type="submit" class="status btn delivered border-none" style="width: 70px;">Recu <i class="bi bi-check-lg"></i></button>
                                </form>
                            <?php } ?>
                            <form action="deleteMessage" method="post">
                                <input type="hidden" name="message_id" value="<?= $message['message_id'] ?>">
                                <button type="submit" class="status btn return border-none" onclick="return confirm('Êtes-vous sûr de vouloir Supprimer ce message ?');">Supprimer </button>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('views/admin/layout.php');
