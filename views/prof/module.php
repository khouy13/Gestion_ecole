<?php

$title = "Module";
$module = new ModuleController();
[$module, $cours, $tasks] = $module->getModule($_POST['id']);
$footer_color = "#eeeeee";
if (isset($_POST['message'])) { ?>
    <script>
        alert("<?= $_POST['message'] ?>");
    </script>
<?php } ?>



<?php ob_start();
?>

<style>
    body {
        background-color: #eeeeee;
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

    .down-file .btn:focus {
        outline: none !important;
    }

    .down-file .btn {
        border: none !important;
    }
</style>

<div class="container p-2 margin-top">
    <div class="my-5 mx-3">
        <h2 class="text-center fs-1 fw-bold" style="color:var(--main-color);"><?= $module['module_name'] ?></h2>
        <div class="d-flex justify-content-center m-0 mt-5">
            <p class="router rter1 fw-bold fs-5 p-2 m-0 active-router " style="color: var(--dark-blue);">Cours</p>
            <p class="router rter2 fw-bold fs-5 p-2 m-0 " style="color: var(--dark-blue);">Devoirs Et Nouveaux</p>
        </div>
        <div class="rounded">
            <div class="row">
                <div class="lesson-block col-12 offset-lg-2 col-lg-8 pt-0 px-2 rounded border" style="background-color:#f7f7f7;">
                    <div class="py-4 px-2">
                        <?php
                        if (!empty($cours)) { ?>
                            <div class="row mb-2 mt-0" style="border-color:var(--dark-blue);">
                                <div class="col"><span class="fst-normal ms-3" style="color: #1663ba;">Nom du cour</span></div>
                                <span class="col font-weight-light text-secondary me-3 text-end">Date du Publication</span>
                            </div>
                            <?php foreach ($cours as $cour) { ?>
                                <div class="row bg-white p-2 rounded m-1 " style="border-color:var(--dark-blue);">
                                    <div class="col position-relative">
                                        <div class="row align-items-center justify-content-between">
                                            <div class="col"><i class="fa-solid fa-file-pdf ms-2 me-2 my-auto"></i><?php echo $cour["cour_name"]; ?></div>
                                            <form class="col ps-0 text-end pe-0" action="<?php echo $cour["filename"]; ?>" method="get" target="_blank">
                                                <div class="row down-file">
                                                    <button type="submit" class="col btn btn-white fichier-less pe-0 text-end"> <a href="#" class="text-decoration-none pe-0" style="color: #1663ba;">
                                                            <i class="bi bi-cloud-download pe-0"></i>
                                                        </a></button>
                                                    <span class="col font-weight-light text-secondary text-end ms-0" style="width: 160px;"><?= ActivityController::time($cour["date_pub"])
                                                                                                                                            ?></span>
                                                </div>
                                            </form>
                                        </div>
                                        <span class="position-absolute " style="top: -35px;right: -29px;font-size:20px">
                                            <form action="deleteCour" method="post">
                                                <input type="hidden" name="cour_id" id="" value="<?= $cour['cour_id'] ?>">
                                                <button class="btn btn-link text-danger " type="submit" name="supprimer"><i class="bi bi-x-circle-fill position-absolute" style="top:22px;right:18px;"></i></button>
                                                <input type="hidden" name="module" value="<?= $_POST['id'] ?>" id="">
                                            </form>
                                        </span>

                                    </div>


                                </div>
                        <?php }
                        } else {
                            echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;aucun fichier a afficher";
                        } ?>
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-primary mt-2 mb-2" data-bs-toggle="modal" data-bs-target="#staticBackdrops">
                                Ajouter un fichier
                            </button>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="staticBackdrops" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Ajouter un Fichier</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="addCour" method="post" enctype="multipart/form-data">
                                            <input type="hidden" name="module" value="<?= $_POST['id'] ?>">
                                            <div class="my-2"><input class="form-control" type="text" name="name" id="" placeholder="titre du cours" required></div>
                                            <div class="my-2"><input class="form-control" type="file" name="file" id="" required></div>
                                            <div class="d-flex justify-content-center">
                                                <div class="my-2 w-25"><input type="submit" value="Ajouter" name="ajouterCour" class="btn btn-primary form-control m-2"></div>
                                            </div>
                                        </form>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="nv-block col-12 offset-lg-2 col-lg-8 pt-0 px-2 rounded border disabled-block" style="background-color:#f7f7f7;">
                    <div class="py-4">
                        <?php
                        if (!empty($tasks)) { ?>
                            <div class="row mb-2 mt-0" style="border-color:var(--dark-blue);">
                                <div class="col"><span class="fst-normal ms-3" style="color: #1663ba;">Contenu</span></div>
                                <span class="col font-weight-light text-secondary me-3 text-end">Date du Publication</span>
                            </div>
                            <?php foreach ($tasks as $key => $task) { ?>
                                <div class="row bg-white p-2 rounded m-1 position-relative" style="border-color:var(--dark-blue);">
                                    <div class="col"><span class="fst-normal" style="color: #296090;"><?= $task['task_content'] ?></span></div>
                                    <span class="position-absolute top-0 end-0" style="width:50px">
                                        <form action="deleteTask" method="post" class="">
                                            <input type="hidden" name="task_id" id="" value="<?= $task['task_id'] ?>">
                                            <button class="btn btn-link text-danger " type="submit" name="supprimer"><i class="bi bi-x-circle-fill position-absolute end-0" style="top:-5px;"></i></button>
                                            <input type="hidden" name="module" value="<?= $_POST['id'] ?>" id="">
                                        </form>
                                    </span>
                                    <span class="col font-weight-light text-secondary text-end me-2"><?= ActivityController::time($task['task_date']) //$task['task_date'] 
                                                                                                        ?></span>
                                </div>
                        <?php }
                        } else {
                            echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;aucun fichier a afficher";
                        } ?>
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-primary m-2" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                Ajouter un Devoir
                            </button>
                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Ajouter un Devoir</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="addTask" method="post">
                                            <input type="hidden" name="module" value="<?= $_POST['id'] ?>">

                                            <div class="my-2"> <textarea class="form-control" name="name" id=""></textarea></div>
                                            <div class="d-flex justify-content-center">
                                                <div class="my-2 w-25 "><input class="form-control btn btn-primary" type="submit" value="Ajouter" name="ajouterTask" class="">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<?php $content = ob_get_clean(); ?>

<?php require('views/includes/layout.php');
