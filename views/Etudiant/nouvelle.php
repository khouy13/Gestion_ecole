<?php $title = "Nouvelle"; ?>
<?php $new = NewsController::getNew();

?>
<?php ob_start(); ?>
<style>
.task {
    position: relative;
    color: #2e2e2f;
    cursor: move;
    background-color: #fff;
    padding: 1rem;
    border-radius: 8px;
    box-shadow: rgba(99, 99, 99, 0.1) 0px 2px 8px 0px;
    margin-bottom: 1rem;
    border: 3px dashed transparent;
}

.task:hover {
    box-shadow: rgba(99, 99, 99, 0.3) 0px 2px 8px 0px;
    border-color: rgba(162, 179, 207, 0.2) !important;
}

.task p {
    font-size: 15px;
    margin: 1.2rem 0;
}

.tag {
    border-radius: 100px;
    padding: 4px 13px;
    font-size: 15px;
    color: #ffffff;
    background-color: #1389eb;
}


.stats {
    position: relative;
    width: 100%;
    color: #9fa4aa;
    font-size: 15px;
}

.stats svg {
    margin-right: 5px;
    height: 100%;
    stroke: #9fa4aa;
}




</style>
<div class="blocks mt-5 container">
    <h3 class="fs-1 fw-bold mt-5 pt-5 text-center mb-5"><?= $new['news_content'] ?></h3>
    <div class="row">
        <div class="col-12 col-md-6">
                <img src="<?= $new['news_img'] ?>" class="img-fluid rounded" alt="">
        </div>
        <div class="col-12 col-md-6 d-flex align-items-center mt-5 mt-md-0 w-50" >
            <div class="task" draggable="true">
            <div class="tags mb-5">
                <span class="tag">Description</span>
            </div>
            <p></p>
                <div class="stats">
                    <div><?= $new['news_desc'] ?></div>
                    <div class="mt-4" ><i class="bi bi-clock"></i>&nbsp;&nbsp;</svg><?= ActivityController::formatDateString($new['news_date']) ?></div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php $content = ob_get_clean(); ?>

<?php require('views/includes/layout.php') ?>