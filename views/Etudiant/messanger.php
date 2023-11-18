<?php
if (isset($_POST['id'])) {
    $sendMessage = new MessangerController();
    $sendMessage->AddMessageToMessanger();
    $sendMessage->DeleteMessage();
    $title = "messanger";
    $message = new  MessangerController();
    [$user, $messagesContents] = $message->MessangerWith($_POST['id']);
    $messageAncien = "";
}
$messanger = new MessangerController();
[$profiles, $messages] = $messanger->getProfilesAndMessages();


$messageAncien = "";
function maxLength($str)
{
    if (strlen($str) < 40) {
        return $str;
    }
    return substr($str, 0, 40) . "...";
}
$footer_color = "#eeeeee";

//time function

function date_diff_from_now(string $date_str): string
{
    $current_date = new DateTime();
    $given_date = new DateTime($date_str);
    $diff = $given_date->diff($current_date);

    $total_seconds = $diff->s + $diff->i * 60 + ($diff->h - 2) * 3600 + $diff->days * 86400;


    if ($total_seconds < 60) {
        return "Maintenant";
    }

    if ($total_seconds < 3600) {
        if ($diff->i == 1) {
            return "il y'a une minute";
        }
        return "il y' a " . floor($total_seconds / 60) . " minutes";
    }

    if ($total_seconds < 86400) {
        if ($diff->h == 1) {
            return "il y'a une heure";
        }
        return "il y' a " . floor($total_seconds / 3600) . " heures";
    }

    if ($total_seconds < 604800) {
        if ($diff->days == 1) {
            return "Hier";
        }
        return "il y' a " . floor($total_seconds / 86400) . " jours";
    }

    if ($total_seconds < 2592000) {
        if (floor($total_seconds / 604800) == 1) {
            return "il y' a une semaine";
        }
        return "il y' a " . floor($total_seconds / 604800) . " semaines";
    }

    if ($total_seconds < 31536000) {
        return "il y' a " . floor($total_seconds / 2592000) . " mois";
    } else {
        if ($diff->y == 1) {
            return "il y' a une année";
        }
        return "il y' a " . $diff->y . " années";
    }
}

//end time function
?>
<?php $title = "messanger"; ?>

<?php ob_start();
?>


<style>
    body {
        background-color: #eeeeee;
    }

    .date-s {
        font-size: 10px;
    }

    .zone-messages {
        width: 50%;
    }

    @media(max-width: 1200px) {
        .zone-messages {
            width: 75%;
        }
    }

    @media(max-width: 992px) {
        .zone-messages {
            width: 100%;
        }
    }

    #chat3 .form-control {
        border-color: transparent;
    }

    #chat3 .form-control:focus {
        border-color: transparent;
        box-shadow: inset 0px 0px 0px 1px transparent;
    }

    .badge-dot {
        border-radius: 50%;
        height: 10px;
        width: 10px;
        margin-left: 2.9rem;
        margin-top: -.75rem;
    }

    .disabled-messanger-block {
        display: none !important;
    }

    .messanger-btn:focus {
        outline: none !important;
    }

    .messanger-btn {
        border: none !important;
    }
</style>

