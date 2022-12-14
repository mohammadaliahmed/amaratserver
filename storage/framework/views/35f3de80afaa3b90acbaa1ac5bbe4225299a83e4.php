<?php

// $logo = asset(Storage::url('logo'));
$logo=\App\Models\Utility::get_file('uploads/logo/');
$color = 'theme-3';
if (!empty($settings['color'])) {
    $color = $settings['color'];
}

$SITE_RTL = $settings['SITE_RTL'];
if ($SITE_RTL == '') {
    $SITE_RTL == 'off';
}

$file_type = config('files_types');
$setting = App\Models\Utility::settings();

$local_storage_validation    = $setting['local_storage_validation'];
$local_storage_validations   = explode(',', $local_storage_validation);

$s3_storage_validation    = $setting['s3_storage_validation'];
$s3_storage_validations   = explode(',', $s3_storage_validation);

$wasabi_storage_validation    = $setting['wasabi_storage_validation'];
$wasabi_storage_validations   = explode(',', $wasabi_storage_validation);


?>

<?php $__env->startSection('page-title'); ?>
   <?php echo e(__('Settings')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('title'); ?>
    <div class="d-inline-block">
        <h5 class="h4 d-inline-block font-weight-400 mb-0"><?php echo e(__('Settings')); ?></h5>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>"><?php echo e(__('Home')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Setting')); ?></li>
<?php $__env->stopSection(); ?>


<?php $__env->startPush('scripts'); ?>
    <script>
        $(document).ready(function() {
            $('#gdpr_cookie').trigger('change');
        });
        $(document).on('change', '#gdpr_cookie', function(e) {
            $('.gdpr_cookie_text').hide();
            if ($("#gdpr_cookie").prop('checked') == true) {
                $('.gdpr_cookie_text').show();
            }
        });
    </script>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-sm-12">
            <div class="row">
                <div class="col-xl-3">
                    <div class="card sticky-top " style="top:30px">
                        <div class="list-group list-group-flush" id="useradd-sidenav">

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Logos')): ?>
                                <a href="#site-setting"
                                    class="list-group-item list-group-item-action border-0"><?php echo e(__('Site Settings')); ?>

                                    <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                                </a>
                            <?php endif; ?>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Email Settings')): ?>
                                <a href="#email-setting"
                                    class="list-group-item list-group-item-action border-0"><?php echo e(__('Application / Mail')); ?><div
                                        class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                            <?php endif; ?>

                            <?php if(\Auth::user()->parent_id == 0): ?>
                            <a href="#email-notification-setting"
                                class="list-group-item list-group-item-action border-0"><?php echo e(__('Email Notification')); ?><div
                                    class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                            <?php endif; ?>

                            <?php if(\Auth::user()->parent_id == 0): ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('System Settings')): ?>
                                    <a href="#system-setting"
                                        class="list-group-item list-group-item-action border-0"><?php echo e(__('System Settings')); ?>

                                        <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                                    </a>
                                <?php endif; ?>
                            <?php endif; ?>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Billing Settings')): ?>
                                <a href="#owner-setting"
                                    class="list-group-item list-group-item-action border-0"><?php echo e(__('Billing Settings')); ?>

                                    <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                                </a>
                            <?php endif; ?>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Billing Settings')): ?>
                                <a href="#invoice-footer-setting"
                                    class="list-group-item list-group-item-action border-0"><?php echo e(__('Invoice Footer Details')); ?>

                                    <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                                </a>
                            <?php endif; ?>

                            <?php if(\Auth::user()->parent_id == 0): ?>
                                <a href="#recaptcha-setting"
                                    class="list-group-item list-group-item-action border-0"><?php echo e(__('ReCaptcha Settings')); ?>

                                    <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                                </a>
                            <?php endif; ?>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Purchases')): ?>
                                <a href="#purchase-invoice-setting"
                                    class="list-group-item list-group-item-action border-0"><?php echo e(__('Purchase Invoice')); ?> <div
                                        class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                            <?php endif; ?>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Sales')): ?>
                                <a href="#sale-invoice-setting"
                                    class="list-group-item list-group-item-action border-0"><?php echo e(__('Sale Invoice')); ?>

                                    <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                                </a>
                            <?php endif; ?>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Quotations')): ?>
                                <a href="#quotation-invoice-setting"
                                    class="list-group-item list-group-item-action border-0"><?php echo e(__('Quotation Invoice')); ?>

                                    <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                                </a>
                            <?php endif; ?>

                            <?php if(\Auth::user()->parent_id == 0): ?>
                            <a href="#storage-settig" class="list-group-item list-group-item-action border-0"><?php echo e(__('Storage Setting')); ?>

                                <div class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>



                <div class="col-xl-9">

                    <div id="site-setting" class="active">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Logos')): ?>
                            <?php echo e(Form::open(['url' => 'systems', 'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

                            <div class="card ">
                                <div class="card-header">
                                    <h5><?php echo e(__('Site Settings')); ?></h5>
                                </div>
                                <div class="card-body ">
                                    <div class="row">
                                        <div class="col-lg-12 col-sm-12 col-md-12">


                                            <div class=" setting-card">
                                                <div class="row mt-2">

                                                    

                                                    <div class="col-lg-4 col-sm-6 col-md-6">
                                                        <div class="card">
                                                            <div class="card-header">
                                                                <h5><?php echo e(__('Logo dark')); ?></h5>
                                                            </div>
                                                            <div class="card-body pt-0">
                                                                <div class=" setting-card">
                                                                    <div class="logo-content mt-4 setting-logo">
                                                                        <a href="<?php echo e($logo.(isset($logo_dark) && !empty($logo_dark)? $logo_dark:'logo-dark.png')); ?>" target="_blank">
                                                                            
                                                                                    <img id="blah" alt="your image" src="<?php echo e($logo.(isset($logo_dark) && !empty($logo_dark)? $logo_dark:'logo-dark.png')); ?>" width="150px" class="big-logo">
                                                                            </a>
                                                                        
                                                                    </div>
                                                                    <div class="choose-files mt-5">
                                                                        <label for="logo_dark">
                                                                            <div class=" bg-primary edit-logo_dark"> <i
                                                                                    class="ti ti-upload px-1"></i><?php echo e(__('Choose file here')); ?>

                                                                            </div>
                                                                            <input type="file" class="form-control file d-none" name="logo_dark" id="logo_dark" data-filename="edit-logo_dark" accept=".jpeg,.jpg,.png" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">

                                                                        </label>
                                                                    </div> 

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>  

                                                    <div class="col-lg-4 col-sm-6 col-md-6">
                                                        <div class="card">
                                                            <div class="card-header">
                                                                <h5><?php echo e(__('Logo Light')); ?></h5>
                                                            </div>
                                                            <div class="card-body pt-0">
                                                                <div class=" setting-card">
                                                                    <div class="logo-content mt-4 setting-logo">
                                                                        <a href="<?php echo e($logo.(isset($logo_light) && !empty($logo_light)?$logo_light:'logo-light.png')); ?>" target="_blank">
                                                                            <img id="blah1" alt="your image" src="<?php echo e($logo.(isset($logo_light) && !empty($logo_light)?$logo_light:'logo-light.png')); ?>" width="150px" class="big-logo img_setting">
                                                                        </a>
                                                                        
                                                                    </div>
                                                                    <div class="choose-files mt-5">
                                                                        <label for="logo_light">
                                                                            <div class=" bg-primary edit-logo_light"> <i
                                                                                    class="ti ti-upload px-1"></i><?php echo e(__('Choose file here')); ?>

                                                                            </div>
                                                                            <input type="file"
                                                                                class="form-control file d-none"
                                                                                name="logo_light" id="logo_light"
                                                                                data-filename="edit-logo_light" 
                                                                                onchange="document.getElementById('blah1').src = window.URL.createObjectURL(this.files[0])">
                                                                        </label>

                                                                    </div>
                                                                    <?php $__errorArgs = ['logo_light'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                        <div class="row">
                                                                            <span class="invalid-logo_light"
                                                                                role="alert">
                                                                                <strong
                                                                                    class="text-danger"><?php echo e($message); ?></strong>
                                                                            </span>
                                                                        </div>
                                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-4 col-sm-6 col-md-6">
                                                        <div class="card">
                                                            <div class="card-header">
                                                                <h5><?php echo e(__('Favicon')); ?></h5>
                                                            </div>
                                                            <div class="card-body pt-0">
                                                                <div class=" setting-card">
                                                                    <div class="logo-content mt-4 setting-logo">
                                                                        <a href="<?php echo e($logo.(isset($company_favicon) && !empty($company_favicon)? $company_favicon :'favicon.png')); ?>" target="_blank">
                                                                            <img id="blah2" alt="your image" src="<?php echo e($logo.(isset($company_favicon) && !empty($company_favicon)? $company_ficon :'favicon.png')); ?>" width="80px" class="big-logo img_setting">
                                                                        </a>
                                                                        
                                                                    </div>
                                                                    <div class="choose-files mt-5">
                                                                        <label for="favicon">
                                                                            <div class=" bg-primary favicon "> <i
                                                                                    class="ti ti-upload px-1"></i><?php echo e(__('Choose file here')); ?>

                                                                            </div>
                                                                            <input type="file"
                                                                                class="form-control file d-none" name="favicon" id="favicon"  data-filename="edit-favicon" 
                                                                                onchange="document.getElementById('blah2').src = window.URL.createObjectURL(this.files[0])">
                                                                        </label>
                                                                    </div>
                                                                    <?php $__errorArgs = ['favicon'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                        <div class="row">
                                                                            <span class="invalid-favicon" role="alert">
                                                                                <strong
                                                                                    class="text-danger"><?php echo e($message); ?></strong>
                                                                            </span>
                                                                        </div>
                                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>


                                        </div>
                                    </div>


                                    <div class="row ">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <?php echo e(Form::label('app_name', __('App Name'), ['class' => 'col-form-label text-dark'])); ?>

                                                <?php echo e(Form::text('app_name', env('APP_NAME'), ['class' => 'form-control', 'placeholder' => __('App Name')])); ?>

                                                <?php $__errorArgs = ['app_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <span class="invalid-app_name" role="alert">
                                                        <strong class="text-danger"><?php echo e($message); ?></strong>
                                                    </span>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group ">
                                                <?php echo e(Form::label('footer_text', __('Footer Text'), ['class' => 'col-form-label text-dark'])); ?>

                                                <?php echo e(Form::text('footer_text', env('FOOTER_TEXT'), ['class' => 'form-control', 'placeholder' => __('Footer Text')])); ?>

                                                <?php $__errorArgs = ['footer_text'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <span class="invalid-footer_text" role="alert">
                                                        <strong class="text-danger"><?php echo e($message); ?></strong>
                                                    </span>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <?php echo e(Form::label('default_language', __('Default Language'), ['class' => 'col-form-label text-dark'])); ?>

                                                <div class="changeLanguage">
                                                    <select name="default_language" id="default_language" data-toggle="select"
                                                        class="form-control">
                                                        <?php
                                                            $default_lan = !empty(env('DEFAULT_LANG')) ? env('DEFAULT_LANG') : 'en';
                                                        ?>
                                                        <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($language); ?>"
                                                                <?php if($default_lan == $language): ?> selected <?php endif; ?>>
                                                                <?php echo e(Str::upper($language)); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-3 ">
                                            <div class="col switch-width">
                                                <div class="form-group ml-2 mr-3">
                                                    <div class="custom-control custom-switch">
                                                        <label class="form-check-label col-form-label text-dark"
                                                            for="display_landing"><?php echo e(__('Landing Page Display')); ?></label>
                                                        <br>
                                                        <input type="checkbox" class="custom-control-input"
                                                            data-toggle="switchbutton" data-onstyle="primary"
                                                            name="display_landing" id="display_landing"
                                                            <?php if(env('DISPLAY_LANDING') == 'on'): ?> checked <?php endif; ?>>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-3 ">
                                            <div class="col switch-width">
                                                <div class="form-group ml-2 mr-3">
                                                    <div class="custom-control custom-switch">
                                                        <label class="form-check-label col-form-label text-dark"
                                                            for="SITE_RTL"><?php echo e(__('RTL')); ?></label> <br>
                                                        <input type="checkbox" data-toggle="switchbutton" data-onstyle="primary"
                                                            name="SITE_RTL" id="SITE_RTL"
                                                            <?php echo e(Utility::getValByName('SITE_RTL') == 'on' ? 'checked="checked"' : ''); ?>>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-3">
                                            <div class="custom-control custom-switch p-0">
                                                <div class="form-group ml-2 mr-3">
                                                    <label class="col-form-label"
                                                        for="gdpr_cookie"><?php echo e(__('GDPR Cookie')); ?></label><br>
                                                    <input type="checkbox" class="form-check-input gdpr_fulltime gdpr_type"
                                                        data-toggle="switchbutton" data-onstyle="primary" name="gdpr_cookie"
                                                        id="gdpr_cookie"
                                                        <?php echo e(isset($settings['gdpr_cookie']) && $settings['gdpr_cookie'] == 'on' ? 'checked="checked"' : ''); ?>>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <?php echo e(Form::label('cookie_text', __('GDPR Cookie Text'), ['class' => 'gdpr_cookie_text form-label'])); ?>

                                        <?php echo Form::textarea('cookie_text', isset($settings['cookie_text']) && $settings['cookie_text'] ? $settings['cookie_text'] : '', ['class' => 'form-control gdpr_cookie_text', 'style' => 'display: hidden;resize: none;', 'rows' => '2', 'placeholder' => 'Enter Cookie Text']); ?>

                                    </div>



                                    <h4 class="small-title"><?php echo e(__('Theme Customizer')); ?></h4>
                                    <div class="setting-card setting-logo-box p-3">
                                        <div class="row">
                                            <div class="col-4 my-auto">
                                                <h6 class="mt-3">
                                                    <i data-feather="credit-card"
                                                        class="me-2"></i><?php echo e(__('Primary color settings')); ?>

                                                </h6>
                                                <hr class="my-2" />
                                                <div class="theme-color themes-color">
                                                    <a href="#!"
                                                        class="theme-color-change <?php echo e($color == 'theme-1' ? 'active_color' : ''); ?>"
                                                        data-value="theme-1" onclick="check_theme('theme-1')"></a>
                                                    <input type="radio" class="theme_color" name="color" value="theme-1"
                                                        style="display: none;">
                                                    <a href="#!"
                                                        class="theme-color-change <?php echo e($color == 'theme-2' ? 'active_color' : ''); ?>"
                                                        data-value="theme-2" onclick="check_theme('theme-2')"></a>
                                                    <input type="radio" class="theme_color" name="color" value="theme-2"
                                                        style="display: none;">
                                                    <a href="#!"
                                                        class="theme-color-change <?php echo e($color == 'theme-3' ? 'active_color' : ''); ?>"
                                                        data-value="theme-3" onclick="check_theme('theme-3')"></a>
                                                    <input type="radio" class="theme_color" name="color" value="theme-3"
                                                        style="display: none;">
                                                    <a href="#!"
                                                        class="theme-color-change <?php echo e($color == 'theme-4' ? 'active_color' : ''); ?>"
                                                        data-value="theme-4" onclick="check_theme('theme-4')"></a>
                                                    <input type="radio" class="theme_color" name="color" value="theme-4"
                                                        style="display: none;">
                                                </div>
                                            </div>
                                            <div class="col-4 my-auto">
                                                <h6 class="ms-5">
                                                    <i data-feather="layout"
                                                        class="me-2"></i><?php echo e(__('Sidebar settings')); ?>

                                                </h6>
                                                <hr class="my-2 " />
                                                <div class="form-check form-switch  mt-2">
                                                    <input type="hidden" name="cust_theme_bg" value="off" />
                                                    <input type="checkbox" class="form-check-input ms-3" id="cust-theme-bg"
                                                        name="cust_theme_bg"
                                                        <?php echo e(Utility::getValByName('cust_theme_bg') == 'on' ? 'checked' : ''); ?> />
                                                    <label class="form-check-label f-w-600 pl-1 ms-2"
                                                        for="cust-theme-bg"><?php echo e(__('Transparent layout')); ?></label>
                                                </div>
                                            </div>
                                            <div class="col-4 my-auto">
                                                <h6 class="ms-5">
                                                    <i data-feather="sun"
                                                        class="me-2"></i><?php echo e(__('Layout settings')); ?>

                                                </h6>
                                                <hr class="my-2 " />
                                                <div class="form-check form-switch mt-2 ">
                                                    <input type="checkbox" class="form-check-input ms-3" id="cust-darklayout"
                                                        name="cust_darklayout"
                                                        <?php echo e(Utility::getValByName('cust_darklayout') == 'on' ? 'checked' : ''); ?> />
                                                    <label class="form-check-label f-w-600 pl-1 ms-2"
                                                        for="cust-darklayout"><?php echo e(__('Dark Layout')); ?></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-12 text-right">
                                            <?php echo e(Form::submit(__('Save Change'), ['class' => 'btn btn-primary float-end'])); ?>

                                        </div>
                                    </div>

                                </div>

                            </div>

                            <?php echo e(Form::close()); ?>

                        <?php endif; ?>


                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Email Settings')): ?>
                            <div id="email-setting" class="card">
                                <div class="email-setting-wrap ">
                                    <?php echo e(Form::open(['route' => 'general.settings', 'method' => 'POST'])); ?>


                                    <div class="card-header">
                                        <h3 class="h5"><?php echo e(__('Email Settings')); ?></h3>
                                    </div>

                                    <div class="row card-body pb-0">
                                        <div class="form-group col-md-4">
                                            <?php echo e(Form::label('mail_driver', __('Mail Driver'), ['class' => 'col-form-label text-dark'])); ?>

                                            <?php echo e(Form::text('mail_driver', env('MAIL_DRIVER'), ['class' => 'form-control', 'placeholder' => __('Enter Mail Driver')])); ?>

                                            <?php $__errorArgs = ['mail_driver'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="invalid-mail_driver" role="alert">
                                                    <strong class="text-danger"><?php echo e($message); ?></strong>
                                                </span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <?php echo e(Form::label('mail_host', __('Mail Host'), ['class' => 'col-form-label text-dark'])); ?>

                                            <?php echo e(Form::text('mail_host', env('MAIL_HOST'), ['class' => 'form-control ', 'placeholder' => __('Enter Mail Driver')])); ?>

                                            <?php $__errorArgs = ['mail_host'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="invalid-mail_driver" role="alert">
                                                    <strong class="text-danger"><?php echo e($message); ?></strong>
                                                </span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <?php echo e(Form::label('mail_port', __('Mail Port'), ['class' => 'col-form-label text-dark'])); ?>

                                            <?php echo e(Form::text('mail_port', env('MAIL_PORT'), ['class' => 'form-control', 'placeholder' => __('Enter Mail Port')])); ?>

                                            <?php $__errorArgs = ['mail_port'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="invalid-mail_port" role="alert">
                                                    <strong class="text-danger"><?php echo e($message); ?></strong>
                                                </span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <?php echo e(Form::label('mail_username', __('Mail Username'), ['class' => 'col-form-label text-dark'])); ?>

                                            <?php echo e(Form::text('mail_username', env('MAIL_USERNAME'), ['class' => 'form-control', 'placeholder' => __('Enter Mail Username')])); ?>

                                            <?php $__errorArgs = ['mail_username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="invalid-mail_username" role="alert">
                                                    <strong class="text-danger"><?php echo e($message); ?></strong>
                                                </span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <?php echo e(Form::label('mail_password', __('Mail Password'), ['class' => 'col-form-label text-dark'])); ?>

                                            <?php echo e(Form::text('mail_password', env('MAIL_PASSWORD'), ['class' => 'form-control', 'placeholder' => __('Enter Mail Password')])); ?>

                                            <?php $__errorArgs = ['mail_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="invalid-mail_password" role="alert">
                                                    <strong class="text-danger"><?php echo e($message); ?></strong>
                                                </span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <?php echo e(Form::label('mail_encryption', __('Mail Encryption'), ['class' => 'col-form-label text-dark'])); ?>

                                            <?php echo e(Form::text('mail_encryption', env('MAIL_ENCRYPTION'), ['class' => 'form-control', 'placeholder' => __('Enter Mail Encryption')])); ?>

                                            <?php $__errorArgs = ['mail_encryption'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="invalid-mail_encryption" role="alert">
                                                    <strong class="text-danger"><?php echo e($message); ?></strong>
                                                </span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <?php echo e(Form::label('mail_from_address', __('Mail From Address'), ['class' => 'col-form-label text-dark'])); ?>

                                            <?php echo e(Form::text('mail_from_address', env('MAIL_FROM_ADDRESS'), ['class' => 'form-control', 'placeholder' => __('Enter Mail From Address')])); ?>

                                            <?php $__errorArgs = ['mail_from_address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="invalid-mail_from_address" role="alert">
                                                    <strong class="text-danger"><?php echo e($message); ?></strong>
                                                </span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <?php echo e(Form::label('mail_from_name', __('Mail From Name'), ['class' => 'col-form-label text-dark'])); ?>

                                            <?php echo e(Form::text('mail_from_name', env('MAIL_FROM_NAME'), ['class' => 'form-control', 'placeholder' => __('Enter Mail From Name')])); ?>

                                            <?php $__errorArgs = ['mail_from_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="invalid-mail_from_name" role="alert">
                                                    <strong class="text-danger"><?php echo e($message); ?></strong>
                                                </span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                    </div>
                                    

                                    <div class="row card-body py-0 ">
                                        <div class="form-group col-md-12 ">
                                            <a href="#" class="btn btn-primary float-end  send_email"
                                                data-title="<?php echo e(__('Send Test Mail')); ?>"
                                                data-url="<?php echo e(route('test.email')); ?>">
                                                <?php echo e(__('Send Test Mail')); ?>

                                            </a>
                                        </div>
                                    </div>





                                    <div class="card-header">
                                        <h3 class="h5"><?php echo e(__('Application Settings')); ?></h3>
                                    </div>
                                    <div class="row card-body">
                                        <div class="form-group col-md-6">
                                            <?php echo e(Form::label('footer_link_1', __('Footer Link Title 1'), ['class' => 'col-form-label text-dark'])); ?>

                                            <?php echo e(Form::text('footer_link_1', env('FOOTER_LINK_1'), ['class' => 'form-control', 'placeholder' => __('Enter Footer Link Title 1')])); ?>

                                        </div>
                                        <div class="form-group col-md-6">
                                            <?php echo e(Form::label('footer_value_1', __('Footer Link href 1'), ['class' => 'col-form-label text-dark'])); ?>

                                            <?php echo e(Form::text('footer_value_1', env('FOOTER_VALUE_1'), ['class' => 'form-control', 'placeholder' => __('Enter Footer Link 1')])); ?>

                                        </div>
                                        <div class="form-group col-md-6">
                                            <?php echo e(Form::label('footer_link_2', __('Footer Link Title 2'), ['class' => 'col-form-label text-dark'])); ?>

                                            <?php echo e(Form::text('footer_link_2', env('FOOTER_LINK_2'), ['class' => 'form-control', 'placeholder' => __('Enter Footer Link Title 2')])); ?>

                                        </div>
                                        <div class="form-group col-md-6">
                                            <?php echo e(Form::label('footer_value_2', __('Footer Link href 2'), ['class' => 'col-form-label text-dark'])); ?>

                                            <?php echo e(Form::text('footer_value_2', env('FOOTER_VALUE_2'), ['class' => 'form-control', 'placeholder' => __('Enter Footer Link 2')])); ?>

                                        </div>
                                        <div class="form-group col-md-6">
                                            <?php echo e(Form::label('footer_link_3', __('Footer Link Title 3'), ['class' => 'col-form-label text-dark'])); ?>

                                            <?php echo e(Form::text('footer_link_3', env('FOOTER_LINK_3'), ['class' => 'form-control', 'placeholder' => __('Enter Footer Link Title 3')])); ?>

                                        </div>
                                        <div class="form-group col-md-6">
                                            <?php echo e(Form::label('footer_value_3', __('Footer Link href 3'), ['class' => 'col-form-label text-dark'])); ?>

                                            <?php echo e(Form::text('footer_value_3', env('FOOTER_VALUE_3'), ['class' => 'form-control', 'placeholder' => __('Enter Footer Link 3')])); ?>

                                        </div>

                                        <div class="    text-right mt-2">
                                            <?php echo e(Form::submit(__('Save Changes'), ['class' => 'btn btn-primary float-end'])); ?>

                                        </div>
                                    </div>


                                    <?php echo e(Form::close()); ?>

                                </div>
                            <?php endif; ?>
                        </div>

                        <?php if(\Auth::user()->parent_id == 0): ?>
                            <div id="email-notification-setting" class="card">
                               
                                <div class="col-md-12">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col-lg-8 col-md-8 col-sm-8">
                                                <h5><?php echo e(__('Email Notification')); ?></h5>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-body">
                                        <div class="row">
                                                <?php $__currentLoopData = $EmailTemplates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $EmailTemplate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div class="col-lg-4 col-md-6 col-sm-6 form-group">
                                                        <div class="list-group">
                                                            <div class="form-switch form-switch-right">
                                                                <label class="form-label" style="margin-left:5%;"><?php echo e($EmailTemplate->name); ?></label>
                                                            
                                                                <input class="form-check-input email-template-checkbox" id="email_tempalte_<?php echo e($EmailTemplate->template->id); ?>" type="checkbox" <?php if($EmailTemplate->template->is_active == 1): ?> checked="checked" <?php endif; ?> type="checkbox" value="<?php echo e($EmailTemplate->template->is_active); ?>" 
                                                                    data-url="<?php echo e(route('status.email.language',[$EmailTemplate->template->id])); ?>" />
                                                                <label class="form-check-label" for="email_tempalte_<?php echo e($EmailTemplate->template->id); ?>"></label>

                                                               
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        <?php endif; ?>

                        <?php if(\Auth::user()->parent_id == 0): ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('System Settings')): ?>
                                <div id="system-setting" class="card">

                                    <div class="email-setting-wrap">
                                        <?php echo e(Form::model($settings, ['route' => 'system.settings', 'method' => 'POST'])); ?>


                                        <?php echo e(Form::hidden('system_settings', '1')); ?>


                                        <div class="card-header">
                                            <h3 class="h5"><?php echo e(__('System Settings')); ?></h3>
                                        </div>
                                        <div class="row card-body">
                                            <div class="form-group col-md-4">
                                                <?php echo e(Form::label('low_product_stock_threshold', __('Low Product Stock Threshold'), ['class' => 'form-label text-dark', 'id' => 'number'])); ?>

                                                <?php echo e(Form::number('low_product_stock_threshold', null, ['class' => 'form-control font-style'])); ?>

                                            </div>
                                            <div class="form-group col-md-4">
                                                <?php echo e(Form::label('barcode_type', __('Barcode Type'), ['class' => 'form-label text-dark'])); ?>

                                                <?php echo e(Form::select('barcode_type', ['code128' => 'code 128', 'code39' => 'Code 39', 'code93' => 'code 93', 'code93' => 'code 93', 'datamatrix' => 'Data Matrix'], null, ['class' => 'form-control', 'data-toggle' => 'select'])); ?>

                                            </div>
                                            <div class="form-group col-md-4">
                                                <?php echo e(Form::label('barcode_format', __('Barcode Format'), ['class' => 'form-label text-dark'])); ?>

                                                <?php echo e(Form::select('barcode_format', ['css' => 'CSS', 'bmp' => 'BMP'], null, ['class' => 'form-control', 'data-toggle' => 'select'])); ?>

                                            </div>
                                            +
                                            <div class="form-group col-md-4">
                                                <?php echo e(Form::label('site_currency', __('Currency *'), ['class' => 'form-label text-dark'])); ?>

                                                <?php echo e(Form::text('site_currency', null, ['class' => 'form-control font-style', 'required' => 'required'])); ?>

                                            </div>
                                            <div class="form-group col-md-4">
                                                <?php echo e(Form::label('site_currency_symbol', __('Currency Symbol *'), ['class' => 'form-label text-dark'])); ?>

                                                <?php echo e(Form::text('site_currency_symbol', null, ['class' => 'form-control', 'required' => 'required'])); ?>

                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <?php echo e(Form::label('currencysymbolposition', __('Currency Symbol Position'), ['class' => 'form-label text-dark'])); ?>

                                                    <div class="row mt-2">
                                                        <div class="col-md-6">
                                                            <div class="form-check form-check-inline">
                                                                <?php echo e(Form::radio('site_currency_symbol_position', 'pre', null, ['class' => 'form-check-input', 'id' => 'presymbol'])); ?>

                                                                <?php echo e(Form::label('presymbol', __('Pre'), ['class' => 'form-check-label'])); ?>

                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-check form-check-inline">
                                                                <?php echo e(Form::radio('site_currency_symbol_position', 'post', null, ['class' => 'form-check-input', 'id' => 'postsymbol'])); ?>

                                                                <?php echo e(Form::label('postsymbol', __('Post'), ['class' => 'form-check-label'])); ?>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <?php echo e(Form::label('site_date_format', __('Date Format'), ['class' => 'form-label text-dark'])); ?>

                                                <?php echo e(Form::select('site_date_format', ['M j, Y' => date('M j, Y'), 'd-m-Y' => date('d-m-Y'), 'm-d-Y' => date('m-d-Y'), 'Y-m-d' => date('Y-m-d')], null, ['class' => 'form-control', 'data-toggle' => 'select'])); ?>

                                            </div>
                                            <div class="form-group col-md-4">
                                                <?php echo e(Form::label('site_time_format', __('Time Format'), ['class' => 'form-label text-dark'])); ?>

                                                <?php echo e(Form::select('site_time_format', ['g:i A' => date('g:i A'), 'g:i a' => date('g:i a'), 'H:i' => date('H:i')], null, ['class' => 'form-control', 'data-toggle' => 'select'])); ?>

                                            </div>
                                            <div class="form-group col-md-4">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <?php echo e(Form::label('purchase_invoice_prefix', __('Purchase Invoice Prefix'), ['class' => 'form-label text-dark'])); ?>

                                                <?php echo e(Form::text('purchase_invoice_prefix', null, ['class' => 'form-control'])); ?>

                                            </div>
                                            <div class="form-group col-md-4">
                                                <?php echo e(Form::label('sale_invoice_prefix', __('Sale Invoice Prefix'), ['class' => 'form-label text-dark'])); ?>

                                                <?php echo e(Form::text('sale_invoice_prefix', null, ['class' => 'form-control'])); ?>

                                            </div>
                                            <div class="form-group col-md-4">
                                                <?php echo e(Form::label('quotation_invoice_prefix', __('Quotation Invoice Prefix'), ['class' => 'form-label text-dark'])); ?>

                                                <?php echo e(Form::text('quotation_invoice_prefix', null, ['class' => 'form-control'])); ?>

                                            </div>
                                        </div>
                                        <div class="card-footer text-right text-end">
                                            <?php echo e(Form::submit(__('Save Changes'), ['class' => 'btn btn-primary'])); ?>

                                        </div>
                                        <?php echo e(Form::close()); ?>

                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Billing Settings')): ?>
                            <div id="owner-setting" class="card">

                                <div class="email-setting-wrap">
                                    <?php echo e(Form::model($settings, ['route' => 'system.settings', 'method' => 'POST'])); ?>


                                    <div class="card-header">
                                        <h3 class="h5"><?php echo e(__('Billing Settings')); ?></h3>
                                    </div>

                                    <div class="row card-body">
                                        <div class="form-group col-md-4">
                                            <?php echo e(Form::label('company_name', __('Company Name *'), ['class' => 'form-label text-dark'])); ?>

                                            <?php echo e(Form::text('company_name', null, ['class' => 'form-control font-style', 'required' => 'required', 'placeholder' => __('Enter Company Name')])); ?>

                                        </div>
                                        <div class="form-group col-md-4">
                                            <?php echo e(Form::label('company_address', __('Address'), ['class' => 'form-label text-dark'])); ?>

                                            <?php echo e(Form::text('company_address', null, ['class' => 'form-control font-style', 'placeholder' => __('Enter Address')])); ?>

                                        </div>
                                        <div class="form-group col-md-4">
                                            <?php echo e(Form::label('company_city', __('City'), ['class' => 'form-label text-dark'])); ?>

                                            <?php echo e(Form::text('company_city', null, ['class' => 'form-control font-style', 'placeholder' => __('Enter City')])); ?>

                                        </div>
                                        <div class="form-group col-md-4">
                                            <?php echo e(Form::label('company_state', __('State'), ['class' => 'form-label text-dark'])); ?>

                                            <?php echo e(Form::text('company_state', null, ['class' => 'form-control font-style', 'placeholder' => __('Enter State')])); ?>

                                        </div>
                                        <div class="form-group col-md-4">
                                            <?php echo e(Form::label('company_zipcode', __('Zip/Post Code'), ['class' => 'form-label text-dark'])); ?>

                                            <?php echo e(Form::text('company_zipcode', null, ['class' => 'form-control', 'placeholder' => __('Enter Zip/Post Code')])); ?>

                                        </div>
                                        <div class="form-group  col-md-4">
                                            <?php echo e(Form::label('company_country', __('Country'), ['class' => 'form-label text-dark'])); ?>

                                            <?php echo e(Form::text('company_country', null, ['class' => 'form-control font-style', 'placeholder' => __('Enter Country')])); ?>

                                        </div>
                                        <div class="form-group col-md-4">
                                            <?php echo e(Form::label('company_telephone', __('Telephone'), ['class' => 'form-label text-dark'])); ?>

                                            <?php echo e(Form::text('company_telephone', null, ['class' => 'form-control', 'placeholder' => __('Enter Telephone')])); ?>

                                        </div>
                                        <div class="form-group col-md-4">
                                            <?php echo e(Form::label('company_email', __('System Email *'), ['class' => 'form-label text-dark'])); ?>

                                            <?php echo e(Form::text('company_email', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => __('Enter System Email')])); ?>

                                        </div>
                                        <div class="form-group col-md-4">
                                            <?php echo e(Form::label('company_email_from_name', __('Email (From Name) *'), ['class' => 'form-label text-dark'])); ?>

                                            <?php echo e(Form::text('company_email_from_name', null, ['class' => 'form-control font-style', 'required' => 'required', 'placeholder' => __('Enter Email')])); ?>

                                        </div>
                                        <div class="form-group col-md-4">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-check form-check-inline">
                                                            <input type="radio" id="customRadio8" name="tax_type" value="VAT"
                                                                class="form-check-input"
                                                                <?php echo e($settings['tax_type'] == 'VAT' ? 'checked' : ''); ?>>
                                                            <label class="form-check-label"
                                                                for="customRadio8"><?php echo e(__('VAT Number')); ?></label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 ">
                                                        <div class="form-check form-check-inline">
                                                            <input type="radio" id="customRadio7" name="tax_type" value="GST"
                                                                class="form-check-input"
                                                                <?php echo e($settings['tax_type'] == 'GST' ? 'checked' : ''); ?>>
                                                            <label class="form-check-label"
                                                                for="customRadio7"><?php echo e(__('GST Number')); ?></label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php echo e(Form::text('vat_number', null, ['class' => 'form-control mt-2', 'placeholder' => __('Enter VAT / GST Number')])); ?>


                                            </div>
                                        </div>

                                    </div>
                                    <div class="card-footer text-right text-end">
                                        <?php echo e(Form::submit(__('Save Changes'), ['class' => 'btn btn-primary'])); ?>

                                    </div>
                                    <?php echo e(Form::close()); ?>


                                </div>
                            </div>
                        <?php endif; ?>


                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Billing Settings')): ?>
                            <div id="invoice-footer-setting" class="card">

                                <div class="email-setting-wrap">
                                    <?php echo e(Form::model($settings, ['route' => 'invoice.footer.settings', 'method' => 'POST'])); ?>


                                    <div class="card-header">
                                        <h3 class="h5"><?php echo e(__('Invoice Footer Details')); ?></h3>
                                    </div>

                                    <div class="row card-body">
                                        <div class="form-group col-md-12">
                                            <?php echo e(Form::label('invoice_footer_title', __('Invoice Footer Title'), ['class' => 'form-label text-dark'])); ?>

                                            <?php echo e(Form::text('invoice_footer_title', null, ['class' => 'form-control', 'placeholder' => __('Enter Invoice Footer Title'), 'required' => 'required'])); ?>

                                        </div>
                                        <div class="form-group col-md-12">
                                            <?php echo e(Form::label('invoice_footer_notes', __('Invoice Footer Notes'), ['class' => 'form-label text-dark'])); ?>

                                            <?php echo e(Form::textarea('invoice_footer_notes', null, ['class' => 'form-control', 'placeholder' => __('Enter Invoice Footer Notes'), 'required' => 'required', 'rows' => 3, 'style' => 'resize: none'])); ?>

                                        </div>
                                        <div class="col-md-12">
                                            <small><?php echo e(__('This detail will be displayed into invoice footer')); ?></small>
                                        </div>
                                    </div>
                                    <div class="card-footer text-right text-end">
                                        <?php echo e(Form::submit(__('Save Changes'), ['class' => 'btn btn-primary'])); ?>

                                    </div>
                                    <?php echo e(Form::close()); ?>

                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if(\Auth::user()->parent_id == 0): ?>
                            <div id="recaptcha-setting" class="card">
                                <div class="col-md-12">
                                    <form method="POST" action="<?php echo e(route('recaptcha.settings.store')); ?>"
                                        accept-charset="UTF-8">
                                        <div class="card-header">
                                            <div class="row">
                                                <div class="col-lg-8 col-md-8 col-sm-8">
                                                    <h5 class=""><?php echo e(__('ReCaptcha settings')); ?></h5>
                                                    <small
                                                        class="text-secondary font-weight-bold">(<?php echo e(__('How to Get Google reCaptcha Site and Secret key')); ?>)</small>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-4 text-end">
                                                    <div class="col switch-width">
                                                        <div class="custom-control custom-switch">
                                                            <input type="checkbox" name="recaptcha_module"
                                                                id="recaptcha_module" data-toggle="switchbutton"
                                                                <?php echo e(env('RECAPTCHA_MODULE') == 'yes' ? 'checked="checked"' : ''); ?>

                                                                value="yes" data-onstyle="primary">
                                                            <label class="custom-control-label form-control-label px-2"
                                                                for="recaptcha_module "></label><br>
                                                            <a href="https://phppot.com/php/how-to-get-google-recaptcha-site-and-secret-key/"
                                                                target="_blank" class="text-blue">

                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">

                                            <?php echo csrf_field(); ?>
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-sm-6 form-group">
                                                    <label for="google_recaptcha_key"
                                                        class="form-label"><?php echo e(__('Google Recaptcha Key')); ?></label>
                                                    <input class="form-control"
                                                        placeholder="<?php echo e(__('Enter Google Recaptcha Key')); ?>"
                                                        name="google_recaptcha_key" type="text"
                                                        value="<?php echo e(env('NOCAPTCHA_SITEKEY')); ?>"
                                                        id="google_recaptcha_key">
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 form-group">
                                                    <label for="google_recaptcha_secret"
                                                        class="form-label"><?php echo e(__('Google Recaptcha Secret')); ?></label>
                                                    <input class="form-control "
                                                        placeholder="<?php echo e(__('Enter Google Recaptcha Secret')); ?>"
                                                        name="google_recaptcha_secret" type="text"
                                                        value="<?php echo e(env('NOCAPTCHA_SECRET')); ?>"
                                                        id="google_recaptcha_secret">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer text-end">

                                            <?php echo e(Form::submit(__('Save Changes'), ['class' => 'btn btn-xs btn-primary'])); ?>


                                        </div>
                                    </form>
                                </div>
                            </div>
                        <?php endif; ?>


                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Purchases')): ?>
                            <div id="purchase-invoice-setting" class="card">
                                <div class="card-header">
                                    <h3 class="h5"><?php echo e(__('Purchase invoice')); ?></h3>
                                </div>
                                <div class="d-flex">
                                    <div class="invoice_color_pallate">
                                        <?php echo e(Form::model($settings, ['route' => 'template.settings', 'method' => 'POST'])); ?>


                                        <div class="form-group">
                                            <label for="address"
                                                class="form-label text-dark"><?php echo e(__('Invoice Template')); ?></label>
                                            <select class="form-control" data-toggle="select"
                                                name="purchase_invoice_template">
                                                <?php $__currentLoopData = \App\Models\Utility::templateData()['templates']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $template): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($key); ?>"
                                                        <?php echo e(isset($settings['purchase_invoice_template']) && $settings['purchase_invoice_template'] == $key ? 'selected' : ''); ?>>
                                                        <?php echo e($template); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label"><?php echo e(__('Color Input')); ?></label>
                                            <div class="row gutters-xs">
                                                <?php $__currentLoopData = \App\Models\Utility::templateData()['colors']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div class="col-auto">
                                                        <label class="colorinput">
                                                            <input name="purchase_invoice_color" type="radio"
                                                                value="<?php echo e($color); ?>" class="colorinput-input"
                                                                <?php echo e(isset($settings['purchase_invoice_color']) && $settings['purchase_invoice_color'] == $color ? 'checked' : ''); ?>>
                                                            <span class="colorinput-color"
                                                                style="background: #<?php echo e($color); ?>"></span>
                                                        </label>
                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        </div>
                                        <?php echo e(Form::submit(__('Save Changes'), ['class' => 'btn btn-primary float-end'])); ?>


                                        <?php echo e(Form::close()); ?>


                                    </div>
                                    <div class="main_invoice">
                                        <iframe id="purchase_invoice_frame" class="w-100 h-1050" frameborder="0"
                                            src="<?php echo e(route('purchased.invoice.preview', [$settings['purchase_invoice_template'], $settings['purchase_invoice_color']])); ?>"></iframe>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Sales')): ?>
                            <div id="sale-invoice-setting" class="card">
                                <div class="card-header">
                                    <h3 class="h5"><?php echo e(__('Sale invoice')); ?></h3>
                                </div>
                                <div class="d-flex">
                                    <div class="invoice_color_pallate">

                                        <?php echo e(Form::model($settings, ['route' => 'template.settings', 'method' => 'POST'])); ?>


                                        <div class="form-group">
                                            <label for="address"
                                                class='form-label text-dark'><?php echo e(__('Invoice Template')); ?></label>
                                            <select class="form-control" data-toggle="select" name="sale_invoice_template">
                                                <?php $__currentLoopData = \App\Models\Utility::templateData()['templates']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $template): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($key); ?>"
                                                        <?php echo e(isset($settings['sale_invoice_template']) && $settings['sale_invoice_template'] == $key ? 'selected' : ''); ?>>
                                                        <?php echo e($template); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label form-label text-dark"><?php echo e(__('Color Input')); ?></label>
                                            <div class="row gutters-xs">
                                                <?php $__currentLoopData = \App\Models\Utility::templateData()['colors']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div class="col-auto">
                                                        <label class="colorinput">
                                                            <input name="sale_invoice_color" type="radio"
                                                                value="<?php echo e($color); ?>" class="colorinput-input"
                                                                <?php echo e(isset($settings['sale_invoice_color']) && $settings['sale_invoice_color'] == $color ? 'checked' : ''); ?>>
                                                            <span class="colorinput-color"
                                                                style="background: #<?php echo e($color); ?>"></span>
                                                        </label>
                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        </div>
                                        <?php echo e(Form::submit(__('Save Changes'), ['class' => 'btn btn-primary'])); ?>


                                        <?php echo e(Form::close()); ?>


                                    </div>
                                    <div class="main_invoice">
                                        <iframe id="sale_invoice_frame" class="w-100 h-1050" frameborder="0"
                                            src="<?php echo e(route('selled.invoice.preview', [$settings['sale_invoice_template'], $settings['sale_invoice_color']])); ?>"></iframe>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>


                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Quotations')): ?>
                            <div id="quotation-invoice-setting" class="card">
                                <div class="card-header">
                                    <h3 class="h5"><?php echo e(__('Quotation invoice')); ?></h3>
                                </div>
                                <div class="d-flex">
                                    <div class="invoice_color_pallate">
                                        <?php echo e(Form::model($settings, ['route' => 'template.settings', 'method' => 'POST'])); ?>


                                        <div class="form-group">
                                            <label for="address"
                                                class='form-label text-dark'><?php echo e(__('Invoice Template')); ?></label>
                                            <select class="form-control" data-toggle="select"
                                                name="quotation_invoice_template">
                                                <?php $__currentLoopData = \App\Models\Utility::templateData()['templates']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $template): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($key); ?>"
                                                        <?php echo e(isset($settings['quotation_invoice_template']) && $settings['quotation_invoice_template'] == $key ? 'selected' : ''); ?>>
                                                        <?php echo e($template); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label form-label text-dark"><?php echo e(__('Color Input')); ?></label>
                                            <div class="row gutters-xs">
                                                <?php $__currentLoopData = \App\Models\Utility::templateData()['colors']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div class="col-auto">
                                                        <label class="colorinput">
                                                            <input name="quotation_invoice_color" type="radio"
                                                                value="<?php echo e($color); ?>" class="colorinput-input"
                                                                <?php echo e(isset($settings['quotation_invoice_color']) && $settings['quotation_invoice_color'] == $color ? 'checked' : ''); ?>>
                                                            <span class="colorinput-color"
                                                                style="background: #<?php echo e($color); ?>"></span>
                                                        </label>
                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        </div>
                                        <?php echo e(Form::submit(__('Save Changes'), ['class' => 'btn btn-primary'])); ?>


                                        <?php echo e(Form::close()); ?>


                                    </div>
                                    <div class="main_invoice">
                                        <iframe id="quotation_invoice_frame" class="w-100 h-1050" frameborder="0"
                                            src="<?php echo e(route('quotation.invoice.preview', [$settings['quotation_invoice_template'], $settings['quotation_invoice_color']])); ?>"></iframe>
                                    </div>

                                </div>
                            </div>
                        <?php endif; ?>


                           <!--storage Setting-->
                           <div id="storage-settig" class="card mb-3">
                            <?php echo e(Form::open(array('route' => 'storage.setting.store', 'enctype' => "multipart/form-data"))); ?>

                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-lg-10 col-md-10 col-sm-10">
                                            <h5 class=""><?php echo e(__('Storage Settings')); ?></h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="pe-2">
                                            <input type="radio" class="btn-check" name="storage_setting" id="local-outlined" autocomplete="off" <?php echo e($settings['storage_setting'] == 'local'?'checked':''); ?> value="local" checked>
                                            <label class="btn btn-outline-success" for="local-outlined"><?php echo e(__('Local')); ?></label>
                                        </div>
                                        <div  class="pe-2">
                                            <input type="radio" class="btn-check" name="storage_setting" id="s3-outlined" autocomplete="off" <?php echo e($settings['storage_setting']=='s3'?'checked':''); ?>  value="s3">
                                            <label class="btn btn-outline-success" for="s3-outlined"> <?php echo e(__('AWS S3')); ?></label>
                                        </div>

                                        <div  class="pe-2">
                                            <input type="radio" class="btn-check" name="storage_setting" id="wasabi-outlined" autocomplete="off" <?php echo e($settings['storage_setting']=='wasabi'?'checked':''); ?> value="wasabi">
                                            <label class="btn btn-outline-success" for="wasabi-outlined"><?php echo e(__('Wasabi')); ?></label>
                                        </div>
                                    </div>
                                    <div  class="mt-2">
                                    <div class="local-setting row">
                                        
                                        <div class="form-group col-8 switch-width">
                                            <?php echo e(Form::label('local_storage_validation',__('Only Upload Files'),array('class'=>' form-label'))); ?>

                                                <select name="local_storage_validation[]" class="select2"  id="local_storage_validation"  multiple>
                                                    <?php $__currentLoopData = $file_type; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $f): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option <?php if(in_array($f, $local_storage_validations)): ?> selected <?php endif; ?>><?php echo e($f); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="form-label" for="local_storage_max_upload_size"><?php echo e(__('Max upload size ( In MB)')); ?></label>
                                                <input type="number" name="local_storage_max_upload_size" class="form-control" value="<?php echo e((!isset($settings['local_storage_max_upload_size']) || is_null($settings['local_storage_max_upload_size'])) ? '' : $settings['local_storage_max_upload_size']); ?>" placeholder="<?php echo e(__('Max upload size')); ?>">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="s3-setting row <?php echo e($settings['storage_setting']=='s3'?' ':'d-none'); ?>">
                                        
                                        <div class=" row ">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="s3_key"><?php echo e(__('S3 Key')); ?></label>
                                                    <input type="text" name="s3_key" class="form-control" value="<?php echo e((!isset($settings['s3_key']) || is_null($settings['s3_key'])) ? '' : $settings['s3_key']); ?>" placeholder="<?php echo e(__('S3 Key')); ?>">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="s3_secret"><?php echo e(__('S3 Secret')); ?></label>
                                                    <input type="text" name="s3_secret" class="form-control" value="<?php echo e((!isset($settings['s3_secret']) || is_null($settings['s3_secret'])) ? '' : $settings['s3_secret']); ?>" placeholder="<?php echo e(__('S3 Secret')); ?>">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="s3_region"><?php echo e(__('S3 Region')); ?></label>
                                                    <input type="text" name="s3_region" class="form-control" value="<?php echo e((!isset($settings['s3_region']) || is_null($settings['s3_region'])) ? '' : $settings['s3_region']); ?>" placeholder="<?php echo e(__('S3 Region')); ?>">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="s3_bucket"><?php echo e(__('S3 Bucket')); ?></label>
                                                    <input type="text" name="s3_bucket" class="form-control" value="<?php echo e((!isset($settings['s3_bucket']) || is_null($settings['s3_bucket'])) ? '' : $settings['s3_bucket']); ?>" placeholder="<?php echo e(__('S3 Bucket')); ?>">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="s3_url"><?php echo e(__('S3 URL')); ?></label>
                                                    <input type="text" name="s3_url" class="form-control" value="<?php echo e((!isset($settings['s3_url']) || is_null($settings['s3_url'])) ? '' : $settings['s3_url']); ?>" placeholder="<?php echo e(__('S3 URL')); ?>">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="s3_endpoint"><?php echo e(__('S3 Endpoint')); ?></label>
                                                    <input type="text" name="s3_endpoint" class="form-control" value="<?php echo e((!isset($settings['s3_endpoint']) || is_null($settings['s3_endpoint'])) ? '' : $settings['s3_endpoint']); ?>" placeholder="<?php echo e(__('S3 Bucket')); ?>">
                                                </div>
                                            </div>
                                            <div class="form-group col-8 switch-width">
                                                <?php echo e(Form::label('s3_storage_validation',__('Only Upload Files'),array('class'=>' form-label'))); ?>

                                                    <select name="s3_storage_validation[]" class="select2" id="s3_storage_validation" multiple>
                                                        <?php $__currentLoopData = $file_type; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $f): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option <?php if(in_array($f, $s3_storage_validations)): ?> selected <?php endif; ?>><?php echo e($f); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label class="form-label" for="s3_max_upload_size"><?php echo e(__('Max upload size ( In MB)')); ?></label>
                                                    <input type="number" name="s3_max_upload_size" class="form-control" value="<?php echo e((!isset($settings['s3_max_upload_size']) || is_null($settings['s3_max_upload_size'])) ? '' : $settings['s3_max_upload_size']); ?>" placeholder="<?php echo e(__('Max upload size')); ?>">
                                                </div>
                                            </div>
                                        </div>
                                    
                                    </div>

                                    <div class="wasabi-setting row <?php echo e($settings['storage_setting']=='wasabi'?' ':'d-none'); ?>">
                                        <div class=" row ">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="s3_key"><?php echo e(__('Wasabi Key')); ?></label>
                                                    <input type="text" name="wasabi_key" class="form-control" value="<?php echo e((!isset($settings['wasabi_key']) || is_null($settings['wasabi_key'])) ? '' : $settings['wasabi_key']); ?>" placeholder="<?php echo e(__('Wasabi Key')); ?>">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="s3_secret"><?php echo e(__('Wasabi Secret')); ?></label>
                                                    <input type="text" name="wasabi_secret" class="form-control" value="<?php echo e((!isset($settings['wasabi_secret']) || is_null($settings['wasabi_secret'])) ? '' : $settings['wasabi_secret']); ?>" placeholder="<?php echo e(__('Wasabi Secret')); ?>">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="s3_region"><?php echo e(__('Wasabi Region')); ?></label>
                                                    <input type="text" name="wasabi_region" class="form-control" value="<?php echo e((!isset($settings['wasabi_region']) || is_null($settings['wasabi_region'])) ? '' : $settings['wasabi_region']); ?>" placeholder="<?php echo e(__('Wasabi Region')); ?>">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="wasabi_bucket"><?php echo e(__('Wasabi Bucket')); ?></label>
                                                    <input type="text" name="wasabi_bucket" class="form-control" value="<?php echo e((!isset($settings['wasabi_bucket']) || is_null($settings['wasabi_bucket'])) ? '' : $settings['wasabi_bucket']); ?>" placeholder="<?php echo e(__('Wasabi Bucket')); ?>">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="wasabi_url"><?php echo e(__('Wasabi URL')); ?></label>
                                                    <input type="text" name="wasabi_url" class="form-control" value="<?php echo e((!isset($settings['wasabi_url']) || is_null($settings['wasabi_url'])) ? '' : $settings['wasabi_url']); ?>" placeholder="<?php echo e(__('Wasabi URL')); ?>">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="wasabi_root"><?php echo e(__('Wasabi Root')); ?></label>
                                                    <input type="text" name="wasabi_root" class="form-control" value="<?php echo e((!isset($settings['wasabi_root']) || is_null($settings['wasabi_root'])) ? '' : $settings['wasabi_root']); ?>" placeholder="<?php echo e(__('Wasabi Bucket')); ?>">
                                                </div>
                                            </div>
                                            <div class="form-group col-8 switch-width">
                                                <?php echo e(Form::label('wasabi_storage_validation',__('Only Upload Files'),array('class'=>'form-label'))); ?>


                                                <select name="wasabi_storage_validation[]" class="select2" id="wasabi_storage_validation" multiple>
                                                    <?php $__currentLoopData = $file_type; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $f): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option <?php if(in_array($f, $wasabi_storage_validations)): ?> selected <?php endif; ?>><?php echo e($f); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label class="form-label" for="wasabi_root"><?php echo e(__('Max upload size ( In MB)')); ?></label>
                                                    <input type="number" name="wasabi_max_upload_size" class="form-control" value="<?php echo e((!isset($settings['wasabi_max_upload_size']) || is_null($settings['wasabi_max_upload_size'])) ? '' : $settings['wasabi_max_upload_size']); ?>" placeholder="<?php echo e(__('Max upload size')); ?>">
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-end">
                                    <input class="btn btn-print-invoice  btn-primary m-r-10" type="submit" value="<?php echo e(__('Save Changes')); ?>">
                                </div>
                            <?php echo e(Form::close()); ?>

                        </div>



                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script>
        $(document).on('keypress keydown keyup', '#low_product_stock_threshold', function() {
            if ($(this).val() == '' || $(this).val() < 0) {
                $(this).val('0');
            }
        });
        $(document).on("change", "select[name='purchase_invoice_template'], input[name='purchase_invoice_color']",
            function() {
                var template = $("select[name='purchase_invoice_template']").val();
                var color = $("input[name='purchase_invoice_color']:checked").val();
                $('#purchase_invoice_frame').attr('src', '<?php echo e(url('purchased-invoices/preview')); ?>/' + template +
                    '/' +
                    color);
            });
        $(document).on("change", "select[name='sale_invoice_template'], input[name='sale_invoice_color']", function() {
            var template = $("select[name='sale_invoice_template']").val();
            var color = $("input[name='sale_invoice_color']:checked").val();
            $('#sale_invoice_frame').attr('src', '<?php echo e(url('selled-invoices/preview')); ?>/' + template + '/' +
                color);
        });
        $(document).on("change", "select[name='quotation_invoice_template'], input[name='quotation_invoice_color']",
            function() {
                var template = $("select[name='quotation_invoice_template']").val();
                var color = $("input[name='quotation_invoice_color']:checked").val();
                $('#quotation_invoice_frame').attr('src', '<?php echo e(url('quotation-invoices/preview')); ?>/' + template +
                    '/' + color);
            });

        $(document).on("click", '.send_email', function(e) {
            e.preventDefault();
            var title = $(this).attr('data-title');
            var size = 'md';
            var url = $(this).attr('data-url');
            if (typeof url != 'undefined') {
            // alert('hiii');
                $("#commonModal .modal-title").html(title);
                $("#commonModal .modal").addClass('modal-' + size);

                $.ajax({
                    url: url,
                    type: 'POST',
                    dataType: 'html',
                    data: {
                        mail_driver: $("#mail_driver").val(),
                        mail_host: $("#mail_host").val(),
                        mail_port: $("#mail_port").val(),
                        mail_username: $("#mail_username").val(),
                        mail_password: $("#mail_password").val(),
                        mail_encryption: $("#mail_encryption").val(),
                        mail_from_address: $("#mail_from_address").val(),
                        mail_from_name: $("#mail_from_name").val(),
                    },
                    cache: false,
                    success: function(data) {
                        // ipe
                        $('#commonModal .body').html(data);
                        $('#commonModal').modal('show')({
                            backdrop: 'static',
                            keyboard: false
                        });
                    },
                    error: function(data) {
                        data = data.responseJSON;
                        show_toastr('<?php echo e(__('Error')); ?>', data.error, 'error');
                    }
                });
            }
        });
        $(document).on('submit', '#test_email', function(e) {
            e.preventDefault();
            $("#email_sending").show();
            var post = $(this).serialize();
            var url = $(this).attr('action');
            $.ajax({
                type: "post",
                url: url,
                data: post,
                cache: false,
                success: function(data) {
                    if (data.is_success) {
                        show_toastr('Success', data.message, 'success');
                    } else {
                        show_toastr('<?php echo e(__('Error')); ?>', data.message, 'error');
                    }
                    $("#email_sending").hide();
                }
            });
        });

        $(document).on('change', 'input[name="enable_stripe"]', function(e) {
            e.preventDefault();

            if ($(this).prop('checked')) {
                $('#stripe_key, #stripe_secret').attr('required', 'required');
            } else {
                $('#stripe_key, #stripe_secret').removeAttr('required');
            }
        });

        $(document).on('change', 'input[name="enable_paypal"]', function(e) {
            e.preventDefault();

            if ($(this).prop('checked')) {
                $('#paypal_client_id, #paypal_secret_key').attr('required', 'required');
            } else {
                $('#paypal_client_id, #paypal_secret_key').removeAttr('required');
            }
        });

        $('input[name="enable_stripe"], input[name="enable_paypal"]').trigger('change');


        // var type = window.location.hash.substr(1);
        // $('.list-group-item').removeClass('active');
        // $('.list-group-item').removeClass('text-primary');
        // if (type != '') {
        //     $('a[href="#' + type + '"]').addClass('active').removeClass('text-primary');
        // } else {
        //     $('.list-group-item:eq(0)').addClass('active').removeClass('text-primary');
        // }

        // $(document).on('click', '.list-group-item', function() {
        //     $('.list-group-item').removeClass('active');
        //     $('.list-group-item').removeClass('text-primary');
        //     setTimeout(() => {
        //         $(this).addClass('active').removeClass('text-primary');
        //     }, 10);
        // });

        var scrollSpy = new bootstrap.ScrollSpy(document.body, {
            target: '#useradd-sidenav',
            offset: 300
        })



        // Start [ Menu hide/show on scroll ]
        let ost = 0;
        document.addEventListener("scroll", function() {
            let cOst = document.documentElement.scrollTop;
            if (cOst == 0) {
                document.querySelector(".navbar").classList.add("top-nav-collapse");
            } else if (cOst > ost) {
                document.querySelector(".navbar").classList.add("top-nav-collapse");
                document.querySelector(".navbar").classList.remove("default");
            } else {
                document.querySelector(".navbar").classList.add("default");
                document
                    .querySelector(".navbar")
                    .classList.remove("top-nav-collapse");
            }
            ost = cOst;
        });
        // End [ Menu hide/show on scroll ]
        var wow = new WOW({
            animateClass: "animate__animated", // animation css class (default is animated)
        });
        wow.init();
        var scrollSpy = new bootstrap.ScrollSpy(document.body, {
            target: "#navbar-example",
        });

        $('.themes-color-change').on('click', function() {
            var color_val = $(this).data('value');
            $('.theme-color').prop('checked', false);
            $('.themes-color-change').removeClass('active_color');
            $(this).addClass('active_color');
            $(`input[value=${color_val}]`).prop('checked', true);
        });

        function check_theme(color_val) {
            $('#theme_color').prop('checked', false);
            $('input[value="' + color_val + '"]').prop('checked', true);
        }
    </script>

<script type="text/javascript">

    $(document).on("click", ".email-template-checkbox", function () {
        //  alert('hii');   
        var chbox = $(this);
        $.ajax({
            url: chbox.attr('data-url'),
            data: {_token: $('meta[name="csrf-token"]').attr('content'), status: chbox.val()},
            type: 'post',
            success: function (response) {
                if (response.is_success) {


                    // show_toastr('success', response.success, 'success')


                    toastr('Success', response.success, 'success');
                    if (chbox.val() == 1) {
                        $('#' + chbox.attr('id')).val(0);
                    } else {
                        $('#' + chbox.attr('id')).val(1);
                    }
                } else {
                    toastr('Error', response.error, 'error');
                }
            },
            error: function (response) {
                response = response.responseJSON;
                if (response.is_success) {
                    toastr('Error', response.error, 'error');
                } else {
                    // toastr('Error', response, 'error');
                }
            }
        })
    });

</script>


<script>
    var scrollSpy = new bootstrap.ScrollSpy(document.body, {
        target: '#useradd-sidenav',
        offset: 300,
    })
    $(".list-group-item").click(function(){
        $('.list-group-item').filter(function(){
            return this.href == id;
        }).parent().removeClass('text-primary');
    });

    function check_theme(color_val) {
        $('#theme_color').prop('checked', false);
        $('input[value="' + color_val + '"]').prop('checked', true);
    }

    $(document).on('change','[name=storage_setting]',function(){
    if($(this).val() == 's3'){
        $('.s3-setting').removeClass('d-none');
        $('.wasabi-setting').addClass('d-none');
        $('.local-setting').addClass('d-none');
    }else if($(this).val() == 'wasabi'){
        $('.s3-setting').addClass('d-none');
        $('.wasabi-setting').removeClass('d-none');
        $('.local-setting').addClass('d-none');
    }else{
        $('.s3-setting').addClass('d-none');
        $('.wasabi-setting').addClass('d-none');
        $('.local-setting').removeClass('d-none');
    }
});
</script>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp65\www\pos\resources\views/settings/index.blade.php ENDPATH**/ ?>