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
                            activeMenu('menu-module-manage', 'menu-module-configs', false);
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
                                    <?= L::menu_config ?>
                                </h3>
                                <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                                    <li class="m-nav__item m-nav__item--home">
                                        <a href="#" class="m-nav__link m-nav__link--icon">
                                            <i class="m-nav__link-icon la la-gears"></i>
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
                                                <?= L::menu_config ?>
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
                              id="form-action"  enctype="multipart/form-data" method="POST">
                            <div class="row">
                                <input type="hidden" name="keyId" id="keyId"
                                       value="<?= ($_POST[id] != NULL ? $_POST[id] : "") ?>" />
                                <div class="col-lg-12">
                                    <!--begin::Portlet-->
                                    <div class="m-portlet">
                                        <div class="m-portlet__head">
                                            <div class="m-portlet__head-caption">
                                                <div class="m-portlet__head-title">
                                                    <span class="m-portlet__head-icon m--hide"> <i class="la la-gear"></i>
                                                    </span>
                                                    <h3 class="m-portlet__head-text"><?= L::lb_information ?> <?= L::menu_config ?></h3>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="m-portlet__body">
                                            <div class="m-form__section m-form__section--first">


                                                <div class="form-group m-form__group row">
                                                    <label for="example-text-input"
                                                           class="col-3 col-form-label"> <?= L::lb_address ?>
                                                        <span class="require">*</span></label>
                                                    <div class="col-7">
                                                        <textarea class="form-control m-input" type="text"
                                                                  id="s_address" name="s_address" > </textarea>
                                                    </div>
                                                </div>	



                                                <div class="form-group m-form__group row">
                                                    <label for="example-text-input"
                                                           class="col-3 col-form-label"> <?= L::lb_logo ?>
                                                        <span class="require">*</span>
                                                    </label>
                                                    <div class="col-9">
                                                        <img id="blah-image-upload" alt="your image"  src="../../image/logo/default.png" height="120" />
                                                        <div id="image-preview">
                                                            <label for="image-upload" id="image-label">Choose File</label>
                                                            <input type="file" name="image" id="image-upload" onchange="readURL(this,'blah-image-upload');" />
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group m-form__group row">
                                                    <label for="example-text-input"
                                                           class="col-3 col-form-label"> <?= L::lb_sign ?>
                                                        <span class="require">*</span>
                                                    </label>
                                                    <div class="col-9">
  																											<img id="blah-image-upload1" alt="your image"  src="../../image/logo/default.png" height="120" />
                                                        <div id="image-preview">
                                                            <label for="image-upload1" id="image-label1">Choose File</label>
                                                            <input type="file" name="image" id="image-upload1" onchange="readURL(this,'blah-image-upload1');"  />
                                                        </div>
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
 


        <script src="../../js/config/index.js" type="text/javascript"></script>
        <script type="text/javascript">
					function readURL(input,blah) {

					  if (input.files && input.files[0]) {
					    var reader = new FileReader();

					    reader.onload = function(e) {
					      $('#'+blah).attr('src', e.target.result);
					    }

					    reader.readAsDataURL(input.files[0]);
					  }
					}

					
				</script>
        <!--end::Page Snippets -->
    </body>
    <!-- end::Body -->
</html>
