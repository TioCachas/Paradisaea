Project.Collections.Productions = Backbone.Collection.extend({
    target: null, // objecto del dom $(selector) que indica el elemento que contiene a la representacion de la colleccion
    model: Project.Models.Production,
    url: urlGetProductions,
    urlExport: urlExportOperations, // Link para exportar la collecion a csv
    modelSelected: null, // Produccion sobre la que se dio clic para cambiar estatus, etc.
    fetch: function() {
        var collection = this;
        this.target.find('div.loader').removeClass('hidden');
        this.target.find('div.detail').addClass('hidden');
        this.target.find('div.empty').addClass('hidden');
        var options = {success: function() {
                var total = 0;
                var totalEnabled = 0;
                var totalDisabled = 0;
                collection.each(function(m) {
                    var v = parseInt(m.get('pValue'));
                    var s = parseInt(m.get('pStatus'));
                    if (s === 1)
                    {
                        totalEnabled += v;
                    }
                    else
                    {
                        totalDisabled += v;
                    }
                    total += v;
                });
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
            var view = new Project.Views.Production({model: model});
            view.render();
            view.$el.appendTo(collection.target.find('.detail tbody'));
        }, this);
    }
});