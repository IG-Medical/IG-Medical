<header id="contactUsHeader" class="d-flex align-items-center ">
    <div class="container d-md-flex d-block align-items-center justify-content-between">
        <div class="d-md-block d-none justify-content-between">
            <p class="mb-0"><?php echo e($data['welcome_text']); ?></p>
        </div>
        <div class="d-flex justify-content-between">
            <a href="<?php echo e($data['global_website']); ?>" style="color: #fff;" target="_blank"><p class="mb-0 pr-3 d-md-block d-none text-9fa5a8-hover"><?php echo e(trans('app.global_website')); ?></p></a>
            <div class="pr-3 d-md-block d-none">
                <a href="tel:<?php echo e($data['phone']); ?>" class="text-9fa5a8-hover" style="color: #fff">
                    <i class="fa fa-phone"></i> <span class="d-rtl fs-14"><?php echo e($data['phone']); ?></span>
                </a>
            </div>
            <div class="pr-3 d-md-block d-none">
                <a href="mailto:<?php echo e($data['email']); ?>" class="text-9fa5a8-hover" style="color: #fff">
                <i class="fa fa-envelope"></i> <span class="fs-14"><?php echo e($data['email']); ?></span>
                </a>
            </div>
            <div class="social-links mx-auto">
                <?php if($data['facebook']): ?>
                    <a target="_blank" href="<?php echo e($data['facebook']); ?>" class="facebook pr-3"><i class="fa fa-facebook text-white text-9fa5a8-hover"></i></a>
                <?php endif; ?>
                <?php if($data['linkedin']): ?>
                    <a target="_blank" href="<?php echo e($data['linkedin']); ?>" class="linkedin pr-3"><i class="fa fa-linkedin text-white text-9fa5a8-hover"></i></a>
                <?php endif; ?>



                <?php if($data['youtube']): ?>
                    <a target="_blank" href="<?php echo e($data['youtube']); ?>" class="instagram pr-3"><i class="fa fa-youtube text-white text-9fa5a8-hover"></i></a>
                <?php endif; ?>
                    <?php if($data['instagram']): ?>
                    <a target="_blank" href="<?php echo e($data['instagram']); ?>" class="instagram pr-3"><i class="fa fa-instagram text-white text-9fa5a8-hover"></i></a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</header>

