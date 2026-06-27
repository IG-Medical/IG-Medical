<script>
    <?php if(session()->has('success_message') || isset($success_message)): ?>
    <?php
        $message= isset($success_message) ? $success_message : session('success_message');
    ?>
    toastSuccess('<?php echo e($message); ?>');
    <?php endif; ?>

    <?php if(session()->has('error_message') || isset($error_message)): ?>
    <?php
        $message= isset($success_message) ? $success_message : session('error_message');
    ?>
    toastError('<?php echo e($message); ?>');
    <?php endif; ?>

    <?php if(session()->has('info_message') || isset($info_message)): ?>
    <?php
        $message= isset($success_message) ? $success_message : session('info_message');
    ?>
    toastInfo('<?php echo e($message); ?>');
    <?php endif; ?>

    <?php if(session()->has('warning_message') || isset($warning_message)): ?>
    <?php
        $message= isset($success_message) ? $success_message : session('warning_message');
    ?>
    toastWarning('<?php echo e($message); ?>');
    <?php endif; ?>

    <?php if(session()->has('default_message') || isset($default_message)): ?>
    <?php
        $message= isset($success_message) ? $success_message : session('default_message');
    ?>
    toastDefault('<?php echo e($message); ?>);
    <?php endif; ?>

</script>
<?php /**PATH C:\Users\HP\Desktop\IG MEDICAL.COM\my_new_website\resources\views/app/layouts/includes/alert.blade.php ENDPATH**/ ?>