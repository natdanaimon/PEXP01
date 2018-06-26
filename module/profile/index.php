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
                            activeMenu('menu-dashboard', '', false);
                        });
                    </script>
                    <!-- END: Aside Menu -->
                </div>
                <!-- END: Left Aside -->
                <div class="m-grid__item m-grid__item--fluid m-wrapper">

                    <div class="m-content">

                        <div class="row">
                            <!--Begin::Section-->
                            <div class="row">
                                <div class="col-xl-4 col-lg-4">
                                    <div class="m-portlet m-portlet--full-height  ">
                                        <div class="m-portlet__body">
                                            <div class="m-card-profile">
                                                <div class="m-card-profile__title m--hide">Your Profile
                                                </div>
                                                <div class="m-card-profile__pic">
                                                    <div class="m-card-profile__pic-wrapper uploadProfile">
                                                        <img id="img-profile-3" style="height: 130px;width: 130px"
                                                             src="../../assets/image/profile/<?= $_SESSION['u_profile'] ?>"
                                                             alt="" onclick="editProfile()" style="cursor: pointer;"
                                                             data-toggle="m-tooltip"
                                                             title="<?= L::lb_uploadProfile ?>" />
                                                    </div>
                                                    <form method="post" id="upfile" enctype="multipart/form-data"
                                                          onsubmit="return checkForm(this);">
                                                        <input type="file" style="display: none;" id="file"
                                                               name="file" /> <input type="submit" style="display: none;"
                                                               id="submitfile" name="submit" />
                                                    </form>
                                                </div>


                                                <div class="m-card-profile__details">
                                                    <span class="m-card-profile__name" id="m-card-profile__name">
                                                        <?= $_SESSION['u_fullname'] ?>
                                                    </span> <a href="" class="m-card-profile__email m-link">
                                                    </a>
                                                </div>
                                            </div>
                                            <ul class="m-nav m-nav--hover-bg m-portlet-fit--sides">
                                                <li class="m-nav__separator m-nav__separator--fit"></li>
                                                <li class="m-nav__section m--hide"><span
                                                        class="m-nav__section-text"> Section </span></li>
                                                <li class="m-nav__item">
                                                    <a href="../profile/" class="m-nav__link" style="height: auto !important;"> 

                                                        <i class="m-nav__link-icon flaticon-profile-1"></i> 

                                                        <span  class="m-nav__link-title"> 
                                                            <span  class=""> <span
                                                                    class="m-nav__link-text">  <?= L::lb_profile ?>
                                                                </span> <span class="m-nav__link-badge">  														
                                                                </span>
                                                            </span>
                                                        </span>
                                                    </a></li>

                                            </ul>
                                            <div class="m-portlet__body-separator"></div>
                                            <div class="m-widget1 m-widget1--paddingless"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-8 col-lg-8">
                                    <div class="m-portlet m-portlet--tabs  ">
                                        <div class="m-portlet__head">
                                            <div class="m-portlet__head-tools">
                                                <ul
                                                    class="nav nav-tabs m-tabs m-tabs-line   m-tabs-line--left m-tabs-line--primary"
                                                    role="tablist">
                                                    <li class="nav-item m-tabs__item"><a
                                                            class="nav-link m-tabs__link active" data-toggle="tab"
                                                            href="#m_user_profile_tab_1" role="tab"> <i
                                                                class="flaticon-share m--hide"></i> <?= L::lb_editProfile ?>
                                                        </a></li>
                                                    <li class="nav-item m-tabs__item"><a
                                                            class="nav-link m-tabs__link" data-toggle="tab"
                                                            href="#m_user_profile_tab_2" role="tab"> <?= L::lb_editPassword ?>
                                                        </a></li> 

                                                </ul>
                                            </div>
                                            <div class="m-portlet__head-tools">
                                                <ul class="m-portlet__nav">
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="m_user_profile_tab_1">
                                                <form class="m-form m-form--fit m-form--label-align-right"
                                                      id="form-action" name="form-action">
                                                    <div class="m-portlet__body">

