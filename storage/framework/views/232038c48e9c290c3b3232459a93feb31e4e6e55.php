<!-- ======= Last gallery Section ======= -->
<section id="gallery" class="lastNews gallery bg-2dafe6">
    <div class="container">

        <div class="section-title">
            <?php if(isset($home_page_product_section['title'][getAppLocale()])): ?>
                <p><?php echo e($home_page_product_section['title'][getAppLocale()]); ?></p>
            <?php endif; ?>

            <?php if(isset($home_page_product_section['sub_title'][getAppLocale()])): ?>
                <h2><?php echo e($home_page_product_section['sub_title'][getAppLocale()]); ?></h2>
            <?php endif; ?>
        </div>

        <?php if(isset($banners) && $banners->count() > 0): ?>
            <?php
                $firstBanner = $banners->first();
                $remainingBanners = $banners->skip(1);

                $allCategories = collect();

                foreach ($remainingBanners as $banner) {
                    if ($banner->categories && $banner->categories->count() > 0) {
                        $allCategories = $allCategories->merge($banner->categories);
                    }
                }

                if (isset($freeCategories) && $freeCategories->count() > 0) {
                    $allCategories = $allCategories->merge($freeCategories);
                }

                $allCategories = $allCategories->sortBy('created_at')->values();

                $bannerCol = $allCategories->count() === 1 ? 'col-md-8' : 'col-md-4';
            ?>

            
            <?php if($firstBanner): ?>
                <div class="row mb-4">
                    <div class="col-md-12">
                        <div class="banner-block banner-category-list position-relative"
                            style="background-image: url('<?php echo e(assetUpload(\App\Models\Banner::DIR_UPLOADS . '/' . $firstBanner->image)); ?>');">

                            <a href="<?php echo e(route('product.showOperatingRoomPage')); ?>"
                                class="banner-bg-link"
                                aria-label="Operating Room"
                                style="position:absolute; inset:0; z-index:1;"></a>

                            <div class="position-relative mx-sm-auto-custom banner-content"
                                style="z-index: 2; width: fit-content; height: fit-content;">

                                <?php if($firstBanner->categories && $firstBanner->categories->count() > 0): ?>
                                    <div class="categories-list-grid">
                                        <?php $__currentLoopData = $firstBanner->categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="member grid_cat category-item">
                                                <div class="member-info">
                                                    <h4 class="mb-0" style="font-size: 16px; line-height: 1.4;">
                                                        <?php echo e($category->name); ?>

                                                    </h4>
                                                </div>

                                                <div class="gallery-details text-white text-center"
                                                    style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index:3;">
                                                    <div class="my-auto">
                                                        <a href="<?php echo e(route('product.category', ['category' => $category->slug])); ?>"
                                                            class="category-link">
                                                            <h3 class="fs-16"><?php echo e($category->name); ?></h3>
                                                            <p class="fs-12 cat_desc">
                                                                <?php echo e($category->short_description); ?>

                                                            </p>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                <?php endif; ?>

                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            
            <?php if($remainingBanners->count() > 0 || $allCategories->count() > 0): ?>
                <div class="row mb-4">

                    <?php $__currentLoopData = $remainingBanners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="<?php echo e($bannerCol); ?> mb-3 d-flex align-items-stretch">
                            <div class="banner-block banner-category-list position-relative"
                                style="
                                    background-image: url('<?php echo e(assetUpload(\App\Models\Banner::DIR_UPLOADS . '/' . $banner->image)); ?>');
                                    width: 100%;
                                    height: 100%;
                                    min-height: 350px;
                                    background-size: cover;
                                    background-position: center;
                                    overflow: hidden;
                                ">

                                <a href="<?php echo e(route('product.showOperatingRoomPage')); ?>"
                                    class="banner-bg-link"
                                    aria-label="Banner"
                                    style="position:absolute; inset:0; z-index:1;"></a>

                                <div class="position-relative mx-sm-auto-custom banner-content"
                                    style="z-index: 2; width: fit-content; height: fit-content;">

                                    <?php if($banner->categories && $banner->categories->count() > 0): ?>
                                        <div class="categories-list-grid">
                                            <?php $__currentLoopData = $banner->categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="member grid_cat category-item">
                                                    <div class="member-info">
                                                        <h4 class="mb-0" style="font-size: 16px; line-height: 1.4;">
                                                            <?php echo e($category->name); ?>

                                                        </h4>
                                                    </div>

                                                    <div class="gallery-details text-white text-center"
                                                        style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index:3;">
                                                        <div class="my-auto">
                                                            <a href="<?php echo e(route('product.category', ['category' => $category->slug])); ?>"
                                                                class="category-link">
                                                                <h3 class="fs-16"><?php echo e($category->name); ?></h3>
                                                                <p class="fs-12 cat_desc">
                                                                    <?php echo e($category->short_description); ?>

                                                                </p>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    <?php endif; ?>

                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <?php $__currentLoopData = $allCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $isBanner = $category->slug === 'surgical-instruments'; ?>
                        <div class="<?php echo e($isBanner ? 'col-md-8' : 'col-md-4'); ?> mb-3 d-flex align-items-stretch">
                            <div class="member"
                                style="min-height: 350px; width: 100%; position: relative; overflow: hidden;">
                                <div class="member-img" style="padding: unset; height: <?php echo e($isBanner ? '400px' : '260px'); ?>; overflow: hidden;">
                                    <?php if($category->image): ?>
                                        <img src="<?php echo e($category->image_url); ?>" class="img-fluid"
                                            alt="<?php echo e($category->name); ?>"
                                            style="width: 100%; height: 100%; object-fit: cover;">
                                    <?php endif; ?>
                                </div>

                                <div class="member-info" style="min-height: 90px; padding: 20px;">
                                    <h4 class="font-size-product mb-0" style="font-size: 16px; line-height: 1.4;">
                                        <?php echo e($category->name); ?>

                                    </h4>
                                </div>

                                <div class="gallery-details text-white text-center"
                                    style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;">
                                    <div class="my-auto">
                                        <a href="<?php echo e(route('product.category', ['category' => $category->slug])); ?>">
                                            <h3 class="fs-16 pb-3"><?php echo e($category->name); ?></h3>
                                            <p class="fs-14"><?php echo e($category->short_description); ?></p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </div>
            <?php endif; ?>

        <?php elseif(isset($freeCategories) && $freeCategories->count() > 0): ?>
            <div class="row mb-4">
                <?php $__currentLoopData = $freeCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php $isBanner = $category->slug === 'surgical-instruments'; ?>
                    <div class="<?php echo e($isBanner ? 'col-md-8' : 'col-md-4'); ?> mb-3 d-flex align-items-stretch">
                        <div class="member"
                            style="min-height: 350px; width: 100%; position: relative; overflow: hidden;">
                            <div class="member-img" style="padding: unset; height: <?php echo e($isBanner ? '400px' : '260px'); ?>; overflow: hidden;">
                                <?php if($category->image): ?>
                                    <img src="<?php echo e($category->image_url); ?>" class="img-fluid"
                                        alt="<?php echo e($category->name); ?>"
                                        style="width: 100%; height: 100%; object-fit: cover;">
                                <?php endif; ?>
                            </div>

                            <div class="member-info" style="min-height: 90px; padding: 20px;">
                                <h4 class="font-size-product mb-0" style="font-size: 16px; line-height: 1.4;">
                                    <?php echo e($category->name); ?>

                                </h4>
                            </div>

                            <div class="gallery-details text-white text-center"
                                style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;">
                                <div class="my-auto">
                                    <a href="<?php echo e(route('product.category', ['category' => $category->slug])); ?>">
                                        <h3 class="fs-16 pb-3"><?php echo e($category->name); ?></h3>
                                        <p class="fs-14"><?php echo e($category->short_description); ?></p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php endif; ?>

    </div>
</section>
<!-- End gallery Section --><?php /**PATH C:\Users\HP\Desktop\IG MEDICAL.COM\my_new_website\resources\views/app/home/includes/products.blade.php ENDPATH**/ ?>