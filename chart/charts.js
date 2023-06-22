$(document).ready(function()
{
    google.charts.load('current', {packages: ['corechart', 'bar']});
    google.load('visualization', '1.0', {'packages':['corechart'], 'callback': drawCharts});
    google.charts.setOnLoadCallback();

    function drawCharts()
    {
        var year = $('#year').val();
        load_monthwise_data(year, 'Month Wise Investment Data For', 'Month Wise Withdrawal Data For');
    }

    $('#year').change(function()
    {
        var year = $(this).val();
        if(year != '')
        {
            load_monthwise_data(year, 'Month Wise Investment Data For' ,'Month Wise Withdrawal Data For');
        }
    });

    function load_monthwise_data(year, title, widra)
    {
        
        var temp_title = title + ' '+year+'';
        var widra_title = widra + ' '+year+'';
        $.ajax({
            url:"chart/fetch.php",
            method:"POST",
            data:{year:year},
            dataType:"JSON",
            success:function(data)
            {
                drawMonthwiseChart(data, temp_title);
            }
        });
        
        let log=$.ajax({
            url:"chart/fetch.php",
            method:"POST",
            data:{year1:year},
            dataType:"JSON",
            success:function(data)
            {
                drawMonthwiseChart1(data, widra_title);
                console.log(data);
            }
        });
    }
    function drawMonthwiseChart(chart_data, chart_main_title)
    {
        google.charts.load('current', {packages: ['corechart', 'bar']});
        var jsonData = chart_data;
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Month');
        data.addColumn('number', 'Invest');
        $.each(jsonData, function(i, jsonData)
        {
            var month = jsonData.month;
            var profit = parseFloat($.trim(jsonData.profit));
            data.addRows([[month, profit]]);
        });

        var options = {
            title:chart_main_title,
            hAxis: {
                title: "Months"
            },
            vAxis: {
                title: 'Investment'
            }
        };
        var chart = new google.visualization.ColumnChart(document.getElementById('chart_area'));
        chart.draw(data, options);
    }

    function drawMonthwiseChart1(chart_data, chart_main_title)
    {
        
        var jsonData = chart_data;
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Month');
        data.addColumn('number', 'Withdra');
        $.each(jsonData, function(i, jsonData)
        {
            var month = jsonData.month;
            var profit = parseFloat($.trim(jsonData.profit));
            data.addRows([[month, profit]]);
        });

        var options = {
            title:chart_main_title,
            hAxis: {
                title: "Months"
            },
            vAxis: {
                title: 'Withdrawal'
            },
            colors: ['red','green'],
            is3D:true

        };
        var chart1 = new google.visualization.ColumnChart(document.getElementById('chart_area1'));
        chart1.draw(data, options);
    }
});