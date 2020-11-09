@extends('admin.layouts.app')
@section('title',__('lang.Home'))
@section('sitetitle',__('lang.Home'))


@section('content')
    <section class="content">
        <div class="box box-default color-palette-box ">
            <div class="box-header with-border">
                <h3 class="box-title">@lang('lang.update') @lang('lang.product')</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

                <form method="POST"  action="{{action('ProductController@update', $product->id)}}" enctype="multipart/form-data">
                    <input name="_method" type="hidden" value="PATCH">
                    {{ csrf_field() }}

                    @csrf
                    <div class="form-group col-lg-6 {{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="titleAr">@lang('lang.Add') @lang('lang.name')  </label>
                        <input type="text" id="name" name="name" class="form-control"  value="{{$product->name}}" />
                        <span class="help-block">{{ $errors->first('name', ':message') }}</span>
                    </div>
                    <div class="form-group col-lg-6 {{ $errors->has('description') ? ' has-error' : '' }}">
                        <label for="titleAr">@lang('lang.Add') @lang('lang.description')  </label>
                        <input type="text" id="description" name="description" class="form-control"  value="{{{$product->description}}}" />
                        <span class="help-block">{{ $errors->first('description', ':message') }}</span>
                    </div>
                    <div class="form-group col-lg-6 {{ $errors->has('price') ? ' has-error' : '' }}">
                        <label for="titleAr">@lang('lang.Add') @lang('lang.price')  </label>
                        <input type="number" min="1" id="name" name="price" class="form-control"  value="{{$product->price}}" />
                        <span class="help-block">{{ $errors->first('price', ':message') }}</span>
                    </div>
                    <div class="box-body col-md-10 col-sm-offset-1">

                        <div class="form-group {{ $errors->has('img') ? ' has-error' : '' }}">
                            <label for="img">@lang('lang.Image')</label>
                            <input type="file"  name="img" multiple class="form-control-file" id="img" aria-describedby="fileHelp">
                            <img class="card-img-top" src="{{ asset('images/products/' . $product->img) }} " style="width:150px;height:150px;" >
                            <span class="help-block">{{ $errors->first('img', ':message') }}</span>
                        </div>
                    </div>
                    <hr>


                    <div class="form-group center">
                        <div class="col-md-offset-2 col-md-4">
                            <a href="/admin/certification" class="btn btn-block btn-danger" role="button">@lang('lang.Cancel')</a>
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-block btn-primary">@lang('lang.update')</button>
                        </div>
                    </div>

            </form>
        </div>
        </div>
    </section>
@endsection
