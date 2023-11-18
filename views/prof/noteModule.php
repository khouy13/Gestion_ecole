<?php

$etudaint = new EtudiantController();
[$students, $areAvaibleNotes] = $etudaint->getAllEtudiantDeclass();


// $Note = new NoteController();
// $Note->enregistrerNote();

// $Note = new NoteController();
// $Note->suprimerNote();
$title = 'Gestion du notes';
$footer_color = '#dbedff';
?>
<?php ob_start() ?>
<style>
    body {
        background-color: #dbedff;
    }
</style>
<!-- <div class="container p-2 mt-5">
    <h1 class="fs-1 fw-bold mt-5 mb-5 text-center" style="color:var(--main-color);">Espace Des Notes</h1>
    <div class="row d-flex justify-content-center margin-top">
        <div class="col-md-7">
            <div class="bg-white my-5">
                <div class="card-header bg-white d-flex justify-content-center">
                    <img src="file/notes.jpg" alt="">
                </div>
                <div class="card-body">
                    <div class="row m-0 container-fluid">
                        <div class="col-4 col-lg-5 offset-lg-1 bdr ps-3" style="background-color:#B3D8E0;">Nom Complet</div>
                        <div class="col-6 col-lg-4 text-center bdr" style="background-color:#B3D8E0;">Note</div>
                        <div class="col-2 col-lg-2 text-center bdr" style="background-color:#B3D8E0;"></div>
                    </div>
                    <div class="row m-0 container-fluid">
                        <?php foreach ($students as $Etudaint) { ?>
                            <div class="col-4 col-lg-5 offset-lg-1 bg-white  bdr ps-3"><?= $Etudaint['fullname'] ?></div>
                            <div class="col-6 col-lg-4 bg-white text-center bdr">
                                <form action="AddNote" class="d-flex justify-content-center p-1" method="post">
                                    <input type="text" name="note" class="form-control text-center" style="width: 30%;" value="<?php if (!empty($Etudaint['note'])) {
                                                                                                                                    echo $Etudaint['note'];
                                                                                                                                } ?>" required>
                                    <input type="hidden" name="student_id" value="<?php echo $Etudaint['user_id']; ?>">
                                    <input type="hidden" name="module" value="<?= $_POST['id'] ?>">
                                    <button type="submit" name="ajouter" class="btn btn-primary mx-2 "><i class="fa-solid fa-check"></i></button>
                                </form>
                            </div>
                            <div class="col-2 col-lg-2 text-center bdr">
                                <form action="deleteNote" method="post">
                                    <input type="hidden" name="student_id" value="<?php echo $Etudaint['user_id']; ?>">
                                    <input type="hidden" name="module" value="<?= $_POST['id'] ?>">
                                    <button type="submit" name="suprimer" class="btn btn-danger mx-2" title="suprimer"><i class="bi bi-trash"></i></button>
                                </form>
                            </div>
                        <?php } ?>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div> -->

<!-- hna knjreb  -->
<form action="EnregistrerNotes" class="d-flex justify-content-center p-1" method="post">
    <div class="container p-2 mt-5">
        <div class="details mt-5">
            <div class="notes w-100">
                <div class="cardHeader-note">
                    <h2>Gestion du notes</h2>
                </div>
                <div class="d-flex ms-auto me-5 my-5">
                    <input type="submit" name="ajouter" style="    position: relative;padding: 5px 10px;background: var(--blue);color: var(--white);border-radius: 6px;" value="Enregistrer">
                </div>

                <table>
                    <thead>
                        <tr>
                            <th>Nom Complet</th>
                            <th class="text-center">Note</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($students as $Etudaint) { ?>
                            <tr style="border-bottom: 1px solid #eeeeee;">
                                <td>
                                    <?= $Etudaint['fullname'] ?>
                                </td>
                                <td class="text-center">
                                    <input type="text" name="note[]" class="form-control text-center note-input" style="width: 30%;margin:0 auto" value="<?php if (!empty($Etudaint['note'])) {
                                                                                                                                                                echo $Etudaint['note'];
                                                                                                                                                            } ?>" data-student-id="<?= $Etudaint['user_id'] ?>" data-module-id="<?= $_POST['id'] ?>">


                                    <input type="hidden" name="student_id[]" value="<?php echo $Etudaint['user_id']; ?>" data-student-id="<?php echo $Etudaint['user_id']; ?>" data-module-id="<?= $_POST['id'] ?>">


                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <input type="hidden" name="module" value="<?= $_POST['id'] ?>">
        <!-- hna knjreb -->
    </div>
</form>

<!-- hna knjreb  -->
<?php $content = ob_get_clean(); ?>
<?php
include('views/includes/layout.php');
?>