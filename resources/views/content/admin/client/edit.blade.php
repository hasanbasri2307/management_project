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
	          <h3 class="box-title">Client Form</h3>
	        </div><!-- /.box-header -->
	        <!-- form start -->
	        {!! Form::model($client,['url'=>'client/update/'.$client->id,'method'=>'put']) !!}
	          <div class="box-body">
	          	<div class="form-group{{ $errors->has('company_name') ? ' has-error' : '' }}">
	              <label for="exampleInputEmail1">Company Name</label>
	              {{ Form::text('company_name',old('company_name'),['class'=>'form-control','placeholder'=>'Enter company name']) }}
	             
	              @if($errors->has('company_name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('company_name') }}</strong>
                    </span>
                  @endif

	            </div>
	            <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
	              <label for="exampleInputEmail1">Phone</label>
	              {{ Form::text('phone',old('phone'),['class'=>'form-control','placeholder'=>'Enter phone']) }}
	             
	              @if($errors->has('phone'))
                    <span class="help-block">
                        <strong>{{ $errors->first('phone') }}</strong>
                    </span>
                  @endif

	            </div>
	            <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                  <label>Office Address</label>
                  {{ Form::textarea('address',old('address'),['class'=>'form-control','placeholder'=>'Address']) }}
                  
                  @if($errors->has('company_name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('address') }}</strong>
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