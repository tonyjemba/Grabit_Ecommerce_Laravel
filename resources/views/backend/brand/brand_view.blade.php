@extends('admin.admin-master')
@section('admin')
    <!-- Content Wrapper. Contains page content -->
   
        <div class="container-full">
            <!-- Content Header (Page header) -->
            

            <!-- Main content -->
            <section class="content">
                <div class="row">


                    <div class="col-8">

                        <div class="box">
                            <div class="box-header with-border">
                                <h3 class="box-title">Brand List</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Brand Name En</th>
                                                <th>Brand Name Hin</th>
                                                <th>Images</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                                @foreach ($brands as $brand )
                                                <tr>
                                                <td>{{ $brand->brand_name_en }}</td>
                                                <td>{{ $brand->brand_name_hin}}</td>
                                                <td><img src="{{ asset($brand->brand_image) }}" style="width: 70px; heigth:80px"></td>
                                                <td>
                                                    <a href="" class="btn btn-info">Edit</a>
                                                    <a href="" class="btn btn-danger">Delete</a>

                                                </td>
                                                </tr>
                                                @endforeach

                                            
                                        </tbody>
                                                                                    </tbody>
                                        
                                    </table>
                                </div>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->

                       
                        <!-- /.box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-4">

                        <div class="box">
                            <div class="box-header with-border">
                                <h3 class="box-title">Add Brand </h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="table-responsive">
                                    <form method="POST" action="{{ route('brand.store') }}" >
                                        @csrf
                                        
                                            <div class="form-group">
                                                <h5>Brand Name Engish <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text"  name="brand_name_en" class="form-control" required=""  > </div>
                                            </div>					
                                             
                                              <div class="form-group">
                                                  <h5>Brand Name Hindi <span class="text-danger">*</span></h5>
                                                  <div class="controls">
                                                      <input type="text"  name="brand_name_hin" class="form-control" required=""  > </div>
                                              </div>
                                              <div class="form-group">
                                                <h5>Brand Image <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="file"   name="	brand_image" class="form-control" required=""  > </div>
                                            </div>
                                         
                                         
                                          <div class="text-xs-right">
                                              <button type="submit" class="btn btn-rounded btn-primary">Add brand</button>
                                          </div>
                                      </form>
                                </div>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->

                       
                        <!-- /.box -->
                    </div>
                </div>
                <!-- /.row -->
            </section>
            <!-- /.content -->

        </div>
  
    <!-- /.content-wrapper -->
@endsection
