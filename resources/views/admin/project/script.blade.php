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
    var table2 = $('#editable-usage');

    var oTable = $('#editable-usage').DataTable({
      "aoColumnDefs": [
      { 'bSortable': false, 'aTargets': [ "no-sort" ] }
      ]
    });

    table2.on('click', '.delete', function (e) {
      e.preventDefault();

      if (confirm("Are you sure?") == false) {
        return;
      }

      var nRow = $(this).parents('tr')[0];
      var aData = oTable.row(nRow).data();

      $.ajax({
        url: "{!! route('admins.project.delete') !!}",
        method: "GET",
        data: {
          'id' : aData[1]
        },
        dataType : 'json',
        success : function(result){
          if(result == 'ok') {
            oTable.row(nRow).remove().draw();
            alert("Deleted!");
          } else {
            alert('Project is in transaction');
          }
        }
      });
    });

  });

</script>
<!--/ Page Specific Scripts -->
