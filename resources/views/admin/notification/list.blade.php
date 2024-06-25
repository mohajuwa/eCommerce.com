@extends('admin.layouts.app')

@section('content')
<section class="content-header">
    <div class="container-fuild">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Notifications </h1>
            </div>
            {{-- <div class="col-sm-6" style="text-align: right">
                <a href="{{ url('admin/notification/add') }}" class="btn btn-sm  btn-primary">Add new Notifications </a>
            </div> --}}
        </div>
    </div>
</section>


<section class="content">
    <div class="container-fuild">
        <div class="row">
            <div class="col-12">
                @include('admin.layouts._message')

                <div class="card  card-info ">
                    <div class="card-header">
                        <h3 class="card-title">Notifications </h3>

                    </div>

                    <!-- /.card-header -->
                    <div class="card-body p-0   ">
                        <table
                            class="table table-striped table-responsive-lg  table-responsive-sm table-responsive-md table-responsive-xxl">
                            <thead>

                            </thead>
                            <tbody>
                                @foreach ($getRecord as $value)
                                <tr>

                                    <td>{{ $value->id }}</td>
                                    <td><a style="color:#000; {{ empty($value->is_read) ? 'font-weight:bold': ''}}"
                                            href="{{url($value->url)}}?noti_id={{$value->id}}">{{$value->message}}</a>
                                    </td>

                                    {{-- <td>{{ !empty($value->getUser) ? $value->getUser->name : '' }}</td> --}}





                                </tr>
                                @endforeach


                            </tbody>
                        </table>
                        <div style="padding: 10px;float: right;">
                            {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('script')
@endsection