<!-- Modal -->
<form action="" method="post" id="form-tuvan">
    <div class="modal fade" id="tuvansangiaodich" role="dialog">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Đăng ký tư vấn</h4>
                </div>
                <div class="modal-body">
                    <h3 class="modal-title" id="name"></h3>
                    <input  type="hidden" name="id" id="id" />
                    <div class="row">
                        <div class="col-sm-6">
                            <input  type="email" name="email" placeholder="Email" id="email"/>
                            <br/><br/>
                            <div id="email_warning_msg" style="margin-top: 10px;">
                        </div>
                        <div class="col-sm-6">
                            <input  type="text" name="phone" placeholder="Số điện thoại" id="phone"/>
                            <br/><br/>
                            <div id="phone_warning_msg" style="margin-top: 10px;">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" id="contact">Close</button>
                </div>
            </div>
        </div>
    </div>
</form>
<script type="text/javascript">

    checkEmail=true;
    checkPhone=true;

    //A checkAdd function will check all valid fields of the added form.
    function checkEdit(){
        if(checkEmail&&checkPhone){
            $("#contact").removeAttr("disabled");
        }else{
            $("#contact").attr('disabled', true);
        }
    }

    //check Phone
    $("#phone").blur(function() {
        phone=$(this).val();
        if(phone==''){
            $('#phone_warning_msg').html('<span style="color:red"><strong>Số điện thoại</strong> không để trống !</span>');
            checkPhone=false;
            checkEdit();
        }else{
            $('#phone_warning_msg').html('');
            re1 =/^\d{10}$/;
            re2 =/^\d{11}$/;
            if(re1.test(phone)==false){
                if(re2.test(phone)==false){
                    $('#phone_warning_msg').html('<span style="color:red"><strong>Số điện thoại</strong> phải là 10 hoặc 11 số !</span>');
                    checkPhone=false;
                    checkEdit();
                }
            }else{
                checkPhone=true;
                checkEdit();
            }
        }

    });

    //check Phone
    $("#email").blur(function() {
        email=$(this).val();
        if(email==''){
            $('#email_warning_msg').html('<span style="color:red"><strong>Email</strong> không để trống !</span>');
            checkEmail=false;
            checkEdit();
        }else{
            $('#email_warning_msg').html('');
            re =/^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/;
            if(re.test(email)==false){
                $('#email_warning_msg').html('<span style="color:red"><strong>Email</strong> không đúng định dạng !</span>');
                checkEmail=false;
                checkEdit();
            }else{
                checkEmail=true;
                checkEdit();
            }
        }

    });

    $('#contact').click(function(event) {
        $.ajax({
            url: "{{ route('public.tuvan') }}",
            method: "PUT",
            data: $("#form-edit").serialize(),
            dataType : 'text',
            success : function(item){
                show();
                alert('Sửa thành công');
            }
        });
        $('#reset').click();
        $('#myModalEdit').modal('hide');
        return false;
    });
</script>
