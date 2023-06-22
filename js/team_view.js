$( document ).ready(function() 
{
    
    let log=$('#employee_grid').DataTable({
    "lengthMenu": [[100, -1], [100, "All"]],
    searching:false,
    dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>tp",
                        buttons: [
                        'csv', 'excel', 'pdf', 'print'
                        ],
                "bProcessing": true,
        "serverSide": true,
        "ajax":{
            url :"ajax/team_members.php", // json datasource
            type: "post",  // type of method ,GET/POST/DELETE
            datatype: 'json',
            data:{submit:'Submit',d1:'not_date'},
            error: function(){
                $("#employee_grid_processing").css("display","none");
            }
            // ,
            // success:function(data)
            // {
            //   console.log(data);
            // }
        }
    }); 
    
    $('#search').click(function()
    {
        var d1=$('#fromdate').val();
        var d2=$('#todate').val();
        if(d1=='')
        {
            alert('Please Select From Date');
            exit();
        }
        var table=$('#employee_grid').DataTable();
        table.destroy();

        let log=$('#employee_grid').DataTable({
            "lengthMenu": [[100, -1], [100, "All"]],
            searching:false,
            dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>tp",
            buttons: [ 'csv', 'excel', 'pdf', 'print'],
            "bProcessing": true,
            "serverSide": true,
            "ajax":{
                url :"ajax/load_customers.php",
                type: "post",
                datatype: 'json',
                data:{submit:'Submit',d1:d1,d2:d2},
                error: function(){
                    $("#employee_grid_processing").css("display","none");
                }
                    // ,
                    // success:function(data)
                    // {
                    //   console.log(data);
                    // }
                }
            });
    });

    $("#employee_grid tbody").on('dblclick', 'tr', function() 
    {
        var currow = $(this).closest('tr');
        var item_id = currow.find('td:eq(0)').html();
        var name = currow.find('td:eq(1)').html();
        // console.log(item_id);
        window.location.href = 'view_referal.php?cid='+item_id + '&nam=' + name;
    });
});



function searchreferral()
{
    var cid=$("#full1").val();

    let log=$('#employee_grid').DataTable({
        "lengthMenu": [[100, -1], [100, "All"]],
        searching:false,
        dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>tp",
                            buttons: [
                            'csv', 'excel', 'pdf', 'print'
                            ],
                    "bProcessing": true,
            "serverSide": true,
            "ajax":{
                url :"ajax/team_members.php", // json datasource
                type: "post",  // type of method ,GET/POST/DELETE
                datatype: 'json',
                data:{submit:'Submit',d1:cid},
                error: function(){
                    $("#employee_grid_processing").css("display","none");
                }
                // ,
                // success:function(data)
                // {
                //   console.log(data);
                // }
            }
        });
}