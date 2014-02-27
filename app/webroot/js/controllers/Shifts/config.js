$(document).ready(function()
{
    getModels();
    $('#inputLine').change(getModels);
});

function getModels()
{
    var line = $('#inputLine').val();
    var url = urlGetModels + '/' + line;
    $.getJSON(url, {}, function(options) {
        $('button').removeAttr('disabled');
        renderOptions($('#inputModel'), options);
    });
}