<!--                                                        <div class="form-group m-form__group row">
                                                            <div class="col-10 ml-auto">
                                                                <h3 class="m-form__section">
                                                                    <?= L::lb_profile ?>
                                                                </h3>
                                                            </div>
                                                        </div>-->

                                                        <div class="form-group m-form__group row">
                                                            <label for="example-text-input"
                                                                   class="col-3 col-form-label"> <?= L::lb_username ?>
                                                                <span class="require">*</span></label>
                                                            <div class="col-7">
                                                                <input class="form-control m-input" type="text"
                                                                       id="s_user" name="s_user" readonly
                                                                       style="background: beige;"
                                                                       value="<?= $_SESSION['u_username'] ?>">
                                                            </div>
                                                        </div>	

                                                        <div class="form-group m-form__group row">
                                                            <label for="example-text-input"
                                                                   class="col-3 col-form-label"> <?= L::lb_levelUser ?>
                                                                <span class="require"></span>
                                                            </label>
                                                            <div class="col-9">
                                                                <select class="custom-select form-control" id="level" disabled
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
                                                                       value="<?= $_SESSION['u_firstname'] ?>">
                                                            </div>
                                                        </div>
                                                        <div class="form-group m-form__group row">
                                                            <label for="example-text-input"
                                                                   class="col-3 col-form-label">  <?= L::lb_lastName ?>
                                                                <span class="require">*</span></label>
                                                            <div class="col-7">
                                                                <input class="form-control m-input" type="text"
                                                                       id="s_lastname" name="s_lastname"
                                                                       value="<?= $_SESSION['u_lastname'] ?>">
                                                            </div>
                                                        </div>




                                                        <div class="form-group m-form__group row">
                                                            <label for="example-text-input"
                                                                   class="col-3 col-form-label">  <?= L::lb_phoneMobile ?>
                                                                <span class="require">*</span></label>
                                                            <div class="col-7">
                                                                <input class="form-control m-input" type="text"
                                                                       id="s_phone" name="s_phone"
                                                                       value="<?= $_SESSION['u_phone'] ?>">
                                                            </div>
                                                        </div>


                                                        <div class="form-group m-form__group row">
                                                            <label for="example-text-input"
                                                                   class="col-3 col-form-label"> <?= L::lb_email ?>
                                                                <span class="require">*</span></label>
                                                            <div class="col-7">
                                                                <input class="form-control m-input" type="text"
                                                                       id="s_email" name="s_email"  
                                                                       value="<?= $_SESSION['u_email'] ?>">
                                                            </div>
                                                        </div>	

                                                        <div class="form-group m-form__group row">
                                                            <label for="example-text-input"
                                                                   class="col-3 col-form-label"> <?= L::lb_lineID ?>
                                                            </label>
                                                            <div class="col-7">
                                                                <input class="form-control m-input" type="text"
                                                                       id="s_line" name="s_line"
                                                                       value="<?= $_SESSION['u_line'] ?>">
                                                            </div>
                                                        </div>






                                                        <div class="form-group m-form__group row">
                                                            <label for="example-text-input"
                                                                   class="col-3 col-form-label"> </label>
                                                            <div class="col-7">
                                                                <a href="../profile/"
                                                                   class="btn btn-secondary m-btn m-btn--air m-btn--custom">
                                                                       <?= L::btn_cancel ?>
                                                                </a> &nbsp;&nbsp;
                                                                <button type="button" onclick="save()"
                                                                        class="btn btn-accent m-btn m-btn--air m-btn--custom">
                                                                            <?= L::btn_save ?>
                                                                </button>


                                                            </div>
                                                        </div>




                                                    </div>


                                                </form>
                                            </div>
                                            <div class="tab-pane" id="m_user_profile_tab_2">
                                                <form class="m-form m-form--fit m-form--label-align-right"
                                                      id="form-action-password" name="form-action-password">
                                                    <div class="m-portlet__body">
                                                        <input type="hidden" id="func" name="func"
                                                               value="changepassword">
<!--                                                        <div class="form-group m-form__group row">
                                                            <div class="col-10 ml-auto">
                                                                <h3 class="m-form__section"><?= L::lb_passwordNew ?></h3>
                                                            </div>
                                                        </div>-->
                                                        <div class="form-group m-form__group row">
                                                            <label for="example-text-input"
                                                                   class="col-3 col-form-label"> <?= L::lb_passwordOld ?>
                                                                <span class="require">*</span></label>
                                                            <div class="col-7">
                                                                <input class="form-control m-input" type="password"
                                                                       id="s_password_old" name="s_password_old" value="">
                                                            </div>
                                                        </div>
                                                        <div class="form-group m-form__group row">
                                                            <label for="example-text-input"
                                                                   class="col-3 col-form-label"> <?= L::lb_passwordNew ?>
                                                                <span class="require">*</span></label>
                                                            <div class="col-7">
                                                                <input class="form-control m-input" type="password"
                                                                       id="s_password_new" name="s_password_new" value="">
                                                            </div>
                                                        </div>
                                                        <div class="form-group m-form__group row">
                                                            <label for="example-text-input"
                                                                   class="col-3 col-form-label"> <?= L::lb_passwordNewConfirm ?>
                                                                <span class="require">*</span></label>
                                                            <div class="col-7">
                                                                <input class="form-control m-input" type="password"
                                                                       id="s_password_confirm" name="s_password_confirm"
                                                                       value="">
                                                            </div>
                                                        </div>



                                                        <div class="form-group m-form__group row">
                                                            <label for="example-text-input"
                                                                   class="col-3 col-form-label"> </label>
                                                            <div class="col-7">
                                                                <button type="button" onclick="clearChangePassword()"
                                                                        class="btn btn-secondary m-btn m-btn--air m-btn--custom">
                                                                    <?= L::btn_cancel ?></button>
                                                                &nbsp;&nbsp;
                                                                <button type="button" onclick="changepassword()"
                                                                        class="btn btn-accent m-btn m-btn--air m-btn--custom">
                                                                     <?= L::btn_save ?></button>


                                                            </div>
                                                        </div>




                                                    </div>


                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!--End::Section-->
                        </div>



                    </div>
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
        <script>
        var selectLevel = '<?=$_SESSION['u_level']?>';
        </script>
        <!--begin::Page Vendors -->
        <!--<script src="../../assets/vendors/custom/fullcalendar/fullcalendar.bundle.js" type="text/javascript"></script>-->
        <!--end::Page Vendors -->  
        <!--begin::Page Snippets -->
        <script src="../../js/authentication/profile.js" type="text/javascript"></script>
        <!--end::Page Snippets -->
    </body>
    <!-- end::Body -->
</html>
