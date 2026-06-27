<?php $__env->startPush('page-title',$pageTitle); ?>

<?php $__env->startSection('content'); ?>
    <contact-us-index v-cloak inline-template>
        <main id="main">
            <?php echo $__env->make('app.layouts.includes.breadcrumbs',['breadcrumb_image'=> $breadcrumb], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <section class="contact-us-page mb-5">
                <div class="container">
                    <div class="section-title">
                        <p><?php echo e(trans_module_contact_us('app.email_us')); ?></p>
                    </div>
                    <section id="contact-us" class="contact-us pt-0">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div>
                                        <img src="<?php echo e(asset_app('img/contact us-01.jpg')); ?>" class="img-fluid" alt="">
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 d-flex justify-content-between flex-wrap">
                                            <a href="tel:<?php echo e($data['phone']); ?>" class="text-9fa5a8-hover" style="color: #000;">
                                            <span class="d-block mt-2"><span class="circle-icon"><i class="bx bxs-phone"></i></span><?php echo e($data['phone']); ?></span>
                                            </a>
                                            <a href="mailto:<?php echo e($data['email']); ?>" class="text-9fa5a8-hover" style="color: #000;">
                                                <span class="d-block mt-2">
                                                    <span class="circle-icon"><i class="bx bxs-envelope"></i></span>
                                                    <?php echo e($data['email']); ?>

                                                </span>
                                            </a>
                                        </div>
                                        <div class="col-md-12 col-12">
                                            <a href="javascript:;" class="text-9fa5a8-hover" style="color: #000;">
                                            <span class="d-block mt-2"><span class="circle-icon"><i class="icofont icofont-location-pin"></i></span><?php echo e($data['address']); ?></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <input type="text" v-model="company_name" class="form-control fs-14" id="company" placeholder="<?php echo e(trans_module_contact_us('app.your_company_cname')); ?>">
                                        <span class="error" v-if="form.validation&&form.validation.company_name">{{ form.validation.company_name[0] }}</span>
                                    </div>
                                    <div class="form-group mt-4">
                                        <input type="text" v-model="country" class="form-control fs-14" id="country" placeholder="<?php echo e(trans_module_contact_us('app.your_country')); ?>">
                                        <span class="error" v-if="form.validation&&form.validation.country">{{ form.validation.country[0] }}</span>
                                    </div>
                                    <div class="form-group mt-4">
                                        <input type="text" v-model="email" class="form-control fs-14" id="Email" placeholder="<?php echo e(trans_module_contact_us('app.email_address')); ?>">
                                        <span class="error" v-if="form.validation&&form.validation.email">{{ form.validation.email[0] }}</span>
                                    </div>
                                    <div class="form-group mt-4">
                                        <input type="text" v-model="full_name" class="form-control fs-14" id="FullName" placeholder="<?php echo e(trans_module_contact_us('app.your_full_name')); ?>">
                                        <span class="error" v-if="form.validation&&form.validation.full_name">{{ form.validation.full_name[0] }}</span>
                                    </div>
                                    <div class="form-group mt-4">
                                        <input type="text" v-model="phone" class="form-control fs-14" id="Mobile" placeholder="<?php echo e(trans_module_contact_us('app.phone_number')); ?>">
                                        <span class="error" v-if="form.validation&&form.validation.phone">{{ form.validation.phone[0] }}</span>
                                    </div>
                                    <div class="form-group mt-4">
                                        <label><?php echo e(trans_module_contact_us('app.the_products_you_are_interested_in')); ?></label>

                                        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input type="radio" v-model="favorite_product" value="<?php echo e($product->id); ?>" class="form-check-input" name="optradio"><?php echo e($product->name); ?>

                                                </label>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" v-model="favorite_product" value="other" class="form-check-input" name="optradio"><?php echo e(trans_module_contact_us('app.other')); ?>

                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group mt-4">
                                        <textarea name="" v-model="message" id="Message" class="form-control fs-14" rows="5" placeholder="<?php echo e(trans_module_contact_us('app.your_massage_to_us')); ?>"> </textarea>
                                        <span class="error" v-if="form.validation&&form.validation.message">{{ form.validation.message[0] }}</span>
                                    </div>
                                    <div class="form-group custom-class-recaptcha">
                                        <vue-recaptcha ref="recaptcha" @verify="onVerify" sitekey="<?php echo e(config('recaptcha.key')); ?>"></vue-recaptcha>
                                        <span class="error" v-if="form.validation&&form.validation.recaptcha">{{ form.validation.recaptcha[0] }}</span>
                                    </div>
                                    <div class="row mb-5">
                                        <div class="col-12 pt-4 text-right">
                                            <button type="button" @click="sendMessage" :disabled="form.disabledButton" class="btn btn-warning pl-5 pr-5 pt-2 pb-2 border-radius-25"><?php echo e(trans_module_contact_us('app.send')); ?></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </section>
            <div class="map-container mb-5"><?php echo $google_map; ?></div>
        </main>
    </contact-us-index>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('content_more'); ?>
<?php $__env->stopPush(); ?>
<?php $is_module = true; ?>

<?php $__env->startPush('js_module'); ?>
    <script src="<?php echo e(asset('js/app/contact_us.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('app.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\HP\Desktop\IG MEDICAL.COM\my_new_website\app\Modules\Contact\resources\views/app/index.blade.php ENDPATH**/ ?>