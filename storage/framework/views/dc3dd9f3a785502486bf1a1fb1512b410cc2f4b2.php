<?php
    $user = Auth::user();
    if ($user) {
        $currantLang = $user->lang;
        $languages = \App\Models\Utility::languages();
    }

    $emailTemplate     = App\Models\EmailTemplate::first();

    // $logo = asset(Storage::url('logo'));
    $logo=\App\Models\Utility::get_file('uploads/logo/');

    $company_logo = App\Models\Utility::get_superadmin_logo();

    $cust_theme_bg = App\Models\Utility::getValByName('cust_theme_bg');
?>

<?php if((isset($cust_theme_bg) && $cust_theme_bg == 'on')): ?>
    <nav class="dash-sidebar light-sidebar transprent-bg">
        <?php else: ?>
            <nav class="dash-sidebar light-sidebar">
                <?php endif; ?>


                <div class="navbar-wrapper">
                    <div class="m-header main-logo bg-primary">
                        <a href="<?php echo e(route('home')); ?>" class="b-brand">
                            <!-- ========   change your logo hear   ============ -->
                            <img
                                src="<?php echo e($logo . (isset($company_logo) && !empty($company_logo) ? $company_logo : 'logo-dark.png')); ?>"
                                alt="<?php echo e(config('app.name', 'Posgo')); ?>" class="logo logo-lg">


                        </a>
                    </div>
                    <br>
                    <div class="d-flex justify-content-center">
                        <h3><?php echo e(config('app.name')); ?></h3>
                    </div>
                    <div class="navbar-content">
                        <ul class="dash-navbar">
                            <li class="dash-item  <?php echo e(Request::segment(1) == '' ? 'active' : ''); ?>">
                                <a href="<?php echo e(route('home')); ?>" class="dash-link"><span class="dash-micon"><i
                                            class="ti ti-home"></i></span><span
                                        class="dash-mtext"><?php echo e(__('Dashboard')); ?></span></a>
                            </li>



                            <li class="dash-item">
                                <a href="<?php echo e(route('reports.sales')); ?>" class="dash-link"><span class="dash-micon"><i
                                            class="ti ti-book"></i></span><span
                                        class="dash-mtext"><?php echo e(__('Orders')); ?></span><span class="dash-arrow"><i
                                            data-feather="chevron-right"></i></span></a>

                            </li>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Sales')): ?>
                                <li class="dash-item">
                                    <a href="#" class="dash-link"><span class="dash-micon"><i
                                                class="ti ti-book"></i></span><span
                                            class="dash-mtext"><?php echo e(__('Sales')); ?></span><span class="dash-arrow"><i
                                                data-feather="chevron-right"></i></span></a>


                                    <ul class="dash-submenu">

                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Product')): ?>
                                            <li class="">
                                                <a class="dash-link" href="<?php echo e(route('sales.index')); ?>">Add Sale</a>
                                            </li>
                                        <?php endif; ?>


                                    </ul>
                                </li>
                            <?php endif; ?>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Customer')): ?>
                                <li class="dash-item ">
                                    <a href="<?php echo e(route('customers.index')); ?>"
                                       class="dash-link <?php echo e(Request::segment(1) == 'customers' ? 'active' : ''); ?>"><span
                                            class="dash-micon"><i class="ti ti-user"></i></span><span
                                            class="dash-mtext"><?php echo e(__('Customers')); ?></span>
                                    </a>
                                </li>
                            <?php endif; ?>


                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Vendor')): ?>

                                <li class="dash-item">
                                    <a href="#" class="dash-link"><span class="dash-micon"><i
                                                class="ti ti-brand-producthunt"></i></span><span
                                            class="dash-mtext"><?php echo e(__('Vendors')); ?></span><span class="dash-arrow"><i
                                                data-feather="chevron-right"></i></span></a>
                                    <ul class="dash-submenu">


                                        <li class="">
                                            <a class="dash-link" href="<?php echo e(route('vendors.index')); ?>">Vendors</a>
                                        </li>
                                        <li class="">
                                            <a class="dash-link" href="<?php echo e(route('vendors.orders')); ?>">Assigned
                                                Orders</a>
                                        </li>
                                    </ul>
                                </li>
                            <?php endif; ?>


                            <?php if(Gate::check('Manage Product') || Gate::check('Manage Category') || Gate::check('Manage Brand') || Gate::check('Manage Tax') || Gate::check('Manage Unit')): ?>

                                <li class="dash-item">
                                    <a href="#" class="dash-link"><span class="dash-micon"><i
                                                class="ti ti-brand-producthunt"></i></span><span
                                            class="dash-mtext"><?php echo e(__('Products')); ?></span><span class="dash-arrow"><i
                                                data-feather="chevron-right"></i></span></a>


                                    <ul class="dash-submenu">

                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Product')): ?>
                                            <li class="">
                                                <a class="dash-link" href="<?php echo e(route('products.index')); ?>">Products</a>
                                            </li>
                                        <?php endif; ?>

                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Category')): ?>
                                            <li class="">
                                                <a class="dash-link"
                                                   href="<?php echo e(route('categories.index')); ?>">Categories</a>
                                            </li>
                                        <?php endif; ?>

                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Brand')): ?>
                                            <li class="">
                                                <a class="dash-link" href="<?php echo e(route('brands.index')); ?>">Brands</a>
                                            </li>
                                        <?php endif; ?>

                                        
                                        
                                        
                                        
                                        

                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Unit')): ?>
                                            <li class="">
                                                <a class="dash-link" href="<?php echo e(route('units.index')); ?>">Unit</a>
                                            </li>
                                        <?php endif; ?>

                                    </ul>
                                </li>
                            <?php endif; ?>

                            
                            
                            
                            
                            
                            
                            


                            

                            
                            
                            
                            
                            
                            

                            
                            
                            
                            
                            
                            

                            
                            
                            



                            

                            
                            
                            
                            
                            
                            

                            
                            
                            
                            
                            
                            
                            
                            
                            
                            

                            
                            
                            
                            
                            
                            
                            


                            

                            
                            
                            
                            
                            

                            
                            
                            
                            
                            
                            

                            
                            
                            


                            
                            
                            
                            
                            
                            
                            
                            
                            


                            
                            
                            
                            
                            
                            
                            
                            
                            

                            
                            
                            
                            
                            
                            
                            


                            

                            <?php if(Gate::check('Manage User') || Gate::check('Manage Role') || Gate::check('Manage Permission')): ?>
                                <li class="">
                                    <a href="#!" class="dash-link"><span class="dash-micon"><i class="ti ti-users"></i></span><span
                                            class="dash-mtext"><?php echo e(__('Staff')); ?></span><span class="dash-arrow"><i
                                                data-feather="chevron-right"></i></span></a>
                                    <ul class="dash-submenu">

                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage User')): ?>
                                            <li class="">
                                                <a class="dash-link" href="<?php echo e(route('users.index')); ?>">Users</a>
                                            </li>
                                        <?php endif; ?>

                                        
                                        
                                        
                                        
                                        

                                    </ul>
                                </li>
                            <?php endif; ?>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Coupon')): ?>
                                <li class="">
                                    <a href="<?php echo e(route('coupons.index')); ?>"
                                       class="dash-link <?php echo e(Request::segment(1) == 'coupons' || \Request::route()->getName() == 'coupons.view' ? 'active' : ''); ?>"><span
                                            class="dash-micon"><i class="ti ti-gift"></i></span><span
                                            class="dash-mtext"><?php echo e(__('Coupons')); ?></span>
                                    </a>
                                </li>
                            <?php endif; ?>

                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            

                            


                            
                            
                            
                            
                            
                            

                            
                            
                            
                            
                            
                            

                            
                            
                            
                            
                            
                            

                            
                            
                            
                            
                            
                            

                            
                            
                            
                            
                            
                            

                            
                            
                            
                            
                            
                            

                            
                            
                            
                            
                            
                            

                            
                            
                            
                            
                            
                            
                            

                            
                            
                            
                            
                            
                            
                            
                            
                            
                            



                            
                            
                            
                            
                            
                            
                            

                            
                            
                            
                            
                            
                            

                            
                            
                            
                            
                            
                            

                            
                            
                            
                            
                            
                            

                            
                            
                            
                            
                            
                            

                            
                            
                            

                        </ul>
                    </div>
                    </ul>

                </div>
                </div>
            </nav>
<?php /**PATH C:\wamp65\www\pos\resources\views/sidenav.blade.php ENDPATH**/ ?>