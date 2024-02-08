$(document).ready(function()
{
    //Add more referals
    var yourDateValue = new Date();
    var formattedDate = yourDateValue.toISOString().substr(0, 10)
    $('#regdate').val(formattedDate);

    $('.add_more').click(function (e)
    {
        e.preventDefault();
        $('#show').after(`<div class="row">  
                        <div class="group-form col-md-4">
                            <label for="inputEmail3" class="form_label">Search Referal:</label>
                                <input type="text" class=" col-sm-4 form-control form-control-sm referal" name="referal[]" id="referal"
                                    placeholder="Search Referal">
                                <input type="hidden" name="referal1[]" id="referal1" class="referal1">

                        </div>
                        <div class="group-form col-md-2">
                            <label for="inputEmail3" class="form_label">Asign %:</label>
                                <select class="form-control form-control-sm asignke" name="refAsign[]" id="refAsign[]">
                                    <option value="">Select %</option>
                                    <option>0</option>
                                    <option>0.5</option>
                                    <option>0.6</option>
                                    <option>0.7</option>
                                    <option>0.8</option>
                                    <option>0.9</option>
                                    <option>1.0</option>
                                    <option>1.5</option>
                                <select>
                        </div>
                        <div class="group-form col-md-2">
                            <label for="inputEmail3" class="form_label">Per Day:</label>
                                <input type="text" class=" col-sm-4 form-control form-control-sm perkey" readonly name="refpday[]" id="refpday[]"
                                    placeholder="Per Day Amount">

                            
                        </div>
                        <div class="group-form col-md-2">
                            <label for="inputEmail3" class="form_label">Per Month:</label>
                                <input type="text" class=" col-sm-4 form-control form-control-sm permkeys" readonly name="refpmonth[]" id="refpmonth[]"
                                    placeholder="Per Mounth Amount">
                        </div>
                        <div class="group-form col-md-2">
                            <a class="col-sm-4 btn btn-sm form-control form-control-sm btn-danger remove" style="margin-top:20px;">Remove</a>
                        </div>
                        
                    </div>`);
                    
    });

    //remove button click
    $(document).on('click', '.remove', function(e) {
        e.preventDefault();
        let row_item = $(this).parent().parent();
        $(row_item).remove();
    });

    //invest to only number And Asign Only Numbers
    $('.investOne').keypress(function(event)
    {
        acc =$('#acc').val();
        if(acc=='')
        {
            $('#search_name').html(`<span style='color:red'>First Search Customer..</span>`);
            $('#sub').prop('disabled',true);
            $('#invest').attr('readonly','readonly');
            $('#asign').attr('readonly','readonly');
        }
        //alert(acc);removeAttr
        var keycode = (event.keyCode ? event.keyCode : event.which);
        // alert(keycode);
        if ((keycode < 46 || keycode > 57))
        return false;
        
        return true;
    });

    //invest to only number And Asign Only Numbers
    $('.asignke').keypress(function(event)
    // $('.asignke').on('change',function(event)
    {
        console.log('working');
        acc =$('#acc').val();
        if(acc=='')
        {
            $('#search_name').html(`<span style='color:red'>First Search Customer..</span>`);
            $('#sub').prop('disabled',true);
            $('#invest').attr('readonly','readonly');
            $('#asign').attr('readonly','readonly');
        }
        //alert(acc);removeAttr
        var keycode = (event.keyCode ? event.keyCode : event.which);
        // alert(keycode);
        if ((keycode < 46 || keycode > 57))
        return false;
        
        return true;
    
    });

    //Search Name Autocomplete only in text
    $('.full').keypress(function(event)
    {
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if ((keycode < 48 || keycode > 57))
        return true;
        
        return false;

    });

    //asign to change per month and per day calculation
    // $('#asign').keyup(function(){
        // var invest = $('#invest').val();
        // var asign = $('#asign').val();
        
        // var calc=(invest/100)*asign;
        // var calx=calc/30;
        // $('#pmonth').val(calc.toFixed(2)); 
        // $('#pday').val(calx.toFixed(2)); 

    // });

    $('#asign').on('change',function()
    {
        var invest = parseFloat($('#invest').val());
        var asign = parseFloat($('#asign').val());
        
        var calc=(invest/100)*asign;
        var calx=calc/30;
        $('#pmonth').val(calc.toFixed(2)); 
        $('#pday').val(calx.toFixed(2));
    });

    //asign to change per month and per day calculation bye referals
    $(document).on('change', '.asignke', function(e)
    {
        let asignke = $(this).val();
        let invest = $('#invest').val();

        var cal=(invest/100)*asignke;
        //console.log(cal);
        
        let permkeys = $(this).parent().parent().find('.permkeys');
        $(permkeys).val(cal.toFixed(0));
        //console.log(permkeys);
        let perkey = $(this).parent().parent().find('.perkey');
        var cax=cal/30;
        //console.log(cax);
        $(perkey).val(cax.toFixed(0));

    });

    //submit button to submit code
    $("#form").on('submit',(function(e)
    {
        e.preventDefault();

        var button = $("#sub");
            button.text("Submitting");
            button.prop("disabled", true);
        var cid = $('#full1').val();
        // get all referals
        var vals = [];
        let i = 0;
        //get all referals
        $('.referal1').each(function(index, item)
        {
            vals[i] = [];
            let asignke = $(item).parent().parent().find('.asignke').val();
            let perkey = $(item).parent().parent().find('.perkey').val();
            let permkeys = $(item).parent().parent().find('.permkeys').val();
            vals[i].push(item.value);
            vals[i].push(asignke);
            vals[i].push(perkey);
            vals[i].push(permkeys);
            i++;
        });
        if(cid=='')
        {
            alert('Please Select Customer')
            return;
        }else
        {
            var formData = new FormData(this);
            formData.append('full1', cid);
        }
        let log = $.ajax({
            url: 'ajax/introduceReferal.php',
            type: "POST",
            datatype: 'Json',
            data: formData,
            contentType: false,
            cache: false,
            processData:false,
            
            success: function(data)
            {
                let datatrim = data.trim();
                let log1 = $.ajax({
                    url: 'ajax/introduceReferal1.php',
                    type: "POST",
                    data: {
                        data: datatrim,
                        referals : vals
                    },
                    success: function(response) 
                    {
                        alert(response)
                        button.text("Submit");
                        button.prop("disabled", false);
                        $('#full').val('');
                        $('#full1').val('');
                        $('#invest').val('');
                        $('#asign').val('');
                        $('#pday').val('');
                        $('#pmonth').val('');
                        $('#bank').val('');
                        $('#acc').val('');
                        $('#mobile').val('');
                        $('.remove:not(:first)').parent().parent().remove();
                        $('.referal').val('');
                        $('.referal1').val('');
                        $('.asignke').val('');
                        $('.perkey').val('');
                        $('.addonTot').val('');
                        $('.permkeys').val('');
                        $('#pmode').val('');
                        $('#screen').val('');
                    }
                });
                // console.log(log1);
            }
        });
        // console.log(log)
    }));
    $(document).on('focus','.referal',handleAuctocomplet);
});

