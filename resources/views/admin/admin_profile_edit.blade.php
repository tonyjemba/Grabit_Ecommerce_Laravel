@extends('admin.admin-master')

@section('admin')
<script src="https://code.jquery.com/jquery-3.6.0.slim.min.js" integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script>

    <div class="container-full">

        <div class="box-body">
            <div class="row">
              <div class="col">
                  <form method="POST" action="{{ route('admin.profile.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                      <div class="col-12">						
                         
                          <div class="form-group">
                              <h5>Username <span class="text-danger">*</span></h5>
                              <div class="controls">
                                  <input type="text" name="name" class="form-control" required="" value="{{ $adminData->name }}" > </div>
                          </div>
                          <div class="form-group">
                            <h5>Email  <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="email" name="email" class="form-control" required="" value="{{ $adminData->email }}" > </div>
                        </div>
                          <div class="form-group">
                              <h5>profile Image <span class="text-danger">*</span></h5>
                              <div class="controls">
                                  <input id="image" type="file" name="profile_photo_path" class="form-control" required=""> <div class="help-block"></div></div>
                          </div>
					  <img id="imageshow" class="rounded-circle" src="{{ !empty($adminData->profile_photo_path)? url('upload/admin_images/'.$adminData->profile_photo_path):url('upload/no_image.jpg') }}" alt="User Avatar">  
                      </div>
                    </div>
                     
                      <div class="text-xs-right">
                          <button type="submit" class="btn btn-rounded btn-primary">update</button>
                      </div>
                  </form>

              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
            </div>

            <script type="text/javascript">
            $(document).ready(function(){
                $('#image').change(function(e){
                    let reader = new FileReader();

                    reader.onload = function(e){
                        $('#imageshow').attr('src',e.target.result)
                    }

                    reader.readAsDataURL(e.target.files['0']);
                })
            })
            </script>
@endsection
