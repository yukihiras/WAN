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
                @if ( Session::has('error') )
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <strong>{{ Session::get('error') }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                    </div>
                @endif

                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                        <!-- jquery validation -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Điền thông tin người dùng</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form id="quickForm" action="{{route('updateUsersRoute', ['id'=>request()->route('id')])}}" method="post" enctype="multipart/form-data" >
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Tên người dùng</label>
                                        <input
                                            type="text"
                                            name="name"
                                            id="name"
                                            class="form-control"
                                            placeholder="nhập tên người dùng"
                                            value="{{$objItem->name}}"
                                        >
                                        <span style="color:red; font-weight:bold;">@error('name'){{$message}}@enderror</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email</label>
                                        <input
                                            type="email"
                                            name="email"
                                            id="email"
                                            class="form-control"
                                            placeholder="nhập email"
                                            value="{{$objItem->email}}"
                                        >
                                        <span style="color:red; font-weight:bold;">@error('email'){{$message}}@enderror</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Số điện thoại</label>
                                        <input
                                            type="text"
                                            name="phoneNumber"
                                            id="phoneNumber"
                                            class="form-control"
                                            placeholder="nhập số điện thoại"
                                            value="{{$objItem->phoneNumber}}"
                                        >
                                        <span style="color:red; font-weight:bold;">@error('phonNumber'){{$message}}@enderror</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Mật khẩu</label>
                                        <input
                                            type="password"
                                            name="password"
                                            id="password"
                                            class="form-control"
                                            placeholder="nhập mật khẩu"
                                            value="{{$objItem->password}}"
                                        >
                                        <span style="color:red; font-weight:bold;">@error('password'){{$message}}@enderror</span>

                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputFile">Upload ảnh</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" name="image" id="image" accept="image/*" class="custom-file-input" id="exampleInputFile">
                                                <label class="custom-file-label" for="exampleInputFile">Chọn file</label>
                                            </div>
                                            <div class="input-group-append">
                                                <span class="input-group-text">Upload</span>
                                            </div>
                                        </div>
                                        <div class="input-group">
                                            <img id="mat_truoc_preview"
                                                 src="{{$objItem->image ? ''. Storage::url($objItem->image):'http://placehold.it/100x100'}}"
                                                 alt="your avatar"
                                                 style="max-width: 300px; height:200px; margin-top: 20px;"
                                                 class="img-fluid rounded mx-auto d-block img-thumbnail"
                                            />
                                        </div>


                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Vai trò hiện tại: {{$objItem->roleName}}</label>
                                        <select class="form-control" name="role_id" id="role_id">
                                            <option value="">Chọn phân quyền</option>
                                            @foreach($listRoles as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                        <span style="color:red; font-weight:bold;">@error('role_id'){{$message}}@enderror</span>

                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-5">
                                            <button type="submit" class="btn btn-success"><i class="fas fa-recycle"></i> Cập nhật</button>
                                        </div>
                                        <div class="col-sm-12 col-md-7 d-flex flex-row-reverse">
                                            <a href="{{route('listUsersRoute')}}" class="btn btn-danger"><i class="fas fa-arrow-left"></i> Quay lại</a>
                                        </div>
                                    </div>

                                </div>

                            </form>
                        </div>
                        <!-- /.card -->
                    </div>
                    <!--/.col (left) -->
                    <!-- right column -->
                    <div class="col-md-6">

                    </div>
                    <!--/.col (right) -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
@section('script')
    <script src="{{ asset('default/plugins/input-mask/jquery.inputmask.js') }}"></script>
    <script src="{{ asset('default/plugins/input-mask/jquery.inputmask.date.extensions.js') }}"></script>
    <script>
        $(function() {
            function readURL(input, selector) {
                if (input.files && input.files[0]) {
                    let reader = new FileReader();

                    reader.onload = function(e) {
                        $(selector).attr('src', e.target.result);
                    };

                    reader.readAsDataURL(input.files[0]);
                }
            }
            $("#image").change(function() {
                readURL(this, '#mat_truoc_preview');
            });

        });
    </script>
@endsection
