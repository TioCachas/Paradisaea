var templateRow = null;
var kendoData = [];
var target;
var windowChart;

$(document).ready(function()
{
    target = $('#shift');
    templateRow = swig.compile(target.find('.template').html());
    $("#workDate").datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: 'yy-mm-dd',
        altField: "#alternate",
        altFormat: "DD, d MM",
        maxDate: "today"
    });
    var url = urlList + '/' + $("#workDate").val();
    getOperations(url);

    $('#workDate').change(function() {
        var url = urlList + '/' + $(this).val();
        getOperations(url);
    });


    $('td.productions span').on('click', function() {
        alert('ujus');
    });
    target.find('td.productions').on('click', function() {
        //$("#dialog-form").dialog("open");
        alert('operaciones');
    });

    target.find('.fa-bar-chart-o').on('click', function()
    {
        windowChart = $("#windowChart");
        createChart();
        if (!windowChart.data("kendoWindow")) {
            windowChart.kendoWindow({
                width: "600px",
                title: "Produccion objetivo vs produccion real",
                actions: [
                    "Pin",
                    "Minimize",
                    "Maximize",
                    "Close"
                ]
            });
        }
        windowChart.data("kendoWindow").center().open();
    });
});

function getOperations(url)
{
    var tbody = target.find('div.detail tbody');
    var tfoot = target.find('div.detail tfoot');
    var loader = target.find('div.loader');
    var detail = target.find('div.detail');
    tbody.html('');
    tfoot.html('');
    loader.removeClass('hidden');
    detail.addClass('hidden');
    $.post(url, {}, function(result) {
        var operations = result['operations'];
        kendoData = [];
        operations.forEach(function(o)
        {
            var tr = templateRow(o);
            tbody.append(tr);
            kendoData.push({
                hour: o.hStart + ' - ' + o.hEnd,
                target: o.oTarget,
                production: o.oProduction
            });
        });
        var tr = templateRow(result['sum']);
        tfoot.append(tr);
        loader.addClass('hidden');
        detail.removeClass('hidden');
    }, 'json');
}

function createChart() {
    $("#chart").kendoChart({
        dataSource: {
            data: kendoData
        },
        title: {
            text: ""
        },
        legend: {
            visible: true
        },
        seriesDefaults: {
            type: "line",
            style: "smooth",
            labels: {
                visible: true,
                format: "{0}",
                background: "transparent"
            }
        },
        series: [{
                field: "production",
                name: "Produccion real [piezas]"
            },
            {
                field: "target",
                name: "Produccion objetivo [piezas]"
            }],
        valueAxis: {
            labels: {
                format: "{0}",
            },
            line: {
                visible: true
            }
        },
        categoryAxis: {
            labels: {
                rotation: 270
            },
            field: "hour",
            majorGridLines: {
                visible: true
            }
        }
    });
}