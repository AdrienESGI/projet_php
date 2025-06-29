
var jsonfile = {
    "jsonarray": 
    [
        {"time": 100,
         "temp": 12,
         "humi": 85},
        {"time": 123,
         "temp": 14,
         "humi": 86},
        {"time": 140,
         "temp": 16,
         "humi": 87},
        {"time": 153,
         "temp": 18,
         "humi": 86},
        {"time": 170,
         "temp": 20,
         "humi": 85},
        {"time": 183,
         "temp": 19,
         "humi": 86},
        {"time": 200,
         "temp": 17,
         "humi": 87},
        {"time": 230,
         "temp": 15,
         "humi": 88} 
    ]
 };
 
 var labels = jsonfile.jsonarray.map(function(e) {
    return e.time;
 });
 var datatemp = jsonfile.jsonarray.map(function(e) {
    return e.temp;
 });
 var datahumi = jsonfile.jsonarray.map(function(e) {
    return e.humi;
 });

new Chart("myChart", {
  type: "line",
  data: {
    labels: labels,
    datasets: [{ 
      data: datatemp,
      borderColor: "yellow",
      fill: false,
      yAxisID: 'first-y-axis',
    },
    { 
        data: datahumi,
        borderColor: 'red',
        fill: false,
        yAxisID: 'second-y-axis'
      }
 ]
  },
  options: {
    plugins:{
      legend:{  
          display: 'true',
          color: 'white',
          text: 'hallo',
          labels:{
            color: 'yellow',
            text: 'hallo'
          }
        },
    },
    scales: {
        'first-y-axis':{
            position: 'left',
            'title':{
              display: 'true',
              color: 'white',
              text: 'Temperature [C]'
            },
            ticks:{
              color: 'white'
            },
        },
        'second-y-axis':{
           position: 'right',
           grid:{
             color: 'white',
             borderColor: 'white',
             borderWidth: 1
            },
            'title':{
              display: 'true',
              color: 'white',
              text: 'Humidity [%]'
            },
            max: 110,
            min: 80,
            ticks: {
              stepSize: 5,
              color: 'white'
            }
        },      
        'x': {
          'ticks':{
            color: 'white',
            text:'time',
            display: 'true'
          },
          'title':{
            color: 'white',
            text:'time',
            display: 'true'
          }
        }
      
    }
  }
});