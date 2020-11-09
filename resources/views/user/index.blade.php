@extends('admin.layouts.app')
@section('title', __('lang.users'))
@section('sitetitle', __('lang.users'))
@section('users', 'active ')
@section('content')

<section class="content-header">
    <h1>
        @lang('lang.users') - {{ $result->total() }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="/home"><i class="fa fa-dashboard"></i> @lang('lang.Home')</a></li>
        <li class="active">@lang('lang.users')</li>
    </ol>
</section>

<section class="content">
    <div id="flash-msg">
        @include('flash::message')
    </div>
    @include('messages')
    <div class="box box-default color-palette-box">

        <div class="box-body">
            <div class="row">
            <div class="box-header">
                <h3 class="box-title">
                </h3>
                <div class="box-tools pull-right">
                    @can('add_users')
                        <a href="{{ route('users.create') }}" class="btn btn-primary">
                            @lang('lang.Add') @lang('lang.users')
                        </a>
                    @endcan
                </div>
            </div>
                <div class="box-body">
                    <table class="table table-bordered text-center table-striped">
                        <tbody>
                            <tr>
                                <th style="width: 3%">@lang('lang.ID')</th>
                                <th style="width: 15%">@lang('lang.name')</th>
                                <th style="width: 15%">@lang('lang.email')</th>
                                <th style="width: 15%">@lang('lang.roles')</th>
                                <th style="width: 15%">@lang('lang.created')</th>
                                <th style="width: 20%"></th>
                            </tr>
                            @if(count($result) > 0)
                                @foreach($result as $item)
                                    <tr>
                                    <td>{{$item->id}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->email}}</td>
                                    <td>{{ $item->roles->implode('name', ', ') }}</td>
                                    <td>{{ $item->created_at->toFormattedDateString() }}</td>
                                    @can('edit_users')
                                        <td class="text-center">
                                            @include('shared._actions', [
                                                'entity' => 'users',
                                                'id' => $item->id
                                            ])
                                        </td>
                                    @endcan
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                    <div class="box-footer clearfix">
                        {{ $result }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
