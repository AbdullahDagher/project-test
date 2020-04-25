<?php
session_start();
include 'connection.php';
include 'functions.php';
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
    <title>inbox Page</title>
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
                                <a href="send-message.php" class="m-menu__link ">
                                    <i class="m-menu__link-icon flaticon-add"></i>
                                    <span class="m-menu__link-text">Send a Message</span>
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
                <h1 style="text-align: center">Welcome to your inbox <?php echo $_SESSION['username']?></h1>
                <div>
                    <a href="send-message.php" class="btn btn-primary btn-lg m-btn  m-btn m-btn--icon">
                        <span>
                            <span>Send a Message</span>
                        </span>
                    </a>
                </div>



                <div style="margin-top: 20px">

                    <?php
                    if(isset($_SESSION['message'])){
                        if(!empty($_SESSION['message'])){?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                                <?php echo $_SESSION['message'] ?>
                            </div>
                      <?php  }
                    }
                    ?>

                    <!--begin:: Widgets/Support Tickets -->
                    <div class="m-portlet m-portlet--full-height ">
                        <div class="m-portlet__head">
                            <div class="m-portlet__head-caption">
                                <div class="m-portlet__head-title">
                                    <h3 class="m-portlet__head-text">
                                        Your Messages
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <?php
                        $stmt = $con->prepare('SELECT DISTINCT fromUser FROM messages WHERE toUser = ?');
                        $stmt->execute([encryptData($_SESSION['username'])]);
                        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($rows as $row){
                            $stmt2 = $con->prepare('SELECT readingStatus FROM messages WHERE toUser = ? AND fromUser = ? AND readingStatus = ?');
                            $stmt2->execute([encryptData($_SESSION['username']), $row['fromUser'], '1']);
                            $readingStatusEqualOneCount = $stmt2->rowCount();
                            $test = $stmt2->fetchAll(PDO::FETCH_ASSOC);
                            ?>
                            <div class="m-portlet__body">
                                <div class="m-widget3">
                                    <div class="m-widget3__item">
                                        <div class="m-widget3__header">
                                            <div class="m-widget3__info" style="padding-left: 0;">
                                                <a href="see-messages.php?from=<?php echo decryptData($row['fromUser']) ?>"><span class="m-widget3__username"> <span style="font-weight: bold">Messages From: </span> <?php echo decryptData($row['fromUser']) ?></span></a>
                                                <?php if($readingStatusEqualOneCount > 0) {?>
                                                    <span style="background: #9816f4;padding: 3px 5px;color: #fff; margin-left: 10px;">New Message</span>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                       <?php }?>

                    </div>

                    <!--end:: Widgets/Support Tickets -->
                </div>
            </div>
        </div>
    </div>
</div>



</body>

<!-- end::Body -->
</html>

<?php
if(isset($_SESSION['message'])){
    unset($_SESSION['message']);
}
?>

