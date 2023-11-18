<?php

$Cour=new CourController();
$cours=$Cour->getCourofModule();
?>
<?php $title="module"?>
<?php ob_start();?>
<div class="container my-5">
<div class="row d-flex justify-content-center">
<div class="col-md-6">
    <div class="card">

       <div class="card-header bg-white d-flex justify-content-center">
          <img src="file/cour.png" alt="">
       </div>

        <div class="card-body">
            <div style="overflow-x:auto">
                <table class="table">
                 <thead class="bg-light text-primary">
                     <tr>
                         <td class="h6">Cour</td>
                         <td class="h6 text-center">fichier</td>
                         <td class="text-center h6">Date de publication</td>
                     </tr>
                 </thead>
                 <tbody>
                     <?php foreach($cours as $coure){?>
                      <tr>
                         <td class="h6"><?php echo $coure['cour_name']?></td>
                         <td class="text-center"><a href="file/<?php echo $coure['filename'];?>"><i class="fa-solid fa-eye text-info"></i></td>
                         <td class="text-center">
                         <?php echo $coure['date_pub']?>
                         </td>
                         </tr>
                     <?php } ?>
                 </tbody>
                </table>
            </div>
        </div>

    </div>
    </div>
 </div>
 </div>
<?php $content=ob_get_clean();?>
<?php include('views/includes/layout.php'); ?>