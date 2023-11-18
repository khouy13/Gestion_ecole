<?php
$semestre = isset($_POST['semestre']) ? $_POST['semestre'] : 0;
if (isset($_POST['id']) && $_POST['id'] != 0) {
    $modules = ModuleController::getAllByClass($_POST['id'], $semestre);
} else {
    $modules = ModuleController::All($semestre);
}
$classes = ClassController::getAllClassess();
$teachers = EtudiantController::getAllProfs();
?>

<?php $title = "Modules" ?>
<?php ob_start(); ?>

<div class="details-table">
    <div class="activities">
        <div class="cardHeader">
            <h2 class="fw-bold">Modules</h2>
            <div>
                <button type="button" class="status btn delivered border-none mx-3" data-bs-toggle="modal" data-bs-target="#addModule">
                    Ajouter un module
                </button>
            </div>
            <!-- Modal add module -->
            <div class="modal fade" id="addModule" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="addModule" method="post">
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form5Example1">Nom du Module</label>
                                    <input type="text" id="form5Example1" class="form-control" name="module_name" id="" />
                                </div>
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form5Example1">Coefficient du Module</label>
                                    <input type="text" id="form5Example1" class="form-control" name="module_coeff" id="" />
                                </div>
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form5Example1">Semestre</label>
                                    <select name="semestre" id="" class="form-control">
                                        <option value="1" <?php echo $semestre == 1 ? "selected" : "" ?>>S1</option>
                                        <option value="2" <?php echo $semestre == 2 ? "selected" : "" ?>>S2</option>
                                    </select>

                                </div>
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form5Example1">Class</label>
                                    <select name="class_id" id="" class="form-control">
                                        <option value="0"></option>
                                        <?php
                                        if (isset($_POST['id'])) {
                                            foreach ($classes as $class) {
                                                if ($class['class_id'] == $_POST['id']) { ?>
                                                    <option value="<?= $class['class_id'] ?>" selected><?= $class['class_name'] ?></option>

                                                <?php } else { ?>
                                                    <option value="<?= $class['class_id'] ?>"><?= $class['class_name'] ?></option>
                                                <?php }
                                            }
                                        } else {
                                            foreach ($classes as $class) { ?>
                                                <option value="<?= $class['class_id'] ?>"><?= $class['class_name'] ?></option>
                                        <?php
                                            }
                                        } ?>
                                    </select>

                                </div>
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form5Example1">Responsable du module</label>
                                    <select name="prof_id" id="" class="form-control">
                                        <option value="0"></option>
                                        <?php foreach ($teachers as $teacher) { ?>
                                            <option value="<?= $teacher['user_id'] ?>"><?= $teacher['fullname'] ?></option>
                                        <?php
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
        <div class="d-flex my-2 justify-content-between">
            <div class="d-flex">
            <label class="fw-bold fs-5 mt-1">Filtrer &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
            <select name="classes" id="selectFilliere" class="form-select w-75" aria-label="Default select example" style="height: 40px !important;">
                <?php if (isset($_POST['id'])) { ?>
                    <option value="0">Tous</option>
                    <?php foreach ($classes as $classe) {
                        if ($_POST['id'] == $classe['class_id']) { ?>
                            <option value="<?= $classe['class_id'] ?>" selected><?= $classe['class_name'] ?></option>
                        <?php } else { ?>
                            <option value="<?= $classe['class_id'] ?>"><?= $classe['class_name'] ?></option>

                    <?php  }
                    }
                } else { ?>
                    <option value="0">Tous</option>
                    <?php foreach ($classes as $classe) { ?>
                        <option value="<?= $classe['class_id'] ?>"><?= $classe['class_name'] ?></option>
                    <?php } ?>
                <?php } ?>
            </select>
            </div>
            <div class="d-flex">
            <label class="fw-bold fs-5 mt-1">Smestre &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
            <select name="classes" id="selectSemestre" class="form-select w-75" aria-label="Default select example" style="height: 40px !important;">
                <?php if (isset($_POST['semestre'])) { ?>
                    <option value="0" <?php echo ($_POST['semestre'] == 0) ? "selected" : "" ?>>Tous</option>
                    <option value="1" <?php echo ($_POST['semestre'] == 1) ? "selected" : "" ?>>Semestre 1</option>
                    <option value="2" <?php echo ($_POST['semestre'] == 2) ? "selected" : "" ?>>Semestre 2</option>
                <?php } else { ?>
                    <option value="0" selected>Tous</option>
                    <option value="1">Semestre 1</option>
                    <option value="2">Semestre 2</option>
                <?php } ?>
            </select>
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <td>Nom du Module</td>
                    <td class="text-center">Coefficient du Module</td>
                    <td class="text-center">Classe</td>
                    <td class="text-center">Semestre</td>
                    <td class="text-center">Responsable du Module</td>
                    <td class="text-center">Action</td>
                </tr>
            </thead>

            <tbody id="">
                <?php foreach ($modules as $module) { ?>
                    <tr>
                        <td><?= $module['module_name'] ?></td>
                        <td class="text-center"><?= $module['module_coeff'] ?></td>
                        <td class="text-center"><?= $module['class_name'] ?></td>
                        <td class="text-center"><?= $module['semestre'] ?></td>
                        <td class="text-center"><?= $module['fullname'] ?></td>

                        <td class="d-flex justify-content-evenly py-2"><button type="button" class="status btn delivered border-none mx-3" data-bs-toggle="modal" data-bs-target="#modifierModule<?= $module['module_id'] ?>">
                                Modifier
                            </button>
                            <form action="DeleteModule" method="post">
                                <input type="hidden" name="module_id" value="<?= $module['module_id'] ?>">
                                <button type="submit" class="status btn return border-none" onclick="return confirm('Êtes-vous sûr de vouloir supprimer le module <?= $module['module_name'] ?>  ?');">Supprimer</button>

                            </form>
                        </td>
                        <!-- Modal of Modifier Module -->
                        <div class="modal fade" id="modifierModule<?= $module['module_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Module <?= $module['module_name'] ?></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="editModule" method="post">
                                            <input type="hidden" name="module_id" value="<?= $module['module_id'] ?>">

                                            <div class="form-outline mb-4">
                                                <label class="form-label" for="form5Example1">Nom du Module</label>
                                                <input type="text" id="form5Example1" class="form-control" name="module_name" id="" value="<?= $module['module_name'] ?>" />

                                            </div>
                                            <div class="form-outline mb-4">
                                                <label class="form-label" for="form5Example1">Coefficient du Module</label>
                                                <input type="text" id="form5Example1" class="form-control" name="module_coeff" id="" value="<?= $module['module_coeff'] ?>" />

                                            </div>
                                            <div class="form-outline mb-4">
                                                <label class="form-label" for="form5Example1">Semestre</label>
                                                <select name="semestre" id="" class="form-control">
                                                    <option value="1" <?php echo $module['semestre'] == 1 ? "selected" : "" ?>>S1</option>
                                                    <option value="2" <?php echo $module['semestre'] == 2 ? "selected" : "" ?>>S2</option>
                                                </select>

                                            </div>
                                            <div class="form-outline mb-4">
                                                <label class="form-label" for="form5Example1">Class</label>
                                                <select name="class_id" id="" class="form-control">
                                                    <option value="0"></option>
                                                    <?php
                                                    foreach ($classes as $class) {
                                                        if ($class['class_id'] == $module['class_id']) { ?>
                                                            <option value="<?= $class['class_id'] ?>" selected><?= $class['class_name'] ?></option>

                                                        <?php } else { ?>
                                                            <option value="<?= $class['class_id'] ?>"><?= $class['class_name'] ?></option>
                                                    <?php }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-outline mb-4">
                                                <label class="form-label" for="form5Example1">Responsable du module</label>
                                                <select name="prof_id" id="" class="form-control">
                                                    <option value="0"></option>
                                                    <?php foreach ($teachers as $teacher) {
                                                        if ($teacher['user_id'] == $module['prof_id']) { ?>
                                                            <option value="<?= $teacher['user_id'] ?>" selected><?= $teacher['fullname'] ?></option>

                                                        <?php } else { ?>
                                                            <option value="<?= $teacher['user_id'] ?>"><?= $teacher['fullname'] ?></option>

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
            <input type="hidden" name="semestre" id="" value="<?php echo (isset($_POST['semestre'])) ? $_POST['semestre'] : $_SESSION['current_semestre'] ?>">
        </form>
        <form method="post" action="" id="FilterSemestre">
            <input type="hidden" name="semestre" value="" id="inputSemestre">
            <input type="hidden" name="id" id="" value="<?php echo (isset($_POST['id'])) ? $_POST['id'] : 0 ?>">
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
    let selectSemstre = document.querySelector('#selectSemestre');
    let inputSemestre = document.querySelector('#inputSemestre');
    selectSemstre.addEventListener('change', (e) => {
        inputSemestre.value = (e.currentTarget.value);
        document.getElementById("FilterSemestre").submit();
    });
</script>

<?php $content = ob_get_clean(); ?>

<?php require('views/admin/layout.php');
