Project.Models.Production = Backbone.Model.extend({
    initialize: function() {
        this.on('change:p.status', function() {
            var view = new Project.Views.Production({model: this});
            var m = this.get('p');
            view.render();
            $('tr[data-id="' + m.id + '"]').replaceWith(view.$el);
            var total = 0;
            var totalEnabled = 0;
            var totalDisabled = 0;
            window.collections.productions.each(function(model) {
                var p = model.get('p');
                var v = parseInt(p.value);
                var s = parseInt(p.status);
                if (s == 1)
                {
                    totalEnabled += v;
                }
                else
                {
                    totalDisabled += v;
                }
                total += v;
            });
            this.updateOperation(totalEnabled);
        }, this);
    },
    updateOperation: function(totalEnabled)
    {
        if (window.collections.operations !== undefined)
        {
            var operation = window.collections.operations.first();
            if (operation !== undefined)
            {
                var oJSON = operation.toJSON();
                oJSON.o.production = totalEnabled;
                operation.set('o.production', totalEnabled);
            }
        }
    }
});