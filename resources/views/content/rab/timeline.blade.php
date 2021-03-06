@extends("layouts.master")
@section("css")
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datepicker/datepicker3.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/iCheck/all.css') }}">
@endsection
@section("content")
    {!! Form::open(['url'=>'rab/update_timeline/'.$rab->id,'method'=>'put','id'=>'rabform','files'=>true]) !!}
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">RAB Information</h3>
                </div><!-- /.box-header -->
                <!-- form start -->

                <div class="box-body">
                    <div class="form-group{{ $errors->has('file_attach') ? ' has-error' : '' }}">
                        <label for="exampleInputFile">Copy of Rab</label>
                        @if(empty($rab->file_attach))
                            {!! Form::file('file_attach'); !!}

                            @if($errors->has('file_attach'))
                                <span class="help-block">
	  						<strong>{{ $errors->first('file_attach') }}</strong>
	  					</span>
                            @endif
                        @else
                            <br/>
                            <a href="{{ asset('uploads/'.$rab->file_attach) }}">{{ $rab->file_attach }}</a> &nbsp &nbsp<a style="cursor:pointer" id='ganti_attach'>Change file</a>
                        @endif

                    </div>
                    <div class="form-group">
                        <label>Project Name</label>

                        <input type="text" id="project_name" class="form-control" value="{{ $rab->project->p_name }}"  placeholder="Project Name ..." disabled>
                    </div>
                    <div class="form-group">
                        <label>Client</label>
                        <input type="text" id="client" class="form-control" value="{{ $rab->project->client->client->company_name }}"  placeholder="Client ..." disabled>
                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <textarea class="form-control" id="address" rows="3" placeholder="Address ..." disabled>{{ $rab->project->client->client->address }}</textarea>
                    </div>


                </div><!-- /.box-body -->
            </div><!-- /.box -->



        </div><!--/.col (left) -->
        <!-- right column -->
        <div class="col-md-12">
            <!-- general form elements disabled -->
            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3 class="box-title">Detail RAB Information</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <!-- text input -->
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Master Job</th>
                            <th>Job Item</th>

                            <th>Start Date</th>
                            <th>Estimate End Date</th>
                            <th>Finish ?</th>
                            <th>End Date</th>
                            <th>Late ?</th>
                            <th>Reason of Late</th>
                        </tr>

                        </thead>
                        <tbody id="job_table">
                        <?php
                        $temp = "";
                        $counter = 0;
                        ?>
                        @foreach($detail_rab as $key => $value)
                            <input type="hidden" name="detail_rab_id[]" value="{{ $value->id }}">
                            <tr><td>-</td><td><input type='text' name='master_job_name[]' class='form-control' value="{{ $value['master_job'] }}" required readonly></td><td><input type='text' name='sub_job_name[]' class='form-control' value="{{ $value['sub_job_name'] }}" required readonly></td><td>{!! Form::text('start_date[]',$value->start_date,['class'=>'form-control datepicker','placeholder'=>'Start Date']) !!}</td><td>{!! Form::text('estimate_end_date[]',$value->estimate_end_date,['class'=>'form-control datepicker','placeholder'=>'Estiamte End Date']) !!}</td><td><div class="checkbox">
                                        <label><input type="checkbox" <?php if($value->status_sub==1):?> checked <?php endif;?> name="finish[]" value="1" class="finish" onchange="finish(this)">Finish ?</label>
                                    </div></td><td>
                                    @if($value->status_sub==1)
                                        {!! Form::text('end_date[]',$value->end_date,['class'=>'form-control datepicker end-date','placeholder'=>'End Date']) !!}
                                        @else
                                        {!! Form::text('end_date[]',$value->end_date,['class'=>'form-control datepicker end-date','placeholder'=>'End Date','readonly'=>true]) !!}
                                    @endif
                                </td><td><div class="checkbox">
                                        <label><input type="checkbox" <?php if(!empty($value->late_reason)):?> checked <?php endif;?> name="late[]" value="1" class="late" onchange="late(this)">Late ?</label>
                                    </div></td><td>{!! Form::text('late[]',$value->late_reason,['class'=>'form-control late','placeholder'=>'Late','readonly'=>true]) !!}</td></tr>
                        @endforeach

                        </tbody>
                        <tfoot>
                        <tr>
                            <td>-</td>
                            <td colspan="5"><input type="hidden" value="{{ $rab->estimate_total_budget }}" name="estimate_total_budget" class="form-control number" readonly="true"> </td>
                            <td></td>
                        </tr>
                        </tfoot>
                    </table>

                </div><!-- /.box-body -->
            </div><!-- /.box -->


        </div><!--/.col (right) -->
    </div>   <!-- /.row -->
    <div class="row">
        <div class="col-md-12">
            <div class="box box-default">
                <div class="box-footer">
                    {{ Form::submit('Submit',['class'=>'btn btn-primary']) }}
                    <a href="{{ url('project/rab/'.$id.'/download') }}"> <button class="btn btn-primary" type="button">Download Timeline</button></a>
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
    <script src="{{ asset('assets/jquery.number.min.js') }}"></script>
