@extends('admin.layouts.app')
@section('title', __('lang.roles'))
@section('sitetitle', __('lang.roles'))
@section('roles', 'active ')
@section('css')
@endsection

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        @lang('lang.roles')
    </h1>
    <ol class="breadcrumb">
        <li><a href="/home"><i class="fa fa-dashboard"></i> @lang('lang.Home')</a></li>
        <li class="active">@lang('lang.roles')</li>
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
        <div class="box-header">
            <h3 class="box-title">
            </h3>
            <div class="box-tools pull-right">
                @can('add_roles')
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-add">
                        @lang('lang.Add') @lang('lang.roles')
                    </button>
                @endcan
            </div>
        </div>

        <div class="row">
        <div class="col-md-12">
          <div class="box box-solid">
            <!-- /.box-header -->
            <div class="box-body">
                <div class="box-group" id="accordion">
                    @forelse ($roles as $role)
                    
                    
                        {!! Form::model($role, ['method' => 'PUT', 'route' => ['roles.update',  $role->id ], 'class' => 'm-b']) !!}
                        @if($role->name === 'Super Admin')
                            @include('shared._permissions', [
                                        'title' => $role->name .' Permissions',
                                        'options' => ['disabled'] ])
                                        <hr>
                        @else
                            @include('shared._permissions', [
                                        'title' => $role->name .' Permissions',
                                        'model' => $role ])
                            @can('edit_roles')
                            
                                <br>
                                {!! Form::submit(__('lang.Save'), ['class' => 'btn btn-primary']) !!}
                                @if($loop->last)
                                @else
                                    
                                @endif
                            @endcan
                        @endif
                            {!! Form::close() !!}
                            @if($role->name === 'Super Admin')
                            @else
                            <br>
                                @can('delete_roles')
                                <form action="{{action('RoleController@destroy', $role['id'])}}" method="post">
                                    {{csrf_field()}}
                                    <input name="_method" type="hidden" value="DELETE">
                                    <button type="submit" class="btn btn-danger">@lang('lang.Delete')</button>
                                </form>
                                @endcan
                                <hr>
                            @endif
                        @empty
                        
                        @endforelse
                        
                </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
    </div>

        <!-- /.box-body -->
    </div>
    <!-- /.box -->
</section>

<!-- Modal -->
<div class="modal fade" id="modal-add" tabindex="-1" role="dialog" aria-labelledby="roleModalLabel">
    <div class="modal-dialog" role="document">
        {!! Form::open(['method' => 'post']) !!}

        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="roleModalLabel">@lang('lang.Add') @lang('lang.roles')</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- name Form Input -->
                <div class="form-group @if ($errors->has('name')) has-error @endif">
                    {!! Form::label('name', __('lang.name')) !!}
                    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => __('lang.name')]) !!}
                    @if ($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">@lang('lang.Cancel')</button>

                <!-- Submit Form Button -->
                {!! Form::submit(__('lang.Save'), ['class' => 'btn btn-primary']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

@endsection
