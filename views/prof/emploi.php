<?php
[$moudules,$temps,$jours]=ModuleController::ModulesOfProf($_SESSION['prof_id']);
$emploi=new EmploiController();
?>

<?php $title = "Emploi du temps"; ?>
<?php ob_start(); ?>
<style>
    td,th{
        text-align:center;
    }
</style>
<div style="height:100vh;display:flex;justify-content:center;align-items:center">
   <div class="w-100 d-flex justify-content-center">

       <table class="w-75 table-striped table-bordered" height="400px"  style="box-shadow:0px 5px 25px rgb(1 1 1/15%)">
           <thead>
        <tr>
            <th></th>
            <?php foreach($temps as $temp){?>
                <th><?= $temp['name_temps'] ?></th>
                <?php }  ?>
            </tr>
        </thead>
        <tbody>
            <?php   foreach($jours as $jour){?>
                <tr>
                    <th><?= $jour['nom_jour']?></th>
                    <?php foreach($temps as $temp){?>
                        
                        <td><?php 
                    echo $emploi->aficheEmploi(['id_prof'=>$_SESSION['prof_id'],'id_temps'=>$temp['id'],'id_jour'=>$jour['id_jour']]);    
                    ?></td>
                    <?php }?>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<?php $content = ob_get_clean(); ?>
<?php require('views/includes/layout.php') ?>