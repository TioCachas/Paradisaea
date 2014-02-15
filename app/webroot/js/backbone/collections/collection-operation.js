Project.Collections.Operations = Backbone.Collection.extend({
    model: Project.Models.Operation,
    url: 'getByWorkDate',
    initialize: function() {
        this.on('add', function(model) {
            var view = new Project.Views.Operation({model: model});
            view.render();
            view.$el.appendTo('#tableOperations tbody');
        }, this);
    }
});