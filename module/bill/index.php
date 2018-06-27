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
                        <form class="m-form m-form--fit m-form--label-align-right" id="form-action" action="../../bill/export/?export=1" target="_blank"  method="POST" enctype="multipart/form-data">
                            <div class="row">
                                
                                <div class="col-lg-12">
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
                                            <div class="row">
                                            	<div class="col-5">
                                            		<div class="row">
                                            			<div class="col-12">
		                                                <div class="form-group m-form__group row">
		                                                    <label for="example-text-input"
		                                                           class="col-3 col-form-label"> <?= L::lb_product ?>
		                                                        <span class="require">*</span>
		                                                    </label>
		                                                    <div class="col-9">
		                                                        <img id="blah-s_product" onclick="putImage('s_product')"style="cursor: pointer;" title="<?= L::lb_product ?>" data-toggle="m-tooltip"  src="../../image/noimage.gif" width="150" />
		                                                        <div id="image-preview">
		                                                            <label for="s_product" id="image-s_product" style="display: none;">Choose File</label>
		                                                            <input style="display: none;" type="file" name="s_product" id="s_product" onchange="readURL(this,'blah-s_product');" accept=".jpg,.jpeg,.gif,.png" />
		                                                        </div>
		                                                    </div>
		                                                </div>
	                                                </div>
                                              	</div>
                                              	<br />
                                              	<br />
                                              	<div class="row">
                                              		<div class="col-12">
		                                              	<div class="form-group m-form__group row">
		                                                    <label for="example-text-input"
		                                                           class="col-3 col-form-label"> <?= L::lb_slip ?>
		                                                        <span class="require">*</span>
		                                                    </label>
		                                                    <div class="col-9">
		                                                        <img id="blah-s_slip" onclick="putImage('s_slip')"style="cursor: pointer;" title="<?= L::lb_slip ?>" data-toggle="m-tooltip"  src="../../image/noimage.gif" width="150" />
		                                                        <div id="image-preview">
		                                                            <label for="s_slip" id="image-s_slip" style="display: none;">Choose File</label>
		                                                            <input style="display: none;" type="file" name="s_slip" id="s_slip" onchange="readURL(this,'blah-s_slip');" accept=".jpg,.jpeg,.gif,.png" />
		                                                        </div>
		                                                    </div>
		                                                </div>
	                                                </div>
                                                </div>
                                              </div>
                                              <div class="col-7">
                                                <div class="form-group m-form__group row" style="padding-top: 5px;padding-bottom: 5px;">
                                                    <label for="example-text-input"
                                                           class="col-4 col-form-label"> <?= L::lb_name ?>
                                                        <span class="require">*</span></label>
                                                    <div class="col-7">
                                                        <input class="form-control m-input" type="text" id="s_name" name="s_name" required="required">
                                                    </div>
                                                </div>
                                                <div class="form-group m-form__group row" style="padding-top: 5px;padding-bottom: 5px;">
                                                    <label for="example-text-input"
                                                           class="col-4 col-form-label"> <?= L::lb_phoneMobile ?>
                                                        <span class="require">*</span></label>
                                                    <div class="col-7">
                                                        <input class="form-control m-input" type="text" id="s_phone" name="s_phone" required="required">
                                                    </div>
                                                </div>
                                                <div class="form-group m-form__group row" style="padding-top: 5px;padding-bottom: 5px;">
                                                    <label for="example-text-input"
                                                           class="col-4 col-form-label"> <?= L::lb_type ?>
                                                        <span class="require">*</span></label>
                                                    <div class="col-7">
                                                        <input class="form-control m-input" type="text" id="s_type" name="s_type" required="required">
                                                    </div>
                                                </div>
                                                <div class="form-group m-form__group row" style="padding-top: 5px;padding-bottom: 5px;">
                                                    <label for="example-text-input"
                                                           class="col-4 col-form-label"> <?= L::lb_price ?>
                                                        <span class="require">*</span></label>
                                                    <div class="col-7">
                                                        <input class="form-control m-input" type="number" id="i_price" name="i_price" required="required"  onkeyup="calculator();" onblur="calculator();"/>
                                                    </div>
                                                </div>
                                                <div class="form-group m-form__group row" style="padding-top: 5px;padding-bottom: 5px;">
                                                    <label for="example-text-input"
                                                           class="col-4 col-form-label"> <?= L::lb_commission ?>
                                                        <span class="require"></span></label>
                                                    <div class="col-3">
                                                    	<table>
                                                    		<tr>
                                                    			<td><input class="form-control m-input" type="number" id="i_commission1" name="i_commission1" value="3"  onkeyup="calculator();" onblur="calculator();"></td>
                                                    			<td>%</td>
                                                    		</tr>
                                                    	</table>
                                                    </div>
                                                    <div class="col-4">
                                                        <input class="form-control m-input" disabled="disabled" type="number" id="i_commission" name="i_commission">
                                                    </div>
                                                </div>
                                                <div class="form-group m-form__group row" style="padding-top: 5px;padding-bottom: 5px;">
                                                    <label for="example-text-input"
                                                           class="col-4 col-form-label"> <?= L::lb_vat ?>
                                                        <span class="require"></span></label>
                                                    <div class="col-3">
                                                    	<table>
                                                    		<tr>
                                                    			<td><input class="form-control m-input" type="number" id="i_vat1" name="i_vat1" value="7"  onkeyup="calculator();" onblur="calculator();"></td>
                                                    			<td>%</td>
                                                    		</tr>
                                                    	</table>
                                                    </div>
                                                    <div class="col-4">
                                                        <input class="form-control m-input" disabled="disabled" type="number" id="i_vat" name="i_vat" >
                                                    </div>
                                                </div>
                                                <div class="form-group m-form__group row" style="padding-top: 5px;padding-bottom: 5px;">
                                                    <label for="example-text-input"
                                                           class="col-4 col-form-label"> <?= L::lb_balance ?>
                                                        <span class="require"></span></label>
                                                    <div class="col-7">
                                                        <input class="form-control m-input" disabled="disabled" type="number" id="i_balance" name="i_balance">
                                                    </div>
                                                </div>
                                                <div class="form-group m-form__group row" style="padding-top: 5px;padding-bottom: 5px;">
                                                    <label for="example-text-input"
                                                           class="col-4 col-form-label"> <?= L::lb_refund ?>
                                                        <span class="require"></span></label>
                                                    <div class="col-7">
                                                        <input class="form-control m-input" disabled="disabled" type="number" id="i_refund" name="i_refund">
                                                    </div>
                                                </div>
                                                <div class="form-group m-form__group row" style="padding-top: 5px;padding-bottom: 5px;">
                                                    <label for="example-text-input"
                                                           class="col-4 col-form-label"> <?= L::lb_dateFinish ?>
                                                        <span class="require">*</span></label>
                                                    <div class="col-7">
                                                        <input class="form-control m-input" type="date" id="d_finish" name="d_finish" required="required" value="<?=date('Y-m-d');?>">
                                                    </div>
                                                </div>

                                            	</div>
                                            	</div>
                                            </div>
                                        </div>
                                        <div class="m-portlet__foot m-portlet__foot--fit" align="center">
                                            <div class="m-form__actions m-form__actions">
                                                <a href="index.php" class="btn btn-secondary"><?= L::btn_cancel ?></a>
                                                <button type="submit" class="btn btn-primary" id="btn-mg-save"><?= L::btn_exportBill ?></button>
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
        <script>
        	unblockui();
        </script>
        <script src="../../js/bill/index.js" type="text/javascript"></script>
        <!--end::Page Snippets -->
    </body>
    <!-- end::Body -->
</html>
