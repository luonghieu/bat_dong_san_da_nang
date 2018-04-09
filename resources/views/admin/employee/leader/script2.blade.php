 <!-- === Vendor JavaScripts === -->
 <script src="{!! asset('admin_asset/js/vendor/datatables/extensions/ColReorder/js/dataTables.colReorder.min.js') !!}"></script>
 <script src="{!! asset('admin_asset/js/vendor/datatables/extensions/Responsive/js/dataTables.responsive.min.js') !!}"></script>
 <script src="{!! asset('admin_asset/js/vendor/datatables/extensions/ColVis/js/dataTables.colVis.min.js') !!}"></script>
 <script src="{!! asset('admin_asset/js/vendor/datatables/extensions/TableTools/js/dataTables.tableTools.min.js') !!}"></script>
 <!--/ vendor javascripts -->
 
<!--Page Specific Scripts -->
    <script>
        $(window).load(function(){
    //initialize editable datatable
    checkAdd =false;
    checkEdit =true;

    function restoreRow(oTable, nRow) {
        var aData = oTable.row(nRow).data();
        var jqTds = $('>td', nRow);

        for (var i = 0, iLen = jqTds.length; i < iLen; i++) {
            oTable.row(nRow).data(aData[i]);
        }

        oTable.draw();
    }

    function editRow(oTable, nRow) {
        $.ajax({
          url: "{!! route('common.district.list') !!}",
          method: "GET",
          data: {
          },
          dataType : 'json',
          success : function(result){
            var aData = oTable.row(nRow).data();
            var jqTds = $('>td', nRow);
            jqTds[0].innerHTML = '<input type="text" disabled="disabled" class="form-control input-sm" value="' + aData[0] + '">';

            jqTds[1].innerHTML = '<input type="text" class="form-control input-sm" value="' + aData[1] + '" placeholder="Name" id="name"><br/><div id="name_warning_msg" style="margin-top: 10px;">';

            var male = female = '';
            if (aData[2] == 0|| aData[0] =='') {
                male = 'checked="checked"';
            } else {
                female = 'checked="checked"';
            }
            jqTds[2].innerHTML = '<label class="checkbox checkbox-custom"><input name="customRadio" type="radio" value="0" ' +  male + '><i></i>Male</label><label class="checkbox checkbox-custom"><input name="customRadio" type="radio" value="1" ' +  female + '><i></i>Female</label>';

            jqTds[3].innerHTML = '<textarea class="form-control" style="overflow:auto;resize:vertical" rows="5" name="message" id="message" placeholder="Address">' + aData[3] + '</textarea><br/><div id="address_warning_msg" style="margin-top: 10px;">';

            jqTds[4].innerHTML = '<input type="text" class="form-control input-sm" value="' + aData[4] + '" id="phone"><br/><div id="phone_warning_msg" style="margin-top: 10px;">';
            html = '<select class="form-control">';
            $.each (result, function (key, item){
                if (item.name==aData[5]) {
                  choose='selected="selected"';
              } else {
                  choose='';
              }
              html += '<option value="'+item.id+'"' + choose + '>'+item.name+'</option>';
          });
            html+= '</select>';
            jqTds[5].innerHTML = html;

            jqTds[6].innerHTML = '<a role="button" tabindex="0" class="edit text-success text-uppercase text-strong text-sm mr-10">Save</a><a role="button" tabindex="0" class="cancel text-warning text-uppercase text-strong text-sm mr-10">Cancel</a>';

            checkName=false;
            checkAddress=false;
            checkPhone=false;

            //A checkAdd function will check all valid fields of the added form.
            function check(){
                if(checkName&&checkAddress&&checkPhone){
                  // $("#add").removeAttr("disabled");
                  checkAdd = true;
                  checkEdit = true;
                }else{
                  // $("#add").attr('disabled', true);
                  checkAdd = false;
                  checkEdit = false;
                }
            }
            //check Username.

            $("#message").blur(function() {
                address=$(this).val();
                if(address==''){
                    $('#address_warning_msg').html('<span style="color:red"><strong>Address</strong> is required!</span>');
                    checkAddress=false;
                    check();
                } else {
                    $('#address_warning_msg').html('');
                    if(address.length<3){
                        $('#address_warning_msg').html('<span style="color:red"><strong>Address</strong> not less than 3 character !</span>');
                        checkAddress=false;
                        check();
                    }else if(address.length>255){
                      $('#address_warning_msg').html('<span style="color:red"><strong>Address</strong> not greater than 255 character !</span>');
                      checkAddress=false;
                      check();
                  }else{
                      checkAddress=true;
                      check();
                  }
              }
            });
            $("#name").blur(function() {
              name=$(this).val();
              if(name==''){
                $('#name_warning_msg').html('<span style="color:red"><strong>Name</strong> is required !</span>');
                checkName=false;
                check();
            }else{
             $('#name_warning_msg').html('');
             re =/^[a-zA-Z]+$/;
             if(re.test(name)==true){
               if(name.length<3){
                  $('#name_warning_msg').html('<span style="color:red"><strong>Name</strong> not less than 3 character !</span>');
                  checkName=false;
                  check();
              }else if(name.length>20){
                  $('#hoten_warning_msg').html('<span style="color:red"><strong>Name</strong> not greater than 20 character !</span>');
                  checkName=false;
                  check();
              }else{
                  checkName=true;
                  check();
              } 
              } else {
                $('#name_warning_msg').html('<span style="color:red"><strong>Name</strong> not contains special character!</span>');
                checkName=false;
                check();
                }
             }
            });

            //check Phone
            $("#phone").blur(function() {
              phone=$(this).val();
              if(phone==''){
                $('#phone_warning_msg').html('<span style="color:red"><strong>Phone</strong> is required!</span>'); 
                checkPhone=false;
                check();
                }else{
                    $('#phone_warning_msg').html('');
                    re1 =/^\d{10}$/;
                    re2 =/^\d{11}$/;
                    if(re1.test(phone)==false){
                      if(re2.test(phone)==false){
                        $('#phone_warning_msg').html('<span style="color:red"><strong>Phone</strong> must be 10 or 11 number !</span>');
                        checkPhone=false;
                        check();
                        }
                    }else{
                      checkPhone=true;
                      check();                
                    }
                }
            });
        }
    });
}


function saveRow(oTable, nRow) {
    var jqInputs = $('input[type="text"]', nRow);
    var id = jqInputs[0].value;
    var name = jqInputs[1].value;
    var phone = jqInputs[2].value;

    var jqInputs = $('input[type="radio"]:checked', nRow);
    var gender = jqInputs[0].value;

    var jqInputs = $('textarea', nRow);
    var address = jqInputs[0].value;

    var jqInputs = $('select', nRow);
    var district = jqInputs[0].value;

    $.ajax({
      url: "{!! route('admins.leader.createOrUpdate') !!}",
      method: "GET",
      data: {
        'id' : id,
        'name' : name,
        'gender' : gender,
        'phone' : phone,
        'address' : address,
        'district_id' :district
    },
    dataType : 'json',
    success : function(result){
        oTable.cell(nRow, 0).data(result.id);
        oTable.cell(nRow, 1).data(result.name);
        oTable.cell(nRow, 2).data(result.gender);
        oTable.cell(nRow, 3).data(result.address);
        oTable.cell(nRow, 4).data(result.phone);
        oTable.cell(nRow, 5).data(result.district);
        oTable.cell(nRow, 6).data('<a role="button" tabindex="0" class="edit text-primary text-uppercase text-strong text-sm mr-10">Edit</a><a role="button" tabindex="0" class="delete text-danger text-uppercase text-strong text-sm mr-10">Remove</a>');
        oTable.draw();
    }
});
}

var table2 = $('#editable-usage');

var oTable = $('#editable-usage').DataTable({
    "aoColumnDefs": [
    { 'bSortable': false, 'aTargets': [ "no-sort" ] }
    ]
});

var nEditing = null;
var nNew = false;
var type = '';

$('#add-entry').click(function (e) {
    e.preventDefault();

    if (nNew && nEditing) {
        // if (confirm("Previous row is not saved yet. Save it ?")) {
        //     saveRow(oTable, nEditing); // save
        //     $(nEditing).find("td:first").html("Untitled");
        //     nEditing = null;
        //     nNew = false;

        // } else {
        //     oTable.row(nEditing).remove().draw(); // cancel
        //     nEditing = null;
        //     nNew = false;

        //     return;
        // }
        alert("A record is progressed!");
        return;
    }
    var aiNew = oTable.row.add(['0', '', '', '', '', '', '']).draw();
    var nRow = oTable.row(aiNew[0]).node();
    editRow(oTable, nRow);
    nEditing = nRow;
    nNew = true;
    type = 'add';
});

table2.on('click', '.delete', function (e) {
    e.preventDefault();

    if (confirm("Are you sure?") == false) {
        return;
    }

    var nRow = $(this).parents('tr')[0];
    var aData = oTable.row(nRow).data();

    $.ajax({
      url: "{!! route('admins.leader.delete') !!}",
      method: "GET",
      data: {
        'id' : aData[0],
    },
    dataType : 'json',
    success : function(result){
        oTable.row(nRow).remove().draw();
        alert("Deleted!");
    }
});
});

table2.on('click', '.cancel', function (e) {
    e.preventDefault();
    if (nNew) {
        oTable.row(nEditing).remove().draw();
        nEditing = null;
        nNew = false;
        type = '';
    } else {
        restoreRow(oTable, nEditing);
        nEditing = null;
        type = '';
    }
});

table2.on('click', '.edit', function (e) {
    e.preventDefault();
    checkAdd =false;
    checkEdit =true;

    /* Get the row as a parent of the link that was clicked on */
    var nRow = $(this).parents('tr')[0];

    if (nEditing !== null && nEditing != nRow) {
        /* Currently editing - but not this row - restore the old before continuing to edit mode */
        // restoreRow(oTable, nEditing);
        // editRow(oTable, nRow);
        // nEditing = nRow;
        alert("A record is progressed!");
    } else if (nEditing == nRow) {
        /* Editing this row and want to save it */
        if ((type == 'edit' && checkEdit) || (type == 'add' && checkAdd)) {
          saveRow(oTable, nEditing);
          nEditing = null;
          type = '';
          alert("Updated!");
        } else {
          alert('Value is not valid!');
        }
        
    } else {
        /* No edit in progress - let's start one */
        type = 'edit';
        editRow(oTable, nRow);
        nEditing = nRow;
    }
});

    });
</script>
<!--/ Page Specific Scripts -->
