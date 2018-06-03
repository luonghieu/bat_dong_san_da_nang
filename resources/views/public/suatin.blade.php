@extends('public.inc.index')
@section('content')
@if (session('objCustomer'))
@php      
$objCustomer = Session::get("objCustomer");
@endphp
@endif 
<div class="content_wrapper">
    <div class="container">
        <div class="main bg_white clearfix">
            <div class="box register margin-center mt30 mb30">
                <div class="title-tabs bor-bot-blue2 font-roboto position">
                    <span class="font-robotonormal uppercase font17 blue2 normal">Đăng tin rao bán/cho thuê</span>
                </div>
                <form class="form-horizontal" role="form" method="post" action="{!! route('public.capnhattin') !!}" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{csrf_token()}}" />
                    <input type="hidden" name="id" value="{!! $obj->id !!}" />
                    @if (session('error'))
                    <div class="alert alert-danger">
                        <p>{{ session('error') }}</p>
                    </div>
                    @endif
                    @if (session('success'))
                    <div class="alert alert-danger">
                        <p>Cập nhật thành công</p>
                    </div>
                    @endif
                    <div class="value-newsup clearfix">
                        <div class="clearfix pd30 bor-left bor-right bor-bot">
                            <div class="boxpost">
                                <div class="w-640 fl">
                                    <div class="mb30 clearfix">
                                        <div class="uppercase pb5 mb10">
                                            <h3 class="font-robotonormal x-posi-title blue font16 normal"><s class="ic-arrow2 mr5"></s>Thông tin cơ bản</h3>
                                        </div>
                                        <div class="box-cont">
                                            <ul class="clearfix">
                                                <li class="mb20 clearfix">
                                                    <label class="w-15-100 fl bold">Loại tin</label>
                                                    <label class="w-85-100 fl pr30">
                                                        <input type="radio" value="1" name="rds" class="radio" {{($obj->cat->type_transaction ==1) ? 'checked="checked"' : ''}}/><label for="rdoCanban" class="radio_type radio_selected">
                                                            BĐS bán
                                                        </label>
                                                        <input type="radio" value="2" name="rds" class="radio" {{($obj->cat->type_transaction ==2) ? 'checked="checked"' : ''}}/><label for="rdoCanchothue" class="radio_type">
                                                            BĐS cho thuê
                                                        </label>
                                                    </label>
                                                </li>

                                                <li class="mb20 clearfix">
                                                    <label class="w-15-100 fl lh35">Loại nhà đất <span class="red">*</span></label>
                                                    <div class="w-85-100 fl clearfix">
                                                        <div class="mix-select fl position w-30-100">
                                                            <select id="loainhadat" name="cat_id" class="select">
                                                                <option value="-1">-- Chọn loại nhà đất --</option>
                                                                @foreach($bdsBan as $item)
                                                                <option value="{!! $item->id !!}" {{($obj->cat->id == $item->id) ? 'selected="selected"' : ''}}>{!! $item->name !!}</option>
                                                                @endforeach
                                                            </select>
                                                            @if ($errors->has('cat_id'))
                                                            <span style="color: red; display: block; font-weight: normal;" id="spanGia">{!! $errors->first('cat_id') !!}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </li>

                                                <li class="mb10 clearfix">
                                                    <label class="w-15-100 fl lh35">Vị trí <span class="red">*</span></label>
                                                    <div class="w-85-100 fl clearfix">
                                                        <div class="mix-select fl position w-30-100 mr10 mb10">
                                                            <select class="select">
                                                                <option value="-1">Đà Nẵng</option>
                                                            </select>
                                                        </div>
                                                        <div class="mix-select fl position w-30-100 mr10 mb10">
                                                            <select id="district" name="district_id" onchange="changeDistrict()" class="select">
                                                                <option value="-1">-- Chọn Quận/Huyện --</option>
                                                                @foreach($district as $id => $name)
                                                                <option value="{!! $id !!}" {{($obj->district_id == $id) ? 'selected="selected"' : ''}}>{!! $name !!}</option>
                                                                @endforeach
                                                            </select>
                                                            @if ($errors->has('district_id'))
                                                            <span style="color: red; display: block; font-weight: normal;" id="spanGia">{!! $errors->first('district_id') !!}</span>
                                                            @endif
                                                        </div>
                                                        <div class="clear"></div>
                                                        <div class="mix-select fl position w-30-100 mr10 mb10">
                                                            <select id="village" name="village_id" onchange="changeVillage()" class="select">
                                                                <option value="-1">-- Chọn Phường/Xã --</option>
                                                                @foreach($village as $id => $name)
                                                                <option value="{!! $id !!}" {{($obj->village_id == $id) ? 'selected="selected"' : ''}}>{!! $name !!}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="mix-select fl position w-30-100 mr10 mb10">
                                                            <select id="street" name="street_id" onchange="changeStreet()" class="select">
                                                                <option value="-1">-- Chọn Đường/Phố --</option>
                                                                @foreach($street as $id => $name)
                                                                <option value="{!! $id !!}" {{($obj->street_id == $id) ? 'selected="selected"' : ''}}>{!! $name !!}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="mb20 clearfix">
                                                    <label class="w-15-100 fl lh35">
                                                        Dự án <span class="red">*</span>
                                                    </label>
                                                    <label class="w-85-100 fl pr13">
                                                        <input name="project" type="text" class="width-full lh20 gray2" value="{{$obj->project}}" />
                                                    </label>
                                                </li>
                                                <li class="mb20 clearfix">
                                                    <label class="w-15-100 fl lh35">Giá</label>
                                                    <div class="w-85-100 fl clearfix">
                                                        <label class="fl position w-30-100 mr3-100">
                                                            <input name="price" type="number" min="0" max="999" class="width-full txtgia" value="{{$obj->price}}" />
                                                            @if ($errors->has('price'))
                                                            <span style="color: red; display: block; font-weight: normal;" id="spanGia">{!! $errors->first('price') !!}</span>
                                                            @endif
                                                        </label>
                                                        <div class="mix-select fl position w-30-100 mr10">
                                                            <select name="unit_price_id" onchange="" class="select">
                                                                <option value="-1">-- Chọn đơn vị --</option>
                                                                @foreach($unitPrice as $id => $name)
                                                                <option value="{!! $id !!}" {{($obj->unit_price_id == $id) ? 'selected="selected"' : ''}}>{!! $name !!}</option>
                                                                @endforeach
                                                            </select>
                                                            @if ($errors->has('unit_price_id'))
                                                            <span style="color: red; display: block; font-weight: normal;" id="spanGia">{!! $errors->first('unit_price_id') !!}</span>
                                                            @endif
                                                        </div>
                                                        <label class="fl position w-30-100 mr10 clearfix">
                                                            <input name="area" type="number" min="0" max="10000" class="txtdientich" value="{{ $obj->area }}" />
                                                            <span>m2
                                                            </span>
                                                            @if ($errors->has('area'))
                                                            <span style="color: red; display: block; font-weight: normal;" id="spanGia">{!! $errors->first('area') !!}</span>
                                                            @endif
                                                        </label>
                                                    </div>
                                                </li>

                                                <li class="mb20 clearfix">
                                                    <label class="w-15-100 fl lh35">
                                                        Địa điểm <span class="red">*</span>
                                                    </label>
                                                    <label class="w-85-100 fl pr13">
                                                        <input name="diadiem" type="text" id="diadiem" class="width-full lh20 gray2" />
                                                    </label>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="mb30 clearfix">
                                        <div class="uppercase pb5 mb10">
                                            <h3 class="font-robotonormal x-posi-title blue font16 normal"><s class="ic-arrow2 mr5"></s>Mô tả chi tiết</h3>
                                        </div>
                                        <div class="box-cont">
                                            <ul class="clearfix">
                                                <li class="mb10 clearfix">
                                                    <label class="w-15-100 fl lh35">Tiêu đề <span class="red">*</span></label>
                                                    <label class="w-85-100 fl pr13">
                                                        <input name="name" type="text" id="tieude" class="width-full lh20 gray2" placeholder="Vui lòng gõ tiếng Việt có dấu để tin đăng được kiểm duyệt nhanh hơn" value="{{ $obj->name }}"/></label>
                                                        @if ($errors->has('name'))
                                                        <span style="color: red; display: block; font-weight: normal;" id="spanGia">{!! $errors->first('name') !!}</span>
                                                        @endif
                                                    </li>
                                                    <li id="boxSuggest" class="clearfix" style="display: block;">
                                                        <span class="Suggest">Gợi ý tiêu đề:
                                                        </span>
                                                        <span>
                                                            <span id="spanGoiytieude" class="orange ml10"></span>
                                                            <span id="spanLinkGoiy" style="margin-top: 5px; display:block; min-width: 300px;">
                                                                <a style="color: red; font-weight: bold;" href="javascript:void(0)" onclick="getTitle()" rel="no-follow">Click để sử dụng tiêu đề gợi ý</a>
                                                            </span>
                                                        </span>
                                                    </li>
                                                    <li class="mb20 mt10 clearfix">
                                                        <label class="w-15-100 fl lh35">Mô tả <span class="red">*</span></label>
                                                        <label class="w-85-100 fl pr13">
                                                            <textarea name="description" class="width-full radius" cols="60" rows="5">{{ $obj->description}}</textarea>
                                                            @if ($errors->has('description'))
                                                            <span style="color: red; display: block; font-weight: normal;" id="spanGia">{!! $errors->first('description') !!}</span>
                                                            @endif
                                                        </label>
                                                    </li>
                                                    <li class="mb20 clearfix">
                                                        <label class="w-15-100 fl lh35">Thời gian <span class="red">*</span></label>
                                                        <div class="w-85-100 fl pr13 clearfix">
                                                            <div class="date-select  fl position">
                                                                <span class="pd5">Từ:</span><input name="start_time" type="date" value="{!! date('Y-m-d', strtotime($obj->start_time)) !!}" class="gray2 show-value lh20 hasDatepicker" onkeypress="return false;">
                                                                @if ($errors->has('start_time'))
                                                                <span style="color: red; display: block; font-weight: normal;" id="spanGia">{!! $errors->first('start_time') !!}</span>
                                                                @endif
                                                            </div>
                                                            <div class="date-select  fr position">
                                                                <span class="pd5">Đến:</span><input name="end_time" type="date" value="{!! date('Y-m-d', strtotime($obj->end_time)) !!}" class="gray2 show-value lh20 hasDatepicker" onkeypress="return false;">
                                                                @if ($errors->has('end_time'))
                                                                <span style="color: red; display: block; font-weight: normal;" id="spanGia">{!! $errors->first('end_time') !!}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="mb20 clearfix position">
                                                        <label class="w-15-100 fl mb10">Hình ảnh : </label><br>
                                                        <div class="row">
                                                            @foreach(explode("|", $obj->images) as $key => $item)
                                                            @if (!empty($item))
                                                            <div class="col-md-3">
                                                                <img src="{!! asset($item) !!}" class="img-responsive" height="auto" width="auto" />
                                                            </div>
                                                            @endif
                                                            @endforeach
                                                        </div>
                                                        <div class="clear"></div>
                                                        <div class="gray2 mt5 italic">
                                                            <input type="file" name="image" />
                                                        </div>
                                                        <div class="clear"></div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="clearfix">
                                            <div class="uppercase pb5 mb10">
                                                <h3 class="font-robotonormal x-posi-title blue font16 normal"><s class="ic-arrow2 mr5"></s>Bản đồ</h3>
                                            </div>
                                            <div class="pr13">
                                                <div>
                                                  <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBHnNC04F9_o08K9ImoQivLJua1rv94IWY&callback=initMap" type="text/javascript"></script>
                                                  <script type="text/javascript">
                                                    var map;
                                                    function initiadivze() {
                                                      var latitude = "{{ explode('|', $obj->map)[0]}}";
                                                      var longitude = "{{ explode('|', $obj->map)[1]}}";
                                                      var myLatlng = new google.maps.LatLng(latitude,longitude);
                                                      var myOptions = {
                                                        zoom: 16,
                                                        center:new google.maps.LatLng(latitude,longitude),
                                                        mapTypeId: google.maps.MapTypeId.ROADMAP,            


                                                    }
                                                    map = new google.maps.Map(document.getElementById("div_id"), myOptions); 
    // Biến text chứa nội dung sẽ được hiển thị
    var text;
    text= "{{$obj->name}}";
    var infowindow = new google.maps.InfoWindow(
      { content: text,
        size: new google.maps.Size(100,50),
        position: myLatlng
    });
    infowindow.open(map); 
    var marker = new google.maps.Marker({
      position: myLatlng, 
      map: map,
      title:""
  });
}
</script>

