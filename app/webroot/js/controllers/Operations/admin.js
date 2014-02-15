$(document).ready(function() {
    window.collections.operations = new Project.Collections.Operations();
    $("#workDate").datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: 'yy-mm-dd',
        altField: "#alternate",
        altFormat: "DD, d MM",
        maxDate: "today"
    });

    $('#modalHours .comment').change(function()
    {
        var v = $(this).val().trim();
        var dialog = $(this).parents('div[role="dialog"]');
        dialog.find('.save').attr('disabled', 'disabled');
        if (v != '')
        {
            dialog.find('.save').removeAttr('disabled');
        }
    });

    $('#modalHours .save').click(function() {
        var comment = $('#commentHour').val();
        if (comment != '')
        {
            var v = $('#modalHours select').val();
            var h = selectedModel.get('h');
            h.id = v;
            h.comment = comment;
            selectedModel.set('h.id', v);
            $('#modalHours').modal('hide');
        }
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
        $('#loadingOperations').removeClass('hidden');
        $('#operations').addClass('hidden');
        $('#emptyOperations').addClass('hidden');
        window.collections.operations.fetch(
                {
                    data:
                            {
                                date: $(this).val()
                            },
                    success: function()
                    {
                        if (window.collections.operations.length > 0)
                        {
                            $('#operations').removeClass('hidden');
                        }
                        else
                        {
                            $('#emptyOperations').removeClass('hidden');
                        }
                        $('#loadingOperations').addClass('hidden');
                    }
                }
        );
    });
});