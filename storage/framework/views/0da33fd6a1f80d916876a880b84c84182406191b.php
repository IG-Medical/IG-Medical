<!-- BEGIN: Left Aside -->
<button class="m-aside-left-close  m-aside-left-close--skin-dark " id="m_aside_left_close_btn"><i class="la la-close"></i></button>
<div id="m_aside_left" class="m-grid__item	m-aside-left  m-aside-left--skin-dark ">

    <!-- BEGIN: Aside Menu -->
    <div id="m_ver_menu" class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark " m-menu-vertical="1" m-menu-scrollable="1" m-menu-dropdown-timeout="500" style="position: relative;">
        <ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow ">

            <li class="m-menu__item  m-menu__item<?php echo e(active_link_sidebar('dashboard')); ?>" aria-haspopup="true"><a href="<?php echo e(route_admin('dashboard.index')); ?>" class="m-menu__link "><i class="m-menu__link-icon flaticon-line-graph"></i><span class="m-menu__link-title"> <span class="m-menu__link-wrap"> <span class="m-menu__link-text"><?php echo e(trans_admin('dashboard')); ?></span></span></span></a></li>

            <li class="m-menu__item m-menu__item<?php echo e(active_link_sidebar('contact')); ?>" aria-haspopup="true"><a href="<?php echo e(route_admin('contact.index')); ?>" class="m-menu__link "><i class="m-menu__link-icon flaticon-web"></i><span class="m-menu__link-text"><?php echo e(trans_admin('contact_us')); ?></span></a></li>
            <li class="m-menu__item m-menu__item<?php echo e(active_link_sidebar('mailing-lists')); ?>" aria-haspopup="true"><a href="<?php echo e(route_admin('mailing_list.index')); ?>" class="m-menu__link "><i class="m-menu__link-icon flaticon-web"></i><span class="m-menu__link-text"><?php echo e(trans_admin('mailing_lists')); ?></span></a></li>

           <li class="m-menu__item m-menu__item<?php echo e(active_link_sidebar('categories')); ?>" aria-haspopup="true"><a href="<?php echo e(route_admin('category.index')); ?>" class="m-menu__link "><i class="m-menu__link-icon flaticon-web"></i><span class="m-menu__link-text"><?php echo e(trans_admin('categories')); ?></span></a></li>


           <li class="m-menu__item  m-menu__item--submenu<?php echo e(active_arrow_down_sidebar(['products','attributes','options','attribute-sets'])); ?>" aria-haspopup="true" m-menu-submenu-toggle="hover"><a href="javascript:;" class="m-menu__link m-menu__toggle"><i class="m-menu__link-icon flaticon-interface-6"></i><span class="m-menu__link-text"><?php echo e(trans_admin('manage_products')); ?></span><i class="m-menu__ver-arrow la la-angle-right"></i></a>
                <div class="m-menu__submenu "><span class="m-menu__arrow"></span>
                    <ul class="m-menu__subnav">
                        <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true"><span class="m-menu__link"><span class="m-menu__link-text">Timeline</span></span></li>
                        <li class="m-menu__item<?php echo e(active_link_sidebar('products')); ?>" aria-haspopup="true"><a href="<?php echo e(route_admin('product.index')); ?>" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text"><?php echo e(trans('admin.products')); ?></span></a></li>
                        <li class="m-menu__item<?php echo e(active_link_sidebar('attribute-sets')); ?>" aria-haspopup="true"><a href="<?php echo e(route_admin('attribute_set.index')); ?>" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text"><?php echo e(trans('admin.attribute_sets')); ?></span></a></li>
                        <li class="m-menu__item<?php echo e(active_link_sidebar('attributes')); ?>" aria-haspopup="true"><a href="<?php echo e(route_admin('attribute.index')); ?>" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text"><?php echo e(trans('admin.attributes')); ?></span></a></li>
                    </ul>
                </div>
           </li>

            <li class="m-menu__item  m-menu__item--submenu<?php echo e(active_arrow_down_sidebar(['jobs'])); ?>" aria-haspopup="true" m-menu-submenu-toggle="hover"><a href="javascript:;" class="m-menu__link m-menu__toggle"><i class="m-menu__link-icon flaticon-folder"></i><span class="m-menu__link-text"><?php echo e(trans_admin('jobs')); ?></span><i class="m-menu__ver-arrow la la-angle-right"></i></a>
                <div class="m-menu__submenu "><span class="m-menu__arrow"></span>
                    <ul class="m-menu__subnav">
                        <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true"><span class="m-menu__link"><span class="m-menu__link-text">Timeline</span></span></li>
                        <li class="m-menu__item<?php echo e(active_link_sidebar('jobs')); ?>" aria-haspopup="true"><a href="<?php echo e(route_admin('job.index')); ?>" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text"><?php echo e(trans_admin('jobs')); ?></span></a></li>
                        <li class="m-menu__item<?php echo e(active_link_sidebar('categories')); ?>" aria-haspopup="true"><a href="<?php echo e(route_admin('job.category.index')); ?>" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text"><?php echo e(trans_admin('categories')); ?></span></a></li>
                    </ul>
                </div>
            </li>

           <li class="m-menu__section ">
                <h4 class="m-menu__section-text"><?php echo e(trans('admin.content')); ?></h4>
                <i class="m-menu__section-icon flaticon-more-v2"></i>
           </li>

            <li class="m-menu__item m-menu__item<?php echo e(active_link_sidebar('pages')); ?>" aria-haspopup="true"><a href="<?php echo e(route_admin('page.index')); ?>" class="m-menu__link "><i class="m-menu__link-icon flaticon-web"></i><span class="m-menu__link-text"><?php echo e(trans_admin('pages')); ?></span></a></li>
            <li class="m-menu__item m-menu__item<?php echo e(active_link_sidebar('news')); ?>" aria-haspopup="true"><a href="<?php echo e(route_admin('news.index')); ?>" class="m-menu__link "><i class="m-menu__link-icon flaticon-web"></i><span class="m-menu__link-text"><?php echo e(trans_admin('news')); ?></span></a></li>
            <li class="m-menu__item m-menu__item<?php echo e(active_link_sidebar('distributors')); ?>" aria-haspopup="true"><a href="<?php echo e(route_admin('distributor.index')); ?>" class="m-menu__link "><i class="m-menu__link-icon flaticon-web"></i><span class="m-menu__link-text"><?php echo e(trans_admin('distributors')); ?></span></a></li>



            <li class="m-menu__section ">
                <h4 class="m-menu__section-text"><?php echo e(trans('admin.constants')); ?></h4>
                <i class="m-menu__section-icon flaticon-more-v2"></i>
            </li>

            <li class="m-menu__section ">
                <h4 class="m-menu__section-text"><?php echo e(trans('admin.system')); ?></h4>
                <i class="m-menu__section-icon flaticon-more-v2"></i>
            </li>

            <li class="m-menu__item  m-menu__item--submenu<?php echo e(active_arrow_down_sidebar(['admins','roles','permissions'])); ?>" aria-haspopup="true" m-menu-submenu-toggle="hover"><a href="javascript:;" class="m-menu__link m-menu__toggle"><i class="m-menu__link-icon flaticon-interface-6"></i><span class="m-menu__link-text"><?php echo e(trans_admin('users')); ?></span><i class="m-menu__ver-arrow la la-angle-right"></i></a>
                <div class="m-menu__submenu "><span class="m-menu__arrow"></span>
                    <ul class="m-menu__subnav">
                        <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true"><span class="m-menu__link"><span class="m-menu__link-text">Timeline</span></span></li>

                        <li class="m-menu__item<?php echo e(active_link_sidebar('admins')); ?>" aria-haspopup="true"><a href="<?php echo e(route_admin('admin.index')); ?>" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text"><?php echo e(trans('admin.admins')); ?></span></a></li>





                        

                    </ul>
                </div>
            </li>

            <li class="m-menu__item  m-menu__item--submenu<?php echo e(active_arrow_down_sidebar([PAGE_SOCIAL_MEDIA_LINKS,PAGE_CONTACT_INFO,PAGE_ABOUT_US,PAGE_CERTIFICATIONS,'banners','sliders','menus','logo','general','footer'])); ?>" aria-haspopup="true" m-menu-submenu-toggle="hover"><a href="javascript:;" class="m-menu__link m-menu__toggle"><i class="m-menu__link-icon flaticon-interface-6"></i><span class="m-menu__link-text"><?php echo e(trans_admin('appearance')); ?></span><i class="m-menu__ver-arrow la la-angle-right"></i></a>
                <div class="m-menu__submenu "><span class="m-menu__arrow"></span>
                    <ul class="m-menu__subnav">
                        <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true"><span class="m-menu__link"><span class="m-menu__link-text">Timeline</span></span></li>
                        <li class="m-menu__item<?php echo e(active_link_sidebar(PAGE_GENERAL)); ?>" aria-haspopup="true"><a href="<?php echo e(route_admin('appearance.index',['page'=> PAGE_GENERAL])); ?>" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text"><?php echo e(trans_admin('general')); ?></span></a></li>
                        <li class="m-menu__item<?php echo e(active_link_sidebar(PAGE_HOME_PAGE)); ?>" aria-haspopup="true"><a href="<?php echo e(route_admin('appearance.index',['page'=> PAGE_HOME_PAGE])); ?>" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text"><?php echo e(trans_admin('home_page')); ?></span></a></li>
                        <li class="m-menu__item<?php echo e(active_link_sidebar(PAGE_LOGO)); ?>" aria-haspopup="true"><a href="<?php echo e(route_admin('appearance.index',['page'=> PAGE_LOGO])); ?>" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text"><?php echo e(trans_admin('logo')); ?></span></a></li>
                        <li class="m-menu__item<?php echo e(active_link_sidebar('navbar-items')); ?>" aria-haspopup="true"><a href="<?php echo e(route_admin('navbar-items.index')); ?>" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text"><?php echo e(trans('admin.navbar_items')); ?></span></a></li>
                        <li class="m-menu__item<?php echo e(active_link_sidebar('banners')); ?>" aria-haspopup="true"><a href="<?php echo e(route_admin('banners.index')); ?>" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text"><?php echo e(trans('admin.banners')); ?></span></a></li>
                    
                        <li class="m-menu__item<?php echo e(active_link_sidebar('testimonials')); ?>" aria-haspopup="true"><a href="<?php echo e(route_admin('testimonial.index')); ?>" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text"><?php echo e(trans_admin('companies')); ?></span></a></li>

                        <li class="m-menu__item<?php echo e(active_link_sidebar(PAGE_SOCIAL_MEDIA_LINKS)); ?>" aria-haspopup="true"><a href="<?php echo e(route_admin('appearance.index',['page'=> PAGE_SOCIAL_MEDIA_LINKS])); ?>" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text"><?php echo e(trans_admin('social_links')); ?></span></a></li>
                        <li class="m-menu__item<?php echo e(active_link_sidebar(PAGE_CONTACT_INFO)); ?>" aria-haspopup="true"><a href="<?php echo e(route_admin('appearance.index',['page'=> PAGE_CONTACT_INFO])); ?>" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text"><?php echo e(trans_admin('contact_info')); ?></span></a></li>
                        <li class="m-menu__item<?php echo e(active_link_sidebar(PAGE_CERTIFICATIONS)); ?>" aria-haspopup="true"><a href="<?php echo e(route_admin('appearance.index',['page'=> PAGE_CERTIFICATIONS])); ?>" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text"><?php echo e(trans_admin('certifications')); ?></span></a></li>
                        <li class="m-menu__item<?php echo e(active_link_sidebar(PAGE_ABOUT_US)); ?>" aria-haspopup="true"><a href="<?php echo e(route_admin('appearance.index',['page'=> PAGE_ABOUT_US])); ?>" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text"><?php echo e(trans_admin('about_us')); ?></span></a></li>
                        <li class="m-menu__item<?php echo e(active_link_sidebar(PAGE_BREADCRUMBS)); ?>" aria-haspopup="true"><a href="<?php echo e(route_admin('appearance.index',['page'=> PAGE_BREADCRUMBS])); ?>" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text"><?php echo e(trans_admin('breadcrumbs')); ?></span></a></li>
                        <li class="m-menu__item<?php echo e(active_link_sidebar(PAGE_TITLES)); ?>" aria-haspopup="true"><a href="<?php echo e(route_admin('appearance.index',['page'=> PAGE_TITLES])); ?>" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text"><?php echo e(trans_admin('titles')); ?></span></a></li>
                    
                        <li class="m-menu__item<?php echo e(active_link_sidebar('sliders')); ?>" aria-haspopup="true"><a href="<?php echo e(route_admin('slider.index')); ?>" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text"><?php echo e(trans_admin('sliders')); ?></span></a></li>
                    
                    
                    </ul>
                </div>
            </li>
            <li class="m-menu__item  m-menu__item--submenu<?php echo e(active_arrow_down_sidebar([PAGE_GENERAL,PAGE_MAINTENANCE,PAGE_SITE,PAGE_MAIL,PAGE_CUSTOM_CSS_JS,'payment-methods'])); ?>" aria-haspopup="true" m-menu-submenu-toggle="hover"><a href="javascript:;" class="m-menu__link m-menu__toggle"><i class="m-menu__link-icon flaticon-interface-6"></i><span class="m-menu__link-text"><?php echo e(trans_admin('settings')); ?></span><i class="m-menu__ver-arrow la la-angle-right"></i></a>
                <div class="m-menu__submenu "><span class="m-menu__arrow"></span>
                    <ul class="m-menu__subnav">
                        <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true"><span class="m-menu__link"><span class="m-menu__link-text">Timeline</span></span></li>
                        <li class="m-menu__item<?php echo e(active_link_sidebar(PAGE_GENERAL)); ?>" aria-haspopup="true"><a href="<?php echo e(route_admin('setting.index',['page'=> PAGE_GENERAL])); ?>" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text"><?php echo e(trans('admin.general')); ?></span></a></li>
                        <li class="m-menu__item<?php echo e(active_link_sidebar(PAGE_MAINTENANCE)); ?>" aria-haspopup="true"><a href="<?php echo e(route_admin('setting.index',['page'=> PAGE_MAINTENANCE])); ?>" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text"><?php echo e(trans_admin('maintenance')); ?></span></a></li>
                    
                        <li class="m-menu__item<?php echo e(active_link_sidebar(PAGE_MAIL)); ?>" aria-haspopup="true"><a href="<?php echo e(route_admin('setting.index',['page'=> PAGE_MAIL])); ?>" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text"><?php echo e(trans_admin('mail')); ?></span></a></li>
                        <li class="m-menu__item<?php echo e(active_link_sidebar(PAGE_CUSTOM_CSS_JS)); ?>" aria-haspopup="true"><a href="<?php echo e(route_admin('setting.index',['page'=> PAGE_CUSTOM_CSS_JS])); ?>" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text"><?php echo e(trans_admin('custom_css_and_js')); ?></span></a></li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</div>


<?php /**PATH C:\Users\HP\Desktop\IG MEDICAL.COM\my_new_website\resources\views/admin_panel/layouts/includes/sidebar.blade.php ENDPATH**/ ?>