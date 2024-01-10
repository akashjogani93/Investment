// $(document).ready(function()
// {
//     var app = new Vue({
//         el: '#app',
//         data:{
//             limit:50,
//             start:-50,
//             records: [],
//             isLoading: true,
//             action: 'inactive'
//         },
//         methods:
//         {
//             fetchData()
//             {
//                 const th=this;
//                 var limit=th.limit;
//                 var start=th.start;
//                 var action=th.action;
//                 console.log('ru');
//                 console.log(action);
//                 setInterval(function() 
//                 {
//                     if (action == 'inactive')
//                     {
//                         console.log('set');
//                         th.start = th.start + th.limit;
//                         $(document.body).css({
//                             'cursor': 'not-allowed'
//                         });
//                         th.load_customer_data(th.limit, th.start);
//                     }else
//                     {
//                         console.log('close')
//                         $(document.body).css({
//                             'cursor': 'default'
//                         });
//                     }
//                 }, 300);
//             },
//             load_customer_data(limit,start)
//             {
//                 const th=this;
//                 let log=$.ajax({
//                     url: "ajax/Fetch_data.php",
//                     method: "POST",
//                     data: {
//                         limit: limit,
//                         start: start
//                     },
//                     cache: false,
//                     success: function(data)
//                     {
//                         th.records = th.records.concat(data);
//                         if (data.length != 0)
//                         {
//                             console.log('running');
//                             th.records = th.records.concat(data);
//                             th.action = 'inactive';
//                         } 
//                         else 
//                         {
//                             console.log('working');
//                             th.action = 'active';
//                             th.fetchData();
//                         }
//                     }
//                 });
//             }
//         },
//         mounted: function() 
//         {
//             this.fetchData();
//             // this.apidata()
//         },
//     });
// });

// $(document).ready(function()
// {
//     var limit = 50;
//     var start = -50;
//     var t = "true";
//     var action = 'inactive';

//     console.log('running');
//     function load_customer_data(limit, start) 
//     {
//         // console.log('check');
//         console.log(limit,start)
//         let log=$.ajax({
//             url: "ajax/Fetch_data.php",
//             method: "POST",
//             data: {
//                 limit: limit,
//                 start: start
//             },
//             cache: false,
//             success: function(data) 
//             {
//                 // console.log(data);
//                 $('#mytable1').append(data);

//                 if (data == 0) 
//                 {
//                     action = 'active';
//                     // $('.tfut:last').show();
//                 } else {
//                     action = "inactive";

//                 }
//             }
//         });

//         var myVar = setInterval(function() 
//         {
//             if (action == 'inactive') {
//                 start = start + limit;
//                 $(document.body).css({
//                     'cursor': 'not-allowed'
//                 });
//                 load_customer_data(limit, start);

//             } else {
//                 clearInterval(myVar);
//                 $(document.body).css({
//                     'cursor': 'default'
//                 });
//                 // $('#example thead th').each(function(i) {
//                 //     calculateColumn(i);
//                 // });
//             }
//         }, 300);
//         // console.log(log);
//     }
// });