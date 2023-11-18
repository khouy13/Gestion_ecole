<?php

$Cour = new CourController();
$cours = $Cour->getCourofModule();

$Cour->ajouterCour();

$Cour->suprimerCour();

ob_start() ?>

<div class="container">
    <div class="modal" id="myModal2">
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header bg-light">
                    <h4 class="modal-title h6">ajouter du cours</h4>
                    <button type="button" class="btn-close bg-white" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form method="post">
                        <input type="text" class="form-control" name="filename" placeholder="nom de la cour" required>
                        <input type="hidden" name="departement_id" value="<?php echo $_SESSION['module_id']; ?>">
                        <input type="file" class="form-control my-4" name="file" required>
                        <button type="submit" name="ajouter" class="form-control bg-info text-white">ajouter</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row d-flex justify-content-center">
        <div class="col-md-6">
            <div class="card bg-white my-5">
                <div class="card-header bg-white">
                    <div class="d-flex justify-content-center">
                        <img src="file/cour.png" alt="">
                    </div>
                    <button class="btn btn-sm  text-dark" style="background-color:lightgrey;border-radius:50%;" data-bs-toggle="modal" data-bs-target="#myModal2" title="ajoute du cour"><i class="fas fa-plus"></i></button>
                </div>
                <div class="card-body">
                    <div style="overflow-x:auto">
                        <table class="table">
                            <thead class="bg-light text-primary">
                                <tr>
                                    <td class="h6">Cour</td>
                                    <td class="h6">fichier</td>
                                    <td class="h6">Date de publication</td>
                                    <td class="text-center h6">delete</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($cours as $coure) { ?>
                                    <tr>
                                        <td class="h6">
                                            <?php echo $coure['cour_name'] ?>
                                        </td>
                                        <td>
                                            <a href="file/<?php echo $coure['filename'] ?>">
                                                <i class="fa-solid fa-eye text-info">
                                                </i>
                                            </a>
                                        </td>
                                        <td>
                                            <?php echo $coure['date_pub']; ?>
                                        </td>
                                        <td class="text-center">
                                            <form method="post">
                                                <input type="hidden" name="cour_id" value="<?= $coure['cour_id']; ?>">
                                                <button type="submit" name="suprimer" class="btn text-drak btn-sm" style="background-color:lightgrey;border-radius:50%;"><i class="fas fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $content = ob_get_clean(); ?>
<?php
include('views/includes/layout.php');
?>