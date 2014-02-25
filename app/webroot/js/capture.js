$(document).ready(function()
{
    loadModels();
    $('#selectLineInMenu').change(loadModels);
});

function loadModels()
{
    var line = $('#selectLineInMenu').val();
    var url = __urlGetModels + '/' + line;
    $.getJSON(url, {}, function(options)
    {
        renderOptions('#selectModelInMenu', options);
    });
}