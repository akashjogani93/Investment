<script>
    var de='';
    var in_id= "<?php echo $_GET['cid']; ?>";
    
    //alert(in_id);
    let log = $.ajax({
        url: 'ajax/editInvestment.php',
        type: "POST",
        dataType: 'json',
        data: {
            in_id : in_id,
        },
        success: function(data)
        {
            $("#in_id").val(in_id);
            $("#full").val(data[0].full);
            $("#full1").val(data[0].cid);
            $("#bank").val(data[0].bank);
            $("#acc").val(data[0].account);
            $("#mobile").val(data[0].mobile);
            $("#invest").val(data[0].invest);
            $("#asign").val(data[0].asign);
            $("#pday").val(data[0].pday);
            $("#pmonth").val(data[0].pmonth);
            $("#regdate").val(data[0].regdate);
            $("#pmode").val(data[0].pmode);
            de=data[0].img;
            console.log(log)
            referals();
            
            
        }
        
        //console.log(log)
    });
    function referals()
    {
        //alert('hii');
        var log1=$.ajax({
            url: 'ajax/editInvestment.php',
            type: "POST",
            dataType: 'json',
            data: {
                in_id_referal : in_id,
            },
            success: function(data)
            {
                //dd=data[0].refpday;
                //console.log(log1)
                data.map((item,i)=>{
                    $('#show').after(`<div class="row"> 
                        <div class="group-form col-md-4">
                            <label for="inputEmail3" class="form_label">Search Referal:</label>
                                <input type="text" class=" col-sm-4 form-control form-control-sm referal" name="referal[]" id="referal"
                                    placeholder="Search Referal" value="${item.full}">
                                <input type="hidden" name="referal1[]" id="referal1" class="referal1" value="${item.cid}">

                        </div>
                        <div class="group-form col-md-2">
                            <label for="inputEmail3" class="form_label">Asign %:</label>
                                <input type="text" class=" col-sm-4 form-control form-control-sm asignke" name="refAsign[]" id="refAsign[]"
                                    placeholder="Asign %" value="${item.refasign}">

                            
                        </div>
                        <div class="group-form col-md-2">
                            <label for="inputEmail3" class="form_label">Per Day:</label>
                                <input type="text" class=" col-sm-4 form-control form-control-sm perkey" readonly name="refpday[]" id="refpday[]"
                                    placeholder="Per Day Amount" value="${item.refpday}">

                            
                        </div>
                        <div class="group-form col-md-2">
                            <label for="inputEmail3" class="form_label">Per Month:</label>
                                <input type="text" class=" col-sm-4 form-control form-control-sm permkeys" readonly name="refpmonth[]" id="refpmonth[]"
                                    placeholder="Per Mounth Amount" value="${item.refpmonth}">
                        </div>
                        <div class="group-form col-md-2">
                            
                            <a class="col-sm-4 btn btn-sm form-control form-control-sm btn-danger remove" style="margin-top:20px;">Remove</a>
                        </div>
                        
                    </div>`);
                });
            }
           
        });
        //
    }
    

    function picture()
    { 
        if(de !='')
        {
            var pic = de.slice(3);
            $('#dow').show();
            $(".item a[href='#']").prop("href", pic);
            document.getElementById('bigpic').src = pic.replace();
        }else
        {
            alert("No Photo Uploaded..");
            exit();
        }
    }
    function view()
    {
        // alert('hii');
        window.open(de)
    }
</script>

<script>
    $(document).on('keyup', '.asignke', function(e)
    {
        // /alert('hii');
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
</script>