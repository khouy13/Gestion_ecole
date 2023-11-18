<?php
$Message=new MessageController();
$messages=$Message->getAllMessage();
?>
<?php $title="meassge"?>
<?php ob_start();?>
<div class="container">
<div class="row d-flex justify-content-center">
<div class="col-md-6">
     <div class="card bg-white my-5">
        <div class="card-header bg-white d-flex justify-content-center">
            <img src="file/alert.png" alt="">
        </div>
        <div class="card-body">
            <div style="overflow-x:auto">
                <table class="table">
                 <thead class="bg-light text-primary">
                     <tr> 
                         <td class="h6">Message</td>
                     </tr>
                 </thead>
                 <tbody>
                     <?php foreach($messages as $message){?>
                      <tr>
                         <td>
                             <div class="alert alert-info">
                                 <p>
                                     <?php echo $message['message_content']?>
                                 </p>
                               <p class="text-primary text-end"><?php echo $message['date_pub']?></p>
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