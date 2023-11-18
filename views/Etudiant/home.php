<?php $title = "Accueil"; ?>
<?php $news = NewsController::get();
$class = ClassController::get($_SESSION['user_info']['class']);

?>
<?php ob_start(); ?>
<div class="main my-5">
    <div class="row mt-0">
        <div class="offset-md-1 col-md-6 p-0 pe-2">
            <div class="main-text text-center text-md-start p-0" style="color: #0B2840;">
                <h1 class="mb-4 fw-bold">Bienvenue sur votre espace d'étudiant !</h1>

                <p class="m-0 w-md-75 p-md-0 ps-5 pe-5 pe-lg-5 fw-normal fs-5">
                    Notre mission est de fournir aux étudiants une
                    plateforme passionnante et attrayante pour explorer
                    les merveilles de l'univers et en apprendre davantage
                    sur les dernières découvertes spatiales
                </p>
            </div>
        </div>
        <div class="img col-md-5 p-0 mt-5 me-0" style="z-index: 1;">
            <img src="./assets/student.png" class="img-fluid ms-auto me-auto d-none d-md-block me-0" alt="">
        </div>
    </div>
    <div class="custom-shape-divider-bottom-1678992685">
        <svg data-name="Layer 1" viewBox="0 0 1200 120" preserveAspectRatio="none">
            <path d="M985.66,92.83C906.67,72,823.78,31,743.84,14.19c-82.26-17.34-168.06-16.33-250.45.39-57.84,11.73-114,31.07-172,41.86A600.21,600.21,0,0,1,0,27.35V120H1200V95.8C1132.19,118.92,1055.71,111.31,985.66,92.83Z" class="shape-fill"></path>
        </svg>
    </div>
</div>
<div class="blocks mt-5">
    <!-- <div class="heading text-center mb-5">
        <h2 class="fs-1 fw-bold">Nouveautées</h2>
    </div> -->
    <div class="row mt-5">
        <!-- <div class="lesson-block col-12 offset-lg-2 col-lg-8 pt-0 px-2 rounded border mt-5" style="background-color:#f7f7f7;">
            <div class="py-4 px-2">
                <?php
                if ((count($news) != 0)) { ?>
                    <div class="row mb-2 mt-0" style="border-color:var(--dark-blue);">
                        <div class="col"><span class="fst-normal ms-3" style="color: #1663ba;">Contenu</span></div>
                        <span class="col font-weight-light text-secondary me-3 text-end">Date du Publication</span>
                    </div>
                    <?php foreach ($news as $key => $new) { ?>
                        <div class="row bg-white p-2 rounded m-1" style="border-color:var(--dark-blue);">
                            <div class="col">
                                <div class="row align-items-center justify-content-between">
                                    <div class="col"><?= $new['news_content'] ?></div>
                                    <span class="col font-weight-light text-secondary text-end ms-0"><?= ActivityController::time($new["news_date"]) ?></span>
                                </div>
                                <form action="nouvelle" method="post">
                                    <input type="hidden" name="id" value="<?= $new['news_id'] ?>">
                                    <input type="submit" value="Voir plus" class="btn btn-primary">
                                </form>



                            </div>
                        </div>
                    <?php } ?>
                    <div class="d-flex justify-content-end">
                        <div class="my-2 w-25 ">

                            <a class="form-control btn btn-primary" href="nouvelles">Voir tous</a>
                        </div>

                    <?php } else {
                    echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;aucune Actualités";
                } ?>
                    </div>
            </div>
        </div> -->
        <?php
        if ($class['niveau'] == 2) { ?>
            <div class="heading text-center">
                <a href="choixFillieres" class="btn btn-primary">Choix du fillière</a>
            </div>
        <?php } ?>

        <div class="blocks mt-5">

            <div class="heading text-center">
                <h2 class="fs-1 fw-bold">Centre étudiant</h2>
            </div>
            <!-- from here -->
            <div class="container d-flex justify-content-center mt-5 position-relative">
                <div class="wrapper">
                    <i id="left" class="fa-solid fa-angle-left position-absolute " style="left: -10%; z-index:200"></i>
                    <ul class="carousel">

                        <li class="card actv d-flex justify-content-center text-center rounded m-4" style="background: linear-gradient(to left,#FFFFFF, #B3D8E0, #5899E2);">
                            <a href="showProfile" class="text-decoration-none my-auto" style="color: #0B2840;">
                                <div class="block my-auto">
                                    <div class="icon mb-3"><i class="fa-solid fa-user fs-3"></i></div>
                                    <div class="block-text">
                                        <h3 class="fw-bold fs-4">Profile</h3>
                                        <p>Vos informations</p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="card actv d-flex justify-content-center text-center rounded m-4 ">
                            <a href="modules" class="text-decoration-none my-auto" style="color: #0B2840;">
                                <div class="block my-auto">
                                    <div class="icon mb-3"><i class="fa-solid fa-book fs-3"></i></div>
                                    <div class="block-text">
                                        <h3 class="fw-bold fs-4">Modules</h3>
                                        <p>Accédez à vos leçons</p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="card actv d-flex justify-content-center text-center rounded m-4">
                            <a href="note" class="text-decoration-none my-auto" style="color: #0B2840;">
                                <div class="block my-auto">
                                    <div class="icon mb-3"><i class="fa-solid fa-note-sticky fs-3"></i></div>
                                    <div class="block-text">
                                        <h3 class="fw-bold fs-4">Espace d'affichage</h3>
                                        <p>Connaissez vos notes</p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="card actv d-flex justify-content-center text-center rounded m-4">
                            <a href="messanger" class="text-decoration-none my-auto" style="color: #0B2840;">
                                <div class="block my-auto">
                                    <div class="icon mb-3"><i class="fa-sharp fa-solid fa-comment fs-3"></i></div>
                                    <div class="block-text">
                                        <h3 class="fw-bold fs-4">Messager</h3>
                                        <p>Rapprochez-vous de votres collégues</p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="card actv d-flex justify-content-center text-center rounded m-4">
                            <a href="contact" class="text-decoration-none my-auto" style="color: #0B2840;">
                                <div class="block my-auto">
                                    <div class="icon mb-3"><i class="fa-solid fa-message fs-3"></i></div>
                                    <div class="block-text">
                                        <h3 class="fw-bold fs-4">Contact</h3>
                                        <p>Services administratifs</p>
                                    </div>
                                </div>
                            </a>
                        </li>
                    </ul>
                    <i id="right" class="fa-solid fa-angle-right position-absolute " style="right: -10%; "></i>
                </div>
            </div>
            <!-- to here -->
        </div>
    </div>
