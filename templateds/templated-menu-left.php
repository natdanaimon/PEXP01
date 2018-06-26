<meta charset="utf-8" />

<!-- BEGIN: Aside Menu -->
<div 
    id="m_ver_menu" 
    class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark " 
    m-menu-vertical="1"
    m-menu-scrollable="1" m-menu-dropdown-timeout="500"  
    style="position: relative;">
    <ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow ">
        <li id="menu-dashboard" class="m-menu__item " aria-haspopup="true" >
            <a  href="../dashboard/" class="m-menu__link ">
                <i class="m-menu__link-icon flaticon-line-graph"></i>
                <span class="m-menu__link-title">
                    <span class="m-menu__link-wrap">
                        <span class="m-menu__link-text">
                            <?= L::menu_dashboard ?>
                        </span>
<!--                        <span class="m-menu__link-badge">
                            <span class="m-badge m-badge--danger">

                            </span>
                        </span>-->
                    </span>
                </span>
            </a>
        </li>


        <li id="menu-module-config"class="m-menu__item  m-menu__item--submenu m-menu__item--open m-menu__item--expanded" aria-haspopup="true"  m-menu-submenu-toggle="hover">
            <a  href="javascript:;" class="m-menu__link m-menu__toggle">
                <i class="m-menu__link-icon flaticon-layers"></i>
                <span class="m-menu__link-text">
                    <?= L::menu_permission ?>
                </span>
                <i class="m-menu__ver-arrow la la-angle-right"></i>
            </a>
            <div class="m-menu__submenu ">
                <span class="m-menu__arrow"></span>
                <ul class="m-menu__subnav">
                    <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true" >
                        <span class="m-menu__link">
                            <span class="m-menu__link-text">
                                <?= L::menu_permission ?>
                            </span>
                        </span>
                    </li>
                    <li id="menu-module-staff" class="m-menu__item " aria-haspopup="true" >
                        <a  href="../staff/" class="m-menu__link ">
                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                <span></span>
                            </i>
                            <span class="m-menu__link-text">
                                <?= L::menu_user ?>
                            </span>
                        </a>
                    </li>


                </ul>
            </div>

        </li>


        <li id="menu-module-manage"class="m-menu__item  m-menu__item--submenu m-menu__item--open m-menu__item--expanded" aria-haspopup="true"  m-menu-submenu-toggle="hover">
            <a  href="javascript:;" class="m-menu__link m-menu__toggle">
                <i class="m-menu__link-icon flaticon-layers"></i>
                <span class="m-menu__link-text">
                    <?= L::menu_manage ?>
                </span>
                <i class="m-menu__ver-arrow la la-angle-right"></i>
            </a>
            <div class="m-menu__submenu ">
                <span class="m-menu__arrow"></span>
                <ul class="m-menu__subnav">
                    <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true" >
                        <span class="m-menu__link">
                            <span class="m-menu__link-text">
                                <?= L::menu_manage ?>
                            </span>
                        </span>
                    </li>
                    <li id="menu-module-configs" class="m-menu__item " aria-haspopup="true" >
                        <a  href="../config/" class="m-menu__link ">
                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                <span></span>
                            </i>
                            <span class="m-menu__link-text">
                                <?= L::menu_config ?>
                            </span>
                        </a>
                    </li>
                    <li id="menu-module-bill" class="m-menu__item " aria-haspopup="true" >
                        <a  href="../bill/" class="m-menu__link ">
                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                <span></span>
                            </i>
                            <span class="m-menu__link-text">
                                <?= L::menu_bill ?>
                            </span>
                        </a>
                    </li>


                </ul>
            </div>

        </li>
    </ul>
</div>
<!-- END: Aside Menu -->
