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
                url: "{!! route('admins.customer.deleteTransaction') !!}",
                method: "GET",
                data: {
                    'id' : aData[1],
                },
                dataType : 'json',
                success : function(result){
                    if (result == 'ok') {
                        oTable.row(nRow).remove().draw();
                        alert("Deleted!");
                    } else {
                        if (confirm('Are you really want to delete?')) {
                            $.ajax({
                                url: "{!! route('admins.customer.deleteConfirmTransaction') !!}",
                                method: "GET",
                                data: {
                                    'id' : aData[1],
                                },
                                dataType : 'json',
                                success : function(result){
                                    if (result == 'ok') {
                                        oTable.row(nRow).remove().draw();
                                        alert("Deleted!");
                                    }
                                }
                            });
                        } else {
                            return false;
                        }                        
                    }
                }
            });
        });

        //load wysiwyg editor
        $('#summernote').summernote({
            height: 200   //set editable area's height
        });
        //*load wysiwyg editor
    });

</script>
<!--/ Page Specific Scripts -->