<body onLoad="initiadivze()">
  <div  id="div_id" style="height: 505px; width: 100%; color: #333;"></div>
</body> 
</div>
</div>
</div>

<div class="bt-suces tc  mt40 normal">
    <input id="btnSave" class="btnUpNew" type="submit" value="Cập nhật">
</div>
</div>

<div class="w-280 fr">
    <div class="mb30 clearfix">
        <div class="uppercase pb5 mb10">
            <h3 class="font-robotonormal x-posi-title blue font16 normal"><s class="ic-arrow2 mr5"></s>Thông tin liên hệ</h3>
        </div>
        <div class="box-cont">
            <ul class="clearfix">
                <li class="mb20 clearfix">
                    <label class="w-40-100 fl lh35">Tên liên hệ <span class="red">*</span></label>
                    <label class="w-60-100 fl">
                        <input name="fullname" type="text" value="{{ $infcontact[0]}}" class="width-full lh20 gray2" />
                        @if ($errors->has('fullname'))
                        <span style="color: red; display: block; font-weight: normal;" id="spanGia">{!! $errors->first('fullname') !!}</span>
                        @endif
                    </label>
                </li>
                <li class="mb20 clearfix">
                    <label class="w-40-100 fl lh35">Địa chỉ</label>
                    <label class="w-60-100 fl">
                        <input name="address" type="text" value="{{ $infcontact[1]}}" class="width-full lh20 gray2" />
                    </label>
                </li>
                <li class="mb20 clearfix">
                    <label class="w-40-100 fl lh35">Điện thoại</label>
                    <label class="w-60-100 fl">
                        <input name="phone" type="text" value="{{ $infcontact[2]}}" class="width-full lh20 gray2" />
                        @if ($errors->has('phone'))
                        <span style="color: red; display: block; font-weight: normal;" id="spanGia">{!! $errors->first('phone') !!}</span>
                        @endif
                    </label>
                </li>
                <li class="mb20 clearfix">
                    <label class="w-40-100 fl lh35">Email</label>
                    <label class="w-60-100 fl">
                        <input name="email" type="text" value="{{ $infcontact[3]}}" class="width-full lh20 gray2" />
                        @if ($errors->has('email'))
                        <span style="color: red; display: block; font-weight: normal;" id="spanGia">{!! $errors->first('email') !!}</span>
                        @endif
                    </label>
                </li>
            </ul>
        </div>
    </div>

    <div class="mb30 clearfix">
        <div class="uppercase pb5 mb10">
            <h3 class="font-robotonormal x-posi-title blue font16 normal"><s class="ic-arrow2 mr5"></s>Thông tin khác</h3>
        </div>
        <div class="box-cont">
            <ul class="clearfix">
                <li class="mb20 clearfix">
                    <label class="w-40-100 fl lh35">Mặt tiền (m)</label>
                    <label class="w-60-100 fl">
                        <input name="fontispiece" value="{{ $obj->frontispiece}}" type="number" min="0" max="100000" class="width-full lh20 gray2" />
                    </label>
                </li>
                <li class="mb20 clearfix">
                    <label class="w-40-100 fl lh35">Đường trước (m)</label>
                    <label class="w-60-100 fl">
                        <input name="road_ahead" value="{{ $obj->road_ahead}}" type="number" min="0" max="100000" class="width-full lh20 gray2" />
                    </label>
                </li>
                <li class="mb20 clearfix">
                    <label class="w-40-100 fl lh35">Hướng nhà</label>
                    <label class="w-60-100 fl">
                        <div class="mix-select fl position width-full mb10">
                            <select class="w165px" tabindex="15" name="direction">
                                @foreach($direction as $key => $value)
                                <option value="{!! $key !!}" {{($obj->direction == $key) ? 'selected="selected"' : ''}}>{!! $value !!}</option>
                                @endforeach
                            </select>
                        </div>
                    </label>
                </li>

                <li class="mb20 clearfix">
                    <label class="w-40-100 fl lh35">Số tầng</label>
                    <label class="w-60-100 fl">
                        <input name="number_of_floor" type="number" min="0" max="100" value="{{ $obj->number_of_floor}}" class="width-full lh20 gray2" />
                    </label>
                </li>
                <li class="mb20 clearfix">
                    <label class="w-40-100 fl lh35">Số phòng</label>
                    <label class="w-60-100 fl">
                        <input name="number_of_room" type="number" min="0" max="100" value="{{ $obj->number_of_room}}" class="width-full lh20 gray2" /></label>
                    </li>
                    <li class="mb20 clearfix">
                        <label class="w-40-100 fl lh35">Số toilet</label>
                        <label class="w-60-100 fl">
                            <input name="number_of_toilet" type="number" min="0" max="100" value="{{ $obj->number_of_toilet}}" class="width-full lh20 gray2" />
                        </label>
                    </li>
                    <li class="mb20 clearfix">
                        <label class="w-40-100 fl lh35">Nội thất</label>
                        <label class="w-60-100 fl">
                            <textarea name="furniture" rows="3" cols="20" class="width-full radius lh20 gray2">{{ $obj->furniture}}</textarea>
                        </label>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
