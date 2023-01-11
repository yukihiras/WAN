@extends('adminView.dashboard')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{$title}}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('dashboardRoute')}}">Trang chủ</a></li>
                        <li class="breadcrumb-item active">{{$title}}</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            @if ( Session::has('success') )
                <div class="alert alert-success alert-dismissible" role="alert">
                    <strong>{{ Session::get('success') }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                </div>
            @endif
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-sm-12 col-md-5 " >
                                    <h3 class="card-title">Tổng số người dùng: {{$list->count()}}</h3>
                                </div>
                                <div class="col-sm-12 col-md-7 d-flex flex-row-reverse">
                                    <a href="{{route('addUsersRoute')}}" class="btn btn-success"><i class="fas fa-plus"></i> Thêm mới</a>
                                </div>
                            </div>

                        </div>

                        <!-- /.card-header -->
                        <div class="card-body">
                            <div id="example-wrapper" class="dataTables_wrapper dt-bootstrap4">
                                <div class="row">
                                    <table id="example2" class="table table-bordered table-hover">
                                        <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center">Tên</th>
                                            <th class="text-center">Ảnh</th>
                                            <th class="text-center">Email</th>
                                            <th class="text-center">Số điện thoại</th>
                                            <th class="text-center">Vai trò</th>
                                            <th class="text-center" colspan="2">Hành động</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($list as $item)
                                            <tr>
                                                <td class="text-center align-middle">{{$item->id}}</td>
                                                <td class="text-center align-middle">{{$item->name}}</td>
                                                <td class="text-center align-middle">
                                                    <img
                                                        class="text-center"
                                                        src="{{$item->image ? ''. Storage::url($item->image):'http://placehold.it/100x100'}}"
                                                        alt="" style="max-width: 200px; height:100px; margin: 5px;"
                                                        class="img-responsive rounded mx-auto d-block img-thumbnail"
                                                    />
                                                </td>
                                                <td class="text-center align-middle">{{$item->email}}</td>
                                                <td class="text-center align-middle">{{$item->phoneNumber}}</td>
                                                <td class="text-center align-middle">{{$item->roleName}}</td>
                                                <td class="text-center align-middle">
                                                    <a href="{{route('detailUsersRoute', ['id' => $item->id])}}" class="btn btn-info"><i class="fas fa-edit"></i></a>
                                                </td>
                                                <td class="text-center align-middle">
                                                    <a href="{{route('deleteUsersRoute', ['id' => $item->id])}}" onclick="return confirm('Bạn có chắc muốn xoá')" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-5">
                                        <div class="dataTables_info" id="example2_info" role="status" aria-live="polite"></div>
                                    </div>
{{--                                    hiển thị phân trang--}}
{{--                                    <div class="col-sm-12 col-md-7 d-flex flex-row-reverse">--}}
{{--                                        <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">--}}
{{--                                            <ul class="pagination">--}}
{{--                                                <li class="paginate_button page-item previous disabled" id="example2_previous"><a href="#" aria-controls="example2" data-dt-idx="0" tabindex="0" class="page-link">Previous</a></li>--}}
{{--                                                <li class="paginate_button page-item active"><a href="#" aria-controls="example2" data-dt-idx="1" tabindex="0" class="page-link">1</a></li>--}}
{{--                                                <li class="paginate_button page-item "><a href="#" aria-controls="example2" data-dt-idx="2" tabindex="0" class="page-link">2</a></li>--}}
{{--                                                <li class="paginate_button page-item "><a href="#" aria-controls="example2" data-dt-idx="3" tabindex="0" class="page-link">3</a></li>--}}
{{--                                                <li class="paginate_button page-item "><a href="#" aria-controls="example2" data-dt-idx="4" tabindex="0" class="page-link">4</a></li>--}}
{{--                                                <li class="paginate_button page-item "><a href="#" aria-controls="example2" data-dt-idx="5" tabindex="0" class="page-link">5</a></li>--}}
{{--                                                <li class="paginate_button page-item "><a href="#" aria-controls="example2" data-dt-idx="6" tabindex="0" class="page-link">6</a></li>--}}
{{--                                                <li class="paginate_button page-item next" id="example2_next"><a href="#" aria-controls="example2" data-dt-idx="7" tabindex="0" class="page-link">Next</a></li>--}}
{{--                                            </ul>--}}

{{--                                        </div>--}}
{{--                                    </div>--}}
                                </div>
                            </div>

                        </div>

                        <!-- /.card-body -->
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
@endsection
