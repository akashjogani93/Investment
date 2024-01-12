$(document).ready(function()
{
    google.charts.load('current', {packages: ['corechart', 'bar']});
    google.load('visualization', '1.0', {'packages':['corechart'], 'callback': drawCharts});
    google.charts.setOnLoadCallback(drawCharts);

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
                // console.log(data);
            }
        });
    }
    function drawMonthwiseChart(chart_data, chart_main_title) {
        google.charts.load('current', { packages: ['corechart', 'bar'], language: 'en' }); // Set language to 'en' for English
        var jsonData = chart_data;
        var data = new google.visualization.DataTable();
    
        // Define columns in the DataTable
        data.addColumn('string', 'Month');
        data.addColumn('number', 'Invest');
    
        // Populate rows in the DataTable with numeric profit values
        $.each(jsonData, function (i, jsonData) {
            var month = jsonData.month;
            var profit = parseFloat(jsonData.profit);
    
            // Check if profit is a string before applying replace
            if (typeof jsonData.profit === 'string') {
                profit = parseFloat($.trim(jsonData.profit.replace(/[^\d.-]/g, ''))); // Remove non-numeric characters
            }
    
            // Add row to DataTable
            data.addRows([[month, profit]]);
        });
    
        // Define chart options
        // var options = {
        //     title: 'Investment Data',
        //     hAxis: {title: 'Months', format: 'Rs #,###'},
        //     vAxis: {title: 'Investment Amount'},
        //     tooltip: {text: 'value'},
        //     legend: 'none',
        //     colors: ['#3c8dbc'],
        //     is3D: true,
        //    };
           const options = {
            title: chart_main_title,
            hAxis: { title: "Months"},
            vAxis: { title: "Invest", format: '₹ #,###' },
            tooltip: {
              isHtml: true,
              textStyle: { fontSize: 12 },
            },
         };
        // var options = {
        //     title: chart_main_title,
        //     hAxis: {
        //         title: "Months"
        //     },
        //     vAxis: {
        //         title: 'Investment',
        //         format: (value) => {
        //             return '₹' + new Intl.NumberFormat('en-IN').format(value);
        //         },
        //         textStyle: {
        //             fontSize: 12
        //         }
        //     },
        //     tooltip: {
        //         isHtml: true,
        //         textStyle: {
        //             fontSize: 12
        //         }
        //     }
        // };
    
    
        // Create and draw the ColumnChart
        var chart = new google.visualization.ColumnChart(document.getElementById('chart_area'));
        chart.draw(data, options);
    
        // Set up a listener for 'onmouseover' events to modify the tooltip
        google.visualization.events.addListener(chart, 'onmouseover', function (e) {
            var tooltip = document.querySelector('.google-visualization-tooltip');
            var value = data.getValue(e.row, 1);
            var formattedValue = '₹' + new Intl.NumberFormat('en-IN').format(value);
    
            tooltip.innerHTML = '<div style="padding:10px;">' +
                '<b>' + data.getValue(e.row, 0) + '</b>: ' + formattedValue +
                '</div>';
        });
    }
    
    
    
    
    
    
    

    function drawMonthwiseChart1(chart_data, chart_main_title) {
        var jsonData = chart_data;
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Month');
        data.addColumn('number', 'Withdrawal');
        data.addColumn({type: 'string', role: 'tooltip'});

        if (Array.isArray(jsonData)) {
            jsonData.forEach(function(jsonData) {
                if (typeof jsonData === 'object') {
                    var month = jsonData.month;
                    var profit = parseFloat($.trim(jsonData.profit));
                    var formattedProfit = new Intl.NumberFormat('en-IN').format(profit);
                    data.addRows([[month, profit, formattedProfit]]);
                }
            });
        }

        var options = {
            title: chart_main_title,
            hAxis: {
                title: "Months"
            },
            vAxis: {
                title: 'Withdrawal',
                format: function (value) {
                    console.log(value);
                    return new Intl.NumberFormat('en-IN').format(+value);
                }
            },
            colors: ['red', 'green'],
            is3D: true,
            tooltip: {
                isHtml: true
            }
        };

        var chart1 = new google.visualization.ColumnChart(document.getElementById('chart_area1'));
        chart1.draw(data, options);
        
        // Redraw the chart to call the vAxis.format function
        google.visualization.events.addListener(chart1, 'ready', function () {
            chart1.draw(data, options);
        });
        
    }
});