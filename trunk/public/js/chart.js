$(document).ready(function() {
    //draw_band_chart();
    //draw_album_chart();
    // draw_song_chart();
    $('#popup').hide();
   
    $('#blanket').click(function(event){
        $('#blanket').hide();
        $('#popup #pie_chart, #popup #bar_chart').html("");
        $('#popup').hide();
    })
   
    $('a#song_graph').click(function(event){
        event.preventDefault(event);
        draw_song_chart();
    })
    $('a#by_date_graph').click(function(event){
        event.preventDefault(event);
        draw_album_date_chart();
        draw_song_date_chart();
    })
    
    $('a#album_graph').click(function(event){
        event.preventDefault(event);
        draw_album_chart();
    })
    
    $('a#band_graph').click(function(event){
        event.preventDefault(event);
        draw_band_chart();
    })
});


function draw_band_chart()
{
    $.ajax({
        url: "stats/get_band_kind",
        type: "POST",
        dataType: "json",
        success: function(data) {
            $('#blanket').show();
            $('#popup').show();
            var arr = new Array;
           
            var series = new Array;
            $.each(data, function(i){
                var values = {
                    name: data[i][0],
                    data: [data[i][1]]    
                };
                series.push(values); 
              
            });
            
           
           
            bar = new Highcharts.Chart({
                chart: {
                    renderTo: 'bar_chart',
                    type: 'column'
                },
                title: {
                    text: 'Répartition des groupes selon le genre'
                },
            
                xAxis: {
                    categories: ['Genre']
                },
           
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Nombre de groupes'
                    }
                },
                legend: {
                    layout: 'vertical',
                    backgroundColor: '#FFFFFF',
                    align: 'left',
                    verticalAlign: 'top',
                    x: 100,
                    y: 70,
                    floating: false,
                    shadow: true
                },
         
                plotOptions: {
                    column: {
                        pointPadding: 0.2,
                        borderWidth: 0
                    }
                },
                series: series
               
            });
       
            $('#blanket').css('height',$('#popup').height()+100);
        }
    });  
}
function draw_album_chart()
{
    $.ajax({
        url: "stats/get_album_kind",
        type: "POST",
        dataType: "json",
        success: function(data) {
            $('#blanket').show();
            $('#popup').show();
            var arr = new Array;
           
            var series = new Array;
            $.each(data, function(i){
                var values = {
                    name: data[i][0],
                    data: [data[i][1]]    
                };
                series.push(values); 
              
            });
            
           
           
            bar = new Highcharts.Chart({
                chart: {
                    renderTo: 'bar_chart',
                    type: 'column'
                },
                title: {
                    text: 'Répartition des albums selon le genre'
                },
            
                xAxis: {
                    categories: ['Genre']
                },
           
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Nombre d\'albums'
                    }
                },
                legend: {
                    layout: 'vertical',
                    backgroundColor: '#FFFFFF',
                    align: 'left',
                    verticalAlign: 'top',
                    x: 100,
                    y: 70,
                    floating: false,
                    shadow: true
                },
         
                plotOptions: {
                    column: {
                        pointPadding: 0.2,
                        borderWidth: 0
                    }
                },
                series: series
               
            });
       
            $('#blanket').css('height',$('#popup').height()+100);
        }
    });  
}



function draw_song_chart()
{
    
    $.ajax({
        url: "stats/get_song_kind",
        type: "POST",
        dataType: "json",
        success: function(data) {
            $('#blanket').show();
            $('#popup').show();
            var arr = new Array;
            var kind = new Array;
           
            var series = new Array;
            $.each(data, function(i){
                //var value = new Array(data[i][1]);
                arr.push([data[i][0],data[i][1]]); 
                kind.push(data[i][0]);
                var values = {
                    name: data[i][0],
                    data: [data[i][2]]
    
                };
                series.push(values); 
              
            });
            
            chart = new Highcharts.Chart({
                chart: {
                    renderTo: 'pie_chart'
                   
                },
             
                title: {
                    text: 'Repartition des chansons par genre'
                },
               
                series: [{
                    type: 'pie',
                    data: arr
                }]
            });
           
            bar = new Highcharts.Chart({
                chart: {
                    renderTo: 'bar_chart',
                    type: 'column'
                },
                title: {
                    text: 'Répartition des chansons selon son genre'
                },
            
                xAxis: {
                    categories: ['Genre']
                },
           
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Nombre de chansons'
                    }
                },
                legend: {
                    layout: 'vertical',
                    backgroundColor: '#FFFFFF',
                    align: 'left',
                    verticalAlign: 'top',
                    x: 100,
                    y: 70,
                    floating: false,
                    shadow: true
                },
         
                plotOptions: {
                    column: {
                        pointPadding: 0.2,
                        borderWidth: 0
                    }
                },
                series: series
               
            });
       
            $('#blanket').css('height',$('#popup').height()+100);
        }
    });  
      
}

function draw_album_date_chart()
{
    $.ajax({
        url: "stats/get_album_date",
        type: "POST",
        dataType: "json",
        success: function(data) {
            $('#blanket').show();
            $('#popup').show();
            var arr = new Array;
           
            var series = new Array;
            $.each(data, function(i){
                var values = {
                    name: data[i][0],
                    data: [data[i][1]]    
                };
                series.push(values); 
              
            });
            
           
           
            bar = new Highcharts.Chart({
                chart: {
                    renderTo: 'bar_chart',
                    type: 'column'
                },
                title: {
                    text: 'Répartition des albums selon le genre'
                },
            
                xAxis: {
                    categories: ['Genre']
                },
           
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Nombre d\'albums'
                    }
                },
                legend: {
                    layout: 'vertical',
                    backgroundColor: '#FFFFFF',
                    align: 'left',
                    verticalAlign: 'top',
                    x: 100,
                    y: 70,
                    floating: false,
                    shadow: true
                },
         
                plotOptions: {
                    column: {
                        pointPadding: 0.2,
                        borderWidth: 0
                    }
                },
                series: series
               
            });
       
            $('#blanket').css('height',$('#popup').height()+400);
        }
    });  
}

function draw_song_date_chart()
{
    $.ajax({
        url: "stats/get_song_date",
        type: "POST",
        dataType: "json",
        success: function(data) {
            $('#blanket').show();
            $('#popup').show();
            var arr = new Array;
           
            var series = new Array;
            $.each(data, function(i){
                var values = {
                    name: data[i][0],
                    data: [data[i][1]]    
                };
                series.push(values); 
              
            });
            
           
           
            bar = new Highcharts.Chart({
                chart: {
                    renderTo: 'pie_chart',
                    type: 'column'
                },
                title: {
                    text: 'Répartition des albums selon le genre'
                },
            
                xAxis: {
                    categories: ['Genre']
                },
           
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Nombre d\'albums'
                    }
                },
                legend: {
                    layout: 'vertical',
                    backgroundColor: '#FFFFFF',
                    align: 'left',
                    verticalAlign: 'top',
                    x: 100,
                    y: 70,
                    floating: false,
                    shadow: true
                },
         
                plotOptions: {
                    column: {
                        pointPadding: 0.2,
                        borderWidth: 0
                    }
                },
                series: series
               
            });
       
            $('#blanket').css('height',$('#popup').height()+400);
        }
    });  
}