<!DOCTYPE html>
<html lang="en" dir="<?php echo e(Utility::getValByName('SITE_RTL') == 'on' ? 'rtl' : ''); ?>">

<head>

    <title><?php echo e(env('APP_NAME')); ?></title>

    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
         >

</head>
<body style="background: #e8e8e8">

<!-- Favicon icon -->
<?php
    $logo=\App\Models\Utility::get_file('uploads/logo/');

?>
<div class="container">
    <div class="d-flex justify-content-center">
        <div class="card m-5 p-5">

            <div class="row">

                    <img class="col-lg-6 col-12 d-none d-sm-block" src="<?php echo e($logo.'/construction.jpg'); ?>">

                <div class="col-lg-6 col-12 p-4 " style="background: #e8e8e8">

                    <div class="card p-2">
                        <center>
                            <img width="80" height="80"
                                 src="<?php echo e($logo . (isset($company_logo) && !empty($company_logo) ? $company_logo : 'logo-dark.png')); ?>"
                                 alt="<?php echo e(config('app.name', 'Posgo')); ?>" class="logo logo-lg">
                            <h2>Amarat Materials</h2>
                        </center>
                    </div>

                    <div class="">
                        <h2 class="mt-3 f-w-600"><?php echo e('Login'); ?></h2>
                    </div>
                    <?php if(session('error')): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <span class="alert-text"><?php echo e(session('error')); ?></span>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"
                                    onclick="this.parentElement.style.display='none';">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                    <?php endif; ?>



                    <?php if(Session::has('message')): ?>
                        <div class="alert <?php echo e(Session::get('alert-class', 'alert-info')); ?> alert-dismissible fade show ">
                            <?php echo e(Session::get('message')); ?>

                            <button type="button" class="btn-close mt-3" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <form method="POST" id="form_data" action="<?php echo e(route('login')); ?>" role="form">
                        <?php echo csrf_field(); ?>
                        <div class="">
                            <div class="form-group mb-3">
                                <label class="form-label"><?php echo e(__('Email')); ?></label>
                                <input id="email" type="email" placeholder="<?php echo e(__('Email')); ?>"
                                       class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="email"
                                       value="<?php echo e(old('email')); ?>" required autocomplete="email" autofocus>
                                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback" role="alert">
                                <small><?php echo e($message); ?></small>
                            </span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <div class="form-group mb-3">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        <label class="form-label"><?php echo e(__('Password')); ?></label>
                                    </div>

                                </div>

                                <input id="input-password" type="password" placeholder="<?php echo e(__('Password')); ?>"
                                       class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="password"
                                       required
                                       autocomplete="current-password">
                                <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback" role="alert">
                                <small><?php echo e($message); ?></small>
                            </span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>


                            <?php if(env('RECAPTCHA_MODULE') == 'yes'): ?>
                                <div class="form-group mb-3">
                                    <?php echo NoCaptcha::display(); ?>

                                    <?php $__errorArgs = ['g-recaptcha-response'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="small text-danger" role="alert">
                                    <strong><?php echo e($message); ?></strong>
                                </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            <?php endif; ?>


                            <div class="d-grid">
                                <button type="submit" style="background: #584ed2" class="btn btn-primary btn-block mt-2"
                                        id="login_button"><?php echo e(__('Login')); ?></button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
</body>
</html>

<?php /**PATH C:\wamp65\www\pos\resources\views/auth/login.blade.php ENDPATH**/ ?>