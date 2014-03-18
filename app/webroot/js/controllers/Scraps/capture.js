$(document).ready(function() {
    $("#value").kendoNumericTextBox({
        culture: GLOBALIZATION.KENDO_CULTURE,
        format: "\\#"
    });
    var validator = $("#newRecord").kendoValidator().data("kendoValidator");
    var templateRow = swig.compile($('#templateRow').html());
    $("#newRecord").submit(function(event) {
        event.preventDefault();
        if (validator.validate()) {
            var url = $(this).attr('action');
            var form = this;
            $('.accept i.fa-spin').removeClass('hidden');
            $('.accept button.k-button').addClass('hidden');
            $.getJSON(url, {
                o: oId,
                c: $('#comment').val(),
                v: $("#value").data('kendoNumericTextBox').value()
            }, function(newRecord) {
                if (newRecord !== false)
                {
                    form.reset();
                    $('.accept i.fa-spin').addClass('hidden');
                    $('.accept button.k-button').removeClass('hidden');
                    var tr = templateRow(newRecord);
                    $('#records tbody').prepend(tr);
                }
            });
        }
    });
    $('#records').on('click', '.fa-times', function() {
        var pId = $(this).parent().parent().attr('data-id');
        var tr = $(this).parent().parent();
        var faTimes = $(this);
        $(this).addClass('hidden');
        tr.find('.fa-refresh').removeClass('hidden');
        $.getJSON(urlDelete, {
            i: pId
        },
        function(success) {
            faTimes.removeClass('hidden');
            tr.find('.fa-refresh').addClass('hidden');
            if (success === true)
            {
                tr.remove();
            }
        })
    });
});