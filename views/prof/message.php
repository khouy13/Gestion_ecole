<?php
$Message=new MessageController();
$messages=$Message->getAllMessage();
$Message->inserer();
$Message->suprimer();
?>
<?php $title="meassge"?>
<?php ob_start();?>
<div class="container">
<div class="row d-flex justify-content-center">
<div class="col-md-6">
     <div class="card bg-white my-5">
        <div class="card-header bg-white">
            <div class=" d-flex f justify-content-center">
                <img src="file/alert.png" alt="">
            </div>
            <form method="post" class="d-flex justify-content-center">
                 <textarea class="border-info" name="message_content" cols="40" placeholder="message" required></textarea>
                 <input type="hidden" name="module_id" value="<?php echo $_SESSION['module_id'];?>">
                 <button type="submit" name="ajouter" class="bg-info text-white border-0"><i class="fa-solid fa-share"></i></button>
            </form>
        </div>
        <div class="card-body">
            <div style="overflow-x:auto">

                <table class="table">
                 <thead class="bg-light h6">
                     <tr> 
                         <td class="h6">Message</td>
                     </tr>
                 </thead>
                 <tbody>
                     <?php foreach($messages as $message){?>
                      <tr>
                         <td class="h6">
                         <div class="alert p-2 alert-info"> 
                              <form action="" method="post" class="text-end mt-0">
                                 <input type="hidden" name="message_id" value="<?= $message['message_id'];?>">
                                 <button type="submit" name="suprimer" class="btn text-danger"><i class="fa-solid fa-trash h5"></i></button>
                             </form>
                            <p><?php echo $message['message_content']?></p>
                            <p class="text-primary text-end">
                            <?php echo $message['date_pub']?>
                            </p>
                          </div>
                         </td>
                         </tr>
                     <?php } ?>
                 </tbody>
                </table>
            </div>
        </div>
    </div>
     </div>
<?php $content=ob_get_clean();?>
<?php include('views/includes/layout.php'); ?>