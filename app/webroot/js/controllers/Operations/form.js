var templateRow = null;
var target

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
        operations.forEach(function(o)
        {
            var tr = templateRow(o);
            tbody.append(tr);
        });
        var tr = templateRow(result['sum']);
        tfoot.append(tr);
        loader.addClass('hidden');
        detail.removeClass('hidden');
    }, 'json');
}