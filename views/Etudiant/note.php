<?php

$Note = new NoteController();
$semestre = (!isset($_POST['semestre'])) ? $_SESSION['current_semestre'] : $_POST['semestre'];
[$notes, $seuil, $moyenne] = $Note->getAllNotes($semestre);
$footer_color = '#dbedff';
?>

<?php $title = "note" ?>
<?php ob_start(); ?>

<style>
    body{
    background-color: #dbedff;
}
</style>

<div class="container p-2 mt-5">
    <div class="details mt-5">
        <div class="notes w-100">
            <div class="cardHeader-note">
                <h2>Notes</h2>
            </div>
            <div class="d-flex ms-auto me-5 my-5">
                <div class="d-flex my-2">
                    <select name="semestre" id="selectSemestre" class="form-select " aria-label="Default select example" style="height: 40px !important;">
                        <option value="1" <?php echo ($semestre == 1) ? "selected" : '' ?>>Semestre 1</option>
                        <option value="2" <?php echo ($semestre == 2) ? "selected" : '' ?>>Semestre 2</option>
                    </select>
                </div>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th></th>
                        <th class="text-center">note</th>
                        <th class="text-center">Décision</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($notes as $note) { ?>
                        <tr style="border-bottom: 1px solid #eeeeee;">
                            <td>
                                <?= $note['module_name'] ?>
                            </td>
                            <td></td>
                            <td class="text-center">
                                <?= $note['note_value'] ?>
                            </td>

                            <?php if ($note['note_value'] >= $seuil) { ?>
                                <td class="text-center" style="background-color: #5ced73;color:white;">V</td>
                            <?php } else if ($note['note_value'] == null) { ?>
                                <td class="text-center bg-white"></td>
                            <?php } else { ?>
                                <td class="text-center" style="background-color: #ce0000ad; color:white;">NV</td>
                            <?php } ?>

                        </tr>
                    <?php } ?>
                    <tr>
                        <th>Moyenne</th>
                        <td></td>
                        <td class="text-center"><?= $moyenne ?></td>
                        <?php if ($moyenne >= 10) { ?>
                            <td class="text-center text-white" style="background-color: #5ced73;">V</td>
                        <?php } else if ($moyenne == null) { ?>
                            <td class="text-center bg-white"></td>
                        <?php } else { ?>
                            <td class="text-center text-white" style="background-color: #ce0000ad; color:white;">NV</td>
                        <?php } ?>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <!-- hna knjreb -->
</div>
<form method="post" action="" id="FilterClass">
    <input type="hidden" name="semestre" value="" id="MyId">
</form>
<script>
    let select = document.querySelector('#selectSemestre');
    let input = document.querySelector('#MyId');
    select.addEventListener('change', (e) => {
        input.value = (e.currentTarget.value);
        document.getElementById("FilterClass").submit();
    });
</script>
<?php $content = ob_get_clean(); ?>
<?php include('views/includes/layout.php'); ?>