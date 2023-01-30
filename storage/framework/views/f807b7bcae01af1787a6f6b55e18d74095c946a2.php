<?php $__env->startSection('title'); ?>
    <div class="d-inline-block">
        <h5 class="h4 d-inline-block font-weight-400 mb-0"><?php echo e(__('Dashboard')); ?></h5>
    </div>
<?php $__env->stopSection(); ?>



<?php $__env->startPush('old-datatable-css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('custom/css/jquery.dataTables.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('custom/css/customdatatable.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/plugins/flatpickr.min.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startPush('stylesheets'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/fullcalendar.min.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
    <script src="<?php echo e(asset('assets/js/plugins/flatpickr.min.js')); ?>"></script>
    <script>
        // minimum setup
        document.querySelector("#pc-daterangepicker-1").flatpickr({
            mode: "range",
            onChange: function (selectedDates, dateStr, instance) {
                var dates = dateStr.split(" to ");
                var start = moment(dates[0]).format('YYYY-MM-DD');
                var end = moment(dates[0]).format('YYYY-MM-DD');
                $('#start_date1').val(start);
                $('end_date1').val(end);
                if (dates.length == 1) {
                    var end = moment(dates[1]).format('YYYY-MM-DD');
                    $('end_date1').val(end);
                    if (typeof ajax_invoice_filter == 'function') {
                        ajax_invoice_filter();
                    }
                }
            }
        });
    </script>
<?php $__env->stopPush(); ?>



<?php $__env->startSection('content'); ?>
    <div class="row">
        <?php if(count($lowstockproducts) > 0): ?>
            <div class="col-md-12">
                <?php $__currentLoopData = $lowstockproducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <span class="alert-icon"><i class="ti ti-alert-triangle"></i></span>
                        <strong><?php echo e($product['name']); ?></strong><small><?php echo e(__(' (Only ') . $product['quantity'] . __(' items left)')); ?></small>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php endif; ?>












    </div>

    <?php if($branches == 0 || $cashregisters == 0 || $productscount == 0 || $customers == 0 || $vendors == 0): ?>
        <div class="row mt-4">
            <div class="col-md-12">
                <?php
                $alerts = [];

                $alerts[] = $branches == 0 ? __('Please add some Branches!') : '';

                $alerts[] = $cashregisters == 0 ? __('Please add some Cash Registers!') : '';

                $alerts[] = $productscount == 0 ? __('Please add some Products!') : '';

                $alerts[] = $customers == 0 ? __('Please add some Customers!') : '';

                $alerts[] = $vendors == 0 ? __('Please add some Vendors!') : '';

                $result = array_filter($alerts);
                ?>
                <?php if(isset($result) && !empty($result) && count($result) > 0): ?>
                    <?php $__currentLoopData = $result; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $alert): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="alert alert-warning alert-dismissible fade show  mt-1" role="alert">
                            <span class="alert-icon"><i class="ti ti-alert-triangle"></i></span>
                            <strong><?php echo e($alert); ?></strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>

    <div class="row">

        <div class="col-sm-12">
            <div class="row">
                <div class="">
                    <div class="row">
                        <div class="col-lg-3 col-6">
                            <div class="card" style="min-height: 225px;">
                                <div class="card-body">
                                    <div class="theme-avtar bg-primary">
                                        <i class="ti ti-hand-finger"></i>
                                    </div>
                                    <p class="text-muted text-sm mt-4 mb-2"><?php echo e(__('Sales Of This Month')); ?></p>
                                    <h6 class="mb-3"></h6>
                                    <h3 class="mb-0"><?php echo e($monthlySelledAmount); ?><span
                                            class="text-success text-sm"><i class=""></i> </span></h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="card" style="min-height: 225px;">
                                <div class="card-body">
                                    <div class="theme-avtar bg-info">
                                        <i class="ti ti-chart-pie"></i>
                                    </div>
                                    <p class="text-muted text-sm mt-4 mb-2"><?php echo e(__('Total Sales Amount')); ?></p>
                                    <h6 class="mb-3"></h6>
                                    <h3 class="mb-0"><?php echo e($totalSelledAmount); ?><span
                                            class="text-danger text-sm"><i class=""></i></span></h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="card" style="min-height: 225px;">
                                <div class="card-body">
                                    <div class="theme-avtar bg-warning">
                                        <i class="ti ti-report-money"></i>
                                    </div>
                                    <p class="text-muted text-sm mt-4 mb-2"><?php echo e(__('Orders Of This Month')); ?></p>
                                    <h6 class="mb-3"></h6>
                                    <h3 class="mb-0"><?php echo e($monthlyOrders); ?><span
                                            class="text-success text-sm"><i class=""></i> </span></h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="card" style="min-height: 225px;">
                                <div class="card-body">
                                    <div class="theme-avtar bg-danger">
                                        <i class="ti ti-chart-bar"></i>
                                    </div>
                                    <p class="text-muted text-sm mt-4 mb-2"><?php echo e(__('Total Orders Count')); ?></p>
                                    <h6 class="mb-3"></h6>
                                    <h3 class="mb-0"><?php echo e($totalSalesCount); ?><span
                                            class="text-danger text-sm"><i class=""></i> </span></h3>
                                </div>
                            </div>
                        </div>
                    </div>


                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    

                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                </div>
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                

                
                
                
                
                
                
                
                
                
                

                
                
                
                
                
                
                
                
                

                

                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                

                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                

            </div>
        </div>
    </div>








    <div class="row ">
        <div class="col-12">
            <h3>Orders</h3>

            



































            <div class="card table-card">
                <div class="card-header card-body table-border-style">
                    
                    <div class="col-sm-12 table-responsive mt-3 table_over">
                        <table class="table dataTable table-sm" id="myTable" role="grid">
                            <thead class="thead-light">
                            <tr role="row">
                                <th style="width: 277px;"><?php echo e(__('Invoice ID')); ?></th>
                                <th><?php echo e(__('Date')); ?></th>
                                <th><?php echo e(__('Sold To')); ?></th>
                                <th><?php echo e(__('Site')); ?></th>
                                <th><?php echo e(__('Items')); ?></th>
                                <th><?php echo e(__('Total')); ?></th>
                                <th><?php echo e(__('Payment Status')); ?></th>
                                <th><?php echo e(__('Order Status')); ?></th>
                                <th style="width: 180px;"><?php echo e(__('Action')); ?></th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                            <tfoot>
                            <tr>
                                <td rowspan="1" colspan="1">
                                    <h5 class="h6"><?php echo e(__('Grand Total')); ?></h5>
                                </td>
                                <td rowspan="1" colspan="1"></td>
                                <td rowspan="1" colspan="1"></td>
                                <td rowspan="1" colspan="1"></td>
                                <td rowspan="1" colspan="1">
                                    <h5 class="h6" id="totalitems"></h5>
                                </td>
                                <td rowspan="1" colspan="1">
                                    <h5 class="h6" id="totalcounts"></h5>
                                </td>
                                <td rowspan="1" colspan="1"></td>
                                <td rowspan="1" colspan="1"></td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('old-datatable-js'); ?>

    <script src="<?php echo e(asset('custom/js/jquery.dataTables.min.js')); ?>"></script>
    <script>
        var dataTabelLang = {
            paginate: {previous: "<i class='fas fa-angle-left'>", next: "<i class='fas fa-angle-right'>"},
            lengthMenu: "<?php echo e(__('Show')); ?> _MENU_ <?php echo e(__('entries')); ?>",
            zeroRecords: "<?php echo e(__('No data available in table.')); ?>",
            info: "<?php echo e(__('Showing')); ?> _START_ <?php echo e(__('to')); ?> _END_ <?php echo e(__('of')); ?> _TOTAL_ <?php echo e(__('entries')); ?>",
            infoEmpty: "<?php echo e(__('Showing 0 to 0 of 0 entries')); ?>",
            infoFiltered: "<?php echo e(__('(filtered from _MAX_ total entries)')); ?>",
            search: "<?php echo e(__('Search:')); ?>",
            thousands: ",",
            loadingRecords: "<?php echo e(__('Loading...')); ?>",
            processing: "<?php echo e(__('Processing...')); ?>"
        };

        var site_currency_symbol_position = '<?php echo e(\App\Models\Utility::getValByName('site_currency_symbol_position')); ?>';
        var site_currency_symbol = '<?php echo e(\App\Models\Utility::getValByName('site_currency_symbol')); ?>';
    </script>

<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
    <script src="<?php echo e(asset('js/bootstrap-datepicker.min.js')); ?>"></script>

    <script>

        $(document).on('click', '.copy_link_sale', function (e) {
            e.preventDefault();
            var copyText = $(this).attr('href');

            document.addEventListener('copy', function (e) {
                e.clipboardData.setData('text/plain', copyText);
                e.preventDefault();
            }, true);

            document.execCommand('copy');
            show_toastr('Success', 'Url copied to clipboard', 'success');
        });
    </script>

    <script type="text/javascript">


        $(document).ready(function () {
            ajax_invoice_filter();
        });

        $(document).on('change', '#sell_to, #sell_by', function (e) {
            ajax_invoice_filter();
        });

        function ajax_invoice_filter() {

            var data = {
                'url': '<?php echo e(route('invoice.filter')); ?>',
                'start_date': $('#start_date1').val(),
                'end_date': $('#end_date1').val(),
                'customer_id': $('#sell_to').val(),
                'user_id': $('#sell_by').val(),
                'customers': 1,
            }

            $('#myTable').DataTable({
                "processing": true,
                "destroy": true,
                "paging": true,
                "pageLength": 10,
                "ordering": false,
                "language": dataTabelLang,
                "ajax": {
                    "type": "GET",
                    "url": data.url,
                    "data": data,
                },
                "columns": [{
                    "data": "invoice_id"
                },
                    {
                        "data": "created_at"
                    },

                    {
                        "data": "customername"
                    },
                    {
                        "data": "site"
                    },
                    {
                        "data": "itemscount"
                    },
                    {
                        "data": "itemstotal"
                    }
                    , {
                        "data": "paymentstatus"
                    },
                    {
                        "data": "order_status"
                    },

                    {
                        "data": "action"
                    }
                ],
            })
                .on("xhr.dt", function (e, settings, json, xhr) {
                    $('#totalitems').text(json.totalItemsCount);
                    $('#totalcounts').text(json.totalCount);
                    setTimeout(function () {
                        loadConfirm();
                    }, 1000);
                });
        }

        $(document).on('click', '.payment-action', function (e) {
            e.stopPropagation();
            e.preventDefault();

            var ele = $(this);

            var id = ele.parent().attr('data-id');
            var url = ele.parent().attr('data-url');
            var status = ele.attr('data-status');

            $.ajax({
                url: url,
                method: 'PATCH',
                data: {
                    status: status
                },
                success: function (response) {

                    if (response) {
                        location.reload();

                        // $('[data-li-id="' + id + '"] .payment-action').removeClass('selected');
                        //
                        // if (ele.hasClass('selected')) {
                        //
                        //     ele.removeClass('selected');
                        //
                        // } else {
                        //     ele.addClass('selected');
                        // }
                        //
                        // var payment = $('[data-li-id="' + id + '"] .payment-actions').find('.selected')
                        //     .text().trim();
                        //
                        // var payment_class = $('[data-li-id="' + id + '"] .payment-actions').find(
                        //     '.selected').attr('data-class');
                        // $('[data-li-id="' + id + '"] .payment-label').removeClass(
                        //     'unpaid partially-paid paid').addClass(payment_class).text(payment);
                    }
                },
                error: function (data) {
                    data = data.responseJSON;
                    show_toastr('<?php echo e(__('Error')); ?>', data.error, 'error');
                }
            });
        });
    </script>
<?php $__env->stopPush(); ?>


<?php $__env->startPush('scripts'); ?>
    <script src="<?php echo e(asset('assets/js/plugins/apexcharts.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/moment.min.js')); ?>"></script>

    <script>
        (function () {
            var options = {
                chart: {
                    height: 325,
                    type: 'area',
                    toolbar: {
                        show: false,
                    },
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    width: 2,
                    curve: 'smooth'
                },
                series: [

                    {
                        name: '<?php echo e(__('Sales')); ?>',
                        data: <?php echo json_encode($salesArray['value']); ?>

                    },
                ],
                xaxis: {
                    categories: <?php echo json_encode($purchasesArray['label']); ?>,
                    title: {
                        text: '<?php echo e(__('Days')); ?>'
                    }
                },
                colors: ['#6fd943'],

                grid: {
                    strokeDashArray: 4,
                },
                legend: {
                    show: false,
                },
                // markers: {
                //     size: 4,
                //     colors: ['#ffa21d', '#FF3A6E'],
                //     opacity: 0.9,
                //     strokeWidth: 2,
                //     hover: {
                //         size: 7,
                //     }
                // },
                yaxis: {
                    title: {
                        text: '<?php echo e(__('Amount')); ?>'
                    },
                }
            };
            var chart = new ApexCharts(document.querySelector("#traffic-chart"), options);
            chart.render();
        })();


        $(document).on('click', '.custom-checkbox .custom-control-input', function (e) {
            $.ajax({
                url: $(this).data('url'),
                method: 'PATCH',
                success: function (response) {
                },
                error: function (data) {
                    data = data.responseJSON;
                    show_toastr('<?php echo e(__('Error')); ?>', data.error, 'error')
                }
            });
        });
    </script>
<?php $__env->stopPush(); ?>


<?php $__env->startPush('scripts'); ?>
    <script src="<?php echo e(asset('assets/js/plugins/main.min.js')); ?>"></script>


    <script type="text/javascript">
        (function () {
            var etitle;
            var etype;
            var etypeclass;
            var calendar = new FullCalendar.Calendar(document.getElementById('calendar'), {
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                buttonText: {
                    timeGridDay: "<?php echo e(__('Day')); ?>",
                    timeGridWeek: "<?php echo e(__('Week')); ?>",
                    dayGridMonth: "<?php echo e(__('Month')); ?>"
                },
                themeSystem: 'bootstrap',

                slotDuration: '00:10:00',
                navLinks: true,
                droppable: true,
                selectable: true,
                selectMirror: true,
                editable: true,
                dayMaxEvents: true,
                handleWindowResize: true,
                events: <?php echo $arrEvents; ?>,


                eventClick: function (e) {
                    e.jsEvent.preventDefault();
                    var title = e.title;
                    var url = e.el.href;

                    if (typeof url != 'undefined') {
                        $("#commonModal .modal-title").html(e.event.title);
                        $("#commonModal .modal-dialog").addClass('modal-md');
                        $("#commonModal").modal('show');

                        $.get(url, {}, function (data) {
                            console.log(data);
                            $('#commonModal .body ').html(data);

                            if ($(".d_week").length > 0) {
                                $($(".d_week")).each(function (index, element) {
                                    var id = $(element).attr('id');

                                    (function () {
                                        const d_week = new Datepicker(document
                                            .querySelector('#' + id), {
                                            buttonClass: 'btn',
                                            format: 'yyyy-mm-dd',
                                        });
                                    })();

                                });
                            }


                        });
                        return false;
                    }
                }

            });

            calendar.render();
        })();
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp65\www\pos\resources\views/dashboard.blade.php ENDPATH**/ ?>