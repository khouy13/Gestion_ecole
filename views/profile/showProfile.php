<?php $title = 'Profile';
$footer_color = '#dbedff';
?>
<?php ob_start(); ?>
<div style="margin-top: 100px;">
    <h1 class="text-center fw-bold mt-5 mb-5" style="color:var(--blue);">Mon Profile</h1>
</div>
<style>
    body{
    background-color: #dbedff;
}
.emp-profile{
    padding: 3%;
    margin-top: 3%;
    margin-bottom: 3%;
    border-radius: 0.5rem;
    background: #fff;
}
.profile-img{
    text-align: center;
}
.profile-img img{
    width: 70%;
    height: 100%;
}
.profile-img .file {
    position: relative;
    overflow: hidden;
    margin-top: -20%;
    width: 70%;
    border: none;
    border-radius: 0;
    font-size: 15px;
    background: #212529b8;
}
.profile-img .file input {
    position: absolute;
    opacity: 0;
    right: 0;
    top: 0;
}
.profile-head h5{
    color: #333;
}
.profile-head h6{
    color: #0062cc;
}
.profile-edit-btn{
    border: none;
    border-radius: 1.5rem;
    width: 70%;
    padding: 2%;
    font-weight: 600;
    color: #ffffff;
    background-color: var(--main-color);
    cursor: pointer;
}
.profile-edit-btn:hover{
    border: none;
    border-radius: 1.5rem;
    width: 70%;
    padding: 2%;
    font-weight: 600;
    color: #6c757d;
    background-color: var(--gray) ;
    cursor: pointer;
}
.nav-tabs{
    margin-bottom:5%;
}
.nav-tabs .nav-link{
    font-weight:600;
    border: none;
}
.nav-tabs .nav-link.active{
    border: none;
    border-bottom:2px solid #0062cc;
}
.profile-work{
    padding: 14%;
    margin-top: -15%;
}
.profile-work p{
    font-size: 12px;
    color: #818182;
    font-weight: 600;
    margin-top: 10%;
}
.profile-work a{
    text-decoration: none;
    color: #495057;
    font-weight: 600;
    font-size: 14px;
}
.profile-work ul{
    list-style: none;
}
.profile-tab label{
    font-weight: 600;
}
.profile-tab p{
    font-weight: 600;
    color: #0062cc;
}
</style>

<div class="container emp-profile">
            <form method="post" action="editProfile">
                <div class="row">
                    <div class="col-md-4">
                        <div class="profile-img mb-4">
                            <img class="rounded" src="./assets/imgsProfile/<?= $_SESSION['user_info']['img']; ?>" alt=""/>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="row mb-4 ">
                            <div class="col profile-head">
                                        <h5>
                                            <?= $_SESSION['user_info']['fullname']; ?>
                                        </h5>
                                        <h6>
                                            <?php if ($_SESSION['user_info']['statut'] == 3) { 
                                                echo "Classe : ".$_SESSION['class_name'];
                                            }else{
                                                echo "Departement ".$datas['departement_name']; 
                                            } ?>
                                        </h6>
                                    </div>
                        <div class="col">
                            <input type="submit" class="profile-edit-btn" name="btnAddMore" value="Edit Profile"/>
                        </div>
                        <div class="row">
                            <ul class=" col nav nav-tabs mt-4" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">About</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                <div class="row">
                    <div class="col">
                        <div class="tab-content profile-tab" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Nom Complet</label>
                                        </div>
                                        <div class="col-md-6">
                                            <p><?= $_SESSION['user_info']['fullname']; ?></p>
                                        </div>
                                    </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Nom d'utilisateur</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?= $_SESSION['user_info']['username']; ?></p>
                                            </div>
                                        </div>

                                        <?php if ($_SESSION['user_info']['statut'] == 3) { ?>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Nom de filliere</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <p><?= $datas['filliere_name']; ?></p>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <?php if ($_SESSION['user_info']['statut'] == 2) { ?>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Nom de departement</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <p><?= $datas['departement_name']; ?></p>
                                                </div>
                                            </div>
                                        <?php } ?>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Email</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?= $_SESSION['user_info']['email']; ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Phone</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?= $_SESSION['user_info']['user_number']; ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Adresse</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?= $_SESSION['user_info']['user_adress']; ?></p>
                                            </div>
                                        </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>

            </form>           
        </div>
<?php $content = ob_get_clean(); ?>
<?php include('views/includes/layout.php'); ?>