setTimeout(function() { $(".alert").hide('slow'); }, 3000);

$(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
        // 'order'       : [[1, "desc"]], //[[1, "asc"]]
        'columnDefs'  : [{"type": "html-num-fmt", "targets": 1}],
        'paging'      : true,
        "pageLength": 50,
        'lengthChange': false,
        'searching'   : false,
        'ordering'    : false,
        'info'        : true,
        'autoWidth'   : false,
        'responsive'  : true,
        "language": {
            "info": "Показаны с _START_ по _END_ записи из _TOTAL_",
            "paginate": {
                "next": "Следующая",
                "previous": "Предыдущая"
            }
        },
    })
});

/* select from or to */

var fromCities = new Bloodhound({
    datumTokenizer: Bloodhound.tokenizers.whitespace,
    queryTokenizer: Bloodhound.tokenizers.whitespace,
    remote: {
        wildcard: '%QUERY',
        url: path + '/main/tfrom?query=%QUERY'
    }
});

fromCities.initialize();

$("#tfrom").typeahead({
    // hint: false,
    highlight: true
},{
    name: 'fromCities',
    display: 'tfrom',
    limit: 10,
    source: fromCities
});

var toCities = new Bloodhound({
    datumTokenizer: Bloodhound.tokenizers.whitespace,
    queryTokenizer: Bloodhound.tokenizers.whitespace,
    remote: {
        wildcard: '%QUERY',
        url: path + '/main/tto?query=%QUERY'
    }
});

toCities.initialize();

$("#tto").typeahead({
    // hint: false,
    highlight: true
},{
    name: 'toCities',
    display: 'tto',
    limit: 10,
    source: toCities
});

// url: 'https://api.vk.com/method/database.getCities?%QUERY&country_id=1&access_token=6f0f79526f0f79526f0f79522b6f7f5aaa66f0f6f0f7952316c06c33b4f3a04dc90af72&v=5.103'


$('.disabled').click(function () {
    alert('Данные раздел в разработке!');
    return false;
});

function randColor() {
    var r = Math.floor(Math.random() * (256)),
        g = Math.floor(Math.random() * (256)),
        b = Math.floor(Math.random() * (256));
    return '#' + r.toString(16) + g.toString(16) + b.toString(16);
}

// if (obj){
//     //-------------
// //- PIE CHART -
// //-------------
// // Get context with jQuery - using jQuery's .get() method.
//     var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
//     var pieChart       = new Chart(pieChartCanvas)
//
//     var company = "{";
//
//     $.each( obj, function( key, value ) {
//         var col = randColor();
//         company += '"' + key + '"' + ':{"value":' + value.countShip + ', "color": "' + col + '", "highlight": "' + col + '", "label": "' + value.name.replace(/"([^"]*)"/g, '«$1»') + '"}';
//         if (key != obj.length-1) company += ',';
//     });
//
//     company += "}";
//
//     var PieData = JSON.parse(company);
//     var pieOptions     = {
//         //Boolean - Whether we should show a stroke on each segment
//         segmentShowStroke    : true,
//         //String - The colour of each segment stroke
//         segmentStrokeColor   : '#fff',
//         //Number - The width of each segment stroke
//         segmentStrokeWidth   : 2,
//         //Number - The percentage of the chart that we cut out of the middle
//         percentageInnerCutout: 50, // This is 0 for Pie charts
//         //Number - Amount of animation steps
//         animationSteps       : 100,
//         //String - Animation easing effect
//         animationEasing      : 'easeOutBounce',
//         //Boolean - Whether we animate the rotation of the Doughnut
//         animateRotate        : true,
//         //Boolean - Whether we animate scaling the Doughnut from the centre
//         animateScale         : false,
//         //Boolean - whether to make the chart responsive to window resizing
//         responsive           : true,
//         // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
//         maintainAspectRatio  : true,
//         //String - A legend template
//         legendTemplate       : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<segments.length; i++){%><li><span style="background-color:<%=segments[i].fillColor%>"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>'
//     }
// //Create pie or douhnut chart
// // You can switch between pie and douhnut using the method below.
//     pieChart.Doughnut(PieData, pieOptions);
// }