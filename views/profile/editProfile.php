<?php
$USER = new EtudiantController();
$USER->modifierInfoUser();
if(isset($_POST['message'])){
    $result = $_POST['message'];
}

?>
<?php 
$title = 'Modifier Profile';
$footer_color = '#dbedff';
?>
<?php ob_start(); ?>

<style>
body {
    background-color: #dbedff;
    margin-top: 150px;
}

.labels {
    font-size: 11px;
}


</style>
<!-- <div style="margin-top: 100px;">
    <h1 class="text-center fw-bold mt-5 mb-5" style="color:var(--main-color);">Modifier Profile</h1>
</div> -->
<!-- <div class="container">

    <form class="container bg-light p-5 mb-5 border border-dark rounded" form action="" method="post" enctype="multipart/form-data">
        <div class="mb-3 text-center">
            <img class="rounded-circle" style="width:200px;height:200px" id="imgP" src="./assets/imgsProfile/<?= $_SESSION['user_info']['img']; ?>" alt="profile img">
        </div>
        <div class="mb-3">
            <label for="exampleInputfile" class="form-label fw-bold">Profile image</label>
            <input type="file" name="img" class="form-control ms-2" id="exampleInputfile" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="username" class="form-label fw-bold">Nom d'Utillisateur</label>
            <input type="text" class="form-control ms-2" id="username" aria-describedby="emailHelp" name="username" value="<?= $_SESSION['user_info']['username']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label fw-bold">Email</label>
            <input type="email" class="form-control ms-2" id="email" aria-describedby="emailHelp" name="email" value="<?= $_SESSION['user_info']['email']; ?>" required>
        </div>
        <div class="mb-3 position-relative">
            <label for="exampleInputPassword1" class="form-label fw-bold">Mot de passe</label>
            <input type="password" class="form-control ms-2" id="passwordEdit" name="password" value="<?= $_SESSION['user_info']['password_user']; ?>"></input> 
            <div style=" right: 17px;top: 38px;" id="changeVisibility" class="position-absolute"><i class="bi bi-eye"></i></div> 

        </div>
        <?php if (isset($result) && !empty($result)) {
            echo $result[0] == 'U'
                ? "<div class='alert alert-success' role='alert'>".$result."</div>"
                : "<div class='alert alert-danger' role='alert'>".$result."</div>";
        }   ?>
        <div class="text-center"><button type="submit" name="modifier" class="btn btn-primary">Modifier</button></div>

    </form>
</div> -->

<!-- knjreb hna  -->
<form  class="container rounded bg-white mt-5 mb-5" action="" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col-md-4 border-right">
            <div class='position-absolute ms-1 mt-2'>
                <a href="showProfile"><i class="bi bi-arrow-left fs-3"></i></a>
            </div>
            <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                <img class="rounded mt-2 mb-5" style="width:200px;height:200px" id="imgP" src="./assets/imgsProfile/<?= $_SESSION['user_info']['img']; ?>" alt="profile img">
                <span class="font-weight-bold">
                    <label for="exampleInputfile" class="form-label fw-bold">Image du profile</label>
                    <input type="file" name="img" class="form-control ms-2" id="exampleInputfile" aria-describedby="emailHelp">
                </span>
            </div>
        </div>
        <div class="col-md-7">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">Modifier Profile</h4>
                </div>
                <div class="row mt-2">
                    <?php if (isset($result) && !empty($result)) {
                        echo $result[0] == 'U'
                            ? " <div class='alert alert-info alert-dismissable'>
                                    <a class='panel-close close' data-dismiss='alert' style='cursor:pointer;'>×</a><i class='bi bi-check2 me-3'></i>mise à jour de vos informations avec succès
                                </div>"
                            : " <div class='alert alert-danger alert-dismissable'>
                                    <a class='panel-close close' data-dismiss='alert' style='cursor:pointer;'>×</a><i class='bi bi-exclamation-triangle-fill me-3'></i>une erreur s'est produite, réessayez !
                                </div>";
                    }?>
                    <div class="col-md-6">
                        <label class="labels">Nom Complet</label>
                        <input type="text" class="form-control" value="<?= $_SESSION['user_info']['fullname']; ?>" disabled>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12">
                        <label class="labels">Nom d'utilisateur</label>
                        <input type="text" class="form-control" id="username" aria-describedby="emailHelp" name="username" value="<?= $_SESSION['user_info']['username']; ?>" required>
                    </div>
                    <div class="col-md-12">
                        <label class="labels">Email</label>
                        <input type="text" class="form-control" id="email" aria-describedby="emailHelp" name="email" value="<?= $_SESSION['user_info']['email']; ?>" required>
                    </div>
                    <div class="col-md-12">
                        <label class="labels">Mot de passe</label>
                        <input type="password" class="form-control" id="passwordEdit" name="password" value="<?= $_SESSION['user_info']['password_user']; ?>"></input>
                        <div style=" right: 20px;top: 38px;cursor:pointer" id="changeVisibility" class="position-absolute"><i class="bi bi-eye"></i></div>
                    </div>
                </div>
                <div class="mt-5 text-center"><button class="btn btn-primary profile-button" type="submit" name="modifier">Modifier</button></div>
            </div>
        </div>
    </div>
    </form>
</div>
</div>
<!-- knjreb hna  -->

<?php $content = ob_get_clean(); ?>
<?php include('views/includes/layout.php'); ?>