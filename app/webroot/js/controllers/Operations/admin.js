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

    /**
     * Checamos el comentario y si su valor es diferente a cadena vacia entonces
     * activamos el boton de guardar.
     * IMPORTANTE!!! 
     * Esta función afecta a todos los dialgos que contengan un campo comentario
     * tener cuidado al cambiar está función ya que afecta a todos los dialogos.
     */
    $('div[role="dialog"] .comment').on('change', function()
    {
        var comment = $(this).val().trim();
        var dialog = $(this).parents('div[role="dialog"]');
        dialog.find('.save').attr('disabled', 'disabled');
        if (comment !== '')
        {
            dialog.find('.save').removeAttr('disabled');
        }
    });

    $('#operations i.fa-download').click(function() {
        $(location).attr('href', window.collections.operations.urlExport);
    });

    $('div[role="dialog"] .status .save').click(function() {
        var dialog = $(this).parents('div[role="dialog"]');
        var comment = dialog.find('.comment').val();
        if (comment !== '')
        {
            var hourId = dialog.find('.hour').val();
            var h = selectedModel.get('h');
            h.id = hourId;
            h.comment = comment;
            selectedModel.set('h.id', hourId);
            dialog.modal('hide');
        }
    });

    $('.modal.hours .save').click(function() {
        var dialog = $(this).parents('div[role="dialog"]');
        var comment = dialog.find('.comment').val();
        if (comment !== '')
        {
            var hourId = dialog.find('.hour').val();
            var h = selectedModel.get('h');
            h.id = hourId;
            h.comment = comment;
            selectedModel.set('h.id', hourId);
            dialog.modal('hide');
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
        $('#operations .loader').removeClass('hidden');
        $('#operations .detail').addClass('hidden');
        $('#operations .empty').addClass('hidden');
        var workDate = $(this).val();
        window.collections.operations.url = urlGetOperations + '/' + workDate;
        window.collections.operations.urlExport = urlExportOperations + '/' + workDate;
        window.collections.operations.fetch();
    });
});