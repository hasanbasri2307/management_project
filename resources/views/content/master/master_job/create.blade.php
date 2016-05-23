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
						<h3 class="box-title">Master Job Form</h3>
					</div><!-- /.box-header -->
					<!-- form start -->
					{!! Form::open(['url'=>'master-job/save','method'=>'post']) !!}
						<div class="box-body">
							<div class="form-group{{ $errors->has('mp_name') ? ' has-error' : '' }}">
								<label for="exampleInputEmail1">Name</label>
								{{ Form::text('mp_name',old('mp_name'),['class'=>'form-control','placeholder'=>'Enter name']) }}
							 
								@if($errors->has('mp_name'))
										<span class="help-block">
												<strong>{{ $errors->first('mp_name') }}</strong>
										</span>
									@endif

							</div>
							<div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
			                  <label>Description</label>
			                  {{ Form::textarea('description',old('description'),['class'=>'form-control','placeholder'=>'Description']) }}
			                  
			                  @if($errors->has('description'))
			                    <span class="help-block">
			                        <strong>{{ $errors->first('description') }}</strong>
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