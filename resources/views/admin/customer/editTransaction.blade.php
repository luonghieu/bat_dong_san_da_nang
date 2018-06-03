@extends('admin.inc.index')
@section('css')
@include('admin.customer.css')
@endsection
@section('title')
<a href="{!! route('admins.customer.list') !!}">Customer</a> >
<a href="{!! route('admins.customer.detailTransaction', ['registerId' => $transaction->register_id ]) !!}">Transaction</a> >
Edit Transaction
@endsection
@section('content')
<!-- tile -->
<section class="tile">

    <!-- tile header -->
    <div class="tile-header dvd dvd-btm">
        <h1 class="custom-font"><strong>Edit Transaction</strong></h1>
        <ul class="controls">
            <li>
                <a role="button" tabindex="0" id="add-entry"><i class="fa fa-plus mr-5"></i> Edit</a>
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
        </ul>
    </div>
    <!-- /tile header -->

    <!-- tile body -->
    <div class="tile-body">
        <h3>
            <a href="{!! route('admins.project.status',['project_id' => $transaction->register->project->id]) !!}" role="button" tabindex="0" class="text-uppercase text-strong text-sm mr-10">{!! $transaction->register->project->name !!}</a>
        </h3>
        @if (session('error'))
        <div class="alert alert-danger">
            <p>{{ session('error') }}</p>
        </div>
        @endif
        <form class="form-horizontal" role="form" id="form-add" method="post" action="{!! route('admins.customer.updateTransaction') !!}">
            <input type="hidden" name="_token" value="{{csrf_token()}}" />
            <input type="hidden" name="transactionId" value="{{$transaction->id}}" />
            <input type="hidden" name="projectId" id="projectId" value="{{$transaction->register->project_id}}" />
            <input type="hidden" name="registerId" id="registerId" value="{{$transaction->register_id}}" />
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Block</label>
                <div class="col-sm-10">
                    <select class="form-control" name="block" id="block">
                        <option value="-1">--Choose--</option>
                        @foreach($blocks as $item)
                        <option value="{!! $item !!}"  {{ ($item == $transaction->product->block) ? 'selected="selected"' : '' }}>{!! $item !!}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">Land</label>
                <div class="col-sm-10">
                    <select class="form-control" name="land" id="land">
                        <option value="-1">--Choose--</option>
                        @foreach($lands as $item)
                        <option value="{!! $item !!}"  {{ ($item == $transaction->product->land) ? 'selected="selected"' : '' }}>{!! $item !!}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">Floor</label>
                <div class="col-sm-10">
                    <select class="form-control" name="floor" id="floor">
                        @if($floors == 0) 
                        <option value="0">-- Choose --</option>
                        @else
                        <option value="-1">-- Choose --</option>
                        @foreach(range(1, $floors) as $value)
                        <option value="{{ $value }}" {{ (isset($transaction->apartment) && $transaction->apartment->floor==$value)? 'selected="selected"': ''}}>{{ $value }}</option>
                        @endforeach
                        @endif
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">Position</label>
                <div class="col-sm-10">
                    <select class="form-control" name="position" id="position">
                        @if($apartment == 0) 
                        <option value="0">-- Choose --</option>
                        @else
                        <option value="-1">-- Choose --</option>
                        @foreach($apartment as $value)
                        <option value="{{ $value }}" {{ (isset($transaction->apartment) && $transaction->apartment->position == $value)? 'selected="selected"': ''}}>{{ $value }}</option>
                        @endforeach
                        @endif
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Description</label>
                <div class="col-sm-10">
                   <textarea id="editor1" name="description">{{ $transaction->description}}
                   </textarea>
                   <script>
                    CKEDITOR.replace( 'editor1', {
                        filebrowserBrowseUrl: '{{ asset('ckfinder/ckfinder.html') }}',
                        filebrowserImageBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Images') }}',
                        filebrowserFlashBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Flash') }}',
                        filebrowserUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}',
                        filebrowserImageUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}',
                        filebrowserFlashUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}'
                    });
                </script>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-rounded btn-primary btn-sm">Cancel</button>
            </div>
        </div>
    </form>
</div>
<!-- /tile body -->

</section>
<!-- /tile -->
@endsection

@section('script')
<script>
    $( document ).ready(function() {
        $('#add-entry').click(function (e) {
            $('#form-add').submit();
        });

        $('#block').change(function () {
            block = $(this).val();
            $("#land").html('<option value="-1">--Choose--</option>');
            $("#floor").html('<option value="-1">--Choose--</option>');
            $("#position").html('<option value="-1">--Choose--</option>');
            if (block == -1) {
                $("#land").html('<option value="-1">--Choose--</option>');
                $("#floor").html('<option value="-1">--Choose--</option>');
                $("#position").html('<option value="-1">--Choose--</option>');
                return false;
            }
            $.ajax({
                url: "{{ route('admins.project.getLandByBlock') }}",
                method: "GET",
                data: {
                    'block' : block,
                    'projectId' : $('#projectId').val(),
                },
                dataType : 'json',
                success : function(result){
                    html = '<option value="-1">--Choose--</option>';
                    $.each (result, function (key, item){
                      html += '<option value="' + item + '">' + item + '</option>';
                  });
                    $("#land").html(html);
                }
            });
        });

        $('#land').change(function () {
            $("#floor").html('<option value="-1">--Choose--</option>');
            $("#position").html('<option value="-1">--Choose--</option>');
            land = $(this).val();
            if (land == -1) {
                $("#floor").html('<option value="-1">--Choose--</option>');
                $("#position").html('<option value="-1">--Choose--</option>');
                return false;
            }
            $.ajax({
                url: "{{ route('admins.project.getFloorByLand') }}",
                method: "GET",
                data: {
                    'block' : $('#block').val(),
                    'land' : land,
                    'projectId' : $('#projectId').val(),
                },
                dataType : 'json',
                success : function(result){
                    if (result == 0) {
                        html = '<option value="0">--Choose--</option>';
                    } else {
                        html = '<option value="-1">--Choose--</option>';
                        $.each (result, function (key, item){
                            html += '<option value="' + item + '">' + item + '</option>'
                        });
                    }
                    $('#floor').html(html);
                }
            });
        });

        $('#floor').change(function () {
            $("#position").html('<option value="-1">--Choose--</option>');
            floor = $(this).val();
            if (floor == -1) {
                $("#position").html('<option value="-1">--Choose--</option>');
                return false;
            }
            $.ajax({
                url: "{{ route('admins.project.getApartmentByFloor') }}",
                method: "GET",
                data: {
                    'block' : $('#block').val(),
                    'land' : $('#land').val(),
                    'floor' : $('#floor').val(),
                    'projectId' : $('#projectId').val(),
                },
                dataType : 'json',
                success : function(result){
                    html = '<option value="-1">--Choose--</option>';
                    $.each (result, function (key, item){
                        html += '<option value="' + item + '">' + item + '</option>'
                    });
                    $('#position').html(html);
                }
            });
        });
    });
</script>
@endsection