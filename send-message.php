<?php
session_start();
$token = sha1(uniqid());
$_SESSION['CSRF_token_sendMessage']= $token;

if(!isset($_SESSION['username'])){
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<!-- begin::Head -->
<head>
    <meta charset="utf-8" />
    <title>Send Message Page</title>
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

    <style>
        @media (min-width: 1025px){
            .m-brand.m-brand--skin-dark{
                display:none !important;
            }
            .m-header-menu {
                float: right !important;
            }
        }

        @media (max-width: 1024px){
            .m-login.m-login--2 .m-login__wrapper {
                padding-top: 6rem !important;
            }
        }


    </style>
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


    <header id="m_header" class="m-grid__item    m-header " m-minimize-offset="200" m-minimize-mobile-offset="200" style="background: #fff;">
        <div class="m-container m-container--fluid m-container--full-height">
            <div class="m-stack m-stack--ver m-stack--desktop">
                <div class="m-stack__item m-brand  m-brand--skin-dark ">
                    <div class="m-stack m-stack--ver m-stack--general">
                        <div class="m-stack__item m-stack__item--middle m-brand__tools">

                            <!-- BEGIN: Responsive Header Menu Toggler -->
                            <a id="m_aside_header_menu_mobile_toggle" href="javascript:;" class="m-brand__icon m-brand__toggler m--visible-tablet-and-mobile-inline-block">
                                <span></span>
                            </a>

                            <!-- END -->
                        </div>
                    </div>
                </div>

                <div class="m-stack__item m-stack__item--fluid m-header-head" id="m_header_nav">
                    <!-- BEGIN: Horizontal Menu -->
                    <button class="m-aside-header-menu-mobile-close  m-aside-header-menu-mobile-close--skin-dark " id="m_aside_header_menu_mobile_close_btn">
                        <i class="la la-close"></i>
                    </button>
                    <div id="m_header_menu" class="m-header-menu m-aside-header-menu-mobile m-aside-header-menu-mobile--offcanvas  m-header-menu--skin-light m-header-menu--submenu-skin-light m-aside-header-menu-mobile--skin-dark m-aside-header-menu-mobile--submenu-skin-dark ">
                        <ul class="m-menu__nav  m-menu__nav--submenu-arrow ">
                            <li class="m-menu__item  m-menu__item--submenu m-menu__item--rel" >
                                <a href="inbox.php" class="m-menu__link ">
                                    <span class="m-menu__link-text">inbox</span>
                                </a>
                            </li>
                            <li class="m-menu__item  m-menu__item--submenu m-menu__item--rel">
                                <a href="logout.php" class="m-menu__link">
                                    <span class="m-menu__link-text">logout</span>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <!-- END: Horizontal Menu -->
                </div>
            </div>
        </div>
    </header>


    <div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor m-login m-login--signin m-login--2 m-login-2--skin-2" id="m_login" style="background-image: url(imgs/bg-3.jpg);">
        <div class="m-grid__item m-grid__item--fluid	m-login__wrapper">
            <div class="m-login__container" style="width: 980px;">
                <h1 style="text-align: center">New Message From <?php echo $_SESSION['username'] ?></h1>
                <div>
                    <a href="inbox.php" class="btn btn-primary btn-lg m-btn  m-btn m-btn--icon">
                        <span>
                            <span>Inbox</span>
                        </span>
                    </a>
                </div>

                <div style="margin-top: 20px">

                    <div class="m-portlet">
                        <div class="m-portlet__head">
                            <div class="m-portlet__head-caption">
                                <div class="m-portlet__head-title">
												<span class="m-portlet__head-icon m--hide">
													<i class="la la-gear"></i>
												</span>
                                    <h3 class="m-portlet__head-text">
                                        Message Content
                                    </h3>
                                </div>
                            </div>
                        </div>

                        <!--begin::Form-->
                        <form class="m-form" method="post" action="send-message-registration.php">

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

                            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['CSRF_token_sendMessage']; ?>" />
                            <div class="m-portlet__body">
                                <div class="m-form__section m-form__section--first">
                                    <div class="form-group m-form__group">
                                        <label for="example_input_full_name">To:</label>
                                        <input type="text" class="form-control m-input" placeholder="Enter Username" name="toUser"  value="<?php if(isset($_SESSION['data']['toUser'])) echo $_SESSION['data']['toUser']?>">
                                    </div>
                                    <div class="form-group m-form__group">
                                        <label for="example_input_full_name">Content:</label>
                                        <textarea class="form-control m-input" name="content" id="" cols="30" rows="10"><?php if(isset($_SESSION['data']['content'])) echo $_SESSION['data']['content']?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="m-portlet__foot m-portlet__foot--fit">
                                <div class="m-form__actions m-form__actions">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>

                        <!--end::Form-->
                    </div>
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

