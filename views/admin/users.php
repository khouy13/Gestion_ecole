<?php
$departements = DepartementController::getAllDepartement();
if (isset($_POST['id'])) {
    [$students, $teachers, $classes] = EtudiantController::GetAllUsers_admin($_POST['id'], 0);
} else if (isset($_POST['departement_id'])) {
    [$students, $teachers, $classes] = EtudiantController::GetAllUsers_admin(0, $_POST['departement_id']);
} else {
    [$students, $teachers, $classes] = EtudiantController::GetAllUsers_admin(0, 0);
}
if (isset($_POST['enregister'])) {
    $emploi = new EmploiController();
    $emploi->InsrtEmpois();
}
?>

<?php $title = "Utilisateurs" ?>
<?php ob_start(); ?>
<div class="d-flex justify-content-center m-0">
    <div class="heading  mx-2">
        <h3 class="router rter1 <?php echo (isset($_POST['departement_id']) || !isset($_POST['id'])) ? " active-router"
                                    : "" ?> fw-bold mt-5 mb-0 text-center position-relative">Enseignants</h3>

    </div>
    <div class="heading mx-2">
        <h3 class="router rter2 <?php echo (isset($_POST['id'])) ? " active-router" : "" ?> fw-bold mt-5 mb-0
            text-center position-relative">Etudiants</h3>
    </div>
