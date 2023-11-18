<?php
$departements = DepartementController::getAllDepartement();
$fillieres = FilliereController::getAllFilleresOfDepartements();
?>

<?php $title = "Départements & Fillière" ?>
<?php ob_start(); ?>
<style>
    .rtr {
        display: none;
    }

    .active {
        display: block !important;
    }

    .actived {
        color: blue;
        font-weight: bold;
    }
</style>
<h2 class="ms-4 fw-bold text-center">Départements</h2>
<div class="d-flex px-3">
    <button type="button" class="btn btn-primary ms-auto" data-bs-toggle="modal" data-bs-target="#addDepartement">
        Ajouter Département
    </button>
</div>


<!-- Modal add Departement -->
<div class="modal fade" id="addDepartement" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <form action="addDepartement" method="post">

                    <div class="form-outline mb-4">
                        <label class="form-label" for="form5Example1">Nom du département</label>
                        <input type="text" id="form5Example1" class="form-control" name="departement_name" id="" />

                    </div>
                    <button type="submit" class="btn btn-primary btn-block mb-4">Ajouter</button>
                </form>
            </div>

        </div>
    </div>
</div>
<div class="d-flex justify-content-center">
    <?php foreach ($departements as $key => $departementt) { ?>
        <div class="px-4 fs-4 titles fw-bold mt-5 mb-0 actives" style="cursor:pointer; ">
            <?= $departementt['departement_name']  ?>
        </div>
    <?php } ?>
