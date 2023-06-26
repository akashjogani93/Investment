$(document).ready(function()
{
    $('.full').keypress(function(event)
    {
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if ((keycode < 48 || keycode > 57))
        return true;
        
        return false;

    });

    var yourDateValue = new Date();
    var formattedDate = yourDateValue.toISOString().substr(0, 10)
    $('#regdate').val(formattedDate);
    
                $('#wamt').keyup(function()
                {
                    var invest = parseInt($('#amt').val());
                    var wamt = parseInt($('#wamt').val());
                    var asign = $('#asign').val();
                    
                    if(wamt > invest)
                    {
                        $('#wamtlable').html(`<span style='color:red'>Amount More Than Invested..</span>`);
                        $('#sub').prop('disabled',true);
                        $('#ramt').val(parseInt(0).toFixed(2));
                        $('#pday').val(parseInt(0).toFixed(2));
                        $('#pmonth').val(parseInt(0).toFixed(2));
                    }else
                    {
                        $('#wamtlable').html(`<span style='color:green'>Widraw Amount..</span>`);
                        $('#sub').prop('disabled',false);

                        if(invest==wamt)
                        {
                            $('#ramt').val(parseInt(0).toFixed(2));
                            $('#pday').val(parseInt(0).toFixed(2));
                            $('#pmonth').val(parseInt(0).toFixed(2));
                            $('#asign').attr('readonly','readonly');
                        }else
                        {
                            $('#asign').removeAttr('readonly','readonly');
                            var rem=(invest-wamt);
                            $('#ramt').val(rem.toFixed(2));
                            var calc=(rem/100)*asign;
                            var calx=calc/30;
                            $('#pday').val(calx.toFixed(2));
                            $('#pmonth').val(calc.toFixed(2)); 
                        }
                    }
                });
                $('#asign').keyup(function()
                {
                    var ramt = $('#ramt').val();
                    var asign = $('#asign').val();
                    var calc=(ramt/100)*asign;
                    var calx=calc/30;
                    $('#pday').val(calx.toFixed(2)); 
                    $('#pmonth').val(calc.toFixed(2)); 

                });

    $('.investone').keypress(function(event)
    {
        full1 =$('#full1').val();
        investid =$('#investid').val();
        // alert(full1);
        if(full1=='')
        {
            $('#search_name').html(`<span style='color:red'>First Search Customer..</span>`);
           
            $('#sub').prop('disabled',true);
            $('.investone').attr('readonly','readonly');
            $('.investone').attr('readonly','readonly');
        }else if(investid=='')
        {
            $('#investedamt').html(`<span style='color:red'>Select Debit Amount..</span>`);
            $('.investone').attr('readonly','readonly');
            $('.investone').attr('readonly','readonly');
            $('#sub').prop('disabled',true);
        }

        var keycode = (event.keyCode ? event.keyCode : event.which);
        if ((keycode < 46 || keycode > 57))
        return false;

        return true;

    });
    
    
});

function searchfull()
{
    var oTable;
    var full1=$('#full1').val();
    // console.log(full1);

    log = $.ajax({
        url: 'ajax/customerWidraw_data.php',
        type: "POST",
        dataType: 'json',
        data: {
            full1: full1,
        },
        success:function(data) 
        {
            
            $("#example1 tbody").empty().html(data);
            $('.loader').fadeOut();
            //$('.mytable').html(data);
            //alert(data);
            console.log(data);
            oTable = $('#example1').dataTable({
                searching:false,
                pageLength : 25,
                aLengthMenu: [
                [25, 50, 100, 200, -1],
                [25, 50, 100, 200, "All"]
            ],
                iDisplayLength: -1
            });
            
            //after search button to remove attribute readonly
            $('#search_name').html(`<span style='color:green'>Customer Name..</span>`);
            $('#investedamt').html(`<span style='color:red'>Select Debit Amount..</span>`);
            // $('#sub').prop('disabled',false);
            $('.investone').removeAttr('readonly','readonly');
            $('.investone').removeAttr('readonly','readonly');
        }
            
    });
    
}

function debit(id)
{
    //alert("hi");
    let log = $.ajax({
        url: 'ajax/widrawDebit.php',
        type: "POST",
        dataType: 'json',
        data: {
            cid: id,
        },
        success:function(data) 
        {
            $("#amt").val(data[0].invest);
            $("#asign").val(data[0].asign);
            $("#pday").val(data[0].pday);
            $("#pmonth").val(data[0].pmonth);
            $("#regdate1").val(data[0].regdate);
            $("#investid").val(id);
            //alert(data);
            console.log(data);

            //after search button to remove attribute readonly
            $('#investedamt').html(`<span style='color:green'>Invested Amount..</span>`);
             $('#sub').prop('disabled',false);
            $('.investone').removeAttr('readonly','readonly');
            $('.investone').removeAttr('readonly','readonly');
        }
    });
}


function widraw()
{
    $('#wamtlable').html(`<span style='color:green'>Widraw Amount..</span>`);
    $('#asignlable').html(`<span style='color:green'>Asign Value..</span>`);
    var investid=$('#investid').val();
    var full1=$('#full1').val();
    if(full1=='')
    {
        $('#search_name').html(`<span style='color:red'>First Search Customer..</span>`);
        
        $('#sub').prop('disabled',true);
        $('.investone').attr('readonly','readonly');
        $('.investone').attr('readonly','readonly');
        exit()
    }
    var regdate=$('#regdate').val();
    var regdate1=$('#regdate1').val();
    if(regdate < regdate1)
    {
        alert('Please Select A Valid Date');
        exit();
    }
    var wamt=$('#wamt').val();
    var ramt=$('#ramt').val();
    var asign=$('#asign').val();
    var pday=$('#pday').val();
    var pmonth=$('#pmonth').val();

    // if(full1 == ''){alert("Search Name For Widraw");exit();}
    // if(investid == ''){alert("Select Invest Amount");exit();}
    // if(investid == ''){alert("Select Invest Amount");exit();}
    // if(regdate == ''){alert("Select Widraw Date");exit();}
    // if(wamt == '' || wamt == 0){alert("Add Widraw Amount");exit();}
    // if(asign == ''){alert("Asign Percentage");exit();}
    
    if(wamt=='' || wamt==0)
    {
        $('#wamtlable').html(`<span style='color:red'>Add Widraw Amount..</span>`);
        exit();
    }
    else if(asign=='')
    {
        
        $('#asignlable').html(`<span style='color:red'>Select Asign Value..</span>`);
        exit();
    }else
    {
        log = $.ajax({
            url: 'ajax/widrawInsert.php',
            type: "POST",
            data: {
                investid : investid,
                full1 : full1,
                regdate : regdate,
                wamt : wamt,
                ramt : ramt,
                asign : asign,
                pday : pday,
                pmonth : pmonth
            },success: function(data) {
                alert(data);
                 searchfull()
                // $('#full1').val('');
                // $('#full').val('');
                $('#regdate').val('');
                $('#regdate1').val('');
                $('#amt').val('');
                $('#wamt').val('');
                $('#ramt').val('');
                $('#asign').val('');
                $('#pday').val('');
                $('#pmonth').val('');
                $('#investedamt').html(`<span style='color:green'>Invested Amount..</span>`);
            }
        });
    }
     

}