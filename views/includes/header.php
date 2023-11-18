<nav class="navbar navbar-expand-lg bleu-back fixed-top">
    <div class="container">
        <div class="d-flex justify-content-center"><img src="assets/ensas.png" width="80px" alt=""></div>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mb-2 mb-lg-0 ms-auto fw-semibold">
                <li class="nav-item my-auto me-2">
                    <a class="nav-link" aria-current="page" href="home">Accueil</a>
                </li>
                <li class="nav-item dropdown my-auto me-2">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" href="modules">
                        Modules
                    </a>
                    <ul class="dropdown-menu py-0 modules">
                        <?php
                        foreach ($_SESSION['modules'] as $module) { ?>
                            <form action="module" method="post" class="py-0 border-bottom">
                                <input type="hidden" name="id" value="<?= $module['module_id'] ?>">
                                <button class="bg-transparent border-0 py-2 my-1" name="module" type="submit">
                                    <?= $module['module_name'] ?>
                                </button>
                            </form>
                        <?php
                        } ?>
                    </ul>
                </li>
                <li class="nav-item my-auto me-2">
                    <a class="nav-link" href="note">Espace d'Affichage</a>
                </li>
                <?php if ($_SESSION['user_info']['statut'] == 2) { ?>
                    <li class="nav-item my-auto me-2">
                        <a class="nav-link" href="absence">Absence</a>
                    </li>
                   
                <?php } ?>
                <li class="nav-item my-auto me-2">
                        <a class="nav-link" href="emploi">emploi du temps</a>
                </li>
                <li class="nav-item my-auto me-2">
                    <a class="nav-link" href="messanger">Messanger<span class="text-danger" style="font-size: 14px;position: absolute;top:-35%;right:-29%"><?php if (isset($_SESSION['nbr_Messages_NSeen']) and $_SESSION['nbr_Messages_NSeen'] != 0) {
                                                                                                                                                                echo $_SESSION['nbr_Messages_NSeen'];
                                                                                                                                                            } ?></span></i></a>
                </li>
                <li class="nav-item my-auto me-2">
                    <a class="nav-link" aria-current="page" href="contact">Services</a>
                </li>

                <?php if ($_SESSION['user_info']['statut'] == 3) { ?>
                    <li class="nav-item d-flex align-items-center dropdown profile mx-lg-3">
                        <a class="nav-link font-weight-bold dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                            <i class="bi bi-bell-fill text-dark"><span class="text-danger" style="font-size: 14px;position: absolute;top:0;right:40%"><?php if ($_SESSION['notifications_nbr'] != 0) {
                                                                                                                                                            echo $_SESSION['notifications_nbr'];
                                                                                                                                                        } ?></span></i>
                        </a>
                        <div class="dropdown-menu ">
                            <?php if (!empty($_SESSION['notifications'])) {
                            ?>
                                <div style="position: absolute;max-height: 200px;max-width: 500px;right: 10px;overflow-x: auto;overflow-y: auto;">
                                    <?php foreach ($_SESSION['notifications'] as $notification) { ?>
                                        <form action="module" method="post" class="py-0">
                                            <input type="hidden" name="id" value="<?= $notification['notification_module'] ?>">
                                            <input class=" form-control input-lg font-weight-bold" type="submit" value="<?= $notification['notification_content'] ?>">
                                        </form>
                                    <?php } ?>
                                </div>
                            <?php } else { ?>
                                <span class="dropdown-item">Aucun notification </span>
                            <?php } ?>
                        </div>
                    </li>
                <?php } ?>
                <li class="nav-item dropdown my-auto">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><img src="./assets/imgsProfile/<?= $_SESSION['user_info']['img'] ?>" width="40px" height="40px" class="rounded-circle me-2" alt="">
                        <?= $_SESSION['user_info']['username'] ?>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="showProfile">Mon Profil</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <form class="dropdown-item" method="post"><button type="submit" name="logout" class="border-0 m-0 dropdown-item" style="background-color:inherit" title="deconexion">Deconnexion</button></form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>