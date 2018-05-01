@extends('admin.inc.index')
@section('css')
@include('admin.customer.css')
@endsection
@section('title')
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
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Block</label>
                <div class="col-sm-10">
                    <select class="form-control" name="block" onchange="getFloor({!! $transaction->product->project->id  !!})">
                        @foreach($products as $item)
                        <option value="{!! $item->id !!}" {{ ($item->id == $transaction->product_id) ? 'selected="selected"' : '' }}>{!! $item->block !!}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">Floor</label>
                <div class="col-sm-10">
                    <select class="form-control" name="floor" id="floor">
                        @foreach(range(1, $floor) as $value)
                        <option value="{{ $value }}" {{ ($transaction->floor==$value)? 'selected="selected"': ''}}>{{ $value }}</option>
                        @endforeach
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

        function getFloor(projectId) {

        }

        $('#block').change(function () {
            productId = $(this).val();
            $.ajax({
                url: "{{ route('admins.customer.getFloorByProduct') }}",
                method: "GET",
                data: {
                    'productId' : productId,
                },
                dataType : 'json',
                success : function(result){
                    html = '';
                    $.each (result, function (key, item){
                        html += '<option value="' + key + '">' + item + '</option>'
                    });
                    $('#floor').html(html);
                }
            });
        });
    });
</script>
@endsection