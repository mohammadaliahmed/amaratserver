@extends('layouts.app')

@section('page-title', __('Customers'))

@section('title')
    <div class="d-inline-block">
        <h5 class="h4 d-inline-block font-weight-400 mb-0">{{ __('Customers') }}</h5>
    </div>
@endsection

@section('action-btn')



@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
    <li class="breadcrumb-item">{{ __('Customer') }}</li>
@endsection

@section('content')
    <div class="card m-3 p-3">
        <H2>Customer: {{$customer->name}}</H2>

    </div>

    <div class="card m-3 p-3">
        <div class="d-flex justify-content-between">
            <H2>Sites</H2>
            <a href="#" data-ajax-popup="true" data-size="lg" data-bs-toggle="tooltip"
               data-title="{{ __('Add New Customer Site') }}" title="{{ __(' New Customer Site') }}"
               data-url="{{ route('sites.create') }}" class="btn btn-sm btn-primary btn-icon m-1">
                <span class=""><i class="ti ti-plus text-white"></i></span>
            </a>
        </div>


    </div>

@endsection
