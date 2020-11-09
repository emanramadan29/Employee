@extends('admin.layouts.app')
@section('title', __('lang.users'))
@section('sitetitle', __('lang.users'))
@section('users', 'active ')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        @lang('lang.Add') @lang('lang.users')
    </h1>
    <ol class="breadcrumb">
        <li><a href="/home"><i class="fa fa-dashboard"></i> @lang('lang.Home')</a></li>
        <li class="active">@lang('lang.users')</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div id="flash-msg">
        @include('flash::message')
    </div>
    @include('messages')
    <!-- COLOR PALETTE -->
    <div class="box box-default color-palette-box">

        <div class="box-body">
            <div class="row">
                <div class="box-body">

                    <div class="col-lg-12">
                        {!! Form::open(['route' => ['users.store'] ]) !!}
                            @include('user._form')
                            <!-- Submit Form Button -->
                            {!! Form::submit(__('lang.Add'), ['class' => 'btn btn-primary']) !!}
                        {!! Form::close() !!}
                    </div>

                </div>
            </div>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->
</section>

@endsection
