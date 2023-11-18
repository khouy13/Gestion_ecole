<?php $title = "Choix du filliere"; ?>
<?php $class=ClassController::get($_SESSION['user_info']['class']);
if($class['niveau']!=2){
    Redirect::to('home');
} ?>
<?php $fillieres = FilliereController::getAllFillieresIng(); ?>
<?php $classement = ClassementController::getClassementOfUser($_SESSION['etudiant_id']) ?>
<?php if ($classement != null) {
    $classement = explode(',', $classement['classement_value']);
} ?>
<?php ob_start(); ?>
<div class="container mt-4 pt-5">
    <div class="col-8 offset-2 position-relative p-0">
        <div class="card">
            <div class="card-body px-4 py-5 px-md-5">
                <?php if (isset($_POST['id']) && $_POST['id'] == 0) { ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Les choix doivent etre distinctes
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php } else if (isset($_POST['id']) && $_POST['id'] == 1) { ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        Vos choix ont été enregistrés avec succés
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php } ?>
                <div>
                    <h3 class="text-center fw-bold mb-2" style="color:var(--dark-blue);">Classez vos fillières</h3>
                    <form class="container bg-white py-5 px-3 mb-5" action="classification" method="POST">
                        <?php if (!empty($classement)) { ?>
                            <?php foreach ($fillieres as $key => $filliere) { ?>
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form5Example1">Choix <?= $key + 1 ?></label>
                                    <select name="filliere<?= $key ?>" id="" class="form-control">
                                        <?php foreach ($fillieres as $filliere1) { ?>
                                            <option value="<?= $filliere1['filliere_id'] ?>" <?php echo ($filliere1['filliere_id'] == $classement[$key]) ? "selected" : "" ?>><?= $filliere1['filliere_name'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            <?php } ?>
                        <?php } else { ?>
                            <?php foreach ($fillieres as $key => $filliere) { ?>
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form5Example1">Choix <?= $key + 1 ?></label>
                                    <select name="filliere<?= $key ?>" id="" class="form-control">
                                        <?php foreach ($fillieres as $filliere1) { ?>
                                            <option value="<?= $filliere1['filliere_id'] ?>"><?= $filliere1['filliere_name'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            <?php } ?>
                        <?php } ?>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary mt-5 mb-4" style="width: 40%;">
                                Enregistrer
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>


</div>


<?php $content = ob_get_clean(); ?>
<?php include('views/includes/layout.php'); ?>