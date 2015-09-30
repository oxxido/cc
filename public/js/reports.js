if (!cc) var cc = {};

cc.reports = {
    init: function(data)
    {
        //-------------
        //- PIE CHART -
        //-------------

        var PieData = [
          {
            value: data['request_not_open'],
            color: "#f56954",
            highlight: "#f56954",
            label: "Not Responsed"
          },
          {
            value: data['request_open'],
            color: "#00a65a",
            highlight: "#00a65a",            
            label: "Requested and Responsed"
          },
          {
            value: data['unrequested_comment'],
            color: "#00c0ef",
            highlight: "#00c0ef",
            label: "Responsed Without Request"
          }
        ];

        //var pieChartCanvas = $("#pieChart").get(0).getContext("2d");
        var pieChartCanvas = document.getElementById("pieChart").getContext("2d");
        var pieChart = new Chart(pieChartCanvas);
        
        var pieOptions = {
          //Boolean - Whether we should show a stroke on each segment
          segmentShowStroke: true,
          //String - The colour of each segment stroke
          segmentStrokeColor: "#fff",
          //Number - The width of each segment stroke
          segmentStrokeWidth: 2,
          //Number - The percentage of the chart that we cut out of the middle
          percentageInnerCutout: 50, // This is 0 for Pie charts
          //Number - Amount of animation steps
          animationSteps: 100,
          //String - Animation easing effect
          animationEasing: "easeOutBounce",
          //Boolean - Whether we animate the rotation of the Doughnut
          animateRotate: true,
          //Boolean - Whether we animate scaling the Doughnut from the centre
          animateScale: false,
          //Boolean - whether to make the chart responsive to window resizing
          responsive: true,
          // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
          maintainAspectRatio: true,
          //String - A legend template
          legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>"
        };
        //Create pie or douhnut chart
        // You can switch between pie and douhnut using the method below.
        pieChart.Doughnut(PieData, pieOptions);

        //-------------
        //- BAR CHART -
        //-------------
        var monthNames = ["January", "February", "March", "April", "May", "June",
                          "July", "August", "September", "October", "November", "December"
                         ];
        var month = new Date().getMonth();

        var areaChartData = {
          labels: [monthNames[month-6], monthNames[month-5], monthNames[month-4], monthNames[month-3], monthNames[month-2], monthNames[month-1], monthNames[month]],
          datasets: [
            {
              label: "Positive",
              //fillColor: "rgba(210, 214, 222, 1)",
              fillColor: "#3c8dbc",
              strokeColor: "rgba(210, 214, 222, 1)",
              pointColor: "rgba(210, 214, 222, 1)",
              pointStrokeColor: "#c1c7d1",
              pointHighlightFill: "#fff",
              pointHighlightStroke: "rgba(220,220,220,1)",
              data: [0, 0, 0, 0, 0, 0, data['positive_comments']]
            },
            {
              label: "Negative",
              fillColor: "rgba(60,141,188,0.9)",
              strokeColor: "rgba(60,141,188,0.8)",
              pointColor: "#3b8bba",
              pointStrokeColor: "rgba(60,141,188,1)",
              pointHighlightFill: "#fff",
              pointHighlightStroke: "rgba(60,141,188,1)",
              data: [0, 0, 0, 0, 0, 0, data['negative_comments']]
            }
          ]
        };

        //var barChartCanvas = $("#barChart").get(0).getContext("2d");
        var barChartCanvas = document.getElementById("barChart").getContext("2d");
        var barChart = new Chart(barChartCanvas);
        var barChartData = areaChartData;
        barChartData.datasets[1].fillColor = "#f56954";
        barChartData.datasets[1].strokeColor = "rgba(210, 214, 222, 1)";
        barChartData.datasets[1].pointColor = "rgba(210, 214, 222, 1)";
        var barChartOptions = {
          //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
          scaleBeginAtZero: true,
          //Boolean - Whether grid lines are shown across the chart
          scaleShowGridLines: true,
          //String - Colour of the grid lines
          scaleGridLineColor: "rgba(0,0,0,.05)",
          //Number - Width of the grid lines
          scaleGridLineWidth: 1,
          //Boolean - Whether to show horizontal lines (except X axis)
          scaleShowHorizontalLines: true,
          //Boolean - Whether to show vertical lines (except Y axis)
          scaleShowVerticalLines: true,
          //Boolean - If there is a stroke on each bar
          barShowStroke: true,
          //Number - Pixel width of the bar stroke
          barStrokeWidth: 2,
          //Number - Spacing between each of the X value sets
          barValueSpacing: 5,
          //Number - Spacing between data sets within X values
          barDatasetSpacing: 1,
          //String - A legend template
          legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
          //Boolean - whether to make the chart responsive
          responsive: true,
          maintainAspectRatio: true
        };

        barChartOptions.datasetFill = false;
        barChart.Bar(barChartData, barChartOptions);
    },
}
