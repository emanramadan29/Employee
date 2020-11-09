@extends('admin.layouts.app')


@section('content')
    <div class="pad no-print">
        @include('messages')
    </div>

    <section class="content">
        <div class="box-default color-palette-box">
            <div class="box">
                <div class="box-header with-border">
                    <a href="product/create" type="button" class="btn btn-info pull-right">@lang('lang.addproduct')</a>
                </div>

                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped text-center">
                        <thead>
                        <tr>
                            <th >@lang('lang.ID')</th>
                            <th >@lang('lang.name')</th>
                            <th >@lang('lang.desc')</th>
                            <th >@lang('lang.Image')</th>
                            <th ></th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($products as $product)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->description }}</td>
                                <td> <img class="card-img-top" src={{asset('images/products/' .$product->img)}} style="width: 300px;height: 100px;" >
                                </td>
                                <td>
                                    <a href="product/{{ $product->id}}/edit" type="button" class="btn btn-info">@lang('lang.Edit')</a>
                                    <a class="btn">
                                        <form action="{{action('ProductController@destroy', $product->id)}}" method="post">
                                            {{csrf_field()}}
                                            <input name="_method" type="hidden" value="DELETE">
                                            <button  type="submit" class="btn btn-danger">@lang('lang.Delete')</button >
                                            @csrf
                                        </form>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </section>
@endsection
@section('js')
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script>

        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('ef18fc2a45b4b807b56f', {
            cluster: 'eu'
        });

        var channel = pusher.subscribe('pro-channel');
        channel.bind('pro-event', function(data) {
            console.log(data);

        });


    </script>
@endsection
