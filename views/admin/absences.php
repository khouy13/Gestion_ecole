<?php
$classes = ClassController::getAllClassess();
if (isset($_POST['id']) && $_POST['id'] != 0) {
    $students = AbsenceController::getAllOfClass($_POST['id']);
} else {
    $students = AbsenceController::getAll();
}
?>

<?php $title = "Utilisateurs" ?>
<?php ob_start(); ?>

<!-- students -->
<div class="details-table  pt-0">
    <div class="activities">
        <div class="cardHeader mb-3">
            <h2 class="fw-bold">Absences</h2>
        </div>
        <div class="d-flex justify-content-between">
            <div class="d-flex">
                <label class="fw-bold fs-5 mt-1">Filtrer &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                <select name="classes" id="selectClass" class="form-select" aria-label="Default select example" style="height: 40px !important;">
                    <?php if (isset($_POST['id'])) { ?>
                        <option value="0">Tous</option>
                        <?php foreach ($classes as $class) {
                            if ($_POST['id'] == $class['class_id']) { ?>
                                <option value="<?= $class['class_id'] ?>" selected><?= $class['class_name'] ?></option>
                            <?php } else { ?>
                                <option value="<?= $class['class_id'] ?>"><?= $class['class_name'] ?></option>
                        <?php  }
                        }
                    } else { ?>
                        <option value="0">Tous</option>
                        <?php foreach ($classes as $class) { ?>
                            <option value="<?= $class['class_id'] ?>"><?= $class['class_name'] ?></option>
                        <?php } ?>
                    <?php } ?>
                </select>
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <td>Nom Complet</td>
                    <td class="text-start">Email</td>
                    <td class="text-center">classe</td>
                    <td class="text-center">Nombre des absences</td>
                </tr>
            </thead>

            <tbody id="<?php echo (isset($_POST['id']) ? 'students' : '') ?>">
                <?php foreach ($students as $student) { ?>
                    <tr>
                        <td><?= $student['fullname'] ?></td>
                        <td class="text-start"><?= $student['email'] ?></td>
                        <td class="text-center"><?= $student['class_name'] ?></td>
                        <td class="text-center"><?= $student['nombre_absences'] ?></td>
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
    let select = document.querySelector('#selectClass');
    let input = document.querySelector('#MyId');
    select.addEventListener('change', (e) => {
        input.value = (e.currentTarget.value);
        document.getElementById("FilterClass").submit();
    });
</script>
<?php $content = ob_get_clean(); ?>

<?php require('views/admin/layout.php');
