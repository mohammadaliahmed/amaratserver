@extends('layouts.app')

@section('title')
    <div class="d-inline-block">
        <h5 class="h4 d-inline-block font-weight-400 mb-0">{{ __('Dashboard') }}</h5>
    </div>
@endsection



@push('old-datatable-css')
    <link rel="stylesheet" href="{{ asset('custom/css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('custom/css/customdatatable.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/flatpickr.min.css') }}">
@endpush

@push('stylesheets')
    <link rel="stylesheet" href="{{ asset('css/fullcalendar.min.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('assets/js/plugins/flatpickr.min.js') }}"></script>
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
@endpush



@section('content')
    <div class="row">
        @if (count($lowstockproducts) > 0)
            <div class="col-md-12">
                @foreach ($lowstockproducts as $product)
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <span class="alert-icon"><i class="ti ti-alert-triangle"></i></span>
                        <strong>{{ $product['name'] }}</strong><small>{{ __(' (Only ') . $product['quantity'] . __(' items left)') }}</small>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endforeach
            </div>
        @endif


{{--        @if (isset($notifications) && !empty($notifications) && count($notifications) > 0)--}}
{{--            <div class="col-md-12">--}}
{{--                @foreach ($notifications as $notification)--}}
{{--                    <div class="alert alert-{{ $notification->color }} alert-dismissible fade show" role="alert">--}}
{{--                        <strong>{!! $notification->description !!}</strong>--}}
{{--                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>--}}
{{--                    </div>--}}
{{--                @endforeach--}}
{{--            </div>--}}
{{--        @endif--}}
    </div>

    @if ($branches == 0 || $cashregisters == 0 || $productscount == 0 || $customers == 0 || $vendors == 0)
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
                @if (isset($result) && !empty($result) && count($result) > 0)
                    @foreach ($result as $alert)
                        <div class="alert alert-warning alert-dismissible fade show  mt-1" role="alert">
                            <span class="alert-icon"><i class="ti ti-alert-triangle"></i></span>
                            <strong>{{ $alert }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    @endif

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
                                    <p class="text-muted text-sm mt-4 mb-2">{{ __('Sales Of This Month') }}</p>
                                    <h6 class="mb-3"></h6>
                                    <h3 class="mb-0">{{ $monthlySelledAmount }}<span
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
                                    <p class="text-muted text-sm mt-4 mb-2">{{ __('Total Sales Amount') }}</p>
                                    <h6 class="mb-3"></h6>
                                    <h3 class="mb-0">{{ $totalSelledAmount }}<span
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
                                    <p class="text-muted text-sm mt-4 mb-2">{{ __('Orders Of This Month') }}</p>
                                    <h6 class="mb-3"></h6>
                                    <h3 class="mb-0">{{ $monthlyOrders }}<span
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
                                    <p class="text-muted text-sm mt-4 mb-2">{{ __('Total Orders Count') }}</p>
                                    <h6 class="mb-3"></h6>
                                    <h3 class="mb-0">{{ $totalSalesCount }}<span
                                            class="text-danger text-sm"><i class=""></i> </span></h3>
                                </div>
                            </div>
                        </div>
                    </div>


                    {{--                    <div class="col-xxl-12">--}}
                    {{--                        <div class="card">--}}
                    {{--                            <div class="card-header">--}}
                    {{--                                <div class="d-flex align-items-center justify-content-between">--}}
                    {{--                                    <h5>{{ __('To do list') }}</h5>--}}
                    {{--                                    <div type="button" class="btn btn-sm btn-primary btn-icon m-1">--}}
                    {{--                                        <a href="#" class="" data-bs-toggle="tooltip" data-bs-placement="top"--}}
                    {{--                                            title="{{ __('Add Todo Task') }}" data-ajax-popup="true"--}}
                    {{--                                            data-title="{{ __('Add Todo Task') }}"--}}
                    {{--                                            data-url="{{ route('todos.create') }}">--}}
                    {{--                                            <i class="ti ti-plus text-white"></i></a>--}}
                    {{--                                    </div>--}}
                    {{--                                </div>--}}
                    {{--                            </div>--}}

                    {{--                            @if (isset($todos) && !empty($todos) && count($todos) > 0)--}}
                    {{--                                <ul class="list-group list-group-flush todo-scrollbar" data-toggle="checklist">--}}
                    {{--                                    @foreach ($todos as $key => $todo)--}}
                    {{--                                        <li class="checklist-entry list-group-item flex-column align-items-start">--}}
                    {{--                                            <div--}}
                    {{--                                                class="d-flex align-items-center justify-content-between checklist-item checklist-item-{{ $todo->color }} {{ $todo->status == 1 ? 'checklist-item-checked' : '' }}">--}}
                    {{--                                                <div class="checklist-info">--}}
                    {{--                                                    <a href="#!" class="fs-14 mb-0"><b>{{ $todo->title }}</b></a>--}}
                    {{--                                                    <small--}}
                    {{--                                                        class="d-block">{{ Auth::user()->datetimeFormat($todo->created_at) }}</small>--}}
                    {{--                                                </div>--}}
                    {{--                                                <div>--}}
                    {{--                                                    <div class="form-check  custom-checkbox ">--}}
                    {{--                                                        <input class="custom-control-input form-check-input"--}}
                    {{--                                                            id="chk-todo-task-{{ $todo->id }}"--}}
                    {{--                                                            data-url="{{ route('todo.status', $todo->id) }}"--}}
                    {{--                                                            type="checkbox"--}}
                    {{--                                                            {{ $todo->status == 1 ? ' checked=""' : '' }}>--}}
                    {{--                                                        <label class="custom-control-label"--}}
                    {{--                                                            for="chk-todo-task-{{ $todo->id }}"></label>--}}
                    {{--                                                    </div>--}}
                    {{--                                                </div>--}}
                    {{--                                            </div>--}}
                    {{--                                        </li>--}}
                    {{--                                    @endforeach--}}
                    {{--                                </ul>--}}
                    {{--                            @endif--}}
                    {{--                        </div>--}}
                    {{--                    </div>--}}
                </div>
                {{--            </div>--}}
                {{--                <div class="">--}}
                {{--                    <div class="card">--}}
                {{--                        <div class="card-header">--}}
                {{--                            <div class="row ">--}}
                {{--                                <div class="col-6">--}}
                {{--                                    <h5>{{ __('Report') }}</h5>--}}
                {{--                                </div>--}}
                {{--                                <div class="col-6 text-end">--}}
                {{--                                    <h6>{{ __('Last 10 Days') }}</h6>--}}
                {{--                                </div>--}}
                {{--                            </div>--}}
                {{--                        </div>--}}
                {{--                        <div class="card-body">--}}
                {{--                            <div id="traffic-chart"></div>--}}
                {{--                        </div>--}}
                {{--                    </div>--}}
                {{--                </div>--}}

                {{--                <div class="col-xxl-7">--}}
                {{--                    <div class="card">--}}
                {{--                        <div class="card-header">--}}
                {{--                            <h5>{{ __('Calendar') }}</h5>--}}
                {{--                        </div>--}}
                {{--                        <div class="card-body">--}}
                {{--                            <div id='calendar' class='calendar'></div>--}}
                {{--                        </div>--}}
                {{--                    </div>--}}
                {{--                </div>--}}

                {{--                @if (isset($saletarget) && !empty($saletarget) && count($saletarget) > 0)--}}
                {{--                    @foreach ($saletarget as $target)--}}
                {{--                        <div class="col-xxl-5">--}}
                {{--                            <div class="card">--}}
                {{--                                <div class="card-header">--}}
                {{--                                    <h5>{{ __('Branches Target') }} (<small>{{ __('This Month') }}</small>)</h5>--}}
                {{--                                    <div class="row align-items-center">--}}
                {{--                                        <div class="col">--}}
                {{--                                            --}}{{-- <b class="mb-0">{{ __('Branches Target') }}</b> --}}

                {{--                                        </div>--}}

                {{--                                    </div>--}}
                {{--                                </div>--}}
                {{--                                <div class="">--}}
                {{--                                    <table class="table align-items-center mb-0 ">--}}
                {{--                                        <thead class="thead-light">--}}
                {{--                                            <tr class="border-top-0">--}}
                {{--                                                <th class="w-25">{{ __('Branch Name') }}</th>--}}
                {{--                                                <th class="w-25">{{ __('Target') }}</th>--}}
                {{--                                                <th class="w-25">{{ __('Sales') }}</th>--}}
                {{--                                                <th class="w-25">{{ __('Progress') }}</th>--}}
                {{--                                            </tr>--}}
                {{--                                        </thead>--}}
                {{--                                        <tbody class="list">--}}
                {{--                                            @if (isset($target['branch']) && count($target['branch']) > 0)--}}
                {{--                                                @for ($i = 0; $i < count($target['branch']); $i++)--}}
                {{--                                                    <tr>--}}
                {{--                                                        <th scope="row">--}}
                {{--                                                            <div class="media align-items-center">--}}
                {{--                                                                <div class="media-body">--}}
                {{--                                                                    <span--}}
                {{--                                                                        class="name mb-0 text-sm">{{ $target['branch'][$i] }}</span>--}}
                {{--                                                                </div>--}}
                {{--                                                            </div>--}}
                {{--                                                        </th>--}}
                {{--                                                        <td class="budget">--}}
                {{--                                                            {{ $target['totaltarget'][$i] }}--}}
                {{--                                                        </td>--}}
                {{--                                                        <td>--}}
                {{--                                                            {{ $target['totalselledprice'][$i] }}--}}
                {{--                                                        </td>--}}
                {{--                                                        <td class="circular-progressbar p-0">--}}
                {{--                                                            <?php--}}
                {{--                                                            $percentage = $target['percentage'][$i];--}}

                {{--                                                            $status = $percentage > 0 && $percentage <= 25 ? 'red' : ($percentage > 25 && $percentage <= 50 ? 'orange' : ($percentage > 50 && $percentage <= 75 ? 'blue' : ($percentage > 75 && $percentage <= 100 ? 'green' : '')));--}}
                {{--                                                            ?>--}}
                {{--                                                            <div class="flex-wrapper">--}}
                {{--                                                                <div class="single-chart">--}}
                {{--                                                                    <svg viewBox="0 0 36 36"--}}
                {{--                                                                        class="circular-chart {{ $status }}">--}}
                {{--                                                                        <path class="circle-bg"--}}
                {{--                                                                            d="M18 2.0845--}}
                {{--                                                                                                          a 15.9155 15.9155 0 0 1 0 31.831--}}
                {{--                                                                                                          a 15.9155 15.9155 0 0 1 0 -31.831" />--}}
                {{--                                                                        <path class="circle"--}}
                {{--                                                                            stroke-dasharray="{{ $percentage }}, 100"--}}
                {{--                                                                            d="M18 2.0845--}}
                {{--                                                                                                          a 15.9155 15.9155 0 0 1 0 31.831--}}
                {{--                                                                                                          a 15.9155 15.9155 0 0 1 0 -31.831" />--}}
                {{--                                                                        <text x="18" y="20.35"--}}
                {{--                                                                            class="percentage">{{ $percentage }}%</text>--}}
                {{--                                                                    </svg>--}}
                {{--                                                                </div>--}}
                {{--                                                            </div>--}}
                {{--                                                        </td>--}}
                {{--                                                    </tr>--}}
                {{--                                                @endfor--}}
                {{--                                            @endif--}}
                {{--                                        </tbody>--}}
                {{--                                    </table>--}}
                {{--                                </div>--}}
                {{--                            </div>--}}
                {{--                        </div>--}}
                {{--                    @endforeach--}}
                {{--                @else--}}
                {{--                @endif--}}

            </div>
        </div>
    </div>








    <div class="row ">
        <div class="col-12">
            <h3>Orders</h3>

            {{--            <div class="card collapse multi-collapse">--}}
{{--                <div class="card-body p-3">--}}
{{--                    <div class="row input-daterange analysis-datepicker align-items-center">--}}
{{--                        <div class="form-group col-md-4 mb-0">--}}
{{--                            {{ Form::label('duration1', __('Date Duration'), ['class' => 'form-control-label']) }}--}}
{{--                            <div class="input-group" style="width: 1066px;">--}}
{{--                                --}}{{-- {{ Form::text('duration', __('Select Date Range'), ['class' => 'form-control', 'id' => 'duration1', 'placeholder' => __('Select Date Range')]) }}--}}
{{--                                {{ Form::hidden('start_date1', $start_date, ['class' => 'form-control', 'id' => 'start_date1']) }}--}}
{{--                                {{ Form::hidden('due_date1', $end_date, ['class' => 'form-control', 'id' => 'end_date1']) }} --}}


{{--                                <div class="col-lg-4 col-md-9 col-sm-12">--}}
{{--                                    <input type='text' class="form-control" id="pc-daterangepicker-1"--}}
{{--                                           placeholder="Select time" type="text"/>--}}
{{--                                    {{ Form::hidden('start_date1', $start_date, ['class' => 'form-control', 'id' => 'start_date1']) }}--}}
{{--                                    {{ Form::hidden('due_date1', $end_date, ['class' => 'form-control', 'id' => 'end_date1']) }}--}}
{{--                                </div>--}}

{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="form-group col-md-4 mb-0">--}}
{{--                            {{ Form::label('sell_to', __('Sold To'), ['class' => 'form-control-label']) }}--}}
{{--                            <div class="input-group">--}}
{{--                                {{ Form::select('sell_to', $customers, null, ['class' => 'form-control', 'id' => 'sell_to', 'data-toggle' => 'select']) }}--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="form-group col-md-4 mb-0">--}}
{{--                            {{ Form::label('sell_by', __('Sold By'), ['class' => 'form-control-label']) }}--}}
{{--                            <div class="input-group">--}}
{{--                                {{ Form::select('sell_by', $users, null, ['class' => 'form-control', 'id' => 'sell_by', 'data-toggle' => 'select']) }}--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

            <div class="card table-card">
                <div class="card-header card-body table-border-style">
                    {{-- <h5></h5> --}}
                    <div class="col-sm-12 table-responsive mt-3 table_over">
                        <table class="table dataTable table-sm" id="myTable" role="grid">
                            <thead class="thead-light">
                            <tr role="row">
                                <th style="width: 277px;">{{ __('Invoice ID') }}</th>
                                <th>{{ __('Date') }}</th>
                                <th>{{ __('Sold To') }}</th>
                                <th>{{ __('Site') }}</th>
                                <th>{{ __('Items') }}</th>
                                <th>{{ __('Total') }}</th>
                                <th>{{ __('Payment Status') }}</th>
                                <th>{{ __('Order Status') }}</th>
                                <th style="width: 180px;">{{ __('Action') }}</th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                            <tfoot>
                            <tr>
                                <td rowspan="1" colspan="1">
                                    <h5 class="h6">{{ __('Grand Total') }}</h5>
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

@endsection

@push('old-datatable-js')

    <script src="{{ asset('custom/js/jquery.dataTables.min.js') }}"></script>
    <script>
        var dataTabelLang = {
            paginate: {previous: "<i class='fas fa-angle-left'>", next: "<i class='fas fa-angle-right'>"},
            lengthMenu: "{{__('Show')}} _MENU_ {{__('entries')}}",
            zeroRecords: "{{__('No data available in table.')}}",
            info: "{{__('Showing')}} _START_ {{__('to')}} _END_ {{__('of')}} _TOTAL_ {{__('entries')}}",
            infoEmpty: "{{ __('Showing 0 to 0 of 0 entries') }}",
            infoFiltered: "{{ __('(filtered from _MAX_ total entries)') }}",
            search: "{{__('Search:')}}",
            thousands: ",",
            loadingRecords: "{{ __('Loading...') }}",
            processing: "{{ __('Processing...') }}"
        };

        var site_currency_symbol_position = '{{ \App\Models\Utility::getValByName('site_currency_symbol_position') }}';
        var site_currency_symbol = '{{ \App\Models\Utility::getValByName('site_currency_symbol') }}';
    </script>

@endpush

@push('scripts')
    <script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>

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
                'url': '{{ route('invoice.filter') }}',
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
                    show_toastr('{{ __('Error') }}', data.error, 'error');
                }
            });
        });
    </script>
@endpush


@push('scripts')
    <script src="{{ asset('assets/js/plugins/apexcharts.min.js') }}"></script>
    <script src="{{ asset('js/moment.min.js') }}"></script>

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
                        name: '{{ __('Sales') }}',
                        data: {!! json_encode($salesArray['value']) !!}
                    },
                ],
                xaxis: {
                    categories: {!! json_encode($purchasesArray['label']) !!},
                    title: {
                        text: '{{ __('Days') }}'
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
                        text: '{{ __('Amount') }}'
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
                    show_toastr('{{ __('Error') }}', data.error, 'error')
                }
            });
        });
    </script>
@endpush


@push('scripts')
    <script src="{{ asset('assets/js/plugins/main.min.js') }}"></script>


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
                    timeGridDay: "{{__('Day')}}",
                    timeGridWeek: "{{__('Week')}}",
                    dayGridMonth: "{{__('Month')}}"
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
                events: {!! $arrEvents !!},


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
@endpush
