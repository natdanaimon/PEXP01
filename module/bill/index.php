<?php
@session_start();
?>
<html lang="en" >
    <!-- begin::Head -->
    <?php include_once '../../templateds/templated-header.php'; ?>
    <!-- end::Head -->
    <!-- end::Body -->
    <body  class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--fixed m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default"  >     <!-- begin:: Page -->
        <div class="m-grid m-grid--hor m-grid--root m-page">
            <!-- BEGIN: Header -->
            <?php include_once '../../templateds/templated-menu-header.php'; ?>
            <!-- END: Header -->		
            <!-- begin::Body -->
            <div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">
                <!-- BEGIN: Left Aside -->
                <button class="m-aside-left-close  m-aside-left-close--skin-dark " id="m_aside_left_close_btn">
                    <i class="la la-close"></i>
                </button>
                <div id="m_aside_left" class="m-grid__item m-aside-left  m-aside-left--skin-dark ">
                    <!-- BEGIN: Aside Menu -->
                    <?php include_once '../../templateds/templated-menu-left.php'; ?>
                    <script>
                        $(document).ready(function () {
                            activeMenu('menu-module-manage', 'menu-module-bill', false);
                        });
                    </script>
                    <!-- END: Aside Menu -->
                </div>
                <!-- END: Left Aside -->
                <div class="m-grid__item m-grid__item--fluid m-wrapper">
                    <!-- BEGIN: Subheader -->
                    <div class="m-subheader ">
                        <div class="d-flex align-items-center">
                            <div class="mr-auto">
                                <h3 class="m-subheader__title m-subheader__title--separator">
                                    <?= L::menu_bill ?>
                                </h3>
                                <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                                    <li class="m-nav__item m-nav__item--home">
                                        <a href="#" class="m-nav__link m-nav__link--icon">
                                            <i class="m-nav__link-icon m-menu__link-icon flaticon-file"></i>
                                        </a>
                                    </li>
                                    <li class="m-nav__separator">
                                        -
                                    </li>
                                    <li class="m-nav__item">
                                        <a href="#" class="m-nav__link">
                                            <span class="m-nav__link-text">
                                                <?= L::menu_manage ?>
                                            </span>
                                        </a>
                                    </li>
                                    <li class="m-nav__separator">
                                        -
                                    </li>
                                    <li class="m-nav__item">
                                        <a href="#" class="m-nav__link">
                                            <span class="m-nav__link-text">
                                                <?= L::menu_bill ?>
                                            </span>
                                        </a>
                                    </li>

                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- END: Subheader -->
                    <!---------------------  START CONTENT  --------------------->
                    <div class="m-content">
                        <!--begin::Form-->
                        <form class="m-form m-form--fit m-form--label-align-right"
                              id="form-action">
                            <div class="row">
                                <input type="hidden" name="keyId" id="keyId"
                                       value="<?= ($_POST[id] != NULL ? $_POST[id] : "") ?>" />
                                <div class="col-lg-8">
                                    <!--begin::Portlet-->
                                    <div class="m-portlet">
                                        <div class="m-portlet__head">
                                            <div class="m-portlet__head-caption">
                                                <div class="m-portlet__head-title">
                                                    <span class="m-portlet__head-icon m--hide"> <i class="la la-gear"></i>
                                                    </span>
                                                    <h3 class="m-portlet__head-text"><?= L::lb_information ?> <?= L::menu_bill ?></h3>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="m-portlet__body">
                                            <div class="m-form__section m-form__section--first">


                                                <div class="form-group m-form__group row">
                                                    <label for="example-text-input"
                                                           class="col-3 col-form-label"> <?= L::lb_username ?>
                                                        <span class="require">*</span></label>
                                                    <div class="col-7">
                                                        <input class="form-control m-input" type="text"
                                                               id="s_user" name="s_user" value="">
                                                    </div>
                                                </div>	

                                                <div class="form-group m-form__group row">
                                                    <label for="example-text-input"
                                                           class="col-3 col-form-label"> <?= L::lb_password ?>
                                                        <span class="require">*</span></label>
                                                    <div class="col-7">
                                                        <div class="m-input-icon m-input-icon--right">
                                                            <input type="password" class="form-control m-input" id="s_pass" name="s_pass" max="20">
                                                            <span class="m-input-icon__icon m-input-icon__icon--right">
                                                                <span>
                                                                    <i class="la la-eye"></i>
                                                                </span>
                                                            </span>
                                                        </div>

                                                    </div>
                                                </div>	

                                                <div class="form-group m-form__group row">
                                                    <label for="example-text-input"
                                                           class="col-3 col-form-label"> <?= L::lb_levelUser ?>
                                                        <span class="require">*</span>
                                                    </label>
                                                    <div class="col-9">
                                                        <select class="custom-select form-control" id="level" 
                                                                name="level">
                                                        </select>
                                                    </div>
                                                </div>


                                                <div class="form-group m-form__group row">
                                                    <label for="example-text-input"
                                                           class="col-3 col-form-label"> <?= L::lb_firstName ?>
                                                        <span class="require">*</span></label>
                                                    <div class="col-7">
                                                        <input class="form-control m-input" type="text"
                                                               id="s_firstname" name="s_firstname"
                                                               value="">
                                                    </div>
                                                </div>
                                                <div class="form-group m-form__group row">
                                                    <label for="example-text-input"
                                                           class="col-3 col-form-label">  <?= L::lb_lastName ?>
                                                        <span class="require">*</span></label>
                                                    <div class="col-7">
                                                        <input class="form-control m-input" type="text"
                                                               id="s_lastname" name="s_lastname"
                                                               value="">
                                                    </div>
                                                </div>




                                                <div class="form-group m-form__group row">
                                                    <label for="example-text-input"
                                                           class="col-3 col-form-label">  <?= L::lb_phoneMobile ?>
                                                        <span class="require">*</span></label>
                                                    <div class="col-7">
                                                        <input class="form-control m-input" type="text"
                                                               id="s_phone" name="s_phone"
                                                               value="">
                                                    </div>
                                                </div>


                                                <div class="form-group m-form__group row">
                                                    <label for="example-text-input"
                                                           class="col-3 col-form-label"> <?= L::lb_email ?>
                                                        <span class="require">*</span></label>
                                                    <div class="col-7">
                                                        <input class="form-control m-input" type="text"
                                                               id="s_email" name="s_email" 
                                                               value="">
                                                    </div>
                                                </div>	

                                                <div class="form-group m-form__group row">
                                                    <label for="example-text-input"
                                                           class="col-3 col-form-label"> <?= L::lb_lineID ?>
                                                    </label>
                                                    <div class="col-7">
                                                        <input class="form-control m-input" type="text"
                                                               id="s_line" name="s_line"
                                                               value="">
                                                    </div>
                                                </div>





                                            </div>
                                        </div>
                                        <div class="m-portlet__foot m-portlet__foot--fit"
                                             align="center">
                                            <div class="m-form__actions m-form__actions">
                                                <a href="index.php" class="btn btn-secondary"><?= L::btn_cancel ?></a>
                                                <a href="javascript:save();" class="btn btn-primary" id="btn-mg-save"
                                                   onclick=""><?= L::btn_save ?></a>
                                            </div>
                                            <?php if ($_POST[id] != NULL && $_POST[id] != "") { ?>
                                                <div class="form-group m-form__group row">
                                                    <label class="col-6" class="require" style="text-align: left; ">
                                                        <span class="require"><?= L::lb_createDate ?> <span id="dCreate"></span></span>
                                                    </label>
                                                    <label class="col-6" class="require" style="text-align: right;">
                                                        <span class="require"><?= L::lb_lastUpdateDate ?> <span id="dUpdate"></span></span>
                                                    </label>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <!--end::Portlet-->

                                </div>
                                <div class="col-lg-4">
                                    <!--begin::Portlet-->
                                    <div class="m-portlet">
                                        <div class="m-portlet__head">
                                            <div class="m-portlet__head-caption">
                                                <div class="m-portlet__head-title">
                                                    <span class="m-portlet__head-icon m--hide"> <i
                                                            class="la la-gear"></i>
                                                    </span>
                                                    <h3 class="m-portlet__head-text"><?= L::lb_statusTitle ?></h3>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="m-form m-form--fit">
                                            <div class="m-portlet__body">
                                                <div class="form-group m-form__group row">
                                                    <label for="example-text-input" class="col-2 col-form-label">
                                                        <?= L::lb_status ?> <span
                                                            class="require">*</span>
                                                    </label>
                                                    <div class="col-8">
                                                        <select class="custom-select form-control" id="status"
                                                                name="status">
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::Portlet-->
                                </div>
                            </div>
                        </form>
                        <!--end::Form-->
                    </div>
                    <!---------------------  END CONTENT  --------------------->
                </div>
            </div>
            <!-- end:: Body -->
            <!-- begin::Footer -->
            <?php include_once '../../templateds/templated-footer.php'; ?>
            <!-- end::Footer -->
        </div>
        <!-- end:: Page -->

        <!-- begin::Scroll Top -->
        <div id="m_scroll_top" class="m-scroll-top">
            <i class="la la-arrow-up"></i>
        </div>
        <!-- end::Scroll Top -->		    

        <?php include_once '../../templateds/templated-script-common.php'; ?>

        <!--begin::Page Vendors -->
        <!--<script src="../../assets/vendors/custom/fullcalendar/fullcalendar.bundle.js" type="text/javascript"></script>-->
        <!--end::Page Vendors -->  
        <!--begin::Page Snippets -->
        <script src="../../js/staff/manage.js" type="text/javascript"></script>
        <!--end::Page Snippets -->
    </body>
    <!-- end::Body -->
</html>
