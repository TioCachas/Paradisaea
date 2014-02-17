Project.Views.Operation = Backbone.View.extend({
    events: {
        'click .fa-eye, .fa-eye-slash': function()
        {
            selectedModel = this.model;
            this.model.collection.target.find('div[role="dialog"].status textarea.comment').val('');
            this.model.collection.target.find('div[role="dialog"].status button.save').attr('disabled', 'disabled');
            this.model.collection.target.find('div[role="dialog"].status').modal('show');
        },
        'click td.hour': function()
        {
            selectedModel = this.model;
            this.model.collection.target.find('div[role="dialog"].hour select.hour').val('');
            this.model.collection.target.find('div[role="dialog"].hour textarea.comment').val('');
            this.model.collection.target.find('div[role="dialog"].hour .save').attr('disabled', 'disabled');
            this.model.collection.target.find('div[role="dialog"].hour').modal('show');
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
        return this;
    }
});