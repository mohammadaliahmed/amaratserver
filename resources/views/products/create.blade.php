{{ Form::open(['url' => 'products', 'enctype' => 'multipart/form-data']) }}
<div class="modal-body">
    <div class="row">
        <div class="form-group col-md-12">
            {{ Form::label('name', __('Product Name'), ['class' => 'col-form-label']) }}
            {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => __('Enter new Product Name'), 'required' => '']) }}
        </div>
        <div class="form-group col-md-12">
            {{ Form::label('description', __('Description'), ['class' => 'col-form-label']) }}
            {!! Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => __('Enter Product Description'), 'rows' => 3, 'style' => 'resize: none']) !!}
        </div>
        <div class="form-group col-md-6">
            {{ Form::label('category_id', __('Category'), ['class' => 'col-form-label']) }}
            <div class="input-group">
                {{ Form::select('category_id', $categories, null, ['class' => 'form-control', 'data-toggle' => 'select']) }}
            </div>
        </div>
        <div class="form-group col-md-6">
            {{ Form::label('brand_id', __('Brand'), ['class' => 'col-form-label']) }}
            <div class="input-group">
                {{ Form::select('brand_id', $brands, null, ['class' => 'form-control', 'data-toggle' => 'select']) }}
            </div>
        </div>
        <div class="form-group col-md-6">
            {{ Form::label('tax_id', __('Tax'), ['class' => 'col-form-label']) }}
            <div class="input-group">
                {{ Form::select('tax_id', $taxes, null, ['class' => 'form-control', 'data-toggle' => 'select']) }}
            </div>
        </div>
        <div class="form-group col-md-6">
            {{ Form::label('unit_id', __('Unit'), ['class' => 'col-form-label']) }}
            <div class="input-group">
                {{ Form::select('unit_id', $units, null, ['class' => 'form-control', 'data-toggle' => 'select']) }}
            </div>
        </div>
        {{-- <div class="mb-4 col-md-6">
        {{ Form::label('upload', __('Upload'), ['class' => 'col-form-label']) }}
        <div class="custom-file">
            {{ Form::file('image', [
                                        'class' => 'custom-file-input d-none',
                                        'accept' => "image/*",
                                        'id' => "product-image",
                                    ]) }}
            {{ Form::label('product-image', __('Choose image'), ['class' => 'custom-file-label1']) }}
        </div>
    </div>
    <div class="col-md-6 my-auto mx-auto">
        <div class="form-group" id="product-image">
            <img class="profile-image rounded-circle w-70px-ni h-70px">
            <button type="button" class="btn btn-danger btn-xs mt-2 product-img-btn d-none">
                <i class="fas fa-trash"></i>
            </button>
        </div>
    </div> --}}

        <div class="mb-4 col-md-6">
            <div class="choose-files mt-3">
                <label for="image">
                    <div class=" bg-primary edit-product-image"> <i
                            class="ti ti-upload px-1"></i>{{ __('Choose file here') }}
                    </div>
                    <input type="file" class="form-control file d-none" name="image" id="image"
                        data-filename="edit-product-image" accept="image/*">
                </label>
            </div>
        </div>
        <div class="col-md-6 my-auto mx-auto">
            <div class="form-group" id="product-image">
                <img class="profile-image rounded-circle-product">
                <button type="button" class="action-btn btn-danger ms-3 product-img-btn d-none">
                    <i class="ti ti-trash text-white btn-xs mb-1"></i>
                </button>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="form-group col-md-4">
            {{ Form::label('purchase_price', __('Purchase price') . ' (' . Auth::user()->currencySymbol() . ')', ['class' => 'col-form-label']) }}
            {{ Form::number('purchase_price', null, ['class' => 'form-control', 'placeholder' => __('Enter new Purchase Price'), 'step' => '0.01']) }}
        </div>
        <div class="form-group col-md-4">
            {{ Form::label('sale_price', __('Selling price') . ' (' . Auth::user()->currencySymbol() . ')', ['class' => 'col-form-label']) }}
            {{ Form::number('sale_price', null, ['class' => 'form-control', 'placeholder' => __('Enter new Selling Price'), 'step' => '0.01']) }}
        </div>
        <div class="form-group col-md-4">
            {{ Form::label('sku', __('SKU'), ['class' => 'col-form-label']) }}
            {{ Form::text('sku', null, ['class' => 'form-control', 'placeholder' => __('Enter new SKU Code')]) }}
        </div>
    </div>
</div>

<div class="modal-footer">
    <button type="button" class="btn btn-secondary btn-light" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
    <input class="btn btn-primary" type="submit" value="{{ __('Create') }}">
</div>
{{ Form::close() }}
