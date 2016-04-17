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
                    <th>No Project</th>
                    <th>Project Name</th>
                    <th>Location</th>
                    <th>Client</th>
                    <th>PM</th>
                    <th>Status</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  	@foreach($project as $item)
	                  <tr>
                      <td>{{ $item->no_project }}</td>
	                    <td>{{ $item->p_name }}</td>
	                    <td>{{ $item->p_address }}</td>
	                    <td>{{ $item->client->name }}</td>
                      <td>{{ $item->pm->name }}</td>
                      <td>
                        @if($item->status_project == "0")
                          <span class="label label-default">Preparation</span>
                        @elseif($item->status_project == "1")
                          <span class="label label-primary">On Progress</span>
                        @elseif($item->status_project == "2")
                          <span class="label label-success">Finish</span>
                        @elseif($item->status_project == "3")
                          <span class="label label-warning">Pending</span>
                        @endif
                      </td>
	                    <td width="15%">
	                    	<div class="btn-group">
		                      <button type="button" class="btn btn-default">Action</button>
		                      <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
		                        <span class="caret"></span>
		                        <span class="sr-only">Toggle Dropdown</span>
		                      </button>
		                      <ul class="dropdown-menu" role="menu">
		                        <li><a href="{{ url('project/edit/'.$item->id.'/'.strtolower(str_replace(" ","-", $item->p_name))) }}"><i class="fa fa-fw fa-edit"></i>Edit</a></li>
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