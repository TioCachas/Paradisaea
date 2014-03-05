var templateRow = null;
var templateTotal = null;
var kendoData = [];
var target;
var windowChart;
var wndProductions;

$(document).ready(function()
{
    target = $('#shift');
    templateRow = swig.compile(target.find('.template.row').html());
    templateTotal = swig.compile(target.find('.template.total').html());
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
    target.find('.fa-bar-chart-o').on('click', function()
    {
        windowChart = $("#windowChart");
        createChart();
        if (!windowChart.data("kendoWindow")) {
            windowChart.kendoWindow({
                width: "800px",
                title: "Produccion objetivo vs produccion real",
                actions: [
                    "Minimize",
                    "Maximize",
                    "Close"
                ]
            });
        }
        windowChart.data("kendoWindow").center().open();
    });

    swig.setFilter('parseInt', function(input, idx)
    {
        return parseInt(input[idx]);
    });
    wndProductions = target.find(".wndProductions");
});

function fnWndOperations(operationId)
{
    var oId = operationId;
    if (!wndProductions.data("kendoWindow")) {
        wndProductions.kendoWindow({
            width: "800px",
            height: "350px",
            title: "Piezas OK",
            content: 'http://localhost/Paradisaea/Productions/capture/',
            actions: [
                "Minimize",
                "Maximize",
                "Close"
            ],
            visible: false,
            close: function(e)
            {
                var workDate = $('#workDate').val();
                var url = urlListSingle + '/' + workDate + '/' + oId;
                $.getJSON(url, {}, function(operation)
                {
                    if (operation !== false)
                    {
                        $('tr[data-id="' + oId + '"]').replaceWith(templateRow(operation));
                    }
                });
            },
            refresh: function(e) {
                target.find('tr[data-id="' + oId + '"] td.productions span').removeClass('hidden');
                target.find('tr[data-id="' + oId + '"] td.productions .fa-spin').addClass('hidden');
                this.center().open();
            }
        });
    }
    wndProductions.data("kendoWindow").refresh({url: 'http://localhost/Paradisaea/Productions/capture/' + operationId});
}

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
        var tr = templateTotal(result['sum']);
        tfoot.append(tr);
        loader.addClass('hidden');
        detail.removeClass('hidden');
        $('td.productions').on('click', function() {
            var operationId = $(this).parent().attr('data-id');
            $(this).find('span').addClass('hidden');
            $(this).find('.fa-spin').removeClass('hidden');
            fnWndOperations(operationId);
        })
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
                name: "Produccion real [piezas]",
                color: "#00ff00"
            },
            {
                field: "target",
                name: "Produccion objetivo [piezas]",
                color: "#0000ff"
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
        },
        tooltip: {
            visible: true,
            format: "{0}%",
            template: "#= series.name #: #= value #"
        }
    });
}