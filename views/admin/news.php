<?php $title = "News" ?>
<?php ob_start();
$news = NewsController::getAll();
?>

<div class="details-table">
    <div class="activities">
        <div class="cardHeader">
            <h2 class="fw-bold">Nouveautés</h2>


            <div>
                <button type="button" class="status btn delivered border-none mx-3" data-bs-toggle="modal" data-bs-target="#addNews">
                    Ajouter un nouveau
                </button>
            </div>
            <!-- Modal add new -->
            <div class="modal fade" id="addNews" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="addNews" method="post" enctype="multipart/form-data">
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form5Example1"> titre du nouveauté</label>
                                    <textarea id="form5Example1" class="form-control" name="news_content" id=""></textarea>
                                </div>
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form5Example1">Contenu</label>
                                    <textarea id="form5Example1" class="form-control" name="desc" id=""></textarea>
                                </div>
                                <div>
                                    <label class="form-label" for="form5Example1">Consernant qui ce nouveau</label>
                                    <select name="news_statut" id="" class="form-control mb-2">
                                        <option value="0">Tout le monde</option>
                                        <option value="1">Les enseignants</option>
                                        <option value="2">Les étudiants</option>
                                    </select>
                                </div>
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form5Example1">Insérer une image</label>
                                    <input type="file" name="img" class="form-control ms-2" id="exampleInputfile" aria-describedby="emailHelp">
                                </div>

                                <button type="submit" class="btn btn-primary btn-block mb-4">Ajouter</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="bg-white p-4 pt-2 rounded" style="overflow-x: auto;">
            <table>
                <thead class="mb-5  ">
                    <tr>
                        <td class="text-start">Titre</td>
                        <td class="text-start">Contenu</td>
                        <td class="text-start">Date de publication</td>
                        <td class="text-center">Recepteur</td>
                        <td>image</td>
                        <td class="text-center">Action</td>
                    </tr>
                </thead>

                <tbody id="">
                    <?php foreach ($news as $new) { ?>
                        <tr>
                            <td>
                                <div style="height:100px;overflow-y:auto;text-align: start !important;" class="px-3"><?= $new['news_content'] ?></div>
                            </td>
                            <td>
                                <div style="height:100px;overflow-y:auto;text-align: start !important;" class="px-3"><?= $new['news_desc'] ?></div>
                            </td>
                            <td class="text-start"><?= ActivityController::formatDateString($new['news_date']) ?></td>
                            <td class="text-center">
                                <?php echo $new['news_statut'] == '0' ? " Tout le monde" : ($new['news_statut'] == '1' ? "Les enseignants" : "Les étudiants"); ?>
                            </td>
                            <td style="height:100px">
                                <?php if ($new['news_img'] != null) { ?>
                                    <img src="<?= $new['news_img'] ?>" alt="" class="img-fluid news_img" style="height:100px;width:auto !important;cursor:pointer">
                                <?php } ?>
                            </td>
                            <td class="d-flex justify-content-evenly py-2">
                                <button type="button" class="status btn delivered border-none mx-3" data-bs-toggle="modal" data-bs-target="#modifierNews<?= $new['news_id'] ?>">
                                    Modifier
                                </button>
                                <form action="DeleteNews" method="post">
                                    <input type="hidden" name="news_id" value="<?= $new['news_id'] ?>">
                                    <button type="submit" class="status btn return border-none" onclick="return confirm('Êtes-vous sûr de vouloir le supprimer  ?');">
                                        Supprimer
                                    </button>
                                </form>
                            </td>
                            <!-- Modal of Modifier Module -->
                            <div class="modal fade" id="modifierNews<?= $new['news_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="updateNews" method="post" enctype="multipart/form-data">
                                                <input type="hidden" name="news_id" value="<?= $new['news_id'] ?>">
                                                <div class="form-outline mb-4" style="height:100px">
                                                    <img class="img-fluid" src="<?= $new['news_img'] ?>" alt="image du nouveauté" style="    height: 100px;">
                                                </div>
                                                <div class="form-outline mb-4">
                                                    <label class="form-label" for="form5Example1"> titre du nouveauté</label>
                                                    <textarea id="form5Example1" class="form-control" name="news_content" id=""><?= $new['news_content'] ?></textarea>
                                                </div>
                                                <div class="form-outline mb-4">
                                                    <label class="form-label" for="form5Example1">Contenu</label>
                                                    <textarea id="form5Example1" class="form-control" name="desc" id=""><?= $new['news_desc'] ?></textarea>
                                                </div>

                                                <div>
                                                    <label class="form-label" for="form5Example1">Consernant qui ce nouveau</label>
                                                    <select name="news_statut" id="" class="form-control mb-2">
                                                        <option value="0" <?= $new['news_statut'] == '0' ? "selected" : "" ?>>Tout le monde</option>
                                                        <option value="1" <?= $new['news_statut'] == '1' ? "selected" : "" ?>>Les enseignants</option>
                                                        <option value="2" <?= $new['news_statut'] == '2' ? "selected" : "" ?>>Les étudiants</option>
                                                    </select>
                                                </div>
                                                <div class="form-outline mb-4">
                                                    <label class="form-label" for="form5Example1">Insérer une image</label>
                                                    <input type="file" name="img" class="form-control ms-2" id="exampleInputfile" aria-describedby="emailHelp">
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
        </div>
    </div>
</div>
<div id="imageModal" class="modal">
    <span class="close" onclick="closeModal()">&times;</span>
    <img src="" id="zoomedImg">
</div>

<style>
    .modal {
        display: none;
        position: fixed;
        z-index: 9999;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.8);
    }

    .modal img {
        display: block;
        margin: auto;
        max-width: 90%;
        max-height: 90%;
    }

    .close {
        position: absolute;
        top: 15px;
        right: 35px;
        color: #fff;
        font-size: 40px;
        font-weight: bold;
        cursor: pointer;
    }

    .close:hover,
    .close:focus {
        color: #bbb;
        text-decoration: none;
        cursor: pointer;
    }
</style>
<script>
    let imgs = document.querySelectorAll('.news_img');
    let img = document.getElementById("zoomedImg");
    var modal = document.getElementById('imageModal');
    imgs.forEach(el => {
        el.addEventListener('click', e => {
            img.src = e.target.src;
            modal.style.display = "block";
            document.querySelector('.activities').style.overflow = "hidden"; // Hide
        })
    })

    function closeModal() {
        var modal = document.getElementById("imageModal");

        modal.style.display = "none";
        document.document.querySelector('.activities').style.overflow = "auto"; // Restore scrollbars when the modal is closed
    }
</script>

<?php $content = ob_get_clean(); ?>

<?php require('views/admin/layout.php');
