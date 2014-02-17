Project.Collections.Operations = Backbone.Collection.extend({
    target: null,
    model: Project.Models.Operation,
    url: urlGetOperations,
    urlExport: urlExportOperations,
    fetch: function() {
        var collection = this;
        this.target.find('div.loader').removeClass('hidden');
        this.target.find('div.detail').addClass('hidden');
        this.target.find('div.empty').addClass('hidden');
        var options = {success: function() {
                if (collection.length > 0)
                {
                    collection.target.find('div.detail').removeClass('hidden');
                }
                else
                {
                    collection.target.find('div.empty').removeClass('hidden');
                }
                collection.target.find('div.loader').addClass('hidden');
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