function searchfull()
{
    var cid = $('#full1').val();
    let log = $.ajax({
        url: 'ajax/investSearchDetail.php',
        type: "POST",
        dataType: 'json',
        data: {
            cid: cid,
        },
        success: function(data) {
            $("#bank").val(data[0].bank);
            $("#acc").val(data[0].account);
            $("#mobile").val(data[0].mobile);

            //after search button to remove attribute readonly
            $('#search_name').html(`<span style='color:green'>Customer Name..</span>`);
            $('#sub').prop('disabled',false);
            $('#invest').removeAttr('readonly','readonly');
            $('#asign').removeAttr('readonly','readonly');
            
        }
    });
    // console.log(log);
}

$("#full1").keyup(function()
{
    var x = $(this).val();
    if(x != '')
    {
        $.ajax({
            url:"search.php",
            method : "POST",
            data :{queryformcid : x },
            success : function(status)
            {
                $('#inputZip1').val(status);
                if(status.trim()=="0")
                {
                    x = x.slice(0, -1);
                    $('#full1').val('');
                    $('#inputZip1').val('');
                    alert('Id Not Regestered');
                }
                // $('#list').fadeIn();
                // $('#list').html(data);
            }
        });
    }
    else
    {
        $('#inputZip1').val('');
        // $('#list').html("");
    }
});

//image click trigger
function image_select()
{
    $('#screen').trigger('click');
}

