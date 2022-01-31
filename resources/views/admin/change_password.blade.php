@extends('admin.admin-master')

@section('admin')

    <div class="container-full">

        <div class="box-body">
            <div class="row">
              <div class="col">
                  <form method="POST" action="{{ route('update.admin.change.password') }}" >
                    @csrf
                    <div class="row">
                      <div class="col-12">	
                        <div class="form-group">
                            <h5>Enter old Password <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="password" id="oldpassword" name="oldpassword" class="form-control" required=""  > </div>
                        </div>					
                         
                          <div class="form-group">
                              <h5>Enter new Password <span class="text-danger">*</span></h5>
                              <div class="controls">
                                  <input type="password" id="password" name="password" class="form-control" required=""  > </div>
                          </div>
                          <div class="form-group">
                            <h5>Confirm new Password <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="password" id="password_confirmation"  name="password_confirmation" class="form-control" required=""  > </div>
                        </div>
                         
                      </div>
                    </div>
                     
                      <div class="text-xs-right">
                          <button type="submit" class="btn btn-rounded btn-primary">Change Password</button>
                      </div>
                  </form>

              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
            </div>


@endsection
