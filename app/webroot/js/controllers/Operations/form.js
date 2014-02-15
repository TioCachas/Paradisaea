window.operations = {};
window.tp = [];
window.ts = [];
window.tr = [];
window.tco = [];
window.ttl = [];
window.tol = [];
var blockSave = false;

$(document).ready(function()
{
    $('#production').focus();

    $('input').keyup(function(e) {
        if (e.which == 13) {
            saveOperation();
        }
    });

    $('input[type=text]').keyup(function(e) {
        var inputs = $('input[type=text]');
        var t = inputs.length;
        for (i = 0; i < t; i++)
        {
            var value = $(inputs[i]).val();
            if (isNaN(parseInt(value)) === true)
            {
                $('#saveOperation').attr('disabled', 'disabled');
                return;
            }
        }
        $('#saveOperation').removeAttr('disabled');
    });

    $('#hour').change(function() {
        $('#model').focus();
    });

    $('#index').change(function() {
        $('#production').focus();
    });

    $('#model').change(function() {
        var id = $(this).val();
        var url = urlGetIndexes + '/' + id;
        $('#indexLoading').removeClass('hidden');
        $.get(url, {}, function(codeHtml) {
            $('#index').html(codeHtml);
            $('#index').focus();
            $('#indexLoading').addClass('hidden');
        });
    });
    
    $('#workstation').change(function() {
        var id = $(this).val();
        var url = urlGetDefects + '/' + id;
        $('#defectLoading').removeClass('hidden');
        $.get(url, {}, function(codeHtml) {
            $('#defect').html(codeHtml);
            $('#defect').focus();
            $('#defectLoading').addClass('hidden');
        });
    });

    $('#saveOperation').click(saveOperation);

    $.post(urlList, {}, function(operations) {
        window.operations = operations;
        operations.forEach(function(o)
        {
            var tr = renderTr(o);
            $('#tableRecords tbody').append(tr);
        });
        calculateResumen();
        renderResumen();
        toggleTableRecords();
    }, 'json');
});

function saveOperation()
{
    if (blockSave == false && checkInputs() === true)
    {
        blockSave = true;
        $('#loading').removeClass('hidden');
        var params = $('#formOperation').serialize();
        var url = urlCreate + '?' + params;
        $.post(url, params, function(operation)
        {
            blockSave = false;
            var tr = renderTr(operation);
            $('#tableRecords').removeClass('hidden');
            $('#tableRecords tbody').prepend(tr);
            $('#loading').addClass('hidden');
            $('input[type=text]').val('');
            $('#production').focus();
            $('#saveOperation').attr('disabled', 'disabled');
            window.operations.push(operation);
            groupByModel(operation);
            renderResumen();
        });
    }
    else
    {
        $('#saveOperation').attr('disabled', 'disabled');
    }
}

function toggleTableRecords()
{
    if (window.operations.length > 0)
    {
        $('#tableRecords').removeClass('hidden');
    }
    else
    {
        $('#tableRecords').addClass('hidden');
    }
}

function calculateResumen()
{
    var t = window.operations.length;
    for (i = 0; i < t; i++)
    {
        var e = window.operations[i];
        groupByModel(e);
    }
}

function groupByModel(e)
{
    var m = e['m']['model'];
    if (window.tp[m] === undefined)
    {
        window.tp[m] = 0;
        window.ts[m] = 0;
        window.tr[m] = 0;
        window.tco[m] = 0;
        window.ttl[m] = 0;
        window.tol[m] = 0;
    }
    window.tp[m] += parseInt(e['o']['production']);
    window.ts[m] += parseInt(e['o']['scrap']);
    window.tr[m] += parseInt(e['o']['rework']);
    window.tco[m] += parseInt(e['o']['changeover']);
    window.ttl[m] += parseInt(e['o']['technical_losses']);
    window.tol[m] += parseInt(e['o']['organizational_losses']);
}

function renderResumen()
{
    $('#tableByCurrentDay tbody').html('');
    for (i in window.tp)
    {
        var tr = $('<tr>');

        var td = $('<td>');
        td.text(i);
        tr.append(td);

        td = $('<td>');
        td.text(window.tp[i]);
        tr.append(td);

        td = $('<td>');
        td.text(window.ts[i]);
        tr.append(td);

        td = $('<td>');
        td.text(window.tr[i]);
        tr.append(td);

        td = $('<td>');
        td.text(window.tco[i]);
        tr.append(td);

        td = $('<td>');
        td.text(window.ttl[i]);
        tr.append(td);

        td = $('<td>');
        td.text(window.tol[i]);
        tr.append(td);
        $('#tableByCurrentDay tbody').append(tr);
    }
}

function renderTr(operation)
{
    var tr = $('<tr>');
    tr.attr('rid', operation['o']['id']);

    var td = $('<td>');
    td.text(operation['l']['line']);
    tr.append(td);

    td = $('<td>');
    td.text(operation[0]['hour']);
    tr.append(td);

    td = $('<td>');
    td.text(operation['m']['model']);
    tr.append(td);

    td = $('<td>');
    td.text(operation['o']['production']);
    tr.append(td);

    td = $('<td>');
    td.text(operation['o']['scrap']);
    tr.append(td);

    td = $('<td>');
    td.text(operation['o']['rework']);
    tr.append(td);

    td = $('<td>');
    td.text(operation['o']['changeover']);
    tr.append(td);

    td = $('<td>');
    td.text(operation['o']['technical_losses']);
    tr.append(td);

    td = $('<td>');
    td.text(operation['o']['organizational_losses']);
    tr.append(td);

    return tr;
}

function checkInputs()
{
    var inputs = $('input[type=text]');
    var t = inputs.length;
    for (i = 0; i < t; i++)
    {
        var value = $(inputs[i]).val();
        if (isNaN(parseInt(value)) === true)
        {
            return false;
        }
    }
    return true;
}
