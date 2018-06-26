<?php
@session_start();
$_SESSION["lang"] = 'th';



$contextPath = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['SERVER_NAME'] . '/' . ($_SERVER['SERVER_NAME'] != 'localhost' ? "" : "PEXP01");
$_SESSION['CONTEXT'] = $contextPath;
?>
<html lang="en" >
    <!-- begin::Head -->
    <head>
        <meta charset="utf-8" />
        <title>
            Management
        </title>
        <meta name="description" content="Latest updates and statistic charts">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
        <?php
        $jsonStringLang = file_get_contents('./lang/lang_' . $_SESSION["lang"] . '.json');
        ?>
        <script>
            var contextPath = '<?= $contextPath ?>';
            var L = <?= $jsonStringLang ?>;
        </script>


        <script src="assets/vendors/base/vendors.bundle.js" type="text/javascript"></script>
        <script src="assets/demo/default/base/scripts.bundle.js" type="text/javascript"></script>
        <!--end::Base Scripts -->   

        <!--end::Web font -->
        <!--begin::Base Styles -->
        <link href="assets/vendors/base/vendors.bundle.css" rel="stylesheet" type="text/css" />
        <link href="assets/demo/default/base/style.bundle.css" rel="stylesheet" type="text/css" />
        <!--end::Base Styles -->
        <link rel="shortcut icon" href="assets/demo/default/media/img/logo/favicon.ico" />
    </head>
    <!-- end::Head -->
    <!-- end::Body -->
    <body  class="m--skin- m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--fixed m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default"  >
        <!-- begin:: Page -->
        <div class="m-grid m-grid--hor m-grid--root m-page">
            <div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor m-login m-login--signin m-login--2 m-login-2--skin-3" id="m_login" style="background-image: url(assets/app/media/img/bg/bg-2.jpg);">
                <div class="m-grid__item m-grid__item--fluid	m-login__wrapper">
                    <div class="m-login__container">
                        <div class="m-login__logo">
                            <a href="#">
                                <img src="assets/app/media/img/logos/logo-1.png">
                            </a>
                        </div>
                        <div class="m-login__signin">
                            <div class="m-login__head">
                                <h3 class="m-login__title">
                                    Management
                                </h3>
                            </div>
                            <form class="m-login__form m-form" id="form-action">
                                <div class="form-group m-form__group">
                                    <input class="form-control m-input"   type="text" placeholder="ชื่อผู้ใช้งาน" id="user" name="user" autocomplete="off">
                                </div>
                                <div class="form-group m-form__group">
                                    <div class="m-input-icon m-input-icon--right">
                                        <input class="form-control m-input m-login__form-input--last" type="password" placeholder="รหัสผ่าน" id="pass" name="pass">
                                        <span class="m-input-icon__icon m-input-icon__icon--right">
                                            <span>
<!--                                                <i class="la la-eye"></i>-->
                                            </span>
                                        </span>
                                    </div>
                                </div>
                                <div class="row m-login__form-sub">
                                    <div class="col m--align-left m-login__form-left">
                                        <label class="m-checkbox  m-checkbox--light">
                                            <input type="checkbox" name="remember">
                                            จดจำ
                                            <span></span>
                                        </label>
                                    </div>
                                    <div class="col m--align-right m-login__form-right">
                                        <!--                                        <a href="javascript:;" id="m_login_forget_password" class="m-link">
                                                                                    ลืมรหัสผ่าน
                                                                                </a>-->
                                    </div>
                                </div>
                                <div class="m-login__form-action">
                                    <a onclick="login();" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air  m-login__btn" style="color: white">
                                        เข้าสู่ระบบ
                                    </a>
                                </div>
                            </form>
                        </div>

                     
                        <div class="m-login__account">
                            <span class="m-login__account-msg">
                                Copyright © 2018 EXP Webdesign All rights reserved.
                            </span>
                            
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end:: Page -->

        <!--begin::Page Snippets -->
        <script src="js/authentication/login.js" type="text/javascript"></script>
        <!--end::Page Snippets -->
    </body>
    <!-- end::Body -->
</html>
