@extends('panel.base')

@section('contenido')
<h5 style="text-align: center; font-weight: bold; color: #4A90E2; margin-top: 20px;">Bienvenido al Dashboard</h5>

<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f3f4f6;
        color: #333;
    }

    .row {
        display: flex;
        justify-content: space-around;
        padding: 20px 0;
    }

    .col-md-4 {
        display: flex;
        flex-direction: column;
        align-items: center;
        background-color: #ffffff;
        border-radius: 10px;
        padding: 15px;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
    }

    .col-md-4:hover {
        transform: scale(1.05);
    }

    #chartCarpetas, #chartArchivos, #chartCarpArch {
        width: 100%;
        height: 200px;
        margin-bottom: 10px;
    }

    .group {
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
    }

    .group p {
        margin: 0;
        color: #ff5e5e;
    }
</style>

<div class="row">
    <div class="col-md-4">
        <div id="chartCarpetas"></div>
        <div class="group">
            <p>Total Carpetas: </p>
            <p id="total_carpetas" style="color: #333; font-weight: bold; padding-left: 5px;"></p>
        </div>
    </div>
    <div class="col-md-4">
        <div id="chartArchivos"></div>
        <div class="group">
            <p>Total Archivos: </p>
            <p id="total_archivos" style="color: #333; font-weight: bold; padding-left: 5px;"></p>
        </div>
    </div>
    <div class="col-md-4">
        <div id="chartCarpArch"></div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<script>
    $.ajax({
        type: "GET",
        url: "/graficos/carpetas",
        dataType: "json",
        success: function (response) {
            llenar_chart_carpetas(response);
            $("#total_carpetas").text(response.data);
        }
    });

    $.ajax({
        type: "GET",
        url: "/graficos/archivos",
        dataType: "json",
        success: function (response) {
            llenar_chart_archivos(response);
            $("#total_archivos").text(response.data);
        }
    });

    $.ajax({
        type: "GET",
        url: "/graficos/carparch",
        dataType: "json",
        success: function (response) {
            llenar_chart_carparch(response);
        }
    });

    function llenar_chart_carpetas(datos) { 
        var options = {
            series: [datos.data],
            chart: {
                height: 350,
                type: 'radialBar',
            },
            plotOptions: {
                radialBar: {
                    hollow: {
                        size: '40%',
                    },
                    dataLabels: {
                        value: {
                            formatter: function(val) {
                                return val + " ";
                            },
                            color: '#111',
                            fontSize: '20px',
                            fontWeight: 600,
                        }
                    }
                },
            },
            labels: ['Carpetas'],
        };

        var chart = new ApexCharts(document.querySelector("#chartCarpetas"), options);
        chart.render();
    }

    function llenar_chart_archivos(datos) { 
        var options = {
            series: [datos.data],
            chart: {
                height: 350,
                type: 'radialBar',
            },
            plotOptions: {
                radialBar: {
                    hollow: {
                        size: '40%',
                    },
                    dataLabels: {
                        value: {
                            formatter: function(val) {
                                return val + " ";
                            },
                            color: '#111',
                            fontSize: '20px',
                            fontWeight: 600,
                        }
                    }
                },
            },
            labels: ['Archivos'],
        };
        var chart = new ApexCharts(document.querySelector("#chartArchivos"), options);
        chart.render();
    }

    function llenar_chart_carparch(datos) { 
        var options = {
            series: [
                { name: 'Carpetas', data: [datos.data.cant_carpetas] },
                { name: 'Archivos', data: [datos.data.cant_archivos] }
            ],
            chart: {
                type: 'bar',
                height: 350
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '55%',
                    endingShape: 'rounded'
                },
            },
            dataLabels: { enabled: false },
            stroke: { show: true, width: 2, colors: ['transparent'] },
            xaxis: { categories: ['Carpetas/Archivos'] },
            yaxis: { title: { text: 'Cantidades' } },
            fill: { opacity: 1 },
            tooltip: {
                y: {
                    formatter: function (val) {
                        return val + " unidades";
                    }
                }
            }
        };

        var chart = new ApexCharts(document.querySelector("#chartCarpArch"), options);
        chart.render();
    }
</script>
@endsection
