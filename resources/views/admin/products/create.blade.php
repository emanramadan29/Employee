@extends('admin.layouts.app')
@section('title',__('lang.Home'))
@section('sitetitle',__('lang.Home'))


@section('content')
    <section class="content">
        <div class="box box-default color-palette-box ">
            <div class="box-header with-border">
                <h3 class="box-title">@lang('lang.addproduct')</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

                <form method="POST" action="{{url(LaravelLocalization::getCurrentLocale().'/product')}}"  enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group col-lg-6 {{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="titleAr">@lang('lang.Add') @lang('lang.name')  </label>
                        <input type="text" id="name" name="name" class="form-control"  value="{!! old('name') !!}" />
                        <span class="help-block">{{ $errors->first('name', ':message') }}</span>
                    </div>
                    <div class="form-group col-lg-6 {{ $errors->has('description') ? ' has-error' : '' }}">
                        <label for="titleAr">@lang('lang.Add') @lang('lang.description')  </label>
                        <input type="text" id="description" name="description" class="form-control"  value="{!! old('description') !!}" />
                        <span class="help-block">{{ $errors->first('description', ':message') }}</span>
                    </div>
                    <div class="form-group col-lg-6 {{ $errors->has('price') ? ' has-error' : '' }}">
                        <label for="titleAr">@lang('lang.Add') @lang('lang.price')  </label>
                        <input type="number" min="1" id="name" name="price" class="form-control"  value="{!! old('price') !!}" />
                        <span class="help-block">{{ $errors->first('price', ':message') }}</span>
                    </div>


                    <div class="box-body col-lg-8 col-sm-offset-1">

                        <div class="form-group {{ $errors->has('img') ? ' has-error' : '' }}" >
                            <label for="img">Main Image</label>
                            <input type="file" name="img"  class="form-control-file" id="img" aria-describedby="fileHelp">
                            <span class="help-block">{{ $errors->first('img', ':message') }}</span>
                        </div>
                    </div>
                    <div class="box-body col-lg-8 col-sm-offset-1">
                        <div class="form-group {{ $errors->has('imgs') ? ' has-error' : '' }}" >
                            <label for="img">Images</label>
                            <input type="file" name="imgs[]" multiple class="form-control-file" id="img" aria-describedby="fileHelp">
                            <span class="help-block">{{ $errors->first('imgs', ':message') }}</span>
                        </div>
                    </div>

                    <hr>

                    <div class="form-group center">
                        <div class="col-md-offset-2 col-md-4">
                            <a href="/product" class="btn btn-block btn-danger" role="button">@lang('lang.Cancel')</a>
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-block btn-primary">@lang('lang.Add')</button>
                        </div>
                    </div>
            </form>
        </div>
        </div>
    </section>
@endsection
