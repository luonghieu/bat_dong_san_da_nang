@extends('admin.inc.index')
@section('css')
@include('admin.product.css')
@endsection
@section('title')
Product
@endsection
@section('content')
<!-- tile -->
<section class="tile">

	<!-- tile header -->
	<div class="tile-header dvd dvd-btm">
		<h1 class="custom-font"><strong>Editable</strong> Usage</h1>
		<ul class="controls">
			<li>
				<a role="button" tabindex="0" id="add-entry"><i class="fa fa-plus mr-5"></i> Add Entry</a>
			</li>
			<li class="dropdown">

				<a role="button" tabindex="0" class="dropdown-toggle settings" data-toggle="dropdown">
					<i class="fa fa-cog"></i>
					<i class="fa fa-spinner fa-spin"></i>
				</a>

				<ul class="dropdown-menu pull-right with-arrow animated littleFadeInUp">
					<li>
						<a role="button" tabindex="0" class="tile-toggle">
							<span class="minimize"><i class="fa fa-angle-down"></i>&nbsp;&nbsp;&nbsp;Minimize</span>
							<span class="expand"><i class="fa fa-angle-up"></i>&nbsp;&nbsp;&nbsp;Expand</span>
						</a>
					</li>
					<li>
						<a role="button" tabindex="0" class="tile-refresh">
							<i class="fa fa-refresh"></i> Refresh
						</a>
					</li>
					<li>
						<a role="button" tabindex="0" class="tile-fullscreen">
							<i class="fa fa-expand"></i> Fullscreen
						</a>
					</li>
				</ul>

			</li>
			<li class="remove"><a role="button" tabindex="0" class="tile-close"><i class="fa fa-times"></i></a></li>
		</ul>
	</div>
	<!-- /tile header -->

	<!-- tile body -->
	<div class="tile-body">
		<div class="table-responsive">
			<table class="table table-custom" id="editable-usage">
				<thead>
					<tr>
						<th>Rendering engine</th>
						<th>Browser</th>
						<th>Platform(s)</th>
						<th>Engine version</th>
						<th>CSS grade</th>
						<th style="width: 160px;" class="no-sort">Actions</th>
					</tr>
				</thead>
				<tbody>
					<tr class="odd gradeX">
						<td>Trident</td>
						<td>Internet Explorer 4.0</td>
						<td>Win 95+</td>
						<td> 4</td>
						<td>X</td>
						<td class="actions"><a role="button" tabindex="0" class="edit text-primary text-uppercase text-strong text-sm mr-10">Edit</a><a role="button" tabindex="0" class="delete text-danger text-uppercase text-strong text-sm mr-10">Remove</a></td>
					</tr>
					<tr class="even gradeC">
						<td>Trident</td>
						<td>Internet Explorer 5.0</td>
						<td>Win 95+</td>
						<td>5</td>
						<td>C</td>
						<td class="actions"><a role="button" tabindex="0" class="edit text-primary text-uppercase text-strong text-sm mr-10">Edit</a><a role="button" tabindex="0" class="delete text-danger text-uppercase text-strong text-sm mr-10">Remove</a></td>
					</tr>
					<tr class="odd gradeA">
						<td>Trident</td>
						<td>Internet Explorer 5.5</td>
						<td>Win 95+</td>
						<td>5.5</td>
						<td>A</td>
						<td class="actions"><a role="button" tabindex="0" class="edit text-primary text-uppercase text-strong text-sm mr-10">Edit</a><a role="button" tabindex="0" class="delete text-danger text-uppercase text-strong text-sm mr-10">Remove</a></td>
					</tr>
					<tr class="even gradeA">
						<td>Trident</td>
						<td>Internet Explorer 6</td>
						<td>Win 98+</td>
						<td>6</td>
						<td>A</td>
						<td class="actions"><a role="button" tabindex="0" class="edit text-primary text-uppercase text-strong text-sm mr-10">Edit</a><a role="button" tabindex="0" class="delete text-danger text-uppercase text-strong text-sm mr-10">Remove</a></td>
					</tr>
					<tr class="odd gradeA">
						<td>Trident</td>
						<td>Internet Explorer 7</td>
						<td>Win XP SP2+</td>
						<td>7</td>
						<td>A</td>
						<td class="actions"><a role="button" tabindex="0" class="edit text-primary text-uppercase text-strong text-sm mr-10">Edit</a><a role="button" tabindex="0" class="delete text-danger text-uppercase text-strong text-sm mr-10">Remove</a></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
	<!-- /tile body -->

</section>
<!-- /tile -->
@endsection

@section('script')
@include('admin.product.script')
@endsection