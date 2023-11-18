<?php
if (isset($_POST['id']) && $_POST['id'] != 0) {
    $fillieres = FilliereController::getAllFillieres();
    $classes = ClassController::getClassesByFilliere($_POST['id']);
} else {
    $fillieres = FilliereController::getAllFillieres();
    $classes = ClassController::getAllClassess();
}



?>

<?php $title = "Classes" ?>
<?php ob_start(); ?>

<div class="details-table">
    <div class="activities">
        <div class="cardHeader">
            <h2 class="fw-bold">Classes</h2>
            <div>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addClass">
                    Ajouter un Classe
                </button>
                <!-- Modal add class -->
                <div class="modal fade" id="addClass" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="addClass" method="post">
                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="form5Example1">Nom du Class</label>
                                        <input type="text" id="form5Example1" class="form-control" name="class_name" id="" />

                                    </div>
                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="form5Example1">Niveau du Class</label>
                                        <input type="text" id="form5Example1" class="form-control" name="niveau" id="" />

                                    </div>
                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="form5Example1">Seuil du réussite</label>
                                        <input type="text" id="form5Example1" class="form-control" name="seuil" id="" />
                                    </div>
                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="form5Example1">Fillière</label>
                                        <select name="filliere_id" id="" class="form-control">
                                            <?php if (isset($_POST['id'])) { ?>
                                                <option value="0">Tous</option>
                                                <?php foreach ($fillieres as $filliere) {
                                                    if ($_POST['id'] == $filliere['filliere_id']) { ?>
                                                        <option value="<?= $filliere['filliere_id'] ?>" selected><?= $filliere['filliere_name'] ?></option>
                                                    <?php } else { ?>
                                                        <option value="<?= $filliere['filliere_id'] ?>"><?= $filliere['filliere_name'] ?></option>

                                                <?php  }
                                                }
                                            } else { ?>
                                                <?php foreach ($fillieres as $filliere) { ?>
                                                    <option value="<?= $filliere['filliere_id'] ?>"><?= $filliere['filliere_name'] ?></option>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-block mb-4">Ajouter</button>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="d-flex my-2">
            <label class="fw-bold fs-5 mt-1">Filtrer &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
            <select name="classes" id="selectFilliere" class="form-select w-25" style="height: 40px !important;">

                <?php if (isset($_POST['id'])) { ?>
                    <option value="0">Tous</option>
                    <?php foreach ($fillieres as $filliere) {
                        if ($_POST['id'] == $filliere['filliere_id']) { ?>
                            <option value="<?= $filliere['filliere_id'] ?>" selected><?= $filliere['filliere_name'] ?></option>
                        <?php } else { ?>
                            <option value="<?= $filliere['filliere_id'] ?>"><?= $filliere['filliere_name'] ?></option>

                    <?php  }
                    }
                } else { ?>
                    <option value="0">Tous</option>
                    <?php foreach ($fillieres as $filliere) { ?>
                        <option value="<?= $filliere['filliere_id'] ?>"><?= $filliere['filliere_name'] ?></option>
                    <?php } ?>
                <?php } ?>


            </select>
            <!-- <select name="classes" id="selectClass" class="form-select w-25" aria-label="Default select example" style="height: 40px !important;">
                <?php if (isset($_POST['id'])) { ?>
                    <option value="0">Tous</option>
                    <?php foreach ($fillieres as $filliere) {
                        if ($_POST['id'] == $filliere['filliere_id']) { ?>
                            <option value="<?= $filliere['filliere_id'] ?>" selected><?= $filliere['filliere_name'] ?></option>
                        <?php } else { ?>
                            <option value="<?= $filliere['filliere_id'] ?>"><?= $filliere['filliere_name'] ?></option>

                    <?php  }
                    }
                } else { ?>
                    <option value="0">Tous</option>
                    <?php foreach ($fillieres as $filliere) { ?>
                        <option value="<?= $filliere['filliere_id'] ?>"><?= $filliere['filliere_name'] ?></option>
                    <?php } ?>
                <?php } ?>
            </select> -->
        </div>

        <table>
            <thead>
                <tr>
                    <td>Nom du Classe</td>
                    <td class="text-start">Fillière</td>
                    <td>Niveau</td>
                    <td class="text-center">Nombre des Etudiants</td>
                    <td class="text-center">seuil</td>
                    <td class="text-center">Action</td>
                </tr>
            </thead>

            <tbody id="">
                <?php foreach ($classes as $class) { ?>
                    <tr>
                        <td><?= $class['class_name'] ?></td>
                        <td class="text-start"><?= $class['filliere_name'] ?></td>
                        <td><?= $class['niveau'] ?></td>
                        <td class="text-center"><?= $class['nbr_students'] ?></td>
                        <td class="text-center"><?= $class['seuil'] ?></td>

                        <td class="d-flex justify-content-evenly py-2"><button type="button" class="status btn delivered border-none mx-3" data-bs-toggle="modal" data-bs-target="#modifierClass<?= $class['class_id'] ?>">
                                Modifier
                            </button>
                            <form action="DeleteClass" method="post">
                                <input type="hidden" name="class_id" value="<?= $class['class_id'] ?>">
                                <button type="submit" class="status btn return border-none" onclick="return confirm('Êtes-vous sûr de vouloir supprimer la classe <?= $class['class_name'] ?>  ?');">Supprimer</button>

                            </form>
                        </td>
                        <!-- Modal of Modifier Class -->
                        <div class="modal fade" id="modifierClass<?= $class['class_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Class <?= $class['class_name'] ?></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="editClass" method="post">
                                            <input type="hidden" name="class_id" value="<?= $class['class_id'] ?>">

                                            <div class="form-outline mb-4">
                                                <label class="form-label" for="form5Example1">Nom du Class</label>
                                                <input type="text" id="form5Example1" class="form-control" name="class_name" id="" value="<?= $class['class_name'] ?>" />

                                            </div>
                                            <div class="form-outline mb-4">
                                                <label class="form-label" for="form5Example1">Niveau du Class</label>
                                                <input type="text" id="form5Example1" class="form-control" name="niveau" id="" value="<?= $class['niveau'] ?>" />

                                            </div>
                                            <div class="form-outline mb-4">
                                                <label class="form-label" for="form5Example1">Seuil du Class</label>
                                                <input type="text" id="form5Example1" class="form-control" name="seuil" id="" value="<?= $class['seuil'] ?>" />

                                            </div>
                                            <div class="form-outline mb-4">
                                                <label class="form-label" for="form5Example1">Fillière</label>
                                                <select name="filliere_id" id="" class="form-control">
                                                    <?php foreach ($fillieres as $filliere) {
                                                        if ($filliere['filliere_id'] == $class['filliere_id']) {
                                                    ?>
                                                            <option value="<?= $filliere['filliere_id'] ?>" selected><?= $filliere['filliere_name'] ?></option>
                                                        <?php } else { ?>
                                                            <option value="<?= $filliere['filliere_id'] ?>"><?= $filliere['filliere_name'] ?></option>

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
                    </tr>
                <?php } ?>

            </tbody>
        </table>
        <form method="post" action="" id="FilterClass">
            <input type="hidden" name="id" value="" id="MyId">
        </form>
    </div>
</div>
<script>
    let select = document.querySelector('#selectFilliere');
    let input = document.querySelector('#MyId');
    select.addEventListener('change', (e) => {
        input.value = (e.currentTarget.value);
        document.getElementById("FilterClass").submit();
    });
</script>
<?php $content = ob_get_clean(); ?>

<?php require('views/admin/layout.php');