//read and fetch image
function readURL(input)
{
    if(input.files && input.files[0])
    {
        var size=input.files[0].size;
        // alert(size);
        if(size < 2097152)
        {
            var reader =new FileReader();
            reader.onload=function(e){
            $('#img1').attr('src',e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }else
        {
            // alert("Max size");
            $("#screen").val('');
            // var img=$("#screen").val();
            // alert(img);
        }
    }
}

//autocomplete referals
function handleAuctocomplet()
{
    var currentEle;
    
    currentEle=$(this);
    let log = $(currentEle).autocomplete({
        source: 'investment_referalName.php',
        focus: function (event, ui) {
            event.preventDefault();
            $($(this)).val(ui.item.label);
        },
        select: function (event, ui) {
            event.preventDefault();
            $($(this)).val(ui.item.value);
            $($(this)).val(ui.item.label);

            let referal1 = $(this).parent().parent().find('.referal1');
            $(referal1).val(ui.item.value);
            console.log(referal1);
            
    }
    });
}

//autocomplete names
$(function() {
                
    $(".full").autocomplete({

        source: 'investment_searchName.php',
        focus: function (event, ui) {
            event.preventDefault();
            $("#full").val(ui.item.label);
        },
        select: function (event, ui) {
            event.preventDefault();
            $("#full1").val(ui.item.value);
            $("#full").val(ui.item.label);
    }
        
    }); 
});


        //Single Investment page 
        function searchfullsingle()
        {
            var table1=$('#example1').DataTable();
            table1.destroy();
            var oTable;
            var full1=$('#full1').val();

            let log = $.ajax({
                url: 'ajax/load_singleInvestData.php',
                type: "POST",
                dataType: 'json',
                data: {
                    full1: full1,
                },
                success:function(data) 
                {
                    $('.mytable').html(data);
                        oTable = $('#example1').dataTable({
                            searching: false,
                            pageLength : 10,
                            aLengthMenu: [
                            [10, 25, 50, 100, -1],
                            [10, 25, 50, 100, "All"]
                            ],
                            iDisplayLength: -1
                        });  
                    //console.log(data);
                }
            });
            searchfull1()
            totalinterest()
            // console.log(log)
        }
        function searchfull1()
        {
            var table1=$('#example2').DataTable();
            table1.destroy(); 
            var oTable;
            var full1=$('#full1').val();
            // console.log(full1);

            let log = $.ajax({
                url: 'ajax/load_singleReferalData.php',
                type: "POST",
                dataType: 'json',
                data: {
                    full1: full1,
                },
                success:function(data) 
                {
                    //  $('.loader').fadeIn();
                    $('.mytable1').html(data);
                    //  $('.loader').fadeOut();
                    oTable = $('#example2').dataTable({
                            searching: false,
                            pageLength : 10,
                            aLengthMenu: [
                            [10, 25, 50, 100, -1],
                            [10, 25, 50, 100, "All"]
                            ],
                            iDisplayLength: -1
                        });
                    
                    // console.log(data);
                }
            });
            console.log(log)
        }
        function totalinterest()
        {
            var full1=$('#full1').val();
            let log = $.ajax({
                url: 'ajax/totalinterest.php',
                type: "POST",
                dataType: 'json',
                data: {
                    full1: full1,
                },
                success:function(data) 
                {
                    // $('.dis_loader').fadeOut();
                    // $('#totalmonth').html(Math.round(data[0]));
                    // $('#totalinvest').html(Math.round(data[1]).toFixed(2));
                    // $('#totaint').html(Math.round(data[2]).toFixed(2));
                    // $('#refmonth').html(Math.round(data[3]).toFixed(2));
                    // $('#refint').html(Math.round(data[4]).toFixed(2));
                    // $('#refamount').html(Math.round(data[5]).toFixed(2));
                    // $('#totalint').val(Math.round(data[6]).toFixed(2));
                    // $('#regdate1').val(Math.round(data[7]).toFixed(2));
                    $('#totalmonth').html(Math.round(data[0]).toLocaleString('en-IN', { minimumFractionDigits: 2 }));
                    $('#totalinvest').html(Math.round(data[1]).toLocaleString('en-IN', { minimumFractionDigits: 2 }));
                    $('#totaint').html(Math.round(data[2]).toLocaleString('en-IN', { minimumFractionDigits: 2 }));
                    $('#refmonth').html(Math.round(data[3]).toLocaleString('en-IN', { minimumFractionDigits: 2 }));
                    $('#refint').html(Math.round(data[4]).toLocaleString('en-IN', { minimumFractionDigits: 2 }));
                    $('#refamount').html(Math.round(data[5]).toLocaleString('en-IN', { minimumFractionDigits: 2 }));
                    $('#totalint').val(Math.round(data[6]).toLocaleString('en-IN', { minimumFractionDigits: 2 }));
                    $('#regdate1').val(Math.round(data[7]).toLocaleString('en-IN', { minimumFractionDigits: 2 }));


                }
            });
            // console.log(log);
        }