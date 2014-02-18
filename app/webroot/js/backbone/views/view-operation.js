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
            this.model.collection.target.find('div[role="dialog"].line textarea.comment').val('');
            this.model.collection.target.find('div[role="dialog"].line select.line').html('').attr('disabled', 'disabled');
            this.model.collection.target.find('div[role="dialog"].line .save').attr('disabled', 'disabled');
            var lId = this.model.get('lId');
            var url = urlGetLines + '/' + lId;
            var target = this.model.collection.target;
            $.post(url, {}, function(code) {
                target.find('div[role="dialog"].line select.line').html(code).removeAttr('disabled');
                target.find('div[role="dialog"].line').modal('show');
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