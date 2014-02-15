Project.Views.Operation = Backbone.View.extend({
    events: {
        'click .fa-eye': 'toggleStatus',
        'click .fa-eye-slash': 'toggleStatus',
        'click td.hour': function()
        {
            selectedModel = this.model;
            $('#commentHour').val('');
            $('#modalHours .save').attr('disabled', 'disabled');
            $('#modalHours').modal('show');
        },
        'click td.line': function()
        {
            selectedModel = this.model;
            $('#modalLines .save').attr('disabled', 'disabled');
            $('#modalLines select').attr('disabled', 'disabled');
            $('#modalLines').modal('show');
            var l = this.model.get('l');
            var url = urlGetLines + '/' + l.id;
            $.post(url, {}, function(code) {
                $('#modalLines select').html(code);
                $('#modalLines select').removeAttr('disabled');
                $('#modalLines .save').removeAttr('disabled', 'disabled');
            });
        }
    },
    initialize: function()
    {
        this.template = swig.compile($('#rowOperation').html());
    },
    render: function() {
        var data = this.model.toJSON();
        this.setElement(this.template(data));
        $('[data-toggle="tooltip"]').tooltip('show');
        return this;
    },
    toggleStatus: function()
    {
        var o = this.model.get('o');
        $('tr[data-id="' + o.id + '"] .status .fa').addClass('hidden');
        $('tr[data-id="' + o.id + '"] .status .fa-refresh').removeClass('hidden');
        o.status = o.status == '1' ? 0 : 1;
        this.model.set('o.status', o.status);
    }
});