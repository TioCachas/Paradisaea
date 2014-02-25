$(document).ready(function()
{
    getModels();
    $('#inputLine').change(getModels);
});

function getModels()
{
    var line = $('#inputLine').val();
    var url = urlGetModels + '/' + line;
    $.post(url, {}, function(options) {
        renderOptions($('#inputModel'), options);
    });
}
