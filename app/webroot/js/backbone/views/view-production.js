Project.Views.Production = Backbone.View.extend({
    events: {
        'click .fa-eye, .fa-eye-slash': function()
        {
            window.collections.productions.selectedModel = this.model;
            this.model.collection.target.find('div[role="dialog"].status textarea.comment').val('');
            this.model.collection.target.find('div[role="dialog"].status button.save').attr('disabled', 'disabled');
            this.model.collection.target.find('div[role="dialog"].status').modal('show');
        }
    },
    initialize: function()
    {
        this.template = swig.compile($('#templateRowProduction').html());
    },
    render: function() {
        var data = this.model.toJSON();
        this.setElement(this.template(data));
        return this;
    }
});