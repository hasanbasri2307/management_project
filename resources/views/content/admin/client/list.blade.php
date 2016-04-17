@extends("layouts.master")
@section("css")
	<link rel="stylesheet" href="{{ asset('assets/plugins/datatables/dataTables.bootstrap.css') }}">
@endsection
@section("content")
	<div class="row">
        <div class="col-xs-12">
          @if(!empty(Session::get('success')))
            <div class="alert alert-success alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <h4>  <i class="icon fa fa-check"></i> Alert!</h4>
              {{ Session::get('success') }}
            </div>
          @endif
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">{{ $title }}</h3>
            </div><!-- /.box-header -->

            <div class="box-body">

              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>PIC</th>
                    <th>Email</th>
                    <th>Company</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Status</th>
                    <th>Created At</th>
                    <th>Last Updated</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  	@foreach($client as $item)
	                  <tr>
	                    <td>{{ $item->user->name }}</td>
	                    <td>{{ $item->user->email }}</td>
	                    <td>{{ !empty($item->company_name) ? $item->company_name : 'Not set' }}</td>
                      <td>{{ !empty($item->phone) ? $item->phone : 'Not set' }}</td>
                      <td>{{ !empty($item->address) ? $item->address : 'Not set' }}</td>
                      <td>{!! $item->user->status_user == 1 ? '<span class="label label-success">Active</span>' : '<span class="label label-danger">Inactive</span>' !!}</td>
	                    <td>{{ date("d F Y H:i:s",strtotime($item->created_at)) }}</td>
	                    <td>{{ date("d F Y H:i:s",strtotime($item->updated_at)) }}</td>
	                    <td width="10%">
	                    	<div class="btn-group">
		                      <button type="button" class="btn btn-default">Action</button>
		                      <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
		                        <span class="caret"></span>
		                        <span class="sr-only">Toggle Dropdown</span>
		                      </button>
		                      <ul class="dropdown-menu" role="menu">
		                        <li><a href="{{ url('client/edit/'.$item->id.'/'.strtolower(str_replace(" ","-", $item->user->name))) }}"><i class="fa fa-fw fa-edit"></i>Edit</a></li>
		                      </ul>
		                    </div>
	                    </td>
	                  </tr>
                  	@endforeach

                </tbody>

              </table>
            </div><!-- /.box-body -->
          </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
@endsection
@section("js")
	<script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
@endsection
@section("js_script")
	<script type="text/javascript">
		$(function () {
	        $("#example1").DataTable();
      });
	</script>
@endsection