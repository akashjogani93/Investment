$(document).ready(function()
{
    $(".pan").change(function () {      
        const emailInput = document.getElementById('pan');
        var inputvalues = $(this).val(); 
        var reg = /([A-Z]){5}([0-9]){4}([A-Z]){1}$/;
        if (inputvalues.match(reg)) { 
                $('#sub').prop('disabled',false);   
                emailInput.style.borderColor = '';
                $('#pan_valid').html(``);
                return true;    
            }
        else {    
                emailInput.style.borderColor = 'red';
                $('#sub').prop('disabled',true);
                $('#pan_valid').html(`<span style='color:red'>Pan Number Not Valid</span>`);
                return false;    
            }    
        });

        

        $(".ifsc").change(function () {      
            var inputvalues = $(this).val();
            const ifsc = document.getElementById('ifsc');      
            var reg = /[A-Z|a-z]{4}[0][a-zA-Z0-9]{6}$/;    
            if (inputvalues.match(reg)) 
            {
                $('#sub').prop('disabled',false);  
                ifsc.style.borderColor = '';
                $('#ifsc_valid').html(``);                 
                return true;    
            }    
            else {    
                    ifsc.style.borderColor = 'red';
                    $('#sub').prop('disabled',true);
                    $('#ifsc_valid').html(`<span style='color:red'>IFSC Number Not Valid</span>`);
                    return false;      
                }    
            }); 

            
            $('#lname , #nom , #rel , #fname , #mname').keypress(function(event){
	
                var keycode = (event.keyCode ? event.keyCode : event.which);
                if ((keycode < 48 || keycode > 57))
                return true;

                return false;
            
            });
            


    $("#mobile").keyup(function()
    { 
        let mob=$("#mobile").val();
        $("#username").val(mob);
        if(mob.length < 10 )
        {
            $('#lab_mob').html(`<span style='color:red'>Mobile Number Not Valid..</span>`);
            $('#sub').prop('disabled',true);
        }else
        {
            var inputString = mob.toString();
            var areDigitsSame = inputString.split('').every(function(digit)
            {
                return digit === inputString[0];
            });
            if(areDigitsSame)
            {
                $('#lab_mob').html(`<span style='color:red'>Mobile Number Not Valid..</span>`);
                $('#sub').prop('disabled',true);
            }else
            {
                $('#lab_mob').html(`<span style='color:green'>Mobile Number is Valid</span>`);
                $('#sub').prop('disabled',false);
            }
        }
    });


    $("#fname").blur(function()
    { 
        let fname=$("#fname").val();
        let trimmedStr = fname.replace(/\s+/g, '');
        $("#password").val(trimmedStr+Math.floor (1000 + Math.random () * 9000));
    });
});

$(document).ready( function() {
    var yourDateValue = new Date();
    var formattedDate = yourDateValue.toISOString().substr(0, 10)
    $('#regdate').val(formattedDate);
});
         
function isNumberKey(evt)
{
    var charCode = (evt.which) ? evt.which : event.keyCode;
    if ((charCode < 48 || charCode > 57))
    return false;

    return true;        
}
    

function checku()
{
    let acc=$("#acc").val();
    var acc1=acc.length;
    if(acc1>=10)
    {
        jQuery.ajax({
            url:'ajax/accnum.php',
            data:{'acc':acc},
            type:"POST",
            success:function(data){
                $("#msg").html(data);
            },
            error:function(){}
        
        });
    }else
    {   
        $("#msg").html('<p class="text-danger">Account Number Must be Greater 10 digits</p>');
    }
   
}
