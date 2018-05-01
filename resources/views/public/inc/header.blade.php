<div class="visible-xs"><div class="menumobile">
    <div class="header">
    	<a href="#menu"></a>
        <div class="clear"></div>
    </div>
    
    <nav id="menu">
    	<ul>
            <li><a href="{!! route('public.trangchu') !!}"><i class="fa fa-home" aria-hidden="true"></i></a></li>
            <li><a href="{!! route('public.gioithieu') !!}">Giới thiệu</a></li>
            <li><a  href="{!! route('public.duan') !!}">Dự án</a></li>
            <li><a  href="{!! route('public.sangiaodich', ['type' => 1]) !!}">BĐS bán</a>
                <ul>
                    @foreach($bdsBan as $obj)
                    <li><a href="{!! route('public.sangiaodich.theloai', ['type' => 1, 'id' => $obj->id]) !!}">{!! $obj->name !!}</a></li>
                    @endforeach
                </ul>   
            </li>
            <li><a  href="{!! route('public.sangiaodich', ['type' => 2]) !!}">BĐS cho thuê</a>
                <ul>
                    @foreach($bdsChoThue as $obj)
                    <li><a href="{!! route('public.sangiaodich.theloai', ['type' => 1, 'id' => $obj->id]) !!}">{!! $obj->name !!}</a></li>
                    @endforeach
                </ul>   
            </li>

            <li><a  href="{!! route('public.tintuc.list') !!}">Tin tức</a>
                <ul>
                    @foreach($catNews as $obj)
                    <li><a href="{!! route('public.tintuc', ['catId' => $obj->id]) !!}">{!! $obj->name !!}</a></li>
                    @endforeach
                </ul>
            </li>
            <li><a  href="{!! route('public.lienhe') !!}">Liên hệ</a></li>
        </ul>
    </nav>
</div>
<!-- menu_left vip --></div>
<div class="top_op">
    <div class="container">                            
        <a href="{!! route('public.dangky') !!}" class="hot_mail">Đăng ký</a>
        <a href="{!! route('public.dangnhap') !!}" class="hot_mail">Đăng nhập</a>
        <a href="{!! route('public.dangtin') !!}" class="hot_phone" id="dangtin">Đăng tin</a>
        <div class="clear"></div>
    </div>
</div>
<script type="text/javascript">
    $('#dangtin').click(function(){
        @if(session()->get('objUser') == null)
        alert('Bạn phải đăng nhập để đăng tin');
        return false;
        @endif
        return true;
    });
</script>
<div class="menutop_wrapper">

    <div class="container">

        <div class="logo"><a href="{!! route('public.trangchu') !!}"><img src="{!! asset('public_asset/images/logo.png') !!}" alt="logo"/></a></div>

        <div class="menu">

            <ul class=" hidden-xs">

                <li><a href="{!! route('public.trangchu') !!}"><i class="fa fa-home" aria-hidden="true"></i></a></li>
                <li><a href="{!! route('public.gioithieu') !!}">Giới thiệu</a></li>
                <li><a  href="{!! route('public.duan') !!}">Dự án</a></li>
                <li><a  href="{!! route('public.sangiaodich', ['type' => 1]) !!}">BĐS bán</a>
                    <ul>
                        @foreach($bdsBan as $obj)
                        <li><a href="{!! route('public.sangiaodich.theloai', ['type' => 1, 'id' => $obj->id]) !!}">{!! $obj->name !!}</a></li>
                        @endforeach
                    </ul>   
                </li>
                <li><a  href="{!! route('public.sangiaodich', ['type' => 2]) !!}">BĐS cho thuê</a>
                    <ul>
                        @foreach($bdsChoThue as $obj)
                        <li><a href="{!! route('public.sangiaodich.theloai', ['type' => 1, 'id' => $obj->id]) !!}">{!! $obj->name !!}</a></li>
                        @endforeach
                    </ul>   
                </li>

                <li><a  href="{!! route('public.tintuc.list') !!}">Tin tức</a>
                    <ul>
                        @foreach($catNews as $obj)
                        <li><a href="{!! route('public.tintuc', ['catId' => $obj->id]) !!}">{!! $obj->name !!}</a></li>
                        @endforeach
                    </ul>
                </li>
                <li><a  href="{!! route('public.lienhe') !!}">Liên hệ</a></li>
            </ul>

            <div class="searchne">

                <form class="form-sea" action="http://www.google.com/search" method="get" target="_blank" id="search">

                    <input type="hidden" name="act" value="search" />

                    <input autocomplete="off" name="query" type="text" id="faq_search_input" placeholder="Tìm kiếm..."/>



                    <button name="btn" style="cursor: pointer;" type="submit"><img src="{!! asset('public_asset/images/sea.png') !!}" alt="search" style="width: 20px;" /></button>

                    <input type="hidden" name="sitesearch" value="http://phoson.vn" />

                    <input type="hidden" name="domains" value="http://phoson.vn" />

                    <div class="clear"></div>

                </form>

            </div>

        </div>

        <div class="clear"></div>

    </div>

</div>