</div>
<div class="parents">
    <?php foreach ($departements as $key => $departement) { ?>
        <div class="details-table me-3 p-0 rtr <?php if((isset($_POST['id']) && $_POST['id'] == $key) ||(!isset($_POST['id']) && $key == 0) ){
            echo "active";
        } ?>">
            <div class="activities">
                <div class="cardHeader">
                    <div class="d-flex ms-auto">
                            <button type="button" class="status btn delivered border-none mx-3" data-bs-toggle="modal" data-bs-target="#modifierDepartement<?= $departement['departement_id'] ?>">
                                Modifier
                            </button>
                            <form action="DeleteDepartement" method="post">
                                <input type="hidden" name="departement_id" value="<?= $departement['departement_id'] ?>">
                                <button type="submit" class="status btn return border-none" onclick="return confirm('Êtes-vous sûr de vouloir supprimer le département <?= $departement['departement_name'] ?>  ?');">Supprimer</button>
                            </form>
                    </div>
                    <!-- Modal of Modifier Departement -->
                    <div class="modal fade" id="modifierDepartement<?= $departement['departement_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Département <?= $departement['departement_name'] ?></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="modifierDepartement" method="post">
                                        <input type="hidden" name="key" value="<?=$key ?>">
                                        <input type="hidden" name="departement_id" value="<?= $departement['departement_id'] ?>">

                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="form5Example1">Nom du département</label>
                                            <input type="text" id="form5Example1" class="form-control" name="departement_name" id="" value="<?= $departement['departement_name'] ?>" />

                                        </div>
                                        <button type="submit" class="btn btn-primary btn-block mb-4">Modifier</button>
                                    </form>

                                </div>

                            </div>
                        </div>
                    </div>

                </div>
                <div>
                    <div class="cardHeader">
                        <h2 class="text-primary">Fillières</h2>
                        <div class="d-flex">
                            <button type="button" class="status btn delivered border-none mx-3" data-bs-toggle="modal" data-bs-target="#addFilliere<?= $departement['departement_id'] ?>">
                                Ajouter un fillière
                            </button>

                        </div>
                        <!-- Modal of Add Filliere -->
                        <div class="modal fade" id="addFilliere<?= $departement['departement_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Ajouter un Fillière</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="addFilliere" method="post">
                                            <input type="hidden" name="key" value="<?=$key ?>">
                                            <div class="form-outline mb-4">
                                                <label class="form-label" for="form5Example1">Nom du fillière</label>
                                                <input type="text" id="form5Example1" class="form-control" name="filliere_name" id="" />

                                            </div>
                                            <div class="form-outline mb-4">
                                                <label class="form-label" for="form5Example1">Département</label>
                                                <select name="departement_id" id="" class="form-control">
                                                    <?php foreach ($departements as $departementt) {
                                                        if ($departementt['departement_id'] == $departement['departement_id']) {
                                                    ?>
                                                            <option value="<?= $departementt['departement_id'] ?>" selected><?= $departementt['departement_name'] ?></option>
                                                        <?php } else { ?>
                                                            <option value="<?= $departementt['departement_id'] ?>"><?= $departementt['departement_name'] ?></option>

                                                    <?php }
                                                    } ?>
                                                </select>
                                            </div>
                                            <button type="submit" class="btn btn-primary btn-block mb-4">Ajouter</button>
                                        </form>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>


                    <table>
                        <thead>
                            <tr>
                                <td>Nom de Fillière</td>
                                <td class="text-center">Nombre de classes</td>
                                <td class="text-center">Action</td>
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach ($fillieres[$key] as $filliere) { ?>
                                <tr>
                                    <td><?= $filliere['filliere_name'] ?></td>
                                    <td class="text-center"><?= $filliere['nbr_classes'] ?></td>
                                    <td class="d-flex justify-content-evenly py-2">
                                        <button type="button" class="status btn delivered border-none mx-3" data-bs-toggle="modal" data-bs-target="#modifierFilliere<?= $filliere['filliere_id'] ?>">
                                            Modifier
                                        </button>
                                        <form action="DeleteFilliere" method="post">
                                            <input type="hidden" name="key" value="<?=$key ?>">
                                            <input type="hidden" name="filliere_id" value="<?= $filliere['filliere_id'] ?>">
                                            <button type="submit" class="status btn return border-none" onclick="return confirm('Êtes-vous sûr de vouloir supprimer la fillière <?= $filliere['filliere_name'] ?>  ?');">Supprimer</button>

                                        </form>
                                    </td>
                                </tr>
                                <!-- Modal of Modifier Filliere -->
                                <div class="modal fade" id="modifierFilliere<?= $filliere['filliere_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Fillière <?= $filliere['filliere_name'] ?></h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="modifierFilliere" method="post">
                                                    <input type="hidden" name="key" value="<?=$key ?>">
                                                    <input type="hidden" name="filliere_id" value="<?= $filliere['filliere_id'] ?>">

                                                    <div class="form-outline mb-4">
                                                        <label class="form-label" for="form5Example1">Nom du fillière</label>
                                                        <input type="text" id="form5Example1" class="form-control" name="filliere_name" id="" value="<?= $filliere['filliere_name'] ?>" />

                                                    </div>
                                                    <div class="form-outline mb-4">
                                                        <label class="form-label" for="form5Example1">Département</label>
                                                        <select name="departement_id" id="" class="form-control">
                                                            <?php foreach ($departements as $departement) {
                                                                if ($departement['departement_id'] == $filliere['departement_id']) {
                                                            ?>
                                                                    <option value="<?= $departement['departement_id'] ?>" selected><?= $departement['departement_name'] ?></option>
                                                                <?php } else { ?>
                                                                    <option value="<?= $departement['departement_id'] ?>"><?= $departement['departement_name'] ?></option>

                                                            <?php }
                                                            } ?>
                                                        </select>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary btn-block mb-4">Modifier</button>
                                                </form>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            <?php } ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <?php } ?>
</div>

<script>
    let headers = document.querySelectorAll('.actives');
    let titles = document.querySelectorAll('.titles');
    let divs = document.querySelectorAll('.rtr');
    <?php if (isset($_POST['id'])) { ?>
            headers[<?=$_POST['id'] ?>].classList.add('active-router');
        <?php } else { ?>
            headers[0].classList.add('active-router');
            <?php } ?>
    
    console.log(titles, divs)
    titles.forEach((title, key) => {
        title.addEventListener('click', (el) => {
            divs.forEach((div) => {
                div.classList.remove('active')
            })
            divs[key].classList.add('active');
            headers.forEach((div) => {
                div.classList.remove('active-router')
            })
            headers[key].classList.add('active-router');

        })

    })
</script>
<?php $content = ob_get_clean(); ?>

<?php require('views/admin/layout.php');
