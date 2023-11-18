<?php $title = "Acceuil" ?>
<?php
$nbr_depar = count(DepartementController::getAllDepartement());
$nbr_fill = count(FilliereController::getAllFillieres());
$nbr_profs = count(EtudiantController::getAllProfs());
$nbr_students = count(EtudiantController::getAllStudents());
$news = NewsController::get();
$demandes = ServiceController::getAllServices();
$activities = ActivityController::getAll();
$current_date = new DateTime();

?>
<?php ob_start(); ?>
<style>
.home-admin{
    background: var(--white);
    padding: 30px;
    border-radius: 20px;
    box-shadow: 0 7px 25px rgba(0, 0, 0, 0.08);
}
</style>
    <div class="home-admin d-md-flex justify-content-evenly mx-3">
        <p class="text-center" style="font-weight: 500;font-size: 1.5rem;">
            <span class="fw-bold" style="color:var(--blue);">Année universitaire</span> <br> <?php echo (intval($_SESSION['annee_universitaire']) - 1) ?>/<?= $_SESSION['annee_universitaire'] ?>
        </p>
        <div class="text-center d-flex align-items-center justify-content-center cardHeader">
            <?php if ($_SESSION['current_semestre'] == 1) { ?>
                <form action="nextSemestre" method="post">
                    <input type="submit" class="btn" value="Passer au deuxième semestre" onclick="return confirm('Êtes-vous sûr    ?');">
                </form>
            <?php } else { ?>
                <form action="nextAnnee" method="post">
                    <input type="submit" class="btn" value=" Passer au année universitaire <?= $_SESSION['annee_universitaire'] ?>/<?php echo (intval($_SESSION['annee_universitaire']) + 1) ?>" onclick="return confirm('Êtes-vous sûr ?');">
                </form>
                <?php } ?>
            </div>
        <p class="text-center" style="font-weight: 500;font-size: 1.5rem;">
            <span class="fw-bold" style="color:var(--blue);">Semestre</span> <br> <?= $_SESSION['current_semestre'] ?>
        </p>
</div>
<!-- ======================= Cards ================== -->
<div class="cardBox">
    <div class="card">
        <div>
            <div class="numbers"><?= $nbr_depar ?></div>
            <div class="cardName">Départements </div>
        </div>

        <div class="iconBx">
            <i class="bi bi-building"></i>
        </div>
    </div>

    <div class="card">
        <div>
            <div class="numbers"><?= $nbr_fill ?></div>
            <div class="cardName">Choix de carrière</div>
        </div>

        <div class="iconBx">
            <i class="bi bi-signpost-split"></i>
        </div>
    </div>

    <div class="card">
        <div>
            <div class="numbers"><?= $nbr_profs ?></div>
            <div class="cardName">Enseignants chercheurs</div>
        </div>

        <div class="iconBx">
            <i class="bi bi-book"></i>
        </div>
    </div>

    <div class="card">
        <div>
            <div class="numbers"><?= $nbr_students ?></div>
            <div class="cardName">Élèves ingénieurs</div>
        </div>

        <div class="iconBx">
            <i class="bi bi-mortarboard"></i>
        </div>
    </div>

</div>

<!-- ================ activities List ================= -->
<div class="details">
    <div class="activities">
        <div class="cardHeader">
            <h2>Nouveautés</h2>
            <a href="news" class="btn">Voir tous</a>
        </div>

        <table>
            <thead>
                <tr>
                    <td>Nom</td>
                    <td></td>
                    <td class="text-center">Action</td>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($news as $new) { ?>
                    <tr>
                        <td>
                            <?= $new['news_content'] ?>
                        </td>
                        <td></td>
                        <td>
                            <form action="DeleteNews" method="post">
                                <input type="hidden" name="news_id" value="<?= $new['news_id'] ?>">
                                <button type="submit" class="status btn return border-none">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                <?php } ?>

            </tbody>
        </table>
    </div>

    <!-- ================= New Customers ================ -->
    <div class="Demandes">
        <div class="cardHeader">
            <h2>Demandes</h2>
            <a href="services" class="btn">Voir tous</a>
        </div>

        <table>
            <thead>
                <tr>
                    <td>Type de demande</td>
                </tr>
            </thead>
            <?php foreach ($demandes as $demande) { ?>
                <tr>
                    <td>
                        <h4><?= $demande['service_type'] ?><br><span><?= $demande['fullname'] ?></span></h4>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('views/admin/layout.php');
