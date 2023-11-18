<?php
$CheckNotes = NextYearController::CheckNotesForSemestre(1);
if (isset($_POST['id']) && $_POST['id'] != 0) {
    [$notes, $allNotesAreEntred] = NoteController::getAllNotesOfClassOfSemestre($_POST['id'], 1);
    $modules = ModuleController::getAllByClass($_POST['id'], 1);
    $class = ClassController::get($_POST['id']);
} else {
    $notes = [];
    $modules = [];
}
$classes = ClassController::getAllClassess();
##Download pdf ###
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

<?php $title = "Modules" ?>
<?php ob_start(); ?>
<?php if (!empty($CheckNotes)) { ?>
    <div class="container">
        <div class="alert alert-danger" role="alert">
            Cette action ne peut pas être faite car  <strong>Les notes sont incomplètes</strong>.
        </div>
    </div>
<?php } else { ?>
    <div class="container">
        <div class="alert alert-success" role="alert">
            Vous Pouvez télécharger les notes ci-dessous sinon <a href="Semestre2" class="btn btn-success">Passer au S2</a>
        </div>
    </div>
<?php } ?>

<div class="details-table">
    <div class="activities">

        <?php
        if (!empty($CheckNotes)) { ?>
            <div class="cardHeader">
                <h4 class="fw-bold">Details</h4>
            </div>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">

                <?php foreach ($CheckNotes as $err) {
                    echo $err . "<br>";
                } ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php } ?>

        <div class="cardHeader">
            <h2 class="fw-bold">Listes des notes</h2>
        </div>

        <div class="d-flex my-2">
            <label class="fw-bold fs-5 mt-1">choisir Classe &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
            <select name="classes" id="selectFilliere" class="form-select w-25" aria-label="Default select example" style="height: 40px !important;">
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

        <!-- Download Button -->
        <form action="" method="POST">
            <input type="hidden" name="D">
            <input type="hidden" name="id" value="<?php echo isset($_POST['id']) ? $_POST['id'] : 0 ?>">
            <button type="submit" class="btn btn-primary">Télécharger</button>
        </form>

        <?php if (!empty($modules) || !empty($notes)) { ?>
            <table>
                <thead>
                    <tr>
                        <td>Nom Complet</td>
                        <?php foreach ($modules as $module) { ?>
                            <td class="text-start"><?= $module['module_name']  ?></td>
                        <?php } ?>

                        <td class="text-start">Moyenne</td>
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
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } else { ?>
            <p>Il n'y a ni modules ni étudiants à afficher pour cette classe. </p>
        <?php } ?>
        <form method="post" action="" id="FilterClass">
            <input type="hidden" name="id" value="" id="MyId">
        </form>
        <form method="post" action="" id="FilterSemestre">
            <input type="hidden" name="semestre" value="" id="inputSemestre">
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
