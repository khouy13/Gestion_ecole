<?php
$title = "Module";

?>
<?php ob_start();
?>
<div class="container p-2 margin-top">
    <div class="my-5 mx-3">
        <div class="row">
            <div class="col-12  col-md-4 py-5">
                <div class="py-3 px-2 bg-light">
                    <div class="py-3 px-2">
                        <h5 class="text-center">Devoirs Et Nouveaux</h5>
                        <div class="py-4">
                            <div class="position-relative py-3 px-2 border-top border-bottom border-dark" style="border-width: 2px !important;">
                                <div>Le ds comporte tous les chapitres Le ds comporte tous les chapitres</div>
                                <div class="font-weight-light position-absolute bottom-0 end-0" style="font-size: 12px;">2023-01-12</div>
                                <span class="position-absolute top-0 end-0">
                                    <i class="bi bi-x-circle text-danger"></i>
                                </span>
                            </div>
                            <div class="position-relative py-3 px-2  border-bottom border-dark" style="border-width: 2px !important;">
                                <div>Le ds comporte tous les chapitres Le ds comporte tous les chapitres</div>
                                <div class="font-weight-light position-absolute bottom-0 end-0" style="font-size: 12px;">2023-01-12</div>
                                <span class="position-absolute top-0 end-0">
                                    <i class="bi bi-x-circle text-danger"></i>
                                </span>
                            </div>
                            <div class="position-relative py-3 px-2  border-bottom border-dark" style="border-width: 2px !important;">
                                <div>Le ds comporte tous les chapitres Le ds comporte tous les chapitres</div>
                                <div class="font-weight-light position-absolute bottom-0 end-0" style="font-size: 12px;">2023-01-12</div>
                                <span class="position-absolute top-0 end-0">
                                    <i class="bi bi-x-circle text-danger"></i>
                                </span>
                            </div>
                            <div class="position-relative py-3 px-2  border-bottom border-dark" style="border-width: 2px !important;">
                                <div>Le ds comporte tous les chapitres</div>
                                <div class="font-weight-light position-absolute bottom-0 end-0" style="font-size: 12px;">2023-01-12</div>
                                <span class="position-absolute top-0 end-0">
                                    <i class="bi bi-x-circle text-danger"></i>
                                </span>
                            </div>
                            <div class="position-relative py-3 px-2  border-bottom border-dark" style="border-width: 2px !important;">
                                <div>Le ds comporte tous les chapitres</div>
                                <div class="font-weight-light position-absolute bottom-0 end-0" style="font-size: 12px;">2023-01-12</div>
                                <span class="position-absolute top-0 end-0">
                                    <i class="bi bi-x-circle text-danger"></i>
                                </span>
                            </div>
                            <div class="position-relative py-3 px-2  border-bottom border-dark" style="border-width: 2px !important;">
                                <div> Le ds comporte tous les chapitres</div>
                                <div class="font-weight-light position-absolute bottom-0 end-0" style="font-size: 12px;">2023-01-12</div>
                                <span class="position-absolute top-0 end-0">
                                    <i class="bi bi-x-circle text-danger"></i>
                                </span>
                            </div>

                        </div>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                            Ajouter Devoir
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Ajouter Devoir</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="addTask" method="post">
                                            <input type="hidden" name="module" value="<?= $_POST['id'] ?>">

                                            <div class="my-2"> <textarea class="form-control" name="name" id=""></textarea></div>
                                            <div class="my-2 w-25 "><input class="form-control btn btn-primary" type="submit" value="ajouter" name="ajouterTask" class="">
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
            <div class="col-12  col-md-8 py-5">
                <div class="py-3 px-2 bg-light">
                    <div class="py-3 px-2">
                        <h5 class="text-center">Cours</h5>
                        <div class="py-4 px-2">
                            <div class=" my-2 py-3 px-2 border border-primary border-3 row" style="border-width: 2px !important;">
                                <div class="col-1"><i class="bi bi-file-earmark-pdf-fill"></i></div>
                                <div class="content position-relative col-11">
                                    <div class="fw-bold">Ch 3 : Chaines de Markov</div>
                                    <div class="font-weight-light position-absolute bottom-0 end-0" style="font-size: 12px;">2023-01-12</div>
                                    <span class="position-absolute " style="top: -32px;right: -19px;font-size:20px">
                                        <i class="bi bi-x-circle text-danger"></i>
                                    </span>
                                </div>

                            </div>
                            <div class=" my-2 py-3 px-2 border border-primary border-3 row" style="border-width: 2px !important;">
                                <div class="col-1"><i class="bi bi-file-earmark-pdf-fill"></i></div>
                                <div class="content position-relative col-11">
                                    <div class="fw-bold">Ch 3 : Chaines de Markov</div>
                                    <div class="font-weight-light position-absolute bottom-0 end-0" style="font-size: 12px;">2023-01-12</div>
                                    <span class="position-absolute " style="top: -32px;right: -19px;font-size:20px">
                                        <i class="bi bi-x-circle text-danger"></i>
                                    </span>
                                </div>

                            </div>
                            <div class=" my-2 py-3 px-2 border border-primary border-3 row" style="border-width: 2px !important;">
                                <div class="col-1"><i class="bi bi-file-earmark-pdf-fill"></i></div>
                                <div class="content position-relative col-11">
                                    <div class="fw-bold">Ch 3 : Chaines de Markov</div>
                                    <div class="font-weight-light position-absolute bottom-0 end-0" style="font-size: 12px;">2023-01-12</div>
                                    <span class="position-absolute " style="top: -32px;right: -19px;font-size:20px">
                                        <i class="bi bi-x-circle text-danger"></i>
                                    </span>
                                </div>

                            </div>
                            <div class=" my-2 py-3 px-2 border border-primary border-3 row" style="border-width: 2px !important;">
                                <div class="col-1"><i class="bi bi-file-earmark-pdf-fill"></i></div>
                                <div class="content position-relative col-11">
                                    <div class="fw-bold">Ch 3 : Chaines de Markov</div>
                                    <div class="font-weight-light position-absolute bottom-0 end-0" style="font-size: 12px;">2023-01-12</div>
                                    <span class="position-absolute " style="top: -32px;right: -19px;font-size:20px">
                                        <i class="bi bi-x-circle text-danger"></i>
                                    </span>
                                </div>

                            </div>

                        </div>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrops">
                            Ajouter Cour
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="staticBackdrops" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Ajouter Cour</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="addCour" method="post" enctype="multipart/form-data">
                                            <input type="hidden" name="module" value="<?= $_POST['id'] ?>">
                                            <div class="my-2"><input class="form-control" type="text" name="name" id="" placeholder="titre du cours"></div>
                                            <div class="my-2"><input class="form-control" type="file" name="file" id=""></div>
                                            <div class="my-2 w-25"><input type="submit" value="ajouter" name="ajouterCour" class="btn btn-primary form-control"></div>
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
