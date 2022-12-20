@extends('layouts.app')

@section('page-title', __('Vendors'))

@section('title')
    <div class="d-inline-block">
        <h5 class="h4 d-inline-block font-weight-400 mb-0">{{ __('Vendors') }}</h5>
    </div>
@endsection


@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
    <li class="breadcrumb-item">{{ __('Assigned Orders') }}</li>
@endsection

@section('content')
    <div class="card m-3 p-3">
        <h3>Select Vendor</h3>


        {{ Form::select('vendors', $vendors, null, ['class' => 'form-control', 'data-toggle' => 'select','id' => 'vendors']) }}

    </div>
    @if(isset($orders) )

        <div class="card m-3 p-3">

            <div class="m-2 badge  bg-primary">
                <h3>{{$vendor->name}}</h3>
                <p>
                    {{$vendor->phone_number}}
                </p>
            </div>

            <hr>
            @if(sizeof($orders)>0)
                <h3>Assigned Orders</h3>
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Image</th>
                        <th scope="col">Product</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Date</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($orders as $key=> $order)
                        <tr>
                            <th scope="row">{{$key + 1}}</th>
                            <td><img src="storage/{{$order->product->image}}" width="70" height="70"></td>
                            <td>{{$order->product->name}}</td>
                            <td>{{$order->quantity}}</td>
                            <td>{{$order->created_at}}</td>

                        </tr>
                    @endforeach

                    </tbody>
                </table>
            @else
                <div class="card m-3 p-3">
                    <h3>No Orders</h3>
                </div>
            @endif
        </div>

    @endif

@endsection


@push('scripts')
    <script>
        $("#vendors").change(function () {
            //selection changed
            // var url = $(location).attr('href');
            //
            // window.location.href = url + "/" + this.value;
            var url = "{{route('vendor.orders.view', '')}}" + "/" + this.value;


            window.location.href = url;


        });
    </script>

@endpush
