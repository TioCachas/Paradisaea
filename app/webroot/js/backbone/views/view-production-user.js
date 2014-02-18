Project.Views.ProductionUser = Backbone.View.extend({
    template: null,
    events: {
    },
    initialize: function()
    {
        debugger;
        this.target.find('.template')
        console.log(template.find('.template').html());
        this.template = swig.compile(this.target.find('.template').html());
    },
    render: function() {
        var data = this.model.toJSON();
        this.setElement(this.template(data));
        return this;
    }
});