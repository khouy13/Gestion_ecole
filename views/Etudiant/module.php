<?php
function timeF($date_str)
{

    $current_date = new DateTime('now');
    $given_date = new DateTime($date_str);
    $diff = $given_date->diff($current_date);

    $total_seconds = ($diff->s + $diff->i * 60 + ($diff->h - 2) * 3600 + $diff->days * 86400);


    if ($total_seconds < 60) {
        return "Maintenant";
    }

    if ($total_seconds < 3600) {
        if ($diff->i == 1) {
            return "il y'a une minute";
        }
        return "il y' a " . floor($total_seconds / 60) . " minutes";
    }

    if ($total_seconds < 86400) {
        if ($diff->h == 1) {
            return "il y'a une heure";
        }
        return "il y' a " . floor($total_seconds / 3600) . " heures";
    }

    if ($total_seconds < 604800) {
        if ($diff->days == 1) {
            return "Hier";
        }
        return "il y' a " . floor($total_seconds / 86400) . " jours";
    }

    if ($total_seconds < 2592000) {
        if (floor($total_seconds / 604800) == 1) {
            return "il y' a une semaine";
        }
        return "il y' a " . floor($total_seconds / 604800) . " semaines";
    }

    if ($total_seconds < 31536000) {
        return "il y' a " . floor($total_seconds / 2592000) . " mois";
    } else {
        if ($diff->y == 1) {
            return "il y' a une année";
        }
        return "il y' a " . $diff->y . " années";
    }


    //end time function
}

$title = "Module";
$module = new ModuleController();
[$module, $cours, $tasks] = $module->getModule($_POST['id']);
$footer_color = "#eeeeee";



?>
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
                                <div class="row bg-white p-2 rounded m-1" style="border-color:var(--dark-blue);">
                                    <div class="col">
                                        <div class="row align-items-center justify-content-between">
                                            <div class="col"><i class="fa-solid fa-file-pdf ms-2 me-2 my-auto"></i><?php echo $cour["cour_name"]; ?></div>
                                            <form class="col ps-0 text-end pe-0" action="<?php echo $cour["filename"]; ?>" method="get" target="_blank">
                                                <button type="submit" class="btn btn-white fichier-less pe-0"> <a href="#" class="text-decoration-none pe-0" style="color: #1663ba;">
                                                        <i class="bi bi-cloud-download pe-0"></i>
                                                    </a></button>
                                                <span class="col font-weight-light text-secondary text-end ms-0"><?=ActivityController::time($cour["date_pub"])
                                                                                                                    ?></span>
                                            </form>
                                        </div>

                                    </div>

                                </div>
                        <?php }
                        } else {
                            echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;aucun fichier a afficher";
                        } ?>
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
                                <div class="row bg-white p-2 rounded m-1" style="border-color:var(--dark-blue);">
                                    <div class="col"><span class="fst-normal" style="color: #1663ba;"><?= $task['task_content'] ?></span></div>
                                    <span class="col font-weight-light text-secondary text-end me-2"><?= ActivityController::time($task['task_date'])
                                                                                                        ?></span>
                                </div>
                        <?php }
                        } else {
                            echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;aucun fichier a afficher";
                        } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<?php $content = ob_get_clean(); ?>

<?php require('views/includes/layout.php');
