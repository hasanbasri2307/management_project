<div class="box">
	<div class="box-header">
	</div><!-- /.box-header -->
	<div class="box-body no-padding">
		<table class="table">
			<tbody>
				<tr>
					<th width="30%">Project name</th>
					<td width="5%">:</td>
					<td>{{ $project->p_name }}</td>
				</tr>
				<tr>
					<th width="30%">Address</th>
					<td width="5%">:</td>
					<td>{{ $project->p_address }}</td>
				</tr>
				<tr>
					<th width="30%">Client</th>
					<td width="5%">:</td>
					<td>{{ $project->client->client->company_name }}</td>
				</tr>
				<tr>
					<th width="30%">Start date</th>
					<td width="5%">:</td>
					<td>{{ date("d F Y",strtotime($project->start_date)) }}</td>
				</tr>
				<tr>
					<th width="30%">Estimate end date</th>
					<td width="5%">:</td>
					<td>{{ date("d F Y",strtotime($project->estimate_end_date)) }}</td>
				</tr>
				<tr>
					<th width="30%">End date</th>
					<td width="5%">:</td>
					<td>@if($project->end_date == "0000-00-00")
							-
						@else
							{{ date("d F Y",strtotime($project->end_date)) }}
						@endif	
					</td>
				</tr>
				<tr>
					<th width="30%">Project manager</th>
					<td width="5%">:</td>
					<td>{{ $project->pm->name }}</td>
				</tr>
				<tr>
					<th width="30%">Status</th>
					<td width="5%">:</td>
					<td>
					@if($project->status_project == "0")
					<span class="label label-default">Preparation</span>
					@elseif($project->status_project == "1")
					<span class="label label-primary">On Progress</span>
					@elseif($project->status_project == "2")
					<span class="label label-success">Finish</span>
					@elseif($project->status_project == "3")
					<span class="label label-warning">Pending</span>
					@endif
					</td>
				</tr>
			</tbody>
		</table>
	</div><!-- /.box-body -->
</div>