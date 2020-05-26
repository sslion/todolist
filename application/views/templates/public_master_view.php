<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon"/>

    <link href="/asets/css/jquery-ui.css" rel="stylesheet">
    <link href="/asets/css/jquery-ui.theme.css" rel="stylesheet">
    <script src="/asets/js/jquery.js"></script>
    <script src="/asets/js/jquery-ui.js"></script>

    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="/asets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <script src="/asets/bootstrap/js/popper.min.js"></script>
    <script src="/asets/bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="/asets/css/styles.css" type="text/css">
    <title>Список задач</title>
</head>
<body>
<div id="header">
    TODO List
</div>
<?php if (isset($current_user)) {
    $logout_link = base_url('/auth/logout/');
    echo "<div id='logout-link'>{$current_user->first_name} {$current_user->last_name}: <a href='{$logout_link}'>Выйти</a></div>";
} ?>


<div class="container">
    <div class="row">
        <div class="col-md-12">
            <?php if (isset($content)) echo $content; ?>
            <?php if (isset($the_view_content)) echo $the_view_content; ?>
        </div>
    </div>
</div>

</body>
</html>