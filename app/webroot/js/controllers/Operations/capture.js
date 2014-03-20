var templateRow = null;
var templateTotal = null;
var kendoData = [];
var target;
var wndTargetVsReal;
var wndCapture;
var workDate;
var shift;
var line;
var user;
var blockGetOperations = true;

$(document).ready(function()
{
    target = $('#shift');
    templateRow = swig.compile(target.find('.template.row').html());
    templateTotal = swig.compile(target.find('.template.total').html());
    workDate = target.find('[name="workDate"]');
    workDate.kendoDatePicker({
        culture: GLOBALIZATION.KENDO_CULTURE,
        format: GLOBALIZATION.KENDO_FORMAT_DATE,
        value: new Date(),
        max: new Date(),
        change: getOperations
    });
    wndTargetVsReal = target.find('div.wndTargetVsReal');
    target.find('.fa-bar-chart-o').on('click', function()
    {
        if (!wndTargetVsReal.data("kendoWindow")) {
            wndTargetVsReal.kendoWindow({
                width: "800px",
                title: "Producción objetivo vs Producción real",
                actions: [
                    "Minimize",
                    "Maximize",
                    "Close"
                ],
                open: function()
                {
                    createChart();
                }
            });
            wndTargetVsReal.data("kendoWindow").center().open();
        }
        else
        {
            wndTargetVsReal.data("kendoWindow").center().open();
        }
    });
    swig.setFilter('parseInt', function(input, idx)
    {
        return parseInt(input[idx]);
    });
    wndCapture = target.find(".wndCapture");
    line = target.find("input.lines").kendoDropDownList({
        dataTextField: "lName",
        dataValueField: "lId",
        dataSource: {
            type: "json",
            dataSource: []
        },
        change: getOperations
    });
    shift = target.find("input.shifts").kendoDropDownList({
        dataTextField: "sName",
        dataValueField: "sId",
        dataSource: {
            type: "json",
            dataSource: []
        },
        change: getOperations
    });
    user = target.find("select.users").kendoDropDownList({
        change: function()
        {
            var userId = this.value();
            $('.k-widget.lines span.k-i-arrow-s').addClass('k-loading');
            $('.k-widget.shifts span.k-i-arrow-s').addClass('k-loading');
            getLinesAndShifts(userId);
        }
    });
    getLinesAndShiftsByFirstUser();
    target.on('click', 'tr.bosch td.productions', function() {
        fnWnd($(this), urlCapture.productions, "Piezas OK");
    });
    target.on('click', 'tr.bosch td.scrapValue', function() {
        fnWnd($(this), urlCapture.scrap, "Scrap");
    });
    target.on('click', 'tr.bosch td.reworkValue', function() {
        fnWnd($(this), urlCapture.rework, "Retrabajo");
    });
    target.on('click', 'tr.bosch td.changeoverValue', function() {
        fnWnd($(this), urlCapture.changeover, "Cambio de modelo");
    });
    target.on('click', 'tr.bosch td.technicalValue', function() {
        fnWnd($(this), urlCapture.technical, "Pérdidas técnicas");
    });
    target.on('click', 'tr.bosch td.organizationalValue', function() {
        fnWnd($(this), urlCapture.organizational, "Pérdidas organizacionales");
    });
    target.on('click', 'tr.bosch td.qualityValue', function() {
        fnWnd($(this), urlCapture.quality, "Pérdidas de calidad");
    });
    target.on('click', 'tr.bosch td.performanceValue', function() {
        fnWnd($(this), urlCapture.performance, "Pérdidas de desempeño");
    });
});

function getLinesAndShiftsByFirstUser()
{
    var firstUser = user.data("kendoDropDownList").value();
    if (firstUser !== undefined)
    {
        getLinesAndShifts(firstUser)
        $('.k-widget.lines span.k-i-arrow-s').addClass('k-loading');
        $('.k-widget.shifts span.k-i-arrow-s').addClass('k-loading');
    }
}

