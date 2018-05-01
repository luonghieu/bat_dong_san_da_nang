<script src="{!! asset('admin_asset/js/vendor/jquery/jquery-1.11.2.min.js') !!}"></script>
<script src="{!! asset('admin_asset/js/vendor/bootstrap/bootstrap.min.js') !!}"></script>
<form action="" method="post" id="form-addRegister">
    <div class="modal fade" id="addRegister" role="dialog">
        <div class="modal-dialog">

          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Add Register</h4>
          </div>
          <div class="modal-body">
              <input  type="hidden" name="id" id="id" />
              <select name="project_id" id="projects">

              </select>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" id="submitAdd">Add</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
    </div>

</div>
</div>
</form>
<script type="text/javascript">

    $('#submitAdd').click(function(event) {
        $.ajax({
            url: "{{ route('admins.customer.storeRegister') }}",
            method: "GET",
            data: $("#form-addRegister").serialize(),
            dataType : 'html',
            success : function(result){
                alert('Add success!');
                $('#resetAdd').click();
                $('#addRegister').modal('hide');
            }
        });
        return false;
    });
</script>
