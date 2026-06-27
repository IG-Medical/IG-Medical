<footer id="footer">
    <div class="container">
        <div class="row mt-5 justify-content-between">
            <div class="col-md-3 col-12 mb-4 mb-md-0 text-sm-center">
                <img class="footer-logo" src="<?php echo e($data['footer_logo']); ?>" alt="">
                <img class="footer-logo-two mx-sm-auto-custom" src="<?php echo e(asset('uploads/footer_logo_new.png')); ?>"
                    alt="">
            </div>
            <div class="col-md-2 col-12 mb-4 mb-md-0 text-sm-center">
                <h5><?php echo e(trans('app.surgical_lights')); ?></h5>
                <div class="row useful-links">
                    <ul class="col-12">
                        <?php $__currentLoopData = $data['categoryFooter']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><a href="<?php echo e(route('product.category', ['category' => $category->slug])); ?>"
                                    class="text-9fa5a8-hover"><?php echo e($category->name); ?></a></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            </div>
            <div class="col-md-3 col-12 mb-4 mb-md-0 text-sm-center">
                <h5><?php echo e(trans_app('contact_us')); ?></h5>
                <div class="row useful-links">
                    <ul class="col-12">
                        <li class="data_link">
                            <div class="data_link_icon">
                                <i class="fa fa-envelope fs-18"></i>
                            </div>
                            <a href="mailto:<?php echo e($data['email']); ?>" class="text-9fa5a8-hover"><?php echo e($data['email']); ?></a>
                        </li>
                        <li class="data_link">
                            <div class="data_link_icon">
                                <i class="fa fa-map-marker fs-18"></i>
                            </div>
                            <a href="javascript:;" class="text-9fa5a8-hover">
                                <?php echo e($data['address']); ?>

                            </a>
                        </li>
                        <li class="data_link">
                            <div class="data_link_icon">
                                <i class="fa fa-phone fs-18"></i>
                            </div>
                            <a href="tel:<?php echo e($data['phone']); ?>" style="color: #fff" class="text-9fa5a8-hover">
                                <?php echo e($data['phone']); ?>

                            </a>
                        </li>
                        
                        

                        <li>
                            <div class="social-links mx-auto mt-2">
                                <?php if($data['facebook']): ?>
                                    <a target="_blank" href="<?php echo e($data['facebook']); ?>" class="facebook mr-2 "><i
                                            class="fa fa-facebook text-white text-9fa5a8-hover fs-22"></i></a>
                                <?php endif; ?>
                                <?php if($data['linkedin']): ?>
                                    <a target="_blank" href="<?php echo e($data['linkedin']); ?>" class="linkedin mr-2"><i
                                            class="fa fa-linkedin text-white text-9fa5a8-hover fs-22"></i></a>
                                <?php endif; ?>
                                <?php if($data['youtube']): ?>
                                    <a target="_blank" href="<?php echo e($data['youtube']); ?>" class="linkedin mr-2"><i
                                            class="fa fa-youtube text-white text-9fa5a8-hover fs-22"></i></a>
                                <?php endif; ?>
                                
                                
                                
                                <?php if($data['instagram']): ?>
                                    <a target="_blank" href="<?php echo e($data['instagram']); ?>" class="instagram mr-2"><i
                                            class="fa fa-instagram text-white text-9fa5a8-hover fs-22"></i></a>
                                <?php endif; ?>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <subscribe-email-component></subscribe-email-component>
        </div>
    </div>
    <hr>
    <div class="container">
        <div class="credits"><?php echo e(date('Y')); ?> &copy; <?php echo e(trans('app.ig_medical_all_rights_reserved')); ?>

            <a href="<?php echo e(route('page.index', ['page' => 'data-protection'])); ?>" style="color: #fff;"
                class="text-9fa5a8-hover"><?php echo e(trans('app.data_protection')); ?></a>
            |
            <a href="<?php echo e(route('contact.index')); ?>" style="color: #fff;"
                class="text-9fa5a8-hover"><?php echo e(trans('app.contact')); ?></a>
            |
            <a href="<?php echo e(route('page.index', ['page' => 'imprint'])); ?>" class="text-9fa5a8-hover"
                style="color: #fff;"><?php echo e(trans('app.imprint')); ?></a>
            |
            <a href="<?php echo e(route('page.index', ['page' => 'conditions'])); ?>" class="text-9fa5a8-hover"
                style="color: #fff;"><?php echo e(trans('app.conditions')); ?></a>
        </div>
    </div>
</footer>
<?php /**PATH C:\Users\HP\Desktop\IG MEDICAL.COM\my_new_website\resources\views/app/layouts/includes/footer.blade.php ENDPATH**/ ?>