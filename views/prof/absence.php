<?php
setlocale(LC_TIME,'fr_FR');
$month = date('n');
$currentMonth = date('n');
$year = date("Y");
$modules = ModuleController::getModulesOfUser();

if (isset($_POST['month']) && $month > 0 && $month < 13) {
    $month = $_POST['month'];
    if ($month >= 9 && $currentMonth >= 1) {
        $year--;
    }
    if ($month <= 7 && $currentMonth >= 9) {
        $year++;
    }
}
if (isset($_POST['message']) && $month > 0 && $month < 13) {
    $month = $_POST['message'];
    if ($month >= 9 && $currentMonth >= 1) {
        $year--;
    }
    if ($month <= 7 && $currentMonth >= 9) {
        $year++;
    }
}
if (isset($_POST['id'])) {
    $students = EtudiantController::getStudentsByModel($_POST['id']);
    $datas=AbsenceController::getAbsencesOfModule($month,$_POST['id']);
    $seancesOfprof=EmploiController::getSeance($_SESSION['prof_id'],$_POST['id']);
}
$months = [
    ['value' => 1, 'name' => 'janvier'],
    ['value' => 2, 'name' => 'février'],
    ['value' => 3, 'name' => 'mars'],
    ['value' => 4, 'name' => 'avril'],
    ['value' => 5, 'name' => 'mai'],
    ['value' => 6, 'name' => 'juin'],
    ['value' => 9, 'name' => 'septembre'],
    ['value' => 10, 'name' => 'octobre'],
    ['value' => 11, 'name' => 'novembre'],
    ['value' => 12, 'name' => 'décembre'],
];
?>
<?php $title = "Modules" ?>
<?php ob_start(); ?>
<style>
    .note-main {
        width: 100%;
        padding: 20px;
    }
    .note-card {
        position: relative;
        background: var(--white);
        padding: 30px;
        border-radius: 20px;
        height: 250px;
        cursor: pointer;
        box-shadow: 0 7px 25px rgba(0, 0, 0, 0.08);
        border: 1px solid #D3D3D3;
    }

    .custom-shape-divider-top-1684313088 {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        overflow: hidden;
        line-height: 0;
        background: linear-gradient(to right, #B3D8E0, #5899E2);
        border-radius: 20px;
        border: 1px solid white;
    }

    .custom-shape-divider-top-1684313088 svg {
        position: relative;
        display: block;
        width: calc(300% + 1.3px);
        height: 72px;
    }

    .custom-shape-divider-top-1684313088 .shape-fill {
        fill: #FFFFFF;
    }

    .note-button {
        bottom: 50px;
        right: 30px;
    }
   
    ::-webkit-scrollbar {
    width: 0px;
    }
</style>
<?php if (!isset($_POST['id'])) { ?>
    <div class="container" style="height: 80vh;">

        <div class="row justify-content-center text-center note-main" style="margin-top: 100px;">
            <?php foreach ($modules as $module) {
            ?>
                <div class="note-card col-lg-3 col-md-4 col-10 m-2 py-5 px-2">
                    <h4 class="fw-bold text-start" style="color: #296090"><?= $module['module_name'] ?></h4>
                    <h5 class="mt-4"><?= $module['class_name'] ?></h5>
                    <form action="" method="post" class="py-0">
                        <input type="hidden" name="id" value="<?= $module['module_id'] ?>">
                        <button class="bg-white note-button border-0 py-2 my-1 z-3 position-absolute text-primary " name="module" type="submit">
                            voir plus &nbsp; <i class="bi bi-arrow-right"></i>
                        </button>
                    </form>
                    <div class="custom-shape-divider-top-1684313088">
                        <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                            <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" opacity=".25" class="shape-fill"></path>
                            <path d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z" opacity=".5" class="shape-fill"></path>
                            <path d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z" class="shape-fill"></path>
                        </svg>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    <p>
      
    </p>
    <?php } else{?>
<div class="container d-flex mt-5 pt-5" style="min-height:100vh;align-items:center;">
<div class="container">
<form action="" method="post">

            <label for="month">Selectioner un mois:</label>
            <select id="month" name="month">
                <?php foreach ($months as $monthh) {
                    if ($monthh['value'] == $month) { ?>
                        <option id="" value="<?= $monthh['value'] ?>" selected><?= $monthh['name'] ?></option>

                    <?php } else { ?>
                        <option id="" value="<?= $monthh['value'] ?>"><?= $monthh['name'] ?></option>
                <?php }
                } ?>
            </select>
        </form>
<div style="overflow-x: auto;overflow-y: auto;">
    <table class="table table-bordered border-primary">
      <thead class="bg-light">  
          <?php $nbrjour=cal_days_in_month(CAL_GREGORIAN,$month,$year); ?>
          <tr>
                <th rowspan="2">Nom etudient</th>
                <th rowspan="2">seance</th>
                <?php for($jour=1;$jour<=$nbrjour;$jour++){
                    $timestamp=mktime(0,0,0,$month,$jour,$year);
                    ?>
                <th>
                    <?php echo date('D',$timestamp); ?>
                </th>
                <?php } ?>
                </tr>
                <tr>
                <?php 
               for($jour=1;$jour<=$nbrjour;$jour++){ ?>
                  <th><?= $jour ?></th>
                  <?php } ?>
                </tr>
            </thead>
            <tbody>
                <form action="AddAbsence" method="post">
            <?php foreach($datas as $data){ ?>
                <?php for($i=0;$i<sizeof($seancesOfprof);$i++){ ?>
                <tr>
                    <?php if($i==0) {?>
                        <td rowspan="<?= sizeof($seancesOfprof) ?>"><?= $data['info_user']['username'] ?></td>
                        <?php } ?>
                        <td  style="width:100px !important"><?=$seancesOfprof[$i]['name_temps'] ?></td> 
                        <?php for($jour=1;$jour<=$nbrjour;$jour++){ ?> 
                            <td>
                                <?php if($seancesOfprof[$i]['name_jour'] == date('D',mktime(0,0,0,$month,$jour,$year))) {?>
                                    <?php  $date=$year.'-'.$month.'-'.$jour;
                                    $test=false;
                                    foreach($data['absence'] as $absence){
                                        if($absence['absence_user']==$data['info_user']['user_id'] && $jour == date('d',strtotime($absence['absence_date']))&& $absence['id_seance']==$seancesOfprof[$i]['id'] ){
                                            $test=true;
                                        }
                                    }
                                        if($test){
                                    ?>
                                    <input type="checkbox" name="abs[]" value="<?=$jour.'-'.$seancesOfprof[$i]['id'].'-'.$data['info_user']['user_id']?>" checked="checked">
                                    <?php } else { ?>
                                    <input type="checkbox" name="abs[]" value="<?=$jour.'-'.$seancesOfprof[$i]['id'].'-'.$data['info_user']['user_id']?>">
                                    <?php } } else {?>
                                        <input type="checkbox" name=""  disabled>
                                        <?php } ?>
                                    </td> 
                                    <?php } ?>   
                                </tr>
                            <?php } ?>
                        <?php } ?>
                        <tfoot>
                            <tr>
                              <th>
                                <input type="hidden" name="month" value="<?= $month ?>">
                                <input type="hidden" name="module" value="<?= $_POST['id'] ?>">
                                <input type="hidden" name="year" value="<?= $year ?>">
                                <input type="submit" class="btn btn-danger" name="enregistrer" value="enregistrer">
                                </th>
                            </tr>
                        </tfoot>
                     </form>
                </tbody>
          </table>        
            </div>
            <div>
                <?php
                // if(isset($_POST['id'])){
                //      print_r($datas);
                // }
                ?>
            </div>
            </div>
    <form method="post" action="" id="FilterClass">
        <input type="hidden" name="month" value="" id="MyId">
        <input type="hidden" name="id" value="<?= $_POST['id'] ?>">
    </form>

</div>
<?php } ?>
<script>
    let select = document.querySelector('#month');
    let input = document.querySelector('#MyId');
    select.addEventListener('change', (e) => {
        input.value = (e.currentTarget.value);
        document.getElementById("FilterClass").submit();
    });
</script>
<?php $content = ob_get_clean(); ?>
<?php include('views/includes/layout.php'); ?>