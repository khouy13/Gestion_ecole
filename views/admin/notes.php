<?php
if (isset($_POST['id']) && $_POST['id'] != 0) {
    [$notes, $allNotesAreEntred] = NoteController::getAllNotesOfClass($_POST['id']);
    $modules = (isset($_POST['semestre'])) ? ModuleController::getAllByClass($_POST['id'], $_POST['semestre']) : ModuleController::getAllByClass($_POST['id']);
    $class = ClassController::get($_POST['id']);
} else {
    $notes = [];
    $modules = [];
    $allNotesAreEntred = false;
}
$classes = ClassController::getAllClassess();
if (isset($_POST['D'])) {
    $html = '<table>
                <thead>
                    <tr>
                        <td>Nom Complet</td>';

    foreach ($modules as $module) {
        $html .= '<td class="text-start">' . $module['module_name'] . '</td>';
    }

    $html .= '<td class="text-start">Moyenne</td>
                    </tr>
                </thead>
                <tbody id="' . (isset($_POST['id']) ? 'students' : '') . '">';

    foreach ($notes as $note) {
        $html .= '<tr>
                            <td>' . $note["student"] . '</td>';

        foreach ($note['modules'] as $module) {
            if (isset($module['note_value'])) {
                $html .= '<td class="text-start">' . $module['note_value'] . '</td>';
            } else {
                $html .= '<td></td>';
            }
        }

        $html .= '<td class="text-start">' . $note["moyenne"] . '</td>
                        </tr>';
    }

    $html .= '</tbody>
            </table>';
    DownloadNotes::Download($html);
}
?>

<?php $title = "Espace des notes" ?>
<?php ob_start(); ?>

<div class="details-table">
    <div class="activities">
        <div class="cardHeader">
            <h2 class="fw-bold">Espace Affichage</h2>
        </div>
        <div class="d-flex justify-content-between my-2 mx-5">
            <div class="d-flex">
                <label class="fw-bold fs-5 mt-1">Classe &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                <select name="classes" id="selectFilliere" class="form-select w-75" aria-label="Default select example" style="height: 40px !important;">
                    <?php if (isset($_POST['id'])) { ?>
                        <option value="0"></option>
                        <?php foreach ($classes as $classe) {
                            if ($_POST['id'] == $classe['class_id']) { ?>
                                <option value="<?= $classe['class_id'] ?>" selected><?= $classe['class_name'] ?></option>
                            <?php } else { ?>
                                <option value="<?= $classe['class_id'] ?>"><?= $classe['class_name'] ?></option>

                        <?php  }
                        }
                    } else { ?>
                        <option value="0"></option>
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
                        <option value="0">Tous</option>
                        <option value="1" <?php echo ($_SESSION['current_semestre'] == 1) ? "selected" : "" ?>>Semestre 1</option>
                        <option value="2" <?php echo ($_SESSION['current_semestre'] == 2) ? "selected" : "" ?>>Semestre 2</option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <!-- Download Button -->
        <?php if (isset($_POST['id'])  && $_POST['id'] != 0) { ?>
            <form action="" method="POST" class="d-flex justify-content-center my-4">
                <input type="hidden" name="D">
                <input type="hidden" name="id" value="<?php echo isset($_POST['id']) ? $_POST['id'] : 0 ?>">
                <input type="hidden" name="semestre" value="<?php isset($_POST['semestre']) ? $_POST['semestre'] : $_SESSION['current_semestre'] ?>">
                <button type="submit" class="btn btn-primary py-0 px-3" style="width: 150px !important;">Télécharger</button>
            </form>
        <?php } ?>
        <?php if (!empty($modules) || !empty($notes)) { ?>
            <table>
                <thead>
                    <tr>
                        <td>Nom Complet</td>
                        <?php foreach ($modules as $module) { ?>
                            <td class="text-start"><?= $module['module_name']  ?></td>
                        <?php } ?>

                        <td class="text-start">Moyenne</td>
                        <?php if ($_POST['semestre'] == 0) { ?>
                            <td class="text-start">Décision</td>
                        <?php } ?>
                    </tr>
                </thead>

                <tbody id="<?php echo (isset($_POST['id']) ? 'students' : '') ?>">
                    <?php foreach ($notes as $note) { ?>
                        <tr>
                            <td><?= $note["student"] ?></td>
                            <?php foreach ($note['modules'] as $module) { ?>
                                <?php if (isset($module['note_value'])) { ?>
                                    <td class="text-start"><?= $module['note_value'] ?></td>
                                <?php } else { ?>
                                    <td></td>
                            <?php }
                            } ?>
                            <td class="text-start"><?= $note["moyenne"] ?></td>
                            <?php if ($_POST['semestre'] == 0) { ?>
                                <td class="text-start"><?php echo ($note["moyenne"] != null) ? (floatval($note['moyenne']) > $class['seuil'] ? "Admis" : "Ajourné") : "" ?></td>
                            <?php } ?>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } else { ?>
            <p>Il n'y a ni modules ni étudiants à afficher pour cette classe. </p>
        <?php } ?>
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