<section class="mt-4">
    <div class="container py-5">

        <div class="row mt-5">
            <div class="col-md-12">

                <div class="card" id="chat3" style="border-radius: 15px;">
                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-6 col-lg-5 col-xl-4 mb-4 mb-md-0 profiles">

                                <div class="p-3 bg-white">
                                    <div data-mdb-perfect-scrollbar="true" class="mb-5" style="position: relative; height: 400px;padding-bottom: 74px;">
                                        <ul class="list-unstyled mb-0">
                                            <?php foreach ($profiles as $key => $profile) { ?>
                                                <li class="p-2 border-bottom position-relative d-flex">
                                                    <div>
                                                        <img src="./assets/imgsProfile/<?= $profile['img'] ?>" alt="avatar" class="d-flex align-self-center me-3 rounded-circle" width="60" height="60">
                                                        <span class="badge bg-success badge-dot"></span>
                                                    </div>
                                                    <form action="" method="POST" class="d-flex text-decoration-none" style="width: 100%;">
                                                        <input type="hidden" name="id" value="<?= $profile['user_id'] ?>">
                                                        <div class="d-flex w-100 justify-content-between">
                                                            <button type="submit" class="bg-white ps-0 pe-0 messanger-btn">
                                                                <div class="fw-bold text-start mb-0 text-primary" style="width: 100%; justify-content: space-evenly;">
                                                                    <div class=""><?= $profile['fullname'] ?></div>
                                                                </div>
                                                                <p class="small text-muted d-flex"><?php if (isset($messages[$key]['message_content'])) {
                                                                                                        if ($messages[$key]['message_isSeen'] == '0' and $messages[$key]['message_receptor'] == $_SESSION['user_info']['user_id']) {
                                                                                                            echo "<p class='text-dark mb-0 font-weight-bold overflow-hidden text-start'>" . maxLength($messages[$key]['message_content']) . "</p>";
                                                                                                            echo "<span class='badge bg-danger rounded-pill position-absolute top-50 end-0 translate-middle-y font-weight-bold' style='top:5%;right:5%;font-size:16px' >" . $messages[$key]['nbr'] . "</span>";
                                                                                                        } else {
                                                                                                            echo "<p class='text-secondary mb-0 overflow-hidden text-start'>" . maxLength($messages[$key]['message_content']) . "</p>";
                                                                                                        }
                                                                                                    } else {
                                                                                                        echo "Aucun message";
                                                                                                    } ?>
                                                                </p>
                                                            </button>
                                                            <div class="pt-2">
                                                                <p class="small text-muted mb-1 text-end">
                                                                    <?php if (isset($messages[$key]['message_content'])) {
                                                                        echo date_diff_from_now($messages[$key]['message_time']);;
                                                                    }
                                                                    ?>
                                                                </p>
                                                            </div>

                                                        </div>

                                                    </form>
                                                </li>
                                            <?php } ?>
                                        </ul>
                                    </div>

                                </div>

                            </div>




                            <?php
                            if (isset($messagesContents)) { ?>
                                <div class="col-12 col-md-6 col-lg-7 col-xl-8 border-start position-relative conversation">
                                    <a href="messanger" id="rja3"><i class="bi bi-arrow-left fw-bold fs-3"></i></a>
                                    <div class="pt-3 pe-3 bg-white" data-mdb-perfect-scrollbar="true" style=" height: 400px;overflow: auto;" id="messageBody">
                                        <?php
                                        foreach ($messagesContents as $message) { ?>
                                            <?php if ($message['message_sender'] == $_SESSION['user_info']['user_id']) { ?>
                                                <div class="d-flex flex-row justify-content-end">
                                                    <form method="post">
                                                        <input type="hidden" name="message_id" value="<?= $message['message_id'] ?>">
                                                        <input type="hidden" name="id" value="<?= $user['user_id'] ?>">
                                                        <button class="btn btn-white" name="deleteMessage" type="submit"> <i class="bi bi-trash3"></i> </button>
                                                    </form>

                                                    <div>
                                                        <p class="small p-2 me-3 mb-1 text-white rounded-3 bg-primary"><?= $message['message_content'] ?></p>
                                                        <p class="small me-3 mb-3 rounded-3 text-muted"><?= date_diff_from_now($message['message_time']) ?></p>
                                                    </div>
                                                    <?php if ($messageAncien == "" || $messageAncien != "me") { ?>
                                                        <img src="./assets/imgsProfile/<?= $_SESSION['user_info']['img'] ?>" alt="mon profil" style="width: 40px;height: 40px;" class="rounded-circle">
                                                    <?php } else {
                                                        echo "<div style='width: 40px' ></div>";
                                                    } ?>
                                                </div>
                                            <?php $messageAncien = "me";
                                            } else { ?>

                                                <div class="d-flex flex-row justify-content-start">
                                                    <?php if ($messageAncien == "" || $messageAncien == "me") { ?>
                                                        <img src="./assets/imgsProfile/<?= $user['img'] ?>" alt="your profil" style="width: 40px;height: 40px;" class="rounded-circle">
                                                    <?php $messageAncien = "other";
                                                    } else {
                                                        echo "<div style='width: 40px'></div>";
                                                    } ?>
                                                    <div>
                                                        <p class="small p-2 ms-3 mb-1 rounded-3" style="background-color: #f5f6f7;"><?= $message['message_content'] ?></p>
                                                        <p class="small ms-3 mb-3 rounded-3 text-muted float-end"><?= date_diff_from_now($message['message_time']) ?></p>
                                                    </div>
                                                </div>

                                        <?php }
                                        } ?><div class="position-absolute bottom-0 w-100">
                                            <form method="post">
                                                <div class="text-muted d-flex justify-content-start align-items-center pe-3 pt-3 mt-2">
                                                    <img class="rounded-circle" src="./assets/imgsProfile/<?= $_SESSION['user_info']['img'] ?>" alt="avatar 3" style="width: 40px; height: 40px;">
                                                    <input type="hidden" name="receptor" value="<?= $user['user_id'] ?>">
                                                    <input type="hidden" name="id" value="<?= $user['user_id'] ?>">
                                                    <input type="text" class="form-control form-control-lg border rounded-pill ms-2" id="addMessage" name="messageContent" placeholder="Type message">
                                                    <button class="btn btn-white" class="ms-3" name="sendMessage" type="submit"><i class="bi bi-send-fill fs-5 text-primary"></i></button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                                <?php  ?>

                            <?php } else {
                            ?><div class="col-md-6 col-lg-7 col-xl-8 border-start position-relative conversation">
                                    <div class="p-0 m-0" style="background-image: url('./assets/messenger.avif');    width: 100%;
    height: 100%;">

                                    </div>
                                </div>

                            <?php } ?>

                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

    </div>
</section>

<?php $content = ob_get_clean(); ?>

<?php require('views/includes/layout.php');
