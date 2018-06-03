@extends('public.inc.index')
@section('content')
<div class="content_wrapper">

	<div class="container">

		<div class="breakdum">

			<a href="{!! route('public.trangchu') !!}">Trang chủ</a><span> <i class="fa fa-caret-right" aria-hidden="true"></i> <h2 style="display: inline-block;"><a href="{!! route('public.chitietduan', ['name' => str_slug($project->name), 'id' => $project->id ]) !!}">{!! $project->name !!}</a></h2></span>

		</div>

		<div class="block-news">


			<div class="tile-body">
				<div class="table-responsive">
					<form class="navbar-form" action="{{ route('public.duan.timkiemsanphamduan') }}" method="GET">
						<input type="hidden" name="_token" value="{{csrf_token()}}" />
						<input type="hidden" name="projectId" value="{{$project->id}}" />
						<strong>Thể loại</strong>
						<select class="form-control" name="cat_id" id="cat_id">
							<option value="-1">--Chọn--</option>
							@foreach($cats as $id => $name)
							<option {{ (isset($search)&&$search['cat_id']==$id) ? 'selected="selected"' : '' }} value="{!! $id !!}">{!! $name !!}</option>
							@endforeach
						</select>
						<strong for="">Giá: </strong>
						<select class="form-control" name="price" id="price">
							<option value="-1">--Chọn--</option>
							@foreach($prices as $id => $name)
							<option {{ (isset($search)&&$search['price']==$id) ? 'selected="selected"' : '' }} value="{!! $id !!}">{!! $name !!}</option>
							@endforeach
						</select>
						<strong for="">Diện tích: </strong>
						<select class="form-control" name="area" id="area">
							<option value="-1">--Chọn--</option>
							@foreach($areas as $id => $name)
							<option {{ (isset($search)&&$search['area']==$id) ? 'selected="selected"' : '' }} value="{!! $id !!}">{!! $name !!}</option>
							@endforeach
						</select>
						<strong for="">Hướng: </strong>
						<select class="form-control" name="direction" id="direction">
							<option value="-1">--Chọn--</option>
							@foreach($directions as $id => $name)
							<option {{ (isset($search)&&$search['direction']==$id) ? 'selected="selected"' : '' }} value="{!! $id !!}">{!! $name !!}</option>
							@endforeach
						</select>
						<strong for="">Trạng thái: </strong>
						<select class="form-control" name="status">
							<option value="-1">--Chọn--</option>
							@foreach($statuses as $key => $value)
							<option  {{ (isset($search)&&$search['status']==$key) ? 'selected="selected"' : '' }}  value="{{ $key }}">{{ $value }}</option>
							@endforeach
						</select>
						<button class="form-control" type="submit" class="pull-right">Tìm</button>
						<a href="{!! route('public.duan.sanpham', ['id' => $project->id]) !!}" role="button" tabindex="0" style="text-decoration: none" class="form-control" class="pull-right">Tất cả</a>
					</form>
					@if (session('success'))
					<div class="alert alert-success">
						<p><strong>{{ session('success') }}</strong></p>
					</div>
					@endif
					<table class="table table-custom" id="editable-usage">
						<thead>
							<tr>
								<th>STT</th>
								<th>Khu</th>
								<th>Lô</th>
								<th>Tầng</th>
								<th>Căn hộ</th>
								<th>Thể loại</th>
								<th>Giá</th>
								<th>Đơn vị</th>
								<th>Diện tích (m2)</th>
								<th>Hướng</th>
								<th>Trạng thái</th>
								<th>Lượt xem</th>
								<th>Chi tiết</th>
							</tr>
						</thead>
						<tbody>
							@foreach($list as $obj)
							<tr class="odd gradeX">
								<td>{!! $obj->id !!}</td>
								<td>{!! $obj->block !!}</td>
								<td>{!! $obj->land !!}</td>
								<td>
									@if (isset($obj->floor))
									{!! $obj->floor !!}
									@endif
								</td>
								<td>
									@if (isset($obj->apartment))
									{!! $obj->apartment !!}
									@endif
								</td>
								<td>{!! $obj->cat->name !!}</td>
								<td>{!! $obj->price !!}</td>
								<td>{!! $obj->unitPrice->name !!}</td>
								<td>{!! $obj->area !!}</td>
								<td>{!! $obj->direction !!}</td>
								<td>
									@if($obj->status == 'Remaining')
									<span>Còn hàng</span>
									@else
									<span>Hết hàng</span>
									@endif
								</td>
								<td>{!! $obj->view !!}</td>
								<td> 
									<a href="{!! route('public.duan.chitietsanpham', ['id' => $obj->id ]) !!}" role="button" tabindex="0" class="text-uppercase text-strong text-sm mr-10">Detail</a>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
			<!-- /tile body -->
			<!-- tile footer -->
			<!-- /tile footer -->

		</div>

	</div>

</div>

@endsection

@section('script')
@section('script')

<script>
        // $( document ).ready(function() {
        	$('#select-all').change(function() {
        		if ($(this).is(":checked")) {
        			$('#editable-usage .selectMe').prop('checked', true);
        		} else {
        			$('#editable-usage .selectMe').prop('checked', false);
        		}
        	});

        	$('#apply').click(function() {
        		var list = $('input[name="selected"]:checked');
        		if (list.length == 0) {
        			alert('No obj is selected!');
        			return false;
        		}
        		return true;
        	});

        	function changeStatus(id) {
        		status = $('select[name = "status-' + id + '"]').val();
        		$.ajax({
        			url: "{!! route('admins.post.status') !!}",
        			method: "GET",
        			data: {
        				'id' : id,
        				'status' : status
        			},
        			dataType : 'json',
        			success : function(result){
        				alert('Action success!');
        			}
        		});
        	}
        // });
    </script>
    @endsection
    @endsection