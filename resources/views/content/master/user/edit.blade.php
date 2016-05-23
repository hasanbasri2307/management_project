@extends("layouts.master")
@section("css")
	<link rel="stylesheet" href="{{ asset('assets/plugins/iCheck/all.css') }}">
@endsection
@section("content")
	<div class="row">
	    <!-- left column -->
	    <div class="col-md-12">
	      <!-- general form elements -->
	      <div class="box box-primary">
	        <div class="box-header with-border">
	          <h3 class="box-title">User Form</h3>
	        </div><!-- /.box-header -->
	        <!-- form start -->
	        {!! Form::model($user,['url'=>'user/update/'.$user->id,'method'=>'put']) !!}
	          <div class="box-body">
	          	<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
	              <label for="exampleInputEmail1">Name</label>
	              {{ Form::text('name',old('name'),['class'=>'form-control','placeholder'=>'Enter name']) }}
	             
	              @if($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                  @endif

	            </div>
	            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
	              <label for="exampleInputEmail1">Email address</label>
	              {{ Form::email('email',old('email'),['class'=>'form-control','placeholder'=>'Enter email','disabled'=>'disabled']) }}

	              @if($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                  @endif

	            </div>
	            <div class="form-group{{ $errors->has('role') ? ' has-error' : '' }}">
                    <label>Role</label>
                    <br />
                      {{ Form::radio('role','administrator',$user->role == 'administrator' ? true :false,['class'=>'flat-red']) }}
                      Administrator
                   
                      {{ Form::radio('role','admin',$user->role == 'admin' ? true :false,['class'=>'flat-red']) }}
                      Admin
                   
                      {{ Form::radio('role','pm',$user->role == 'pm' ? true :false,['class'=>'flat-red']) }}
                      PM
                    
                      {{ Form::radio('role','client',$user->role == 'client' ? true :false,['class'=>'flat-red']) }}
                      Client
                      @if($errors->has('role'))
	                    <span class="help-block">
	                        <strong>{{ $errors->first('role') }}</strong>
	                    </span>
	                  @endif 
                </div>

                <div class="form-group{{ $errors->has('status_user') ? ' has-error' : '' }}">
                    <label>Status</label>
                    <br />
                      {{ Form::radio('status_user','1',$user->status == "1" ? true:false,['class'=>'flat-red']) }}
                      Active
                   
                      {{ Form::radio('status_user','0',$user->status == "0" ? true:false,['class'=>'flat-red']) }}
                      Inactive
                   
                      
                      @if($errors->has('status_user'))
	                    <span class="help-block">
	                        <strong>{{ $errors->first('status_user') }}</strong>
	                    </span>
	                  @endif 
                </div>
	           
	          </div><!-- /.box-body -->
	          
	          <div class="box-footer">
	          	{{ Form::submit('Submit',['class'=>'btn btn-primary']) }}
	            
	          </div>
	        {!! Form::close() !!}
	      </div><!-- /.box -->
	    </div><!--/.col (left) -->
	    <!-- right column -->
	    
	  </div>
@endsection
@section("js")
	<script src="{{ asset('assets/plugins/iCheck/icheck.min.js') }}"></script>
@endsection
@section("js_script")
	<script type="text/javascript">
		$('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
          checkboxClass: 'icheckbox_flat-green',
          radioClass: 'iradio_flat-green'
        });
	</script>
@endsection