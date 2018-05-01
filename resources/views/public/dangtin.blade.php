@extends('public.inc.index')
@section('content')
@if (session('objUser'))
@php      
$objUser = Session::get("objUser");
@endphp
@endif
<div class="content_wrapper">
<div class="container">
    <div class="main bg_white clearfix">
        <div class="box register margin-center mt30 mb30">
            <div class="title-tabs bor-bot-blue2 font-roboto position">
                <span class="font-robotonormal uppercase font17 blue2 normal">Đăng tin rao bán/cho thuê</span>
            </div>
            <form class="form-horizontal" role="form" method="post" action="{!! route('public.taotin') !!}" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{csrf_token()}}" />
                <input type="hidden" name="poster_id" value="{!! $objUser->poster->id !!}" />
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
                                                    <input type="radio" value="1" name="rds" class="radio" checked="checked"
                                                    tabindex="1" /><label for="rdoCanban" class="radio_type radio_selected">
                                                        BĐS bán
                                                    </label>
                                                    <input type="radio" value="2" name="rds" class="radio"
                                                    tabindex="2" /><label for="rdoCanchothue" class="radio_type">
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
                                                            @foreach($bdsBan as $obj)
                                                            <option value{!! $obj->id !!}">{!! $obj->name !!}</option>
                                                            @endforeach
                                                        </select>
                                                        @if ($errors->has('cat_id'))
                                                        <span style="color: Red; display: none; font-weight: normal;" id="spanGia">{!! $errors->first('cat_id') !!}</span>
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
                                                            @foreach($district as $obj)
                                                            <option value="{!! $obj->id !!}">{!! $obj->name !!}</option>
                                                            @endforeach
                                                        </select>
                                                        @if ($errors->has('district_id'))
                                                        <span style="color: Red; display: none; font-weight: normal;" id="spanGia">{!! $errors->first('district_id') !!}</span>
                                                        @endif
                                                    </div>
                                                    <div class="mix-select fl position w-30-100 mr10 mb10">
                                                        <select id="village" name="village_id" onchange="changeVillage()" class="select">
                                                            <option value="-1">-- Chọn Phường/Xã --</option>
                                                        </select>
                                                    </div>
                                                    <div class="clear"></div>
                                                    <div class="mix-select fl position w-30-100 mr10 mb10">
                                                        <select id="street" name="street_id" onchange="changeStreet()" class="select">
                                                            <option value="-1">-- Chọn Đường/Phố --</option>
                                                        </select>
                                                    </div>
                                                    <div class="mix-select fl position w-30-100 mr10 mb10">
                                                        <select id="project" name="porject_id" class="select">
                                                            <option value="-1">-- Chọn Dự án --</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </li>

                                            <li class="mb20 clearfix">
                                                <label class="w-15-100 fl lh35">Giá</label>
                                                <div class="w-85-100 fl clearfix">
                                                    <label class="fl position w-30-100 mr3-100">
                                                        <input name="price" type="text" id="txtGia" class="width-full txtgia" onchange="" />
                                                        @if ($errors->has('price'))
                                                        <span style="color: Red; display: none; font-weight: normal;" id="spanGia">{!! $errors->first('price') !!}</span>
                                                        @endif
                                                    </label>
                                                    <div class="mix-select fl position w-30-100 mr10">
                                                        <input type="hidden" name="" id="hddUnitPost" />
                                                        <select id="unitPrice" onchange="" class="select">
                                                            <option value="-1">-- Chọn đơn vị --</option>
                                                            @foreach($unitPrice as $obj)
                                                            <option value="{!! $obj->id !!}">{!! $obj->name !!}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <label class="fl position w-30-100 mr10 clearfix">
                                                        <input name="area" type="text" id="dientich" placeholder="Diện tích" class="txtdientich" />
                                                        <span>m2
                                                        </span>
                                                        @if ($errors->has('area'))
                                                        <span style="color: Red; display: none; font-weight: normal;" id="spanGia">{!! $errors->first('area') !!}</span>
                                                        @endif
                                                    </label>
                                                </div>
                                            </li>

                                            <li class="mb20 clearfix">
                                                <label class="w-15-100 fl lh35">
                                                    Địa điểm <span class="red">*</span>
                                                </label>
                                                <label class="w-85-100 fl pr13">
                                                    <input name="diadiem" type="text" id="diadiem" class="width-full lh20 gray2" onchange="" />
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
                                                    <input name="name" type="text" id="tieude" class="width-full lh20 gray2" placeholder="Vui lòng gõ tiếng Việt có dấu để tin đăng được kiểm duyệt nhanh hơn" val=""/></label>
                                                    @if ($errors->has('name'))
                                                    <span style="color: Red; display: none; font-weight: normal;" id="spanGia">{!! $errors->first('name') !!}</span>
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

                                                        <textarea name="description" id="tarNoidung" class="width-full radius" cols="60" rows="5"></textarea>
                                                        @if ($errors->has('description'))
                                                        <span style="color: Red; display: none; font-weight: normal;" id="spanGia">{!! $errors->first('discription') !!}</span>
                                                        @endif
                                                    </label>
                                                </li>

                                                <li class="mb20 clearfix">
                                                    <label class="w-15-100 fl lh35">LỊCH ĐĂNG TIN <span class="red">*</span></label>
                                                    <div class="w-85-100 fl pr13 clearfix">
                                                        <div class="fl position">
                                                            <span>Loại tin rao: </span></br>
                                                            <select id="typePost" onchange="" class="select">
                                                                @foreach($typePost as $obj)
                                                                <option value="{!! $obj->id !!}">{!! $obj->name !!}</option>
                                                                @endforeach
                                                            </select>

                                                        </div>
                                                        <div class="fl position">
                                                            <span>Từ:</span></br>
                                                            <input name="start_time" type="date" value="{!! date('Y-m-d') !!}"/>

                                                        </div>
                                                        <div class="fr position">
                                                            <span>Đến:</span></br>
                                                            <input name="end_time" type="date" value="{!! date('Y-m-d') !!}"/>
                                                        </span>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="mb20 clearfix">
                                                <label class="w-15-100 fl lh35"><span class="red"></span></label>
                                                <div class="w-85-100 fl pr13 clearfix">
                                                    <div class="fl position">
                                                        <span>Đơn giá:</span></br>
                                                        <p style="color: Red;" id="price">
                                                            {!! $typePost[0]->price !!}
                                                        </p>đồng/Ngày

                                                    </div>
                                                    <div class="fr position">
                                                        <span>Số ngày:</span></br>
                                                        <p style="color: Red;" id="days"></p>
                                                    </div>
                                                    <div class="fr position">
                                                        <span>Thành tiền:</span></br>
                                                        <p style="color: Red;" id="total"></p>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="mb20 clearfix position">
                                                <label class="w-15-100 fl mb10">Hình ảnh : </label>

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
                                        <input type="hidden" name="ctl00$PH_Container$PostNews1$hddLatitude" id="hddLatitude" value="21.02894860978742" />
                                        <input type="hidden" name="ctl00$PH_Container$PostNews1$hddLongtitude" id="hddLongtitude" value="105.85244722590335" />
                                        <input type="hidden" name="ctl00$PH_Container$PostNews1$txtPositionX" id="txtPositionX" value="14.058324" />
                                        <input type="hidden" name="ctl00$PH_Container$PostNews1$txtPositionY" id="txtPositionY" value="108.277199" />

                                        <script type="text/javascript" src="{!! asset('public_asset/js/map.js') !!}"></script>
                                        <script src="{!! asset('public_asset/js/GoogleMapControl.min.js') !!}" type="text/javascript"></script>
                                        <script src="https://maps.googleapis.com/maps/api/js?callback=initMap" async defer></script>
                                        <div id="mapinfo">
                                            <div id="map_canvas"></div>
                                        </div>
                                        <!-- <script src="https://maps.googleapis.com/maps/api/js?sensor=false"></script> -->
                                        <script>
                                            function initialize() {
                                                var myLatlng = new google.maps.LatLng(15.574281, 108.4677385);
                                                var mapOptions = {
                                                    zoom: 9,
                                                    center: myLatlng
                                                };

                                                var map = new google.maps.Map(document.getElementById('map_canvas'), mapOptions);

                                                var contentString = "<table><tr><th>Công ty đầu tư xây dựng Trung Trung Bộ</th></tr><tr><td>Địa chỉ: 175 Trần Quý Cáp - Tp.Tam Kỳ - Quảng Nam</td></tr></table>";

                                                var infowindow = new google.maps.InfoWindow({
                                                    content: contentString
                                                });

                                                var marker = new google.maps.Marker({
                                                    position: myLatlng,
                                                    map: map,
                                                    title: 'Công ty đầu tư xây dựng Trung Trung Bộ'
                                                });
                                                infowindow.open(map, marker);
                                            }

                                            google.maps.event.addDomListener(window, 'load', initialize);


                                        </script>
                                    </div>
                                </div>

                                <div class="bt-suces tc  mt40 normal">
                                    <input id="btnSave" class="btnUpNew" type="submit" value="Dang tin">
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
                                                    <input name="fullname" type="text" id="txtHovaten" class="width-full lh20 gray2" />
                                                </label>
                                            </li>
                                            <li class="mb20 clearfix">
                                                <label class="w-40-100 fl lh35">Địa chỉ</label>
                                                <label class="w-60-100 fl">
                                                    <input name="address" type="text" id="" class="width-full lh20 gray2" />
                                                </label>
                                            </li>
                                            <li class="mb20 clearfix">
                                                <label class="w-40-100 fl lh35">Điện thoại</label>
                                                <label class="w-60-100 fl">
                                                    <input name="phone" type="text" id="txtDienthoai" class="width-full lh20 gray2" />
                                                </label>
                                            </li>
                                            <li class="mb20 clearfix">
                                                <label class="w-40-100 fl lh35">Email</label>
                                                <label class="w-60-100 fl">
                                                    <input name="email" type="text" id="txtEmail" tabindex="28" class="width-full lh20 gray2" />
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
                                                    <input name="fontispiece" type="text" id="txtMattien" class="width-full lh20 gray2" />
                                                </label>
                                            </li>
                                            <li class="mb20 clearfix">
                                                <label class="w-40-100 fl lh35">Đường trước (m)</label>
                                                <label class="w-60-100 fl">
                                                    <input name="road_ahead" type="text" id="txtDuongtruocnha" class="width-full lh20 gray2" />
                                                </label>
                                            </li>
                                            <li class="mb20 clearfix">
                                                <label class="w-40-100 fl lh35">Hướng nhà</label>
                                                <label class="w-60-100 fl">
                                                    <div class="mix-select fl position width-full mb10">
                                                        <select id="cboDirectionPost" class="w165px" tabindex="15" name="direction">
                                                            @foreach($direction as $key => $value)
                                                            <option value="{!! $key !!}">{!! $value !!}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </label>
                                            </li>

                                            <li class="mb20 clearfix">
                                                <label class="w-40-100 fl lh35">Số tầng</label>
                                                <label class="w-60-100 fl">
                                                    <input name="number_of_floor" type="text" id="txtSotang" class="width-full lh20 gray2" />
                                                </label>
                                            </li>
                                            <li class="mb20 clearfix">
                                                <label class="w-40-100 fl lh35">Số phòng</label>
                                                <label class="w-60-100 fl">
                                                    <input name="number_of_room" type="text" id="txtSophong" class="width-full lh20 gray2" /></label>
                                                </li>
                                                <li class="mb20 clearfix">
                                                    <label class="w-40-100 fl lh35">Số toilet</label>
                                                    <label class="w-60-100 fl">
                                                        <input name="number_of_toilet" type="text" id="txtSotoilet" class="width-full lh20 gray2" />
                                                    </label>
                                                </li>
                                                <li class="mb20 clearfix">
                                                    <label class="w-40-100 fl lh35">Nội thất</label>
                                                    <label class="w-60-100 fl">
                                                        <textarea name="furniture" id="" rows="3" cols="20" class="width-full radius lh20 gray2"></textarea>
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
    district = $('#district').val();
    if (district == -1) {
        $('#village').html('<option value="-1">-- Chọn Phường/Xã --</option>');
        $('#street').html('<option value="-1">-- Chọn Đường/Phố --</option>');
        $('#project').html('<option value="-1">-- Chọn Dự án --</option>');
        return;
    }

    $.ajax({
        url: "{!! route('common.getItemByDistrict') !!}",
        method: "GET",
        data: {
            'districtId' : district
        },
        dataType : 'json',
        success : function(result){
            villages = result['villages'];
            streets = result['streets'];

            htmlVillage = '<option value="-1">-- Chọn Phường/Xã --</option>';
            $.each (villages, function (key, item){
                htmlVillage += '<option value="' + item.id + '">' + item.name + '</option>';
            });

            htmlStreet = '<option value="-1">-- Chọn Đường/Phố --</option>';
            $.each (streets, function (key, item){
                htmlStreet += '<option value="' + item.id + '">' + item.name + '</option>';
            });
            $("#village").html(htmlVillage);
            $("#street").html(htmlStreet);
            $('#diadiem').val($('#district option:selected').text() + ', Da Nang');
        }
    });
}

function changeVillage() {
    village = $('#village').val();
    if (village != -1) {
        $('#diadiem').val($('#village option:selected').text()  + ', ' + $('#district option:selected').text() + ', Da Nang');
        return;
    }
}

function changeStreet() {
    street = $('#street').val();
    if (street != -1) {
        $('#diadiem').val($('#street option:selected').text() + ', ' + $('#district option:selected').text() + ', Da Nang');
        return;
    }
}

function getTitle() {
    $('#tieude').val($('#loainhadat option:selected').text() + ' tại ' + $('#diadiem').val());
    return false;
}

</script>
@endsection
