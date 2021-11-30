$(document).ready(function linegraph(){
  $.ajax({
    url : "http://localhost/chart/exchangedata.php",
    type : "GET",
    success : function(data){
      // console.log(data);

      var price = [];
      var posted = [];

      for(var i in data) {
        price.push(data[i].price);
        posted.push(data[i].posted);
      }

      var chartdata = {
        labels: posted,
        datasets: [
          {
            label: "Vitalium",
            fill: false,
            lineTension: 0.1,
            backgroundColor: "rgba(13, 110, 253, 0.75)",
            borderColor: "rgba(13, 110, 253, 1)",
            pointHoverBackgroundColor: "rgba(13, 110, 253, 1)",
            pointHoverBorderColor: "rgba(13, 110, 253, 1)",
            data: price
          }
        ]
      };

      var ctx = $("#mycanvas");

      var LineGraph = new Chart(ctx, {
        type: 'line',
        data: chartdata,
        options: {
          animation: {
            duration: 0
          }
        }
      });
    },
    error : function(data) {

    }
  }).then(function() {              // on completion, restart
      setTimeout(linegraph, 1000);  // function refers to itself
  });
});
