$(document).ready(function() {
    $("#model").kendoDropDownList();
    $("#index").kendoDropDownList();
    $("#value").kendoNumericTextBox({
        culture: GLOBALIZATION.KENDO_CULTURE,
        format: "\\#"
    });
    var numerictextbox = $("#value").data("kendoNumericTextBox");
    numerictextbox.focus();
    var validator = $("#newProduction").kendoValidator().data("kendoValidator");
    var templateProductionRow = swig.compile($('#templateRow').html());
    $("#newProduction").submit(function(event) {
        event.preventDefault();
        if (validator.validate()) {
            var url = $(this).attr('action');
            var form = this;
            $('.accept i.fa-spin').removeClass('hidden');
            $('.accept button.k-button').addClass('hidden');
            $.getJSON(url, {
                o: oId,
                i: $("#index").data('kendoDropDownList').value(),
                v: $("#value").data('kendoNumericTextBox').value()
            }, function(newProduction) {
                if (newProduction !== false)
                {
                    form.reset();
                    $('.accept i.fa-spin').addClass('hidden');
                    $('.accept button.k-button').removeClass('hidden');
                    var tr = templateProductionRow(newProduction);
                    $('#productions tbody').prepend(tr);
                }
            });
        }
    });
    $('#productions').on('click', '.fa-times', function() {
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