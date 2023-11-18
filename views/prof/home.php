<?php $title = "Accueil"; ?>
<?php $nbr_not = Messanger::getNumberMessagesNonSeen($_SESSION['user_info']['user_id']);
$nbr_classes = count(ClassController::getClassesOfProf());
$semestre = (isset($_POST['semestre']) && $_POST['semestre'] == 2) ? 2 : 1;
$nbr_modules = count(ModuleController::getModulesOfUser($semestre));
$news = NewsController::getAll();
$activities = ActivityController::getActivityOfProf();


// $footer_color = "#eeeeee";
ob_start(); ?>
<div class="home-prof d-flex align-items-center">
    <div class="home-prof-content text-center mt-5" style="color: #0B2840;">
        <h1 class="mb-4 fw-bold">Bienvenue sur votre espace professeur !</h1>
        <p class="w-75 mx-auto fw-normal fs-5">
            Notre mission est de fournir aux Professeur une
            plateforme passionnante et attrayante pour explorer
            les merveilles de l'univers et en apprendre davantage
            sur les dernières découvertes spatiales
        </p>
    </div>
    <div class="custom-shape-divider-bottom-1685367769">
        <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
            <path d="M600,112.77C268.63,112.77,0,65.52,0,7.23V120H1200V7.23C1200,65.52,931.37,112.77,600,112.77Z" class="shape-fill"></path>
        </svg>
    </div>
</div>
<!-- ======================= Cards ================== -->

<div class="container">

    <div class="cardBox">
        <div class="card">
            <div>
                <div class="numbers"><?= $nbr_classes ?></div>
                <div class="cardName">Classes </div>
            </div>

            <div class="iconBx">
                <i class="bi bi-building"></i>
            </div>
        </div>

        <div class="card">
            <div>
                <div class="numbers"><?= $nbr_modules ?></div>
                <div class="cardName">Modules</div>
            </div>

            <div class="iconBx">
                <i class="bi bi-book"></i>
            </div>
        </div>


        <div class="card">
            <div>
                <div class="numbers"><?= $nbr_not ?></div>
                <div class="cardName">Messages</div>
            </div>

            <div class="iconBx">
                <i class="bi bi-chat-dots"></i>
            </div>
        </div>
    </div>
    <!-- ================ activites ================= -->
    <div class="details">
        <div class="activites">
            <div class="cardHeader">
                <h2>activités récentes</h2>
            </div>
            <div class="table pe-5">
                <table>
                    <thead>
                        <tr>
                            <td>Nom</td>
                            <td class="pe-4">Date</td>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($activities as $activity) { ?>
                            <tr>
                                <td class="w-75">Tu <?= $activity['activity_content'] ?></td>
                                <td><?= ActivityController::time($activity['activity_date']) ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- ================= actualites ================ -->
        <div class="actualites">
            <div class="cardHeader">
                <h2>Actualités</h2>
            </div>
            <div class="table pe-2">
                <table>
                    <tr>
                        <th>Contenu</th>
                        <td align="right"><b> Date </b></td>
                    </tr>
                    <?php foreach ($news as $new) { ?>
                        <tr>
                            <td>
                                <h4><?= $new['news_content'] ?></h4>
                            </td>
                            <td class="text-end"><?= ActivityController::time($new['news_date']) ?></td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $content = ob_get_clean(); ?>
<?php require('views/includes/layout.php') ?>