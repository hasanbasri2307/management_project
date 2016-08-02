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
                    @foreach($output as $key => $value)
                        <table>
                            <tr>
                                <td>No. RAB </td>
                                <td>:</td>
                                <td width="50">{{ $value['master_rab']->no_rab }}</td>
                            </tr>
                            <tr>
                                <td>File </td>
                                <td>: </td>
                                <td><a href="{{ asset('uploads/'.$value['master_rab']->file_attach) }}">{{ $value['master_rab']->file_attach }}</a> </td>
                            </tr>
                            <tr>
                                <td>Status Project </td>
                                <td>: </td>
                                <td>
                                    @if($value['master_rab']->project->status_project == "0")
                                        <span class="label label-default">Preparation</span>
                                    @elseif($value['master_rab']->project->status_rab == "1")
                                        <span class="label label-primary">On Progress</span>
                                    @elseif($value['master_rab']->project->status_project == "2")
                                        <span class="label label-success">Finish</span>
                                    @elseif($value['master_rab']->project->status_project == "3")
                                        <span class="label label-warning">Pending</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Download file</td>
                                <td>:</td>
                                <td><a href="{{ url('project/progress/'.$id.'/download') }}">Download file</a> </td>
                            </tr>

                        </table>
                        <br />


                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Master Job</th>
                                <th>Job Item</th>
                                <th>Week</th>
                                <th>Progress</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $no = 0;?>
                            @foreach($value['detail_rab'] as $item)
                                <tr>
                                    <td>{{ $no+=1 }}</td>
                                    <td>{{ $item->detail_rab->master_job }}
                                    <td>{{ $item->detail_rab->sub_job_name }}</td>
                                    <td>{{ $item->week_of }}</td>
                                    <td>{{ $item->progress }} %</td>
                                    <td>{{ $item->start_date }}</td>
                                    <td>{{ $item->end_date }}</td>

                                </tr>
                            @endforeach

                            </tbody>

                        </table>
                    @endforeach
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
    <div class="modal fade" tabindex="-1" role="dialog" id="detailProjectModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <div id="content-body"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
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

        $('#detail_project').on("click",function(){
            var pid = $(this).data("id");
            var url = "{{ url('project/detail') }}";
            $.get(url+'/'+pid, function(data) {
                $('#content-body').replaceWith(data.view);
                $(".modal-title").text(data.no_project);
                $("#detailProjectModal").modal("toggle");
            });



        });
    </script>
@endsection