function getLinesAndShifts(userId)
{
    target.find('tr.error, tr.loader').addClass('hidden');
    target.find('tr.bosch').remove();
    target.find('tfoot').html('');
    target.find('tr.loader.linesAndShifts').removeClass('hidden');
    blockGetOperations = true;
    $.getJSON(urlGetLinesAndShifts, {u: userId}, function(result)
    {
        var lines = result['lines'];
        var shifts = result['shifts'];
        line.data("kendoDropDownList").dataSource.data(lines);
        shift.data("kendoDropDownList").dataSource.data(shifts);
        if (lines.length > 0 && shifts.length > 0)
        {
            blockGetOperations = false;
            getOperations();
        }
        else
        {
            target.find('tr.error, tr.loader').addClass('hidden');
            if (lines.length === 0)
            {
                target.find('tr.error.lines').removeClass('hidden');
            }
            if (shifts.length === 0)
            {
                target.find('tr.error.shifts').removeClass('hidden');
            }
        }
        target.find('tr.loader.linesAndShifts').addClass('hidden');
    });
}

function fnWnd(element, url, title)
{
    var operationId = element.parent().attr('data-id');
    var hStart = element.parent().attr('data-start');
    var hEnd = element.parent().attr('data-end');
    title += ' [' + hStart + ' - ' + hEnd + ']';
    element.find('span').addClass('hidden');
    element.find('.fa-spin').removeClass('hidden');
    url = url + '/' + operationId;
    if (!wndCapture.data("kendoWindow")) {
        wndCapture.kendoWindow({
            width: "800px",
            height: "350px",
            title: title,
            content: url,
            actions: [
                "Minimize",
                "Maximize",
                "Close"
            ],
            visible: false,
            close: getOperations,
            refresh: function() {
                this.center().open();
            }
        });
    }
    else
    {
        wndCapture.data("kendoWindow").refresh({url: url}).title(title);
    }
}

function getOperations()
{
    var dt = workDate.data("kendoDatePicker").value();
    if (blockGetOperations === false && dt !== null)
    {
        var ymd = dt.getFullYear() + '-' + (parseInt(dt.getMonth()) + 1) + '-' + dt.getDate();
        var tfoot = target.find('table.table tfoot');
        target.find('tr.bosch').remove();
        target.find('tr.error').addClass('hidden');
        target.find('tr.loader').addClass('hidden');
        target.find('tr.loader.operations').removeClass('hidden');
        tfoot.html('');
        $.getJSON(urlList,
                {
                    u: user.val(),
                    l: line.data("kendoDropDownList").value(),
                    s: shift.data("kendoDropDownList").value(),
                    w: ymd
                }, function(result) {
            var operations = result['operations'];
            kendoData = [];
            operations.forEach(function(o)
            {
                var tbody = target.find('tbody');
                var tr = templateRow(o);
                tbody.append(tr);
                kendoData.push({
                    hour: o.hStart + ' - ' + o.hEnd,
                    target: o.oTarget,
                    production: o.oProduction,
                    scrap: o.oScrap,
                    rework: o.oRework
                });
            });
            var chart = $(".chart").data('kendoChart');
            if (chart)
            {
                var dataSource = new kendo.data.DataSource(
                        {
                            data: kendoData
                        });
                chart.setDataSource(dataSource);
                chart.refresh();
            }
            var tr = templateTotal(result['sum']);
            tfoot.append(tr);
            target.find('tr.loader.operations').addClass('hidden');
        });
    }
}

function createChart() {
    if (!$(".chart").data('kendoChart'))
    {
        $(".chart").kendoChart({
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
                type: "area",
                style: "smooth",
                labels: {
                    visible: true,
                    format: "{0}",
                    background: "transparent"
                }
            },
            series: [{
                    field: "production",
                    name: "Producción real [piezas]",
                    color: "#00ff00"
                },
                {
                    field: "target",
                    name: "Producción objetivo [piezas]",
                    color: "#0000ff"
                },
                {
                    field: "scrap",
                    name: "Scrap [piezas]",
                    color: "#ff0000"
                },
                {
                    field: "rework",
                    name: "Retrabajo [piezas]",
                    color: "#ffff00"
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
}