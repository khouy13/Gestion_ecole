<?php
$classesLastYear = ClassController::getClassesLastYear();
$classes = ClassController::getAllClassess();
$classesSaufLastYear = ClassController::getAllClassessSaufLY();
$NotesFinals = [];
[$notes, $allNotesAreEntred] = [[], true];

// Check if notes of LY are entred
$result1 = NextYearController::CheckNotesForLY();
$CheckNotesOfLY = !empty($result1);
$result2 = NextYearController::CheckNotesForOthersClasses();
$CheckNotesOfOthers = !empty($result2);
if (isset($_POST['id']) && $_POST['id'] != 0) {
    $class = ClassController::get($_POST['id']);
    $NotesFinals = NoteController::getNotesFinaleLastYear($_POST['id']);
    usort($NotesFinals, function ($a, $b) {
        return $b['moyenne'] <=> $a['moyenne'];
    });
}
if (isset($_POST['class']) && $_POST['class'] != 0) {
    $class = ClassController::get($_POST['class']);
    [$notes, $allNotesAreEntred] = NoteController::getAllNotesOfClass($_POST['class']);
    usort($notes, function ($a, $b) {
        return $b['moyenne'] <=> $a['moyenne'];
    });
}
echo (!isset($_POST['LY']) && isset($_POST['class'])) ? "<script>window.location.hash = '#class'</script>" : "<script>window.location.hash = '#LY'</script>";

?>

<?php $title = "Modules" ?>
<?php ob_start(); ?>
<?php if ($CheckNotesOfLY || $CheckNotesOfOthers) { ?>
    <div class="container">
        <div class="alert alert-danger" role="alert">
            Cette action ne peut pas être faite car il y'a <strong>des notes incomplètes</strong>.
        </div>
    </div>
<?php } else { ?>
    <div class="container">
        <div class="alert alert-success" role="alert">
            Vous Pouvez voir les notes ci-dessous el les listes des lauréats sinon <a href="Year2" class="btn btn-success">Passer au Prochaine Année </a>
        </div>
    </div>
<?php } ?>

<div class="details-table LY">
    <div class="activities">
        <div class="cardHeader">
            <h2 class="fw-bold">Liste des notes pour les étudiants de dernière année</h2>
        </div>

        <?php
        if (!empty($result1)) { ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php foreach ($result1 as $rs) {
                    foreach ($rs as $err) { ?>
                        <?= $err . "<br>" ?>
                <?php }
                } ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php } ?>

        <div class="d-flex my-2">
            <label class="fw-bold fs-5 mt-1">choisir Classe &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
            <select name="classes" id="selectFilliere" class="form-select w-25" aria-label="Default select example" style="height: 40px !important;">
                <?php if (isset($_POST['id'])) { ?>
                    <option value="0"></option>
                    <?php foreach ($classesLastYear as $classe) {
                        if ($_POST['id'] == $classe['class_id']) { ?>
                            <option value="<?= $classe['class_id'] ?>" selected><?= $classe['class_name'] ?></option>
                        <?php } else { ?>
                            <option value="<?= $classe['class_id'] ?>"><?= $classe['class_name'] ?></option>

                    <?php  }
                    }
                } else { ?>
                    <option value="0"></option>
                    <?php foreach ($classesLastYear as $classe) { ?>
                        <option value="<?= $classe['class_id'] ?>"><?= $classe['class_name'] ?></option>
                    <?php } ?>
                <?php } ?>
            </select>
        </div>
        <table>
            <thead>
                <tr>
                    <td>Nom Complet</td>
                    <td class="text-start">Moyenne</td>
                    <td class="text-start">Décision</td>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($NotesFinals as $note) { ?>
                    <tr>
                        <td><?= $note["student"] ?></td>
                        <td class="text-start"><?= $note["moyenne"] ?></td>
                        <td class="text-start"><?php echo ($note["moyenne"] != null) ? (floatval($note['moyenne']) > $class['seuil'] ? "Admis" : "Ajourné") : "" ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <form method="post" action="" id="FilterClass">
            <input type="hidden" name="LY">
            <input type="hidden" name="id" value="" id="MyId">
            <input type="hidden" name="class" id="" value="<?php echo (isset($_POST['class'])) ? $_POST['class'] : 0 ?>">
        </form>
    </div>
</div>
<div class="details-table" id="class">
    <div class="activities">
        <div class="cardHeader">
            <h2 class="fw-bold">Classement des classes</h2>
        </div>
        <?php
        if (!empty($result2)) { ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php foreach ($result2 as $err) {
                ?>
                    <?= $err . "<br>" ?>
                <?php
                } ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php } ?>
        <div class="d-flex my-2">
            <label class="fw-bold fs-5 mt-1">choisir Classe &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
            <select name="classes" id="selectClass" class="form-select w-25" aria-label="Default select example" style="height: 40px !important;">
                <?php if (isset($_POST['class'])) { ?>
                    <option value="0"></option>
                    <?php foreach ($classesSaufLastYear as $classe) {
                        if ($_POST['class'] == $classe['class_id']) { ?>
                            <option value="<?= $classe['class_id'] ?>" selected><?= $classe['class_name'] ?></option>
                        <?php } else { ?>
                            <option value="<?= $classe['class_id'] ?>"><?= $classe['class_name'] ?></option>

                    <?php  }
                    }
                } else { ?>
                    <option value="0"></option>
                    <?php foreach ($classesSaufLastYear as $classe) { ?>
                        <option value="<?= $classe['class_id'] ?>"><?= $classe['class_name'] ?></option>
                    <?php } ?>
                <?php } ?>
            </select>
        </div>
        <table>
            <thead>
                <tr>
                    <td>Nom Complet</td>
                    <td class="text-start">Moyenne</td>
                    <td class="text-start">Décision</td>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($notes as $note) { ?>
                    <tr>
                        <td><?= $note["student"] ?></td>
                        <td class="text-start"><?= $note["moyenne"] ?></td>
                        <td class="text-start"><?php echo ($note["moyenne"] != null) ? (floatval($note['moyenne']) > $class['seuil'] ? "Admis" : "Ajourné") : "" ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <form method="post" action="" id="FilterClassSLY">
            <input type="hidden" name="class" value="" id="inputClass">
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
    let selectSemstre = document.querySelector('#selectClass');
    let inputSemestre = document.querySelector('#inputClass');
    selectSemstre.addEventListener('change', (e) => {
        inputSemestre.value = (e.currentTarget.value);
        document.getElementById("FilterClassSLY").submit();
    });
</script>

<?php $content = ob_get_clean(); ?>

<?php require('views/admin/layout.php');
