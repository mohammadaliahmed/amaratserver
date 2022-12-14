<?php
$currantLang = Auth::user()->lang;
$languages = \App\Models\Utility::languages();

$cust_theme_bg = App\Models\Utility::getValByName('cust_theme_bg');

?>



<?php if(isset($cust_theme_bg) && $cust_theme_bg == 'on'): ?>
    <header class="dash-header transprent-bg">
    <?php else: ?>
        <header class="dash-header">
<?php endif; ?>

<div class="header-wrapper">
    <div class="me-auto dash-mob-drp">
        <ul class="list-unstyled">
            <li class="dash-h-item mob-hamburger">
                <a href="#!" class="dash-head-link" id="mobile-collapse">
                    <div class="hamburger hamburger--arrowturn">
                        <div class="hamburger-box">
                            <div class="hamburger-inner"></div>
                        </div>
                    </div>
                </a>
            </li>
            <li class="dropdown dash-h-item drp-company">
                <a class="dash-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown" href="#"
                    role="button" aria-haspopup="false" aria-expanded="false">
                    
                    <span class="theme-avtar">
                        <img src="<?php echo e((!empty(\Auth::user()->avatar))?  \App\Models\Utility::get_file(\Auth::user()->avatar): asset(Storage::url("uploads/avatar/avatar.png"))); ?>" class="img-fluid rounded-circle">
                    </span>
                    <span class="hide-mob ms-2"><?php echo e(ucfirst(Auth::user()->name)); ?></span>
                    <i class="ti ti-chevron-down drp-arrow nocolor hide-mob"></i>
                </a>



                <div class="dropdown-menu dash-h-dropdown">

                    <a href="<?php echo e(route('profile.display')); ?>" class="dropdown-item">
                        <i class="ti ti-user"></i>
                        <span><?php echo e(__('Profile')); ?></span>
                    </a>


                    <a href="<?php echo e(route('logout')); ?>" class="dropdown-item"
                        onclick="event.preventDefault(); document.getElementById('logout-form1').submit();">
                        <i class="ti ti-power"></i>
                        <span><?php echo e(__('Logout')); ?></span>
                        <?php echo Form::open(['method' => 'POST', 'id' => 'logout-form1', 'route' => ['logout'], 'style' => 'display:none']); ?>

                        <?php echo Form::close(); ?>

                    </a>
                </div>
            </li>

        </ul>
    </div>
    <div class="ms-auto">





























    </div>
</div>
</header>
<?php /**PATH C:\wamp65\www\pos\resources\views/header.blade.php ENDPATH**/ ?>