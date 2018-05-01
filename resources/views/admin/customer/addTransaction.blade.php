@extends('admin.inc.index')
@section('css')
@include('admin.customer.css')
@endsection
@section('title')
Add Transaction
@endsection
@section('content')
<!-- tile -->
<section class="tile">

    <!-- tile header -->
    <div class="tile-header dvd dvd-btm">
        <h1 class="custom-font"><strong>Add Transaction</strong></h1>
        <ul class="controls">
            <li>
                <a role="button" tabindex="0" id="add-entry"><i class="fa fa-plus mr-5"></i> Add</a>
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
            <a href="{!! route('admins.project.status',['project_id' => $register->project->id]) !!}" role="button" tabindex="0" class="text-uppercase text-strong text-sm mr-10">{!! $register->project->name !!}</a>
        </h3>
        @if (session('error'))
        <div class="alert alert-danger">
            <p>{{ session('error') }}</p>
        </div>
        @endif
        <form class="form-horizontal" role="form" id="form-add" method="post" action="{!! route('admins.customer.storeTransaction') !!}">
            <input type="hidden" name="_token" value="{{csrf_token()}}" />
            <input type="hidden" name="registerId" value="{{$register->id}}" />
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Block</label>
                <div class="col-sm-10">
                    <select class="form-control" name="block" id="block">
                        @foreach($products as $item)
                        <option value="{!! $item->id !!}">{!! $item->block !!}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">Floor</label>
                <div class="col-sm-10">
                    <select class="form-control" name="floor" id="floor">
                        @foreach(range(1, $floor) as $value)
                        <option value="{!! $value!!}">{!! $value !!}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Description</label>
                <div class="col-sm-10">
                   <textarea id="editor1" name="description">
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
        <!-- <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">Rating</label>
            <div class="col-sm-10">
                <div class="rateit">
                    <button id="rateit-reset-2" type="button" data-role="none" class="rateit-reset" aria-label="reset rating" aria-controls="rateit-range-2"></button>
                    <div id="rateit-range-2" class="rateit-range" tabindex="0" role="slider" aria-label="rating" aria-owns="rateit-reset-2" aria-valuemin="0" aria-valuemax="5" aria-valuenow="4" aria-readonly="false" style="width: 80px; height: 16px;">
                        <div class="rateit-selected" style="height: 16px; width: 64px; display: block;"></div>
                        <div class="rateit-hover" style="height: 16px; width: 0px; display: none;"></div>
                    </div>
                </div>
                <div id="rateit"  data-transactionid="add"></div>
                <script type="text/javascript">
                    $(function () {
                        $('#rateit_star1').rateit({min: 1, max: 10, step: 1});
                        $('#rateit_star1').bind('rated', function (e) {
                            var ri = $(this);
                            var value = ri.rateit('value');
                            var transactionid = ri.data('transactionid');
                            $.ajax({
                                url: "{{ route('admins.customer.ratingTransaction') }}",
                                method: "GET",
                                data: {
                                    'value' : value,
                                    'transactionid' : transactionid,
                                },
                                dataType : 'json',
                                success : function(result){
                                    alert('Bạn đã đánh giá '+value +' sao cho sản phẩm có id là:'+productID );
                                        //không cho phép đánh giá,sau khi đã đánh giá xong
                                        ri.rateit('readonly', true);
                                    }
                                });
                        });
                    });
                </script>
            </div>
        </div> -->
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
                        html += '<option value="' + item + '">' + item + '</option>'
                    });
                    $('#floor').html(html);
                }
            });
        });
    });
</script>
@endsection