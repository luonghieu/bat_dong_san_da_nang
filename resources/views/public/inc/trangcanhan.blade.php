<script src="{!! asset('public_asset/js/Member.min.js') !!}"></script>
                <div class="w-280 fl mt-35">
                    <div class="box user-manger">
                        <div class="title font-robotonormal">
                            <h3 class="bg_white pd5 bor-bot bor-right font16 normal uppercase">Trang cá nhân</h3>
                            <s class="ic-news-09"></s>
                        </div>
                        <div class="box-cont bor-left bor-right bor-bot font14">
                            <ul class="clearfix">
                                <li class="bor-bot clearfix">
                                    <a class="active block color-text pd10" href="{!! route('public.trangcanhan') !!}">
                                        <s class="ic-arow-news fl mt5 mr5"></s>Quản lý tin rao bán/ thuê
                                    </a>
                                </li>
                                <li class="bor-bot clearfix">
                                    <a class="block color-text pd10" href="{!! route('public.dangtin') !!}">
                                        <s class="ic-arow-news fl mt5 mr5"></s>Đăng tin rao bán/cho thuê
                                    </a>
                                </li>
                                <li class="bor-bot clearfix">
                                    <a class="block color-text pd10" href="{!! route('public.trangcanhan.thaydoithongtincanhan') !!}">
                                        <s class="ic-arow-news fl mt5 mr5"></s>Thay đổi thông tin cá nhân
                                    </a>
                                </li>
                                <li class="bor-bot clearfix">
                                    <a class="block color-text pd10" href="{!! route('public.trangcanhan.thaydoimatkhau') !!}">
                                        <s class="ic-arow-news fl mt5 mr5"></s>Thay đổi mật khẩu
                                    </a>
                                </li>
                                <li class="bor-bot clearfix nobor">

                                    <a class="block color-text pd10" href="{!! route('public.trangcanhan.dangxuat') !!}">
                                        <s class="ic-arow-news fl mt5 mr5"></s>Thoát khỏi hệ thống
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>