@endsection
@section("js_script")
    <script type="text/javascript">
        var totals = 0;

        $(function(){
            // Set up the number formatting.
            $('.number').number(true);

        });

        $(".select2").select2();
        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd'
        });
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
            checkboxClass: 'icheckbox_flat-green',
            radioClass: 'iradio_flat-green'
        });

        $('#project_id').on('change',function(){
            var _id = $(this).val();
            $.get('{{ url("project/get-detail-project") }}/'+_id, function(data) {
                /*optional stuff to do after success */
                $('#project_name').val(data.project.p_name);
                $('#client').val(data.project.client);
                $('#address').val(data.project.p_address);
            });
        });



        $("#add_edit_job").on("click",function(){

            var _element = "<tr><td>-</td><td><input type='text' name='master_job_name[]' class='form-control' required></td><td><input type='text' name='sub_job_name[]' class='form-control' required></td><td><input type='text' name='unit[]' class='form-control' required></td><td><input type='text' name='volume[]' value='0' class='form-control volume number' oninput='volume(this)' required></td><td width='20%'><input type='text' name='unit_price[]' value='0' class='form-control unit_price number' oninput='unit_price(this)' required></td><td><button type='button' class='btn btn-sm btn-danger' onclick='hapus(this)'>Remove</button></td></tr><input type='hidden' name='master_jobs[]' ><input type='hidden' name='detail_rab_id[]' value='0'> ";
            $(_element).appendTo('#job_table');
        });

        function master_jobs(elem){
            var vals = $(elem).val();
            $(elem).parent().parent().find('.add_sub_job').attr('id',vals);
            console.log(vals);
        }

        function finish(elem){
            if(elem.checked) {
                $(elem).parent().parent().parent().parent().find('.end-date').removeAttr('readonly');
            }else{
                $(elem).parent().parent().parent().parent().find('.end-date').attr('readonly',true);
            }

        }

        function late(elem){
            if(elem.checked) {
                $(elem).parent().parent().parent().parent().find('.late').removeAttr('readonly');
            }else{
                $(elem).parent().parent().parent().parent().find('.late').attr('readonly',true);
            }

        }

        function add(elem){
            if(!$(elem).parent().parent().find(".parent-job").val()){
                alert("Job title must be filled.");
                return false;
            }

            var master_j = $(elem).attr('id');

            var _element = "<tr><td>-</td><td><input type='text' name='sub_job_name[]' class='form-control' required></td><td><input type='text' name='unit[]' class='form-control' required></td><td><input type='text' name='volume[]' value='0' class='form-control volume number' oninput='volume(this)' required></td><td width='20%'><input type='text' name='unit_price[]' value='0' class='form-control unit_price number' oninput='unit_price(this)' required></td><td><button type='button' class='btn btn-sm btn-danger' onclick='hapus(this)'>Remove</button></td></tr><input type='hidden' name='master_jobs[]' value='"+master_j+"'> ";

            $(_element).appendTo($(elem).parent().parent().parent());
            $('.number').number(true);
        }

        function hapus(elem){
            var totals = parseFloat(total());
            var subtotal = $(elem).parent().parent().find('.subtotal').val();
            console.log(subtotal)
            totals -= parseFloat(subtotal);
            $(elem).parent().parent().remove();
            $('#estimate_budget').val(totals);
        }

        function volume(elem){
            var vol = $(elem).val();
            var unit_price = $(elem).parent().parent().find('.unit_price').val();
            var subtotal = parseFloat(vol * unit_price);
            $(elem).parent().parent().find('.subtotal').val(subtotal);
            calculate(elem);
        }

        function unit_price(elem){
            var unit_price = $(elem).val();
            var vol = $(elem).parent().parent().find('.volume').val();
            var subtotal = parseFloat(vol * unit_price);

            $(elem).parent().parent().find('.subtotal').val(subtotal);
            calculate();

        }

        function total(){
            var $inputs = $('.subtotal');
            var sum = 0;
            $inputs.each(function () {
                sum += +$(this).val() || 0;
            });
            return sum;
        }

        function calculate() {
            var $inputs = $('.subtotal');
            var sum = 0;
            $inputs.each(function () {
                sum += +$(this).val() || 0;
            });
            $('#estimate_budget').val(sum);
        }

    </script>
@endsection