<!-- ======= Header ======= -->
<header id="header" class="d-flex align-items-center  header-transparent ">
    <ul class="container d-flex align-items-center">

        <div class="logo">
            <h1 class="text-light">
                <a href="<?php echo e(url('/')); ?>">
                    <img class="d-md-inline " src="<?php echo e($data['header_logo']); ?>" alt="">
                </a>
            </h1>
        </div>

        <nav class="nav-menu d-none d-lg-block ">
            <ul>
                <li class="<?php echo e(request()->path() === getAppLocale() || request()->path() === getAppLocale() . '/' ? 'active' : ''); ?>">
                    <a href="<?php echo e(url_lang('/')); ?>"><?php echo e(trans('app.home')); ?></a>
                </li>

                
                <?php if(isset($data['categoryHeader2']) && $data['categoryHeader2']->count() > 0): ?>
                    <li class="<?php echo e(isset($breadcrumbsOperatingRoom) ? 'active' : ''); ?> dropdown dropdown-with-hover">
                        <a href="<?php echo e(route('product.showOperatingRoomPage')); ?>" class="dropdown-toggle" id="dropdownMenuButtonOR" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo e(trans('app.operating_room')); ?></a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButtonOR">
                            <?php $__currentLoopData = $data['categoryHeader2']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="dropdown-submenu">
                                    <a class="dropdown-item dropdown-toggle" href="<?php echo e(route('product.category', ['category' => $cat->slug])); ?>"><?php echo e($cat->name); ?></a>
                                    <?php if($cat->products && $cat->products->count() > 0): ?>
                                        <ul class="dropdown-menu">
                                            <?php $__currentLoopData = $cat->products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li><a class="dropdown-item" href="<?php echo e(route('product.details', ['slug' => $p->slug])); ?>"><?php echo e($p->name); ?></a></li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                    <?php endif; ?>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </li>
                <?php endif; ?>

                
                <?php if(isset($data['categoryHeader1']) && $data['categoryHeader1']->count() > 0): ?>
                    <li class="<?php echo e(isset($breadcrumbsProducts) ? 'active' : ''); ?> dropdown dropdown-with-hover">
                        <a href="<?php echo e(route('product.showProductsPage')); ?>" class="dropdown-toggle" id="dropdownMenuButtonProd" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo e(trans('app.products')); ?></a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButtonProd">
                            <?php $__currentLoopData = $data['categoryHeader1']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="dropdown-submenu">
                                    <a class="dropdown-item dropdown-toggle" href="<?php echo e(route('product.category', ['category' => $cat->slug])); ?>"><?php echo e($cat->name); ?></a>
                                    <?php if($cat->products && $cat->products->count() > 0): ?>
                                        <ul class="dropdown-menu">
                                            <?php $__currentLoopData = $cat->products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li><a class="dropdown-item" href="<?php echo e(route('product.details', ['slug' => $p->slug])); ?>"><?php echo e($p->name); ?></a></li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                    <?php endif; ?>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </li>
                <?php endif; ?>

                
                <li class="<?php echo e(in_array(get_last_segments(), ['about-us', 'distributors', 'jobs', 'r-and-d', 'qm', 'certifications']) ? 'active' : ''); ?> dropdown dropdown-with-hover">
                    <a href="<?php echo e(route_app('home.about_us')); ?>" class="dropdown-toggle" id="dropdownMenuButtonCompany" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo e(trans('app.company')); ?></a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButtonCompany">
                        <li><a class="dropdown-item" href="<?php echo e(route_app('home.about_us')); ?>"><?php echo e(trans('app.about_us')); ?></a></li>
                        <li><a class="dropdown-item" href="<?php echo e(route('distributor.index')); ?>"><?php echo e(trans('app.ig_world_wide')); ?></a></li>
                        <li class="dropdown-submenu">
                            <a class="dropdown-item dropdown-toggle" href="<?php echo e(route_app('home.certification')); ?>"><?php echo e(trans('app.quality')); ?></a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="<?php echo e(route('page.index', ['page' => 'r-and-d'])); ?>"><?php echo e(trans('app.r_and_d')); ?></a></li>
                                <li><a class="dropdown-item" href="<?php echo e(route('page.index', ['page' => 'qm'])); ?>"><?php echo e(trans('app.qm')); ?></a></li>
                                <li><a class="dropdown-item" href="<?php echo e(route_app('home.certification')); ?>"><?php echo e(trans('app.certifications')); ?></a></li>
                            </ul>
                        </li>
                        <li><a class="dropdown-item" href="<?php echo e(route_app('job.index')); ?>"><?php echo e(trans('app.careers')); ?></a></li>
                    </ul>
                </li>

                
                <li class="<?php echo e(get_last_segments() === 'news' ? 'active' : ''); ?>"><a href="<?php echo e(route('news.index')); ?>"><?php echo e(trans('app.news')); ?></a></li>

                
                <li class="<?php echo e(in_array(get_last_segments(), ['sales', 'technical', 'contact-us']) ? 'active' : ''); ?> dropdown dropdown-with-hover">
                    <a href="javascript:;" class="dropdown-toggle" id="dropdownMenuButtonContact" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo e(trans('app.contact')); ?></a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButtonContact">
                        <li><a class="dropdown-item" href="<?php echo e(route('page.index', ['page' => 'sales'])); ?>"><?php echo e(trans('app.sales')); ?></a></li>
                        <li><a class="dropdown-item" href="<?php echo e(route('page.index', ['page' => 'technical'])); ?>"><?php echo e(trans('app.technical_service')); ?></a></li>
                        <li><a class="dropdown-item" href="<?php echo e(route('contact.index')); ?>"><?php echo e(trans('app.contact_us')); ?></a></li>
                    </ul>
                </li>
                
                
                <li class="dropdown ">
                    <a href="javascript:;" class="dropdown-toggle" id="dropdownMenuButtonLang" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="<?php echo e(asset_app('img/'.getAppLocale().'.png')); ?>" class="d-inline" alt=""></a>
                    <ul class="dropdown-menu" style="min-width: 9rem;" aria-labelledby="dropdownMenuButtonLang">
                        <?php $__currentLoopData = languages(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a class="dropdown-item <?php echo e($key===getAppLocale() ? 'selected' : ''); ?>" href="<?php echo e(route('change.language',['locale' => $key])); ?>" style="margin-left:0!important;"><?php echo e($value); ?></a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </li>
            </ul>
        </nav>
    </ul>
</header>

<?php /**PATH C:\Users\HP\Desktop\IG MEDICAL.COM\my_new_website\resources\views/app/layouts/includes/header.blade.php ENDPATH**/ ?>