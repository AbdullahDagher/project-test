<?php
session_start();

$token = sha1(uniqid());
$_SESSION['CSRF_token_forgetPass']= $token;

if(isset($_SESSION['username'])){
    header('Location: inbox.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<!-- begin::Head -->
<head>
    <meta charset="utf-8" />
    <title>Forget Password Page</title>
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
                        <h3 class="m-login__title">Forgotten Password ?</h3>
                        <div class="m-login__desc">Enter your username to reset your password:</div>
                    </div>
                    <form class="m-login__form m-form" action="forget-password-registration.php" method="post">

                        <?php
                        if(isset($_SESSION['errors'])){
                            if(!empty($_SESSION['errors'])){
                                echo '<div>';
                                echo '<ul>';
                                foreach ($_SESSION['errors'] as $error){
                                    echo '<li style="color:red;">' ;
                                    echo $error;
                                    echo '</li>' ;
                                }
                                echo '</ul>';
                                echo   '</div>';
                            }
                        }
                        ?>
                        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['CSRF_token_forgetPass']; ?>" />

                        <div class="form-group m-form__group">
                            <input class="form-control m-input" type="text" placeholder="Username" name="username" autocomplete="off"  value="<?php if(isset($_SESSION['data']['username'])) echo $_SESSION['data']['username']?>">
                        </div>
                        <div class="m-login__form-action">
                            <button class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air  m-login__btn m-login__btn--primaryr">Request</button>&nbsp;&nbsp;
                            <a href="login.php" class="btn btn-outline-focus m-btn m-btn--pill m-btn--custom m-login__btn">Cancel</a>
                        </div>
                    </form>

                </div>

                <div class="m-login__account">
							<span class="m-login__account-msg">
								Don't have an account yet ?
							</span>&nbsp;&nbsp;
                    <a href="sign-up.php" class="m-link m-link--light m-login__account-link">Sign Up</a>
                </div>
            </div>
        </div>
    </div>
</div>

</body>

<!-- end::Body -->
</html>
<?php
if(isset($_SESSION['errors'])){
    unset($_SESSION['errors']);
}
if(isset($_SESSION['data'])){
    unset($_SESSION['data']);
}
?>

