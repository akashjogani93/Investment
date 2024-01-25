<style>
    #list{ max-height: 200px;
                overflow-y: auto;
            }
    #list ul{background-color: #eee;  cursor: pointer;  }
    #list li{ color: black; font: 12pt; padding: 8px;}
    #list li:hover{ color: white;  background-color: #b3b3ff;}
</style>

<script>
    $(document).ready(function()
    {
        $("#inputZip1").keyup(function()
        {
            var x = $(this).val();
                if(x != '')
                {
                    $.ajax({
                        url:"search.php",
                        method : "POST",
                        data :{query : x },
                        success : function(data)
                        {
                            // console.log(data);
                            $('#list').fadeIn();
                            $('#list').html(data);
                        }
                    });
                }
                else
                {
                    $('#list').html("");
                }
                
                $(document).on('click','#lii',function()
                {
                    $('#inputZip1').val($(this).text());
                    $('#full1').val($(this).data('cid')); // Set the cid value
                    $('#list').fadeOut();
                });
        });
    });
</script>
            