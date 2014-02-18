$(document).ready(function()
{
    checkRecords();
    $('table .delete').click(function() {
        if (confirm(msgConfirm) === true)
        {
            var url = $(this).attr('url');
            $.get(url, {}, function(id) {
                var tr = $('table [rid=' + id + ']').parents('tr');
                tr.remove();
                totalRecords--;
                checkRecords();
            }, 'json');
        }
    });

    function checkRecords()
    {
        if (totalRecords == 0)
        {
            $('#empty').removeClass('hidden');
            $('#tableRecords').addClass('hidden');
        }
        else
        {
            $('#empty').addClass('hidden');
            $('#tableRecords').removeClass('hidden');
        }
    }
});
