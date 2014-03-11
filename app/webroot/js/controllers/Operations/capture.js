var templateRow = null;
var templateTotal = null;
var kendoData = [];
var target;
var wndTargetVsReal;
var wndProductions;
var wndScrap;
var wndRework;
var wndChangeover;
var wndTechnical;
var wndOrganizational;
var wndQuality;
var wndPerformance;
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
                title: "Produccion objetivo vs produccion real",
                actions: [
                    "Minimize",
                    "Maximize",
                    "Close"
                ],
            });
            createChart();
        }
        wndTargetVsReal.data("kendoWindow").refresh().center().open();
    });
    swig.setFilter('parseInt', function(input, idx)
    {
        return parseInt(input[idx]);
    });
    wndProductions = target.find(".wndProductions");
    wndScrap = target.find(".wndScrap");
    wndRework = target.find(".wndRework");
    wndChangeover = target.find(".wndChangeover");
    wndTechnical = target.find(".wndTechnical");
    wndOrganizational = target.find(".wndOrganizational");
    wndQuality = target.find(".wndQuality");
    wndPerformance = target.find(".wndPerformance");
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
        var operationId = $(this).parent().attr('data-id');
        $(this).find('span').addClass('hidden');
        $(this).find('.fa-spin').removeClass('hidden');
        fnWndOperations(operationId);
    });
    target.on('click', 'tr.bosch td.scrapValue', function() {
        var operationId = $(this).parent().attr('data-id');
        $(this).find('span').addClass('hidden');
        $(this).find('.fa-spin').removeClass('hidden');
        fnWndScrap(operationId);
    });
    target.on('click', 'tr.bosch td.reworkValue', function() {
        var operationId = $(this).parent().attr('data-id');
        $(this).find('span').addClass('hidden');
        $(this).find('.fa-spin').removeClass('hidden');
        fnWndRework(operationId);
    });
    target.on('click', 'tr.bosch td.changeoverValue', function() {
        var operationId = $(this).parent().attr('data-id');
        $(this).find('span').addClass('hidden');
        $(this).find('.fa-spin').removeClass('hidden');
        fnWndChangeover(operationId);
    });
    target.on('click', 'tr.bosch td.technicalValue', function() {
        var operationId = $(this).parent().attr('data-id');
        $(this).find('span').addClass('hidden');
        $(this).find('.fa-spin').removeClass('hidden');
        fnWndTechnical(operationId);
    });
//    target.on('click', 'tr.bosch td.organizationalValue', function() {
//        var operationId = $(this).parent().attr('data-id');
//        $(this).find('span').addClass('hidden');
//        $(this).find('.fa-spin').removeClass('hidden');
//        fnWndOrganizational(operationId);
//    });
//    target.on('click', 'tr.bosch td.qualityValue', function() {
//        var operationId = $(this).parent().attr('data-id');
//        $(this).find('span').addClass('hidden');
//        $(this).find('.fa-spin').removeClass('hidden');
//        fnWndQuality(operationId);
//    });
//    target.on('click', 'tr.bosch td.performanceValue', function() {
//        var operationId = $(this).parent().attr('data-id');
//        $(this).find('span').addClass('hidden');
//        $(this).find('.fa-spin').removeClass('hidden');
//        fnWndPerformance(operationId);
//    });
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

function fnWndOperations(operationId)
{
    var oId = operationId;
    var url = urlProductionsCapture + '/' + operationId
    if (!wndProductions.data("kendoWindow")) {
        wndProductions.kendoWindow({
            width: "800px",
            height: "350px",
            title: "Piezas OK",
            content: url,
            actions: [
                "Minimize",
                "Maximize",
                "Close"
            ],
            visible: false,
            close: getOperations,
            refresh: function(e) {
                target.find('tr[data-id="' + oId + '"] td.productions span').removeClass('hidden');
                target.find('tr[data-id="' + oId + '"] td.productions .fa-spin').addClass('hidden');
                this.center().open();
            }
        });
    }
    else
    {
        wndProductions.data("kendoWindow").refresh({url: url});
    }
}

function fnWndScrap(operationId)
{
    var url = urlScrapCapture + '/' + operationId;
    if (!wndScrap.data("kendoWindow")) {
        wndScrap.kendoWindow({
            width: "800px",
            height: "350px",
            title: "Scrap",
            content: url,
            actions: [
                "Minimize",
                "Maximize",
                "Close"
            ],
            visible: false,
            close: getOperations,
            refresh: function(e) {
                target.find('tr[data-id="' + operationId + '"] td.productions span').removeClass('hidden');
                target.find('tr[data-id="' + operationId + '"] td.productions .fa-spin').addClass('hidden');
                this.center().open();
            }
        });
    }
    else
    {
        wndScrap.data("kendoWindow").refresh({url: url});
    }
}

function fnWndRework(operationId)
{
    var url = urlReworkCapture + '/' + operationId;
    if (!wndRework.data("kendoWindow")) {
        wndRework.kendoWindow({
            width: "800px",
            height: "350px",
            title: "Retrabajo",
            content: url,
            actions: [
                "Minimize",
                "Maximize",
                "Close"
            ],
            visible: false,
            close: getOperations,
            refresh: function(e) {
                target.find('tr[data-id="' + operationId + '"] td.productions span').removeClass('hidden');
                target.find('tr[data-id="' + operationId + '"] td.productions .fa-spin').addClass('hidden');
                this.center().open();
            }
        });
    }
    else
    {
        wndRework.data("kendoWindow").refresh({url: url});
    }
}

function fnWndChangeover(operationId)
{
    var url = urlChangeoverCapture + '/' + operationId;
    if (!wndChangeover.data("kendoWindow")) {
        wndChangeover.kendoWindow({
            width: "800px",
            height: "350px",
            title: "Cambio de modelo",
            content: url,
            actions: [
                "Minimize",
                "Maximize",
                "Close"
            ],
            visible: false,
            close: getOperations,
            refresh: function(e) {
                target.find('tr[data-id="' + operationId + '"] td.productions span').removeClass('hidden');
                target.find('tr[data-id="' + operationId + '"] td.productions .fa-spin').addClass('hidden');
                this.center().open();
            }
        });
    }
    else
    {
        wndChangeover.data("kendoWindow").refresh({url: url});
    }
}

function fnWndTechnical(operationId)
{
    var url = urlTechnicalCapture + '/' + operationId;
    if (!wndTechnical.data("kendoWindow")) {
        wndTechnical.kendoWindow({
            width: "800px",
            height: "350px",
            title: "Perdidas tecnicas",
            content: url,
            actions: [
                "Minimize",
                "Maximize",
                "Close"
            ],
            visible: false,
            close: getOperations,
            refresh: function(e) {
                target.find('tr[data-id="' + operationId + '"] td.productions span').removeClass('hidden');
                target.find('tr[data-id="' + operationId + '"] td.productions .fa-spin').addClass('hidden');
                this.center().open();
            }
        });
    }
    else
    {
        wndTechnical.data("kendoWindow").refresh({url: url});
    }
}

function getOperations()
{
    var dt = workDate.data("kendoDatePicker").value();
    if (blockGetOperations === false && dt !== null)
    {
        var ymd = dt.getFullYear() + '-' + dt.getMonth() + '-' + dt.getDate();
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
                    production: o.oProduction
                });
            });
            var tr = templateTotal(result['sum']);
            tfoot.append(tr);
            target.find('tr.loader.operations').addClass('hidden');
        });
    }
}

function createChart() {
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