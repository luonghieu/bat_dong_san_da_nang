<!-- Modal -->
<form action="" method="post" id="form-tuvan">
    <div class="modal fade" id="tuvansanpham" role="dialog">
        <div class="modal-dialog modal-sm"  style="background-color: blue">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Đăng ký tư vấn</h4>
                </div>
                <div class="modal-body">
                    <center><h3 class="modal-title" id="name"></h3></center>
                    <hr>
                    <input  type="hidden" name="projectId" id="projectId" />
                    <input  type="hidden" name="productId" id="productId" />
                    <div class="form-group">
                        <input  type="text" name="name" placeholder="Họ tên" id="fullname"/>
                        <br/><br/>
                        <div id="name_warning_msg" style="margin-top: 10px;">
                        </div>
                    </div>
                    <div class="form-group">
                        <input  type="text" name="email" placeholder="Email" id="email"/>
                        <br/><br/>
                        <div id="email_warning_msg" style="margin-top: 10px;">
                        </div>
                    </div>
                    <div class="form-group">
                        <input  type="text" name="phone" placeholder="Số điện thoại" id="phone"/>
                        <br/><br/>
                        <div id="phone_warning_msg" style="margin-top: 10px;">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" id="submit" disabled>Gửi</button>
                    <button type="reset" class="btn btn-default" id="reset">Hủy bỏ</button>
                </div>
            </div>
        </div>
    </div>
</form>
<script type="text/javascript">

    checkEmail=false;
    checkPhone=false;
    checkName=false;

    //A checkAdd function will check all valid fields of the added form.
    function checkSend(){
        if(checkEmail&&checkPhone&&checkName){
            $("#submit").removeAttr("disabled");
        }else{
            $("#submit").attr('disabled', true);
        }
    }

    $("#fullname").blur(function() {
      name=$(this).val();
      if(name==''){
        $('#name_warning_msg').html('<span style="color:red"><strong>Họ tên</strong> không được để trống !</span>');
        checkName=false;
        checkSend();
    }else{
       $('#name_warning_msg').html('');
       re =/^[a-zA-Z]+$/;
       if(re.test(name)==true){
         if(name.length<3){
          $('#name_warning_msg').html('<span style="color:red"><strong>Họ tên</strong> không nhỏ hơn 6 ký tự !</span>');
          checkName=false;
          checkSend();
      }else if(name.length>20){
          $('#name_warning_msg').html('<span style="color:red"><strong>Họ tên</strong>  không lớn hơn 20 ký tự !</span>');
          checkName=false;
          checkSend();
      }else{
          checkName=true;
          checkSend();
      } 
  } else {
    $('#name_warning_msg').html('<span style="color:red"><strong>Họ tên</strong>  không chứa ký tự đặc biệt!</span>');
    checkName=false;
    checkSend();
}
}
});

    //check Phone
    $("#phone").blur(function() {
        phone=$(this).val();
        if(phone==''){
            $('#phone_warning_msg').html('<span style="color:red"><strong>Số điện thoại</strong> không để trống !</span>');
            checkPhone=false;
            checkSend();
        }else{
            $('#phone_warning_msg').html('');
            re1 =/^\d{10}$/;
            re2 =/^\d{11}$/;
            if(re1.test(phone)==false && re2.test(phone)==false){
                $('#phone_warning_msg').html('<span style="color:red"><strong>Số điện thoại</strong> phải là 10 hoặc 11 số !</span>');
                checkPhone=false;
                checkSend();
            }else{
                checkPhone=true;
                checkSend();
            }
        }

    });

    //check Phone
    $("#email").blur(function() {
        email=$(this).val();
        if(email==''){
            $('#email_warning_msg').html('<span style="color:red"><strong>Email</strong> không để trống !</span>');
            checkEmail=false;
            checkSend();
        }else{
            $('#email_warning_msg').html('');
            re =/^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/;
            if(re.test(email)==false){
                $('#email_warning_msg').html('<span style="color:red"><strong>Email</strong> không đúng định dạng !</span>');
                checkEmail=false;
                checkSend();
            }else{
                checkEmail=true;
                checkSend();
            }
        }

    });

    $('#submit').click(function(event) {
        $.ajax({
            url: "{{ route('public.tuvansanpham') }}",
            method: "GET",
            data: $("#form-tuvan").serialize(),
            dataType : 'json',
            success : function(item){
                alert('Gửi thành công');
            }
        });
        $('#reset').click();
        $('#tuvansanpham').modal('hide');
        return false;
    });
</script>