</div>
<div class="details-table pt-0  lesson-block <?php echo (isset($_POST['departement_id']) || !isset($_POST['id'])) ? "" : "
    disabled-block" ?>">
    <div class="activities">
        <div class="d-flex justify-content-between">
            <div class="d-flex">
                <label class="fw-bold fs-5 mt-1">Filtrer &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>

                <select name="classes" id="selectDepartement" class="form-select" aria-label="Default select example" style="height: 40px !important;">
                    <?php if (isset($_POST['departement_id'])) { ?>
                        <option value="0">Tous</option>
                        <?php foreach ($departements as $departement) {
                            if ($_POST['departement_id'] == $departement['departement_id']) { ?>
                                <option value="<?= $departement['departement_id'] ?>" selected>
                                    <?= $departement['departement_name'] ?>
                                </option>
                            <?php } else { ?>
                                <option value="<?= $departement['departement_id'] ?>">
                                    <?= $departement['departement_name'] ?>
                                </option>
                        <?php  }
                        }
                    } else { ?>
                        <option value="0" selected>Tous</option>
                        <?php foreach ($departements as $departement) { ?>
                            <option value="<?= $departement['departement_id'] ?>">
                                <?= $departement['departement_name'] ?>
                            </option>
                        <?php } ?>
                    <?php } ?>
                </select>
            </div>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProf" style="height: 40px !important;">
                Ajouter
            </button>
            <!-- Modal add Prof -->
            <div class="modal fade" id="addProf" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Ajouter un enseignant</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="addProf" method="post">

                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form5Example1">Username</label>
                                    <input type="text" id="form5Example1" class="form-control" name="username" id="" required />

                                </div>
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form5Example1">Nom complet</label>
                                    <input type="text" id="form5Example1" class="form-control" name="fullname" id="" required />

                                </div>
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form5Example1">Email</label>
                                    <input type="text" id="form5Example1" class="form-control" name="email" id="" required />

                                </div>
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form5Example1">Adresse</label>
                                    <input type="text" id="form5Example1" class="form-control" name="adresse" id="" required />

                                </div>
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form5Example1">mot de passe</label>
                                    <input type="text" id="form5Example1" class="form-control" name="password" id="" required />

                                </div>
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form5Example1">numéro de téléphone</label>
                                    <input type="text" id="form5Example1" class="form-control" name="phone" id="" required />

                                </div>
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form5Example1">Nom du département</label>
                                    <select class="form-control" name="departement">

                                        <?php if (isset($_POST['departement_id'])) { ?>
                                            <?php foreach ($departements as $departement) {
                                                if ($_POST['departement_id'] == $departement['departement_id']) { ?>
                                                    <option value="<?= $departement['departement_id'] ?>" selected>
                                                        <?= $departement['departement_name'] ?>
                                                    </option>
                                                <?php } else { ?>
                                                    <option value="<?= $departement['departement_id'] ?>">
                                                        <?= $departement['departement_name'] ?>
                                                    </option>

                                            <?php  }
                                            }
                                        } else { ?>

                                            <?php foreach ($departements as $departement) { ?>
                                                <option value="<?= $departement['departement_id'] ?>">
                                                    <?= $departement['departement_name'] ?>
                                                </option>
                                            <?php } ?>
                                        <?php } ?>


                                    </select>

                                </div>
                                <button type="submit" class="btn btn-primary btn-block mb-4" name="ajouterprof">Ajouter</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <td>Nom Complet</td>
                    <td class="text-start">Email</td>
                    <td class="text-start">Numéro</td>
                    <td class="text-start">Département</td>
                    <td class="text-center">Action</td>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($teachers as $teacher) { ?>
                    <tr>
                        <td>
                            <?= $teacher['fullname'] ?>
                        </td>
                        <td class="text-start">
                            <?= $teacher['email'] ?>
                        </td>
                        <td class="text-start">
                            <?= $teacher['user_number'] ?>
                        </td>
                        <td class="text-start">
                            <?= $teacher['departement_name'] ?>
                        </td>
                        <td class="d-flex justify-content-evenly py-2"><button type="button" class="status btn delivered border-none mx-3" data-bs-toggle="modal" data-bs-target="#modifierProf<?= $teacher['user_id'] ?>">Modifier</button>
                            <form action="deleteUser" method="post">
                                <input type="hidden" name="user_id" value="<?= $teacher['user_id'] ?>">
                                <button type="submit" class="status btn return border-none" onclick="return confirm('Êtes-vous sûr de vouloir supprimer la prof <?= $teacher['fullname'] ?>  ?');">Supprimer</button>

                            </form>
                        </td>
                        <td>
                            <button type="button" class="status btn delivered border-none mx-3" data-bs-toggle="modal" data-bs-target="#ajourerEmploiProf<?= $teacher['user_id'] ?>">emploi du temps</button>
                        </td>




                        <div class="modal fade" id="ajourerEmploiProf<?= $teacher['user_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">ajouter emploi du temps</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <?php $moduleController = new ModuleController();
                                        [$modules, $temps, $jours] = $moduleController->ModulesOfProf($teacher['user_id']);
                                        ?>
                                        <ul style="display:flex;justify-content:space-between;list-style:none">
                                            <li></li>
                                            <?php foreach ($temps as $temp) { ?>
                                                <li><?= $temp['name_temps'] ?></li>
                                            <?php } ?>
                                        </ul>

                                        <form action="" method="post">
                                            <input type="hidden" name="id_prof" value="<?= $teacher['user_id'] ?>">
                                            <?php foreach ($jours as $jour) { ?>
                                                <ul style="display:flex;justify-content:space-between;list-style:none">
                                                    <li><?= $jour['nom_jour'] ?></li>
                                                    <?php foreach ($temps as $temp) { ?>
                                                        <li>
                                                            <input type="hidden" name="id_jour<?= $jour['nom_jour'] ?><?= $temp['name_temps'] ?>" value="<?= $jour['id_jour'] ?>">
                                                            <input type="hidden" name="id_temps<?= $jour['nom_jour'] ?><?= $temp['name_temps'] ?>" value="<?= $temp['id'] ?>">
                                                            <?php
                                                            $res = EmploiController::getByProf_Jour_Temps($teacher['user_id'], $jour['id_jour'], $temp['id'])
                                                            ?>
                                                            <select name="module<?= $jour['nom_jour'] ?><?= $temp['name_temps'] ?>" id="">
                                                                <option value="0"></option>
                                                                <?php foreach ($modules as $module) { ?>
                                                                    <option value="<?= $module['module_id'] ?>" <?php echo (isset($res['id_module']) && $res['id_module'] == $module['module_id']) ? "selected" : "" ?>><?= $module['module_name'] ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </li>
                                                    <?php } ?>
                                                </ul>
                                            <?php } ?>
                                            <input type="submit" name="enregister" value="enregister">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- model for success  -->
                        <!-- modal for edit prof datas -->
                        <div class="modal fade" id="modifierProf<?= $teacher['user_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Modifier les données d'une prof</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="editProf" method="post">
                                            <input type="hidden" name="prof_id" value="<?= $teacher['user_id'] ?>">
                                            <div class="form-outline mb-4">
                                                <label class="form-label" for="form5Example1">Username</label>
                                                <input type="text" id="form5Example1" class="form-control" name="username" id="" value="<?= $teacher['username'] ?>" required />

                                            </div>
                                            <div class="form-outline mb-4">
                                                <label class="form-label" for="form5Example1">Nom complet</label>
                                                <input type="text" id="form5Example1" class="form-control" name="fullname" id="" value="<?= $teacher['fullname'] ?>" required />

                                            </div>
                                            <div class="form-outline mb-4">
                                                <label class="form-label" for="form5Example1">Email</label>
                                                <input type="text" id="form5Example1" class="form-control" name="email" id="" value="<?= $teacher['email'] ?>" required />

                                            </div>
                                            <div class="form-outline mb-4">
                                                <label class="form-label" for="form5Example1">Adresse</label>
                                                <input type="text" id="form5Example1" class="form-control" name="adresse" id="" value="<?= $teacher['user_adress'] ?>" required />

                                            </div>
                                            <div class="form-outline mb-4">
                                                <label class="form-label" for="form5Example1">mot de passe</label>
                                                <input type="text" id="form5Example1" class="form-control" name="password" id="" value="<?= $teacher['password_user'] ?>" required />

                                            </div>
                                            <div class="form-outline mb-4">
                                                <label class="form-label" for="form5Example1">numéro de téléphone</label>
                                                <input type="text" id="form5Example1" class="form-control" name="phone" id="" value="<?= $teacher['user_number'] ?>" required />

                                            </div>
                                            <div class="form-outline mb-4">
                                                <label class="form-label" for="form5Example1">Nom du département</label>
                                                <select name="classes" class="form-control" name="departement">


                                                    <?php foreach ($departements as $departement) {
                                                        if ($teacher['departement'] == $departement['departement_id']) { ?>
                                                            <option value="<?= $departement['departement_id'] ?>" selected>
                                                                <?= $departement['departement_name'] ?>
                                                            </option>
                                                        <?php } else { ?>
                                                            <option value="<?= $departement['departement_id'] ?>">
                                                                <?= $departement['departement_name'] ?>
                                                            </option>

                                                    <?php  }
                                                    }
                                                    ?>


                                                </select>

                                            </div>
                                            <button type="submit" class="btn btn-primary btn-block mb-4" name="changeDatas">Modifier</button>
                                        </form>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </tr>
                <?php } ?>

            </tbody>
        </table>
    </div>
</div>

<!-- students -->
<div class="details-table nv-block <?php echo isset($_POST['id']) ? "" : " disabled-block" ?> pt-0">
    <div class="activities">
        <div class="d-flex justify-content-between">
            <div class="d-flex">
                <label class="fw-bold fs-5 mt-1">Filtrer &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                <select name="classes" id="selectClass" class="form-select" aria-label="Default select example" style="height: 40px !important;">
                    <?php if (isset($_POST['id'])) { ?>
                        <option value="0">Tous</option>
                        <?php foreach ($classes as $class) {
                            if ($_POST['id'] == $class['class_id']) { ?>
                                <option value="<?= $class['class_id'] ?>" selected>
                                    <?= $class['class_name'] ?>
                                </option>
                            <?php } else { ?>
                                <option value="<?= $class['class_id'] ?>">
                                    <?= $class['class_name'] ?>
                                </option>
                        <?php  }
                        }
                    } else { ?>
                        <option value="0">Tous</option>
                        <?php foreach ($classes as $class) { ?>
                            <option value="<?= $class['class_id'] ?>">
                                <?= $class['class_name'] ?>
                            </option>
                        <?php } ?>
                    <?php } ?>
                </select>
            </div>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addStudent" style="height: 40px !important;">
                Ajouter
            </button>
            <!-- Modal add Etudiant -->
            <div class="modal fade" id="addStudent" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Ajouter un etudiant</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="addStudent" method="post">

                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form5Example1">Username</label>
                                    <input type="text" id="form5Example1" class="form-control" name="username" id="" required />

                                </div>
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form5Example1">Nom complet</label>
                                    <input type="text" id="form5Example1" class="form-control" name="fullname" id="" required />

                                </div>
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form5Example1">Email</label>
                                    <input type="text" id="form5Example1" class="form-control" name="email" id="" required />

                                </div>
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form5Example1">Adresse</label>
                                    <input type="text" id="form5Example1" class="form-control" name="adresse" id="" required />

                                </div>
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form5Example1">mot de passe</label>
                                    <input type="text" id="form5Example1" class="form-control" name="password" id="" required />

                                </div>
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form5Example1">numéro de téléphone</label>
                                    <input type="text" id="form5Example1" class="form-control" name="phone" id="" required />

                                </div>
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form5Example1">Nom du Class</label>
                                    <select name="classes" class="form-control" name="departement">

                                        <?php if (isset($_POST['id'])) { ?>
                                            <?php foreach ($classes as $class) {
                                                if ($_POST['id'] == $class['class_id']) { ?>
                                                    <option value="<?= $class['class_id'] ?>" selected>
                                                        <?= $class['class_name'] ?>
                                                    </option>
                                                <?php } else { ?>
                                                    <option value="<?= $class['class_id'] ?>">
                                                        <?= $class['class_name'] ?>
                                                    </option>

                                            <?php  }
                                            }
                                        } else { ?>

                                            <?php foreach ($classes as $class) { ?>
                                                <option value="<?= $class['class_id'] ?>">
                                                    <?= $class['class_name'] ?>
                                                </option>
                                            <?php } ?>
                                        <?php } ?>


                                    </select>

                                </div>
                                <button type="submit" class="btn btn-primary btn-block mb-4" name="ajouter">Ajouter</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>





        <table>
            <thead>
                <tr>
                    <td>Nom Complet</td>
                    <td class="text-start">Email</td>
                    <td class="text-start">Numéro</td>
                    <td class="text-start">classe</td>
                    <td class="text-start">Fillière</td>
                    <td class="text-center">Action</td>
                </tr>
            </thead>

            <tbody id="<?php echo (isset($_POST['id']) ? 'students' : '') ?>">
                <?php foreach ($students as $student) { ?>
                    <tr>
                        <td>
                            <?= $student['fullname'] ?>
                        </td>
                        <td class="text-start">
                            <?= $student['email'] ?>
                        </td>
                        <td class="text-start">
                            <?= $student['user_number'] ?>
                        </td>
                        <td class="text-start">
                            <?= $student['class_name'] ?>
                        </td>
                        <td class="text-start">
                            <?= $student['filliere_name'] ?>
                        </td>
                        <td class="d-flex justify-content-evenly py-2 mt-2 mx-2">
                            <button type="button" class="status btn delivered border-none mx-2" data-bs-toggle="modal" data-bs-target="#modifierStudent<?= $student['user_id'] ?>">Modifier</button>
                            <form action="deleteUser" method="post">
                                <input type="hidden" name="user_id" value="<?= $student['user_id'] ?>">
                                <button type="submit" class="status btn return border-none" onclick="return confirm('Êtes-vous sûr de vouloir supprimer l\'étudaint  <?= $student['fullname'] ?>  ?');">Supprimer</button>

                            </form>
                        </td>
                        <!-- modal for edit student datas -->
                        <div class="modal fade" id="modifierStudent<?= $student['user_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Modifier les données d'un étudiant
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="editStudent" method="post">
                                            <input type="hidden" name="user_id" value="<?= $student['user_id'] ?>">
                                            <div class="form-outline mb-4">
                                                <label class="form-label" for="form5Example1">Username</label>
                                                <input type="text" id="form5Example1" class="form-control" name="username" id="" value="<?= $student['username'] ?>" required />

                                            </div>
                                            <div class="form-outline mb-4">
                                                <label class="form-label" for="form5Example1">Nom complet</label>
                                                <input type="text" id="form5Example1" class="form-control" name="fullname" id="" value="<?= $student['fullname'] ?>" required />

                                            </div>
                                            <div class="form-outline mb-4">
                                                <label class="form-label" for="form5Example1">Email</label>
                                                <input type="text" id="form5Example1" class="form-control" name="email" id="" value="<?= $student['email'] ?>" required />

                                            </div>
                                            <div class="form-outline mb-4">
                                                <label class="form-label" for="form5Example1">Adresse</label>
                                                <input type="text" id="form5Example1" class="form-control" name="adresse" id="" value="<?= $student['user_adress'] ?>" required />

                                            </div>
                                            <div class="form-outline mb-4">
                                                <label class="form-label" for="form5Example1">mot de passe</label>
                                                <input type="text" id="form5Example1" class="form-control" name="password" id="" value="<?= $student['password_user'] ?>" required />

                                            </div>
                                            <div class="form-outline mb-4">
                                                <label class="form-label" for="form5Example1">numéro de téléphone</label>
                                                <input type="text" id="form5Example1" class="form-control" name="phone" id="" value="<?= $student['user_number'] ?>" required />

                                            </div>
                                            <div class="form-outline mb-4">
                                                <label class="form-label" for="form5Example1">Nom du Class</label>
                                                <select name="classes" class="form-control" name="class">


                                                    <?php foreach ($classes as $class) {
                                                        if ($student['class'] == $class['class_id']) { ?>
                                                            <option value="<?= $class['class_id'] ?>" selected>
                                                                <?= $class['class_name'] ?>
                                                            </option>
                                                        <?php } else { ?>
                                                            <option value="<?= $class['class_id'] ?>">
                                                                <?= $class['class_name'] ?>
                                                            </option>

                                                    <?php  }
                                                    }
                                                    ?>


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
        <form method="post" action="" id="FilterDepar">
            <input type="hidden" name="departement_id" value="" id="MyIds">
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
    let selectDep = document.querySelector('#selectDepartement');
    let inputs = document.querySelector('#MyIds');
    console.log(inputs);
    selectDep.addEventListener('change', (e) => {
        inputs.value = (e.currentTarget.value);
        document.getElementById("FilterDepar").submit();
    });
</script>
<?php $content = ob_get_clean(); ?>

<?php require('views/admin/layout.php');