</div>

<!-- knjrb hna  -->
<div class="heading text-center mb-5">
    <h2 class="fs-1 fw-bold mt-5">Nouveautées</h2>
</div>
<section id="features" class="news-area pt-120">
    <div class="container">
        <div class="row justify-content-center">
            <?php foreach ($news as $new) { ?>
                <div class="new-card m-4">
                    <h3 class="new-card__title"><?= $new['news_content'] ?></h3>
                    <p class="new-card__content"><?= $new['news_desc'] ?> </p>
                    <div class="new-card__date mt-5">
                        <?= ActivityController::formatDateString($new['news_date']) ?>
                    </div>
                    <div class="new-card__arrow">
                        <form action="nouvelle" method="post">
                            <input type="hidden" name="id" value="<?= $new['news_id'] ?>">
                            <button type="submit" class="bg-transparent" style=" border:none"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" height="15" width="15">
                                    <path fill="#fff" d="M13.4697 17.9697C13.1768 18.2626 13.1768 18.7374 13.4697 19.0303C13.7626 19.3232 14.2374 19.3232 14.5303 19.0303L20.3232 13.2374C21.0066 12.554 21.0066 11.446 20.3232 10.7626L14.5303 4.96967C14.2374 4.67678 13.7626 4.67678 13.4697 4.96967C13.1768 5.26256 13.1768 5.73744 13.4697 6.03033L18.6893 11.25H4C3.58579 11.25 3.25 11.5858 3.25 12C3.25 12.4142 3.58579 12.75 4 12.75H18.6893L13.4697 17.9697Z"></path>
                                </svg></button>

                        </form>

                    </div>
                </div>
            <?php } ?>
        </div> <!-- row -->
    </div> <!-- container -->
    <div class="d-flex justify-content-center  mt-4">
        <a href="nouvelles" class="cssbuttons-io-button" style="text-decoration: none;"> Voir tous
            <div class="icon">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                    <path fill="none" d="M0 0h24v24H0z"></path>
                    <path fill="currentColor" d="M16.172 11l-5.364-5.364 1.414-1.414L20 12l-7.778 7.778-1.414-1.414L16.172 13H4v-2z"></path>
                </svg>
            </div>
        </a>
    </div>
</section>
<!-- knjrb hna  -->


<?php $content = ob_get_clean(); ?>

<?php require('views/includes/layout.php') ?>