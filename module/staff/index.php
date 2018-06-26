<?php @session_start();
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
                            activeMenu('menu-module-config', 'menu-module-staff', false);
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
                                    <?=L::menu_user?>
                                </h3>
                                <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                                    <li class="m-nav__item m-nav__item--home">
                                        <a href="#" class="m-nav__link m-nav__link--icon">
                                            <i class="m-nav__link-icon la la-user"></i>
                                        </a>
                                    </li>
                                    <li class="m-nav__separator">
                                        -
                                    </li>
                                    <li class="m-nav__item">
                                        <a href="#" class="m-nav__link">
                                            <span class="m-nav__link-text">
                                                <?=L::menu_permission?>
                                            </span>
                                        </a>
                                    </li>
                                    <li class="m-nav__separator">
                                        -
                                    </li>
                                    <li class="m-nav__item">
                                        <a href="#" class="m-nav__link">
                                            <span class="m-nav__link-text">
                                               <?=L::menu_user?>
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
                        <div class="m-portlet m-portlet--mobile">
                            <div class="m-portlet__head">
                                <div class="m-portlet__head-caption">
                                    <div class="m-portlet__head-title">
                                        <h3 class="m-portlet__head-text">
                                            <?=L::lb_tableTitlefix?>
                                            <small>
                                                <?=L::menu_user?>
                                            </small>
                                        </h3>
                                    </div>
                                </div>
                            </div>
                            <div class="m-portlet__body">
                                <!--begin: Search Form -->
                                <div
                                    class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
                                    <div class="row align-items-center">
                                        <div class="col-xl-8 order-2 order-xl-1">
                                            <div class="form-group m-form__group row align-items-center">
                                                <div class="col-md-4">
                                                    <div class="m-form__group m-form__group--inline">
                                                        <div class="m-form__label">
                                                            <label> <?=L::lb_status?>: </label>
                                                        </div>
                                                        <div class="m-form__control">
                                                            <select class="form-control m-bootstrap-select"
                                                                    id="m_form_status">
                                                                <option value=""><?=L::status_all?></option>
                                                                <option value="A"><?=L::status_active?></option>
                                                                <option value="C"><?=L::status_cancel?></option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="d-md-none m--margin-bottom-10"></div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="m-input-icon m-input-icon--left">
                                                        <input type="text" class="form-control m-input"
                                                               placeholder="<?=L::lb_search?>..." id="generalSearch"> <span
                                                               class="m-input-icon__icon m-input-icon__icon--left">
                                                            <span> <i class="la la-search"></i>
                                                            </span>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-4 order-1 order-xl-2 m--align-right">
                                            <a href="manage.php" id="btn-index-add"
                                               class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill">
                                                <span> <i class="la la-plus"></i> <span> <?=L::btn_add?></span>
                                                </span>
                                            </a>
                                            <a href="javascript:cancelAll();" id="btn-index-cancel-all"
                                               class="btn btn-danger m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill">
                                                <span> <i class="la la-minus"></i> <span> <?=L::btn_cancel?></span>
                                                </span>
                                            </a>
                                            <input type="hidden" value="" name="listData" id="listData" />
                                            <div class="m-separator m-separator--dashed d-xl-none"></div>
                                        </div>
                                    </div>
                                </div>
                                <!--end: Search Form -->
                                <!--begin: Datatable -->
                                <div class="m_datatable" id="list-datatable"></div>
                                <!--end: Datatable -->
                            </div>
                        </div>
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
        <script src="../../js/staff/index.js" type="text/javascript"></script>
        <!--end::Page Snippets -->
    </body>
    <!-- end::Body -->
</html>
