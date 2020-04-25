<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<!-- begin::Head -->
<head>
    <meta charset="utf-8" />
    <title>Login Page</title>
    <meta name="description" content="Latest updates and statistic charts">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">

    <!--begin::Web font -->
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
    <script>
        WebFont.load({
            google: {
                "families": ["Poppins:300,400,500,600,700", "Roboto:300,400,500,600,700"]
            },
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>

    <!--end::Web font -->

    <!--begin::Base Styles -->
    <link href="css/main.css" rel="stylesheet" type="text/css" />

    <link href="css/style.bundle.css" rel="stylesheet" type="text/css" />

</head>

<!-- end::Head -->

<!-- begin::Body -->
<body class="m--skin- m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--fixed m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">

<!-- begin:: Page -->
<div class="m-grid m-grid--hor m-grid--root m-page">
    <div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor m-login m-login--signin m-login--2 m-login-2--skin-2" id="m_login" style="background-image: url(imgs/bg-3.jpg);">
        <div class="m-grid__item m-grid__item--fluid	m-login__wrapper">
            <div class="m-login__container">
                <div class="m-login__signin">
                    <div class="m-login__head">
                        <h1 class="m-login__title">From <a href="dbdump-confirm.php">here</a> you can dump the database</h1>
                    </div>
                    <?php
                    if(isset($_SESSION['success'])){ ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                                <?php echo $_SESSION['success'] ?>
                            </div>
                        <?php }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

</body>

<!-- end::Body -->
</html>
<?php

if(isset($_SESSION['success'])){
    unset($_SESSION['success']);
}
?>

