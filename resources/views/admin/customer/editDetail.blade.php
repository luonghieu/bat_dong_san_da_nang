 <script src="{!! asset('admin_asset/js/vendor/jquery/jquery-1.11.2.min.js') !!}"></script>

 <script src="{!! asset('admin_asset/js/vendor/bootstrap/bootstrap.min.js') !!}"></script>
 <form action="" method="post" id="form-editDetail">
    <div class="modal fade" id="editDetail" role="dialog">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit</h4>
                </div>
                <div class="modal-body">
                    <input  type="hidden" name="id" id="idEdit" />
                    <div class="form-group">
                        <input  type="text" name="attribute" placeholder="Attribute" id="attributeEdit"/>
                        <br/><br/>
                        <div id="attribute_edit_warning_msg" style="margin-top: 10px;">
                        </div>
                    </div>
                    <div class="form-group">
                        <input  type="text" name="value" placeholder="Value" id="valueEdit"/>
                        <br/><br/>
                        <div id="value_edit_warning_msg" style="margin-top: 10px;">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" id="submitEdit">Edit</button>
                    <button type="reset" class="btn btn-default" id="resetEdit">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</form>
<script type="text/javascript">

    checkAttributeEdit=true;
    checkValueEdit=true;

    //A checkAdd function will check all valid fields of the added form.
    function checkEdit(){
        if(checkAttributeEdit&&checkValueEdit){
            $("#submitEdit").removeAttr("disabled");
        }else{
            $("#submitEdit").attr('disabled', true);
        }
    }

    $("#attributeEdit").blur(function() {
        attribute=$(this).val();
        if(attribute==''){
            $('#attribute_edit_warning_msg').html('<span style="color:red"><strong>Atribute</strong> không được để trống !</span>');
            checkAttributeEdit=false;
            checkEdit();
        }else{
            $('#attribute_edit_warning_msg').html('');
            checkAttributeEdit=true;
            checkEdit();
        }
    });
    //check Phone
    $("#valueEdit").blur(function() {
        value=$(this).val();
        if(value==''){
            $('#value_edit_warning_msg').html('<span style="color:red"><strong>Value</strong> không để trống !</span>');
            checkValueEdit=false;
            checkEdit();
        }else{
            $('#value_edit_warning_msg').html('');
            checkValueEdit=true;
            checkEdit();
        }
    });


    $('#submitEdit').click(function(event) {
        $.ajax({
            url: "{{ route('admins.customer.updateDetail') }}",
            method: "GET",
            data: $("#form-editDetail").serialize(),
            dataType : 'html',
            success : function(result){
                id = $('#idEdit').val();
                $('#detail-'+id).html(result);
                alert('Edit success!');
                $('#resetEdit').click();
                $('#editDetail').modal('hide');
            }
        });
        return false;
    });
</script>
