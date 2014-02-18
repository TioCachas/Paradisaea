Project.Collections.ProductionsUser = Backbone.Collection.extend({
    modelSelected: null, // Produccion sobre la que se dio clic para cambiar estatus, etc.
    target: null,
    urls: [],
    initialize: function() {
        var target = this.target;
        this.on('add', function(model) {
            var view = new Project.Views.ProductionUser({model: model, target: target});
            view.render();
            view.$el.appendTo(target.find('.detail tbody'));
        }, this);
    }
});