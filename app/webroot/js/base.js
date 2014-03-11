function renderOptions(target, options)
{
    $(target).html('');
    options.forEach(function(o) {
        var option = $('<option>');
        option.val(o.value);
        option.html(o.text);
        target.append(option);
    });
}