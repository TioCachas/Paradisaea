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

    $('#modalLines .save').click(function() {
        $(this).attr('disabled', 'disabled');
        var v = $('#modalLines select').val();
        var l = selectedModel.get('l');
        l.id = v;
        selectedModel.set('l.id', v);
        $('#modalLines').modal('hide');
    });

    $('#workDate').change(function()
    {
        $('#operations .loader').removeClass('hidden');
        $('#operations .detail').addClass('hidden');
        $('#operations .empty').addClass('hidden');
        var workDate = $(this).val();
        window.collections.operations.url = urlGetOperations + '/' + workDate;
        window.collections.operations.urlExport = urlExportOperations + '/' + workDate;
        window.collections.operations.fetch();
    });
});