<div class="clear">
</div>
</form>
</div>
</div>
</div>
</div>
@endsection
@section('script')
<script type="text/javascript">
    $('input[name="rds"]').change(function() {
        type = $(this).val();
        $.ajax({
            url: "{!! route('common.getLoaiNhaDat') !!}",
            method: "GET",
            data: {
                'type' : type
            },
            dataType : 'json',
            success : function(result){
                cat = result['cat'];
                unitPrice = result['unitPrice'];

                htmlCat = '<option value="-1">-- Chọn loại nhà đất --</option>';
                $.each(cat, function(key, obj){
                    htmlCat += '<option value="' + obj.id + '">' + obj.name + '</option>';
                });
                $('#loainhadat').html(htmlCat);

                htmlUnitPrice = '<option value="-1">-- Chọn đơn vị --</option>';
                $.each(unitPrice, function(key, obj){
                    htmlUnitPrice += '<option value="' + obj.id + '">' + obj.name + '</option>';
                });
                $('#unitPrice').html(htmlUnitPrice);
            }
        });
    });

    function changeDistrict() {
        $('#village').html('<option value="-1">-- Chọn Phường/Xã --</option>');
        $('#street').html('<option value="-1">-- Chọn Đường/Phố --</option>');
        $('#project').html('<option value="-1">-- Chọn Dự án --</option>');
        district = $('#district').val();
        if (district == -1) {
            $('#village').html('<option value="-1">-- Chọn Phường/Xã --</option>');
            $('#street').html('<option value="-1">-- Chọn Đường/Phố --</option>');
            $('#project').html('<option value="-1">-- Chọn Dự án --</option>');
            return;
        }

        $.ajax({
            url: "{!! route('common.getVillageByDistrict') !!}",
            method: "GET",
            data: {
                'districtId' : district
            },
            dataType : 'json',
            success : function(result){
                html = '<option value="-1">-- Chọn Phường/Xã --</option>';
                $.each (result, function (key, item){
                    html += '<option value="' + key + '">' + item + '</option>';
                });
                $("#village").html(html);
                $('#diadiem').val($('#district option:selected').text() + ', Da Nang');
            }
        });
    }

    function changeVillage() {
        $('#street').html('<option value="-1">-- Chọn Đường/Phố --</option>');
        $('#project').html('<option value="-1">-- Chọn Dự án --</option>');
        village = $('#village').val();

        if (village == -1) {
            $('#street').html('<option value="-1">-- Chọn Đường/Phố --</option>');
            $('#project').html('<option value="-1">-- Chọn Dự án --</option>');
            return;
        }

        $.ajax({
            url: "{!! route('common.getStreetByVillage') !!}",
            method: "GET",
            data: {
                'villageId' : village
            },
            dataType : 'json',
            success : function(result){
                html = '<option value="-1">-- Chọn Đường/Phố --</option>';
                $.each (result, function (key, item){
                    html += '<option value="' + key + '">' + item + '</option>';
                });

                $("#street").html(html);
                $('#diadiem').val($('#village option:selected').text()  + ', ' + $('#district option:selected').text() + ', Da Nang');
            }
        });
    }

    function changeStreet() {
        street = $('#street').val();
        if (street != -1) {
            $('#diadiem').val($('#street option:selected').text() + ', ' + $('#village option:selected').text()  + ', ' + $('#district option:selected').text() + ', Da Nang');
            return;
        }
    }

    function getTitle() {
        if ($('#loainhadat').val() != -1) {
            if ($('#diadiem').val() == '') {
                diadiem = '';
            } else {
                diadiem = ' tại ' + $('#diadiem').val();
            }
            $('#tieude').val($('#loainhadat option:selected').text() + diadiem);
        }
        return false;
    }

</script>
@endsection
