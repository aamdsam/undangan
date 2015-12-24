<script src="js/jquery.min.js"></script>
<script src="js/highcharts.js"></script>

<script>
/**
 * Request data from the server, add it to the graph and set a timeout to request again
 */
var chart; // global
function requestData() {
$.ajax({
    url: 'datacenter.php',
    success: function(point) {
        var series = chart.series[0],
            shift = series.data.length > 20; // shift if the series is longer than 20

        // add the point
        chart.series[0].addPoint(point, true, shift);

        // call it again after one second
        setTimeout(requestData, 1000);    
    },
    cache: true
   });
 }
 
 $(document).ready(function() {
 Highcharts.setOptions({
            global: {
                useUTC: false 
            },
	   lang: {
			numericSymbols: null		 }
        }); 
  chart = new Highcharts.Chart({
      chart: {
        renderTo: 'container',
        defaultSeriesType: 'spline',
        marginRight: 10,
	height:235,
	

	events: {
            load: requestData
        }
    },
    title: {
        text: 'Data Samsat'
    },
	lang:{
		numericSymbols: null
},
    xAxis: {
        type: 'datetime',
        tickPixelInterval: 100,
        maxZoom: 20 * 1000
    },
     legend: {
                    enabled: false
                },
                exporting: {
                    enabled: false
                },
 

    yAxis: {
        minPadding: 0.2,
        maxPadding: 0.2,
        title: {
           
            text:'Value' 
        },
		plotLines:[{
		value :884551000,
		color :'red',
		dashstyle:'Dot',
		width:2,
		label:{text:'end'}
		}]
    },
	style: {
        cursor: 'pointer',
        color: '#909090',
        fontSize: '10px',
        backgroundImage: 'url("globe.jpg")'
    } ,  
	
    series: [{
       name: 'Random data',
       color: '#058DC7',
       shadow: false,
        data: [],
		tooltip:{valueDecimal:500}
     }]
   });        
});
  </script>
      <div id="container" >
    </div>
