 <script src="{!! asset('admin_asset/js/vendor/jquery/jquery-1.11.2.min.js') !!}"></script>

 <script src="{!! asset('admin_asset/js/vendor/bootstrap/bootstrap.min.js') !!}"></script>
 <form action="" method="post" id="form-addDetail">
    <div class="modal fade" id="addDetail" role="dialog">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add</h4>
                </div>
                <div class="modal-body">
                    <input  type="hidden" name="id" id="idAdd" />
                    <div class="form-group">
                        <input  type="text" name="attribute" placeholder="Attribute" id="attributeAdd"/>
                        <br/><br/>
                        <div id="attribute_add_warning_msg" style="margin-top: 10px;">
                        </div>
                    </div>
                    <div class="form-group">
                        <input  type="text" name="value" placeholder="Value" id="valueAdd"/>
                        <br/><br/>
                        <div id="value_add_warning_msg" style="margin-top: 10px;">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" id="submitAdd" disabled>Add</button>
                    <button type="reset" class="btn btn-default" id="resetAdd">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</form>
<script type="text/javascript">

    checkAttributeAdd=false;
    checkValueAdd=false;

    //A checkAdd function will check all valid fields of the added form.
    function checkAdd(){
        if(checkAttributeAdd&&checkValueAdd){
            $("#submitAdd").removeAttr("disabled");
        }else{
            $("#submitAdd").attr('disabled', true);
        }
    }

    $("#attributeAdd").blur(function() {
        attribute=$(this).val();
        if(attribute==''){
            $('#attribute_add_warning_msg').html('<span style="color:red"><strong>Atribute</strong> không được để trống !</span>');
            checkAttributeAdd=false;
            checkAdd();
        }else{
            $('#attribute_add_warning_msg').html('');
            checkAttributeAdd=true;
            checkAdd();
        }
    });
    //check Phone
    $("#valueAdd").blur(function() {
        value=$(this).val();
        if(value==''){
            $('#value_add_warning_msg').html('<span style="color:red"><strong>Value</strong> không để trống !</span>');
            checkValueAdd=false;
            checkAdd();
        }else{
            $('#value_add_warning_msg').html('');
            checkValueAdd=true;
            checkAdd();
        }
    });


    $('#submitAdd').click(function(event) {
        $.ajax({
            url: "{{ route('admins.customer.storeDetail') }}",
            method: "GET",
            data: $("#form-addDetail").serialize(),
            dataType : 'html',
            success : function(result){
                html = result + $('#contentDetail').html();
                $('#contentDetail').html(html);
                alert('Add success!');
                $('#resetAdd').click();
                $('#addDetail').modal('hide');
            }
        });
        return false;
    });
</script>
