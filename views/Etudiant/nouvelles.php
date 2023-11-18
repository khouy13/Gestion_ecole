<?php $title = "Nouvelles"; ?>
<?php $news = NewsController::getAll(); ?>
<?php ob_start(); ?>

<div class="blocks mt-5">
    <div class="heading text-center mt-5">
        <h2 class="fs-1 fw-bold mt-5 pt-5">Nouveautées</h2>
    </div>
    <div class="row mt-5">
        <div class="lesson-block col-12 offset-lg-2 col-lg-8 pt-0 px-2 rounded border mt-5" style="background-color:#f7f7f7;">
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
                    <?php } else {
                    echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;aucune Actualités";
                } ?>
                    </div>
            </div>
        </div>
    </div>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('views/includes/layout.php') ?>