$(document).ready(function() {
    window.collections.operations = new Project.Collections.Operations();
    window.collections.operations.target = $('#operations');
    $("#workDate").datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: 'yy-mm-dd',
        altField: "#alternate",
        altFormat: "DD, d MM",
        maxDate: "today"
    });

    $('#workDate').change(function()
    {
        var workDate = $(this).val();
        window.collections.operations.url = urlGetOperations + '/' + workDate;
        window.collections.operations.urlExport = urlExportOperations + '/' + workDate;
        window.collections.operations.fetch();
    });
});