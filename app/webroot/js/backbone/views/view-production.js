Project.Views.Production = Backbone.View.extend({
    events: {
        'click .fa-eye': function(e) {
            var p = this.model.get('p');
            p.status = 1;
            this.model.set('p.status', 1);
            //var url = urlToggleStatus + '/' + id;
            //$.post(url);
        },
        'click .fa-eye-slash': function() {
            var p = this.model.get('p');
            p.status = 0;
            this.model.set('p.status', 0);
//            var url = urlToggleStatus + '/' + id;
//            $.post(url);
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