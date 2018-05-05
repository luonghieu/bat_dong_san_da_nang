@extends('public.inc.index')
@section('content')
<div class="content_wrapper">
  <div class="container">
    <div class="breakdum">
      <a href="{!! route('public.trangchu') !!}">Trang chủ</a><span> <i class="fa fa-caret-right" aria-hidden="true"></i> <h1>Tìm kiếm</h1></span>
    </div>
    <div class="block_over">
      <div id="container">
        <div class="main bg_white clearfix">

          <div class="w-680 fl" id="leftPanel">

            <div class="productlist">

              <div class="box news bor-right bor-left bor-bot">
                <div class="font-robotonormal" style="border-top: 2px solid #0098bb">
                  <div class="clearfix bor-bot">
                    <div class="fl title" style="padding-top:0px;">
                      <h1 class="bg_white pd5 font16 normal uppercase">
                      Nhà đất bán tại Đà Nẵng</h1>
                      <s class="ic-news-03"></s>
                    </div>

                  </div>
                </div>

                <h3 class="box-result w-70-100 fl ml10">

                  <span class="spancount">Có <b>
                  527,632</b> bất động sản.</span>
                </h3>
                <div class="fr wr_order mt5 mr10">
                  <div class="lblorder none">Sắp xếp theo:</div>
                  <select name="sort" onchange="sortchange()" id="ddlOrder">
                    <option selected="selected" value="0">Thông thường</option>
                    <option value="2">Giá thấp nhất</option>
                    <option value="3">Giá cao nhất</option>
                    <option value="4">Diện tích nhỏ nhất</option>
                    <option value="5">Diện tích lớn nhất</option>

                  </select>
                </div>
                <div class="clearfix"></div>
                <div class="box-cont pl10 pr10">
                  <ul class="clearfix">

                    <li class="clearfix pt20 pb20 bor-bot">
                      <a class="pic w-190 h-145 fl position" href=""><img  title="" src="/Images/no-photo253.png" alt="" /></a>
                      <div class="infor-descrip w-445 fr">
                        <h4 class="font13 mb5">
                          <a class='block' title="" href="">GIA ĐÌNH MUỐN BÁN CHUNG CƯ N02.</a>
                        </h4>
                        <div class="price-time">
                          <span class="fl w-60-100">
                            <span class="label">Giá: </span>
                            <label class="pricevalue">
                              Thỏa thuận
                            </label>
                          </span>
                          <label class="clearfix mb5 fr">
                            <span class="time mr13 gray font12">08:48 PM</span><span class="date gray font12">05/05/2018</span>
                          </label>
                        </div>
                        <div class="clearfix">

                          <div class="width-full fl">
                            <label class="clearfix">
                              <s class="ic-area fl mt5"></s>
                              <span class="pd3-5 w-80-100 fl">
                              Không xác định</span>
                            </label>
                            <label class="clearfix">
                              <s class="ic-option fl mt5"></s>
                              <span class="pd3-5 w-80-100 fl">
                                <a href="/ban-can-ho-chung-cu-cau-giay.htm"></a></span>
                              </label>
                              <label class="clearfix">
                                <s class="ic-adress fl mt5"></s>
                                <span class="pd3-5 w-80-100 fl">
                                Cầu Giấy - Hà Nội</span>
                              </label>
                            </div>
                          </div>
                        </div>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="box page page_controll nobor position tr">
                  <a href='/nha-dat-ban.htm' title='P1'><div  class='style-pager-row-selected' align='center'>1</div></a><a href='/nha-dat-ban/p2.htm' title='P2'><div  class='style-pager-row' align='center'>2</div></a><a href='/nha-dat-ban/p3.htm' title='P3'><div  class='style-pager-row' align='center'>3</div></a><a href='/nha-dat-ban/p4.htm' title='P4'><div  class='style-pager-row' align='center'>4</div></a><a href='/nha-dat-ban/p5.htm' title='P5'><div  class='style-pager-row' align='center'>5</div></a><a href='/nha-dat-ban/p2.htm'  title='P2'><div  class='style-pager-button-next-first-last' align='center'>></div></a><a href='/nha-dat-ban/p29313.htm' title='P29313'><div  class='style-pager-button-next-first-last' align='center'>Trang cuối</div></a><span id="PH_Container_ProductSearchResult_ProductsPager"></span>
                </div>

              </div>

              <script src="/Scripts/jquery.cookie.js"></script>

            </div>
            <div class="w-300 fr" id="rightPanel">

              <div class="box search_list mb20">
                <div class="title-tabs bor-bot-blue2 font-robotonormal position">
                  <ul class="clearfix type_bds">
                    <li class="font16 normal uppercase fl"><a id="ban" onclick="ChangeType(38);" rel="nofollow">BĐS bán</a></li>
                    <li class="font16 normal uppercase fl"><a id="chothue" onclick="ChangeType(49);" rel="nofollow">BĐS cho thuê</a></li>
                    <input type="hidden" name="..." id="hddpType" value="38" />
                  </ul>
                </div>
                <div class="box-cont bor-left bor-right bor-bot pd5">
                  <ul class="listbox">
                    <li class="item wr_textsearch width-full hidden">
                      <input name="ctl00$PH_Container$BoxSearchList$txtAutoComplete" type="text" id="txtAutoComplete" class="ui-autocomplete-input gray width-full" placeholder="Nhập địa điểm" autocomplete="off" role="textbox" aria-autocomplete="list" aria-haspopup="true" />
                    </li>
                    <li class="item hidden">
                      <input type="hidden" name="..." id="hddType" value="38" />
                      <select id="cboType" onchange="ChangeLoaigiaodich($(this).val());">
                        <option value="-1">Chọn BĐS</option>
                        <option value="38">BĐS Bán</option>
                        <option value="49">BĐS Cho Thuê</option>
                      </select>
                    </li>
                    <li class="item">
                      <input type="hidden" name="ctl00$PH_Container$BoxSearchList$hddCate" id="hddCate" value="-1" />
                      <select id="cboCate" onchange="ChangeValue('Cate', $(this).val());">
                        <option value="-1">-- Loại nhà đất--</option>
                      </select>
                    </li>
                    <li class="item">
                      <input type="hidden" name="ctl00$PH_Container$BoxSearchList$hddCity" id="hddCity" value="-1" />
                      <select id="cboCity" onchange="ChangeCity($(this).val())">
                        <option value="-1">Đà Nẵng</option>
                      </select>
                    </li>
                    <li class="item">
                      <input type="hidden" name="ctl00$PH_Container$BoxSearchList$hddArea" id="hddArea" value="-1" />
                      <select id="cboArea" onchange="ChangeValue('Area', $(this).val());">
                        <option value="-1">-- Diện tích --</option>
                        <option value="-1">Không xác định</option>
                        <option value="-1"><= 30 m2</option>
                        <option value="-1">30-50 m2</option>
                        <option value="-1">50-80 m2</option>
                        <option value="-1">80-100 m2</option>
                        <option value="-1">100-150 m2</option>
                        <option value="-1">150-200 m2</option>
                        <option value="-1">200-250 m2</option>
                        <option value="-1">250-300 m2</option>
                        <option value="-1">300-500 m2</option>
                        <option value="-1">=500 m2</option>
                      </select>
                    </li>
                    <li class="item">
                      <input type="hidden" name="ctl00$PH_Container$BoxSearchList$hddDistrict" id="hddDistrict" value="-1" />
                      <select id="cboDistrict" onchange="ChangeQuanhuyen($(this).val())">
                        <option value="-1">-- Quận / Huyện --</option>
                        @foreach($district as $id => $name)
                          <option value="{!! $id !!}">{!! $name !!}</option>
                        @endforeach
                      </select>
                    </li>
                    <li class="item">
                      <input type="hidden" name="ctl00$PH_Container$BoxSearchList$hddPrice" id="hddPrice" value="-1" />
                      <select id="cboPrice" onchange="ChangeValue('Price', $(this).val());">
                        <option value="-1">-- Mức giá --</option>
                        @foreach($unitPrice as $id => $name)
                          <option value="{!! $id !!}">{!! $name !!}</option>
                        @endforeach
                      </select>
                    </li>
                    <li id="advanced" class="width-full" >
                      <ul>
                        <li class="item">
                          <input type="hidden" name="ctl00$PH_Container$BoxSearchList$hddWard" id="hddWard" value="-1" />
                          <select id="cboWard" onchange="ChangeValue('Ward', $(this).val());">
                            <option value="-1">-- Phường / Xã --
                            </option>
                          </select>
                        </li>
                        <li class="item">
                          <input type="hidden" name="ctl00$PH_Container$BoxSearchList$hddDirection" id="hddDirection" value="-1" />
                          <select id="cboDirection" onchange="ChangeValue('Direction', $(this).val());">
                            <option value="-1">-- Hướng nhà --</option>
                          </select>
                        </li>
                        <li class="item">
                          <input type="hidden" name="ctl00$PH_Container$BoxSearchList$hddStreet" id="hddStreet" value="-1" />
                          <select id="cboStreet" onchange="ChangeValue('Street', $(this).val());">
                            <option value="-1">-- Đường / Phố --</option>
                          </select>
                        </li>
                        <li class="item">
                          <input type="hidden" name="ctl00$PH_Container$BoxSearchList$hddRoom" id="hddRoom" value="-1" />
                          <select id="cboRoom" onchange="ChangeValue('Room', $(this).val());">
                            <option value="-1">-- Phòng ngủ --</option>
                          </select>
                        </li>
                        <li class="item">
                          <input type="hidden" name="ctl00$PH_Container$BoxSearchList$hddProject" id="hddProject" value="-1" />
                          <select id="cboProject" onchange="ChangeValue('Project', $(this).val());">
                            <option value="-1">-- Dự án --</option>
                          </select>
                        </li>
                        
                      </ul>
                    </li>
                    <li class="item last" style="min-width: 0; padding-left: 7px !important; display:none">
                      <div class="fr pt10">
                        <label id="lbAdvanced" onclick="advancedSearch();" class="blue cursor underline adv-btsearch">Tìm kiếm nâng cao</label>
                      </div>
                    </li>
                    <li class="width-full pt10 clear">
                      <label class="tl ml5 clearfix">
                        <a id="btnSearch" class="bt-seaerch bg-orange nobor cursor white bold uppercase font15 font-roboto" rel="nofollow" href="javascript:void(0)">
                          <s class="ic-search fl mr5"></s>
                          <span class="mt2 fl">Tìm kiếm</span>
                        </a>
                      </label>
                    </li>
                  </ul>
                  <div class="clear"></div>
                </div>
              </div>
              <script src="/Scripts/Search.min.js?v=20140425" type="text/javascript"></script>
              <div class="box-link mb20">
                <div class="title font-robotonormal">
                  <h2 class="bg_white pd5 bor-right font16 normal uppercase">
                    Nhà đất bán
                  </h2>
                  <s class="ic-count"></s>
                </div>
                <div class="box-cont pd10 border">

                  <ul>

                    <li>
                      <h3><a href='/nha-dat-ban-tp-hcm.htm'>
                        Hồ Chí Minh <b>(109,241) </b></a></h3>
                      </li>

                      <li>
                        <h3><a href='/nha-dat-ban-ha-noi.htm'>
                          Hà Nội <b>(98,704) </b></a></h3>
                        </li>

                        <li>
                          <h3><a href='/nha-dat-ban-binh-duong.htm'>
                            Bình Dương <b>(19,809) </b></a></h3>
                          </li>

                        </ul>
                      </div>
                      <div class="clear"></div>
                    </div>

                    <div id="PH_Container_BoxHotLink_pnLink">

                      <div class="box-link mb20">
                        <div class="title font-robotonormal">
                          <h3 class="bg_white pd5 bor-right font16 normal uppercase">Liên kết nổi bật</h3>
                          <s class="ic-link"></s>
                        </div>
                        <div class="box-cont pd10 border">
                          <ul>

                            <li>
                              <a href="/nha-dat-ban-duong-ton-that-tung-53">Nhà đất bán Đường Tôn Thất Tùng</a>
                            </li>

                            <li>
                              <a href="/ban-can-ho-chung-cu-quan-2">Bán căn hộ chung cư Quận 2</a>
                            </li>

                            <li>
                              <a href="/ban-can-ho-chung-cu-cao-oc-thinh-vuong">Bán căn hộ chung cư Cao ốc Thịnh Vượng</a>
                            </li>

                          </ul>
                        </div>
                        <div class="clear"></div>
                      </div>

                    </div>



                    <div class="box tools-subport hidden">
                      <div class="title font-roboto">
                        <h3 class="bg_white pd5 bor-bot bor-right font15 uppercase">Công cụ hỗ trợ</h3>
                        <s class="ic-news-04"></s>
                      </div>
                      <div class="box-cont pd10 bor-left bor-right bor-bot">
                        <ul class="clearfix">
                          <li class="rows-tools tc">
                            <a href="#" class="name-tools font-roboto font14">
                              <s class="ic-tools-email"></s>
                              <span class="block mt5">Nhận BĐS qua Email</span>
                            </a>
                          </li>
                          <li class="rows-tools tc">
                            <a href="#" class="name-tools font-roboto font14">
                              <s class="ic-price-list"></s>
                              <span class="block mt5">Bảng giá VLXD</span>
                            </a>
                          </li>
                          <li class="rows-tools tc">
                            <a href="#" class="name-tools font-roboto font14">
                              <s class="ic-price-home"></s>
                              <span class="block mt5">Bảng giá đất</span>
                            </a>
                          </li>
                          <li class="rows-tools tc">
                            <a href="#" class="name-tools font-roboto font14">
                              <s class="ic-textvd"></s>
                              <span class="block mt5">Văn bản nghành VD</span>
                            </a>
                          </li>
                          <li class="rows-tools tc">
                            <a href="#" class="name-tools font-roboto font14">
                              <s class="ic-fengshui"></s>
                              <span class="block mt5">Phong thủy</span>
                            </a>
                          </li>
                          <li class="rows-tools tc">
                            <a href="#" class="name-tools font-roboto font14">
                              <s class="ic-interest"></s>
                              <span class="block mt5">Phong thủy</span>
                            </a>
                          </li>
                        </ul>
                      </div>
                    </div>
                    <div id="PH_Container_AutoCheap_autoCheap" class="productlist mb20 mt10">
                      <div class="title font-robotonormal">
                        <h3 class="bg_white pd5 bor-right font16 normal uppercase"><a rel="nofollow" target="_blank" href="http://banxehoi.com/">Banxehoi.com</a></h3>
                        <s class="ic-auto2"></s>
                      </div>
                      <div class="box-cont pl10 pr10 pb10 border">
                        <div id="autocheaps">
                          <div class="wapper-autocheaps">
                            <ul id="autoContainer" class="clearfix sidebar-post">
                            </ul>

                          </div>
                        </div>
                      </div>
                      <a rel="nofollow" class="readmoroAuto" target="_blank" href="https://banxehoi.com/" title="Mua bán, cho thuê ô tô, xe hơi cũ, mới giá rẻ">Xem thêm >></a>
                    </div>
                    <script type="text/javascript">
                      $(document).ready(function () {
                        BuildAutoBox();
                      })
                    </script>



                    <div class="box-link mb20">
                      <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FDothidiaocDV%2F&tabs=timeline&width=300&height=500&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId=282156201795763" width="300" height="500" style="border: none; overflow: hidden" scrolling="no" frameborder="0" allowtransparency="true"></iframe>
                    </div>

                  </div>

                  <div class="clear">
                  </div>
                </div>
              </div>

              <div class="clear"></div>
            </div>
          </div>
        </div>
        @endsection
        @section('script')
        @endsection