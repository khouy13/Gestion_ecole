<?php
if (isset($_POST['btn'])) {
    session_destroy();
    Redirect::to('login');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laureat</title>
</head>

<body>
    <h1>Laureat Page</h1>
    <form action="" method="post">
        <button type="submit" name="btn">Se déconnecter</button>
    </form>
</body>

</html>