Project.Collections.Operations = Backbone.Collection.extend({
    target: null,
    model: Project.Models.Operation,
    url: urlGetOperations,
    urlExport: urlExportOperations,
    fetch: function() {
        var collection = this;
        var options = {success: function() {
                if (collection.length > 0)
                {
                    collection.target.find('.detail').removeClass('hidden');
                }
                else
                {
                    collection.target.find('.empty').removeClass('hidden');
                }
                collection.target.find('.loader').addClass('hidden');
            }};
        return Backbone.Collection.prototype.fetch.call(this, options);
    },
    initialize: function() {
        var collection = this;
        this.on('add', function(model) {
            model.collection = collection;
            var view = new Project.Views.Operation({model: model});
            view.render();
            view.$el.appendTo(collection.target.find('.detail tbody'));
        }, this);
    }
});