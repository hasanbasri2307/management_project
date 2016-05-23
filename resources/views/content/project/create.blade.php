@extends("layouts.master")
@section("css")
<link rel="stylesheet" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/datepicker/datepicker3.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/iCheck/all.css') }}">
@endsection
@section("content")
{!! Form::open(['url'=>'project/save','method'=>'post']) !!}
<div class="row">
	<!-- left column -->
	<div class="col-md-8">
		<!-- general form elements -->
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title">Project Information</h3>
			</div><!-- /.box-header -->
			<!-- form start -->
			
			<div class="box-body">
				<div class="form-group{{ $errors->has('p_name') ? ' has-error' : '' }}">
					<label for="exampleInputEmail1">Project Name</label>
					{!! Form::text("p_name",old('p_name'),['class'=>'form-control','placeholder'=>'Project Name']) !!}
					@if($errors->has('p_name'))
					<span class="help-block">
						<strong>{{ $errors->first('p_name') }}</strong>
					</span>
					@endif 
				</div>
				<div class="form-group{{ $errors->has('p_address') ? ' has-error' : '' }}">
					<label>Address</label>
					{!! Form::textarea('p_address',old('p_address'),['rows'=>'5','class'=>'form-control','placeholder' => 'Project Address']) !!}
					@if($errors->has('p_address'))
					<span class="help-block">
						<strong>{{ $errors->first('p_address') }}</strong>
					</span>
					@endif 
					
				</div>
				<div class="form-group{{ $errors->has('start_date') ? ' has-error' : '' }}">
					<label>Start Date</label>
					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
						{!! Form::text('start_date',old('start_date'),['class'=>'form-control datepicker','placeholder'=>'Start Date']) !!}
						
					</div>
					@if($errors->has('start_date'))
					<span class="help-block">
						<strong>{{ $errors->first('start_date') }}</strong>
					</span>
					@endif 
				</div>
				
				<div class="form-group{{ $errors->has('estimate_end_date') ? ' has-error' : '' }}">
					<label>Estimation End Date</label>
					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
						{!! Form::text('estimate_end_date',old('estimate_end_date'),['class'=>'form-control datepicker','placeholder'=>'Estimate End Date']) !!}
						
					</div>
					@if($errors->has('estimate_end_date'))
					<span class="help-block">
						<strong>{{ $errors->first('estimate_end_date') }}</strong>
					</span>
					@endif 
				</div>
				<div class="form-group{{ $errors->has('status_project') ? ' has-error' : '' }}">
					<label>Status Project</label>
					<br />
					{{ Form::radio('status_project','0',true,['class'=>'flat-red']) }}
					Preparation
					
					{{ Form::radio('status_project','1',false,['class'=>'flat-red']) }}
					On Progress
					
					{{ Form::radio('status_project','2',false,['class'=>'flat-red']) }}
					Finish
					
					{{ Form::radio('status_project','3',false,['class'=>'flat-red']) }}
					Pending

					@if($errors->has('status_project'))
					<span class="help-block">
						<strong>{{ $errors->first('status_project') }}</strong>
					</span>
					@endif 
				</div>
			</div><!-- /.box-body -->
		</div><!-- /.box -->

		

	</div><!--/.col (left) -->
	<!-- right column -->
	<div class="col-md-4">
		<!-- general form elements disabled -->
		<div class="box box-warning">
			<div class="box-header with-border">
				<h3 class="box-title">Client Information</h3>
			</div><!-- /.box-header -->
			<div class="box-body">
				<!-- text input -->
				<div class="form-group{{ $errors->has('client_id') ? ' has-error' : '' }}">
					<label>Company</label>
					{!! Form::select('client_id',$client,null,['class'=>'form-control select2','id'=>'client_id','placeholder'=>'Choose']) !!}
					@if($errors->has('client_id'))
					<span class="help-block">
						<strong>{{ $errors->first('client_id') }}</strong>
					</span>
					@endif 
				</div>
				<div class="form-group">
					<label>PIC</label>

					<input type="text" id="pic" class="form-control"  placeholder="PIC ..." disabled>
				</div>
				<div class="form-group">
					<label>Phone</label>
					<input type="text" id="phone" class="form-control"  placeholder="Phone ..." disabled>
				</div>
				<div class="form-group">
					<label>Address</label>
					<textarea class="form-control" id="address" rows="3" placeholder="Address ..." disabled></textarea>
				</div>
				
			</div><!-- /.box-body -->
		</div><!-- /.box -->

		<div class="box box-success">
			<div class="box-header with-border">
				<h3 class="box-title">Project Manager Information</h3>
			</div><!-- /.box-header -->
			<div class="box-body">
				<!-- text input -->
				<div class="form-group{{ $errors->has('pm_id') ? ' has-error' : '' }}">
					<label>Project Manager</label>
					{!! Form::select('pm_id',$pm,null,['class'=>'form-control select2','id'=>'pm_id','placeholder'=>'Choose']) !!}
					@if($errors->has('pm_id'))
					<span class="help-block">
						<strong>{{ $errors->first('pm_id') }}</strong>
					</span>
					@endif 
				</div>
				<div class="form-group">
					<label>Email</label>
					<input type="text" id="email" class="form-control"  placeholder="Email ..." disabled>
				</div>
				
			</div><!-- /.box-body -->
		</div><!-- /.box -->
	</div><!--/.col (right) -->
</div>   <!-- /.row -->
<div class="row">
	<div class="col-md-12">
		<div class="box box-default">
			<div class="box-footer">
				{{ Form::submit('Submit',['class'=>'btn btn-primary']) }}
			</div>
		</div><!-- /.box -->
	</div>
</div>
{!! Form::close() !!}
@endsection
@section("js")
<script src="{{ asset('assets/plugins/select2/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('assets/plugins/iCheck/icheck.min.js') }}"></script>
@endsection
@section("js_script")
<script type="text/javascript">
	$(".select2").select2();
	$('.datepicker').datepicker({
		format: 'yyyy-mm-dd'
	});
	$('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
		checkboxClass: 'icheckbox_flat-green',
		radioClass: 'iradio_flat-green'
	});

	$('#client_id').on('change',function(){
		var _id = $(this).val();
		$.get('{{ url("project/get-detail-user") }}/'+_id, function(data) {
			/*optional stuff to do after success */
			$('#pic').val(data.user.name);
			$('#phone').val(data.user.client.phone);
			$('#address').val(data.user.client.address);
		});
	});

	$('#pm_id').on('change',function(){
		var _id = $(this).val();
		$.get('{{ url("project/get-detail-user") }}/'+_id, function(data) {
			/*optional stuff to do after success */
			$('#email').val(data.user.email);
		});
	});
</script>
@endsection
