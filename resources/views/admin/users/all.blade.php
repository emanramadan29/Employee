@extends('admin.layouts.app')
@section('title', 'المستخدمين')
@section('sitetitle', 'Dashboard | All Users')
@section('users', 'active')

@section('content')

<section class="content">
    @if(count($users) > 0)
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
            <h3 class="box-title"> جميع المستخدمين</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <table class="table table-bordered text-center">
                <tbody><tr>
                <th style="width: 10px">#</th>
                <th>الاسم</th>
                <th>الايميل</th>
                <th>الصلاحية</th>
                <th ></th>
                </tr>
               
                @foreach($users as $user)
                <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>

                <td>
                    @if($user->roles == 'user')
                    عميل
                    @endif
                    @if($user->roles == 'admin')
                    وكيل
                    @endif
                </td>
                
                <td>
                    @if($user->roles == 'user')
                    <a href="/users/{{ $user->id}}" class="btn btn-primary">ترقية</a>
                    @endif
                    @if($user->roles == 'admin')
                    <a href="/users/{{ $user->id}}" class="btn btn-danger">إلغاء</a>
                    @endif
                </td>
                </tr>
                @endforeach
                
            </tbody>
        </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
            <ul class="pagination pagination-sm no-margin pull-right">
                {{ $users }}
            </ul>
            </div>
        </div>
    </div>

              
    @endif
</section>
@stop
