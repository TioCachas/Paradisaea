Project.Models.Production = Backbone.Model.extend({
    initialize: function() {
        this.on('change:pStatus', function() {
            var comment = this.collection.target.find('div[role="dialog"].status textarea.comment').val();
            if (comment !== '')
            {
                this.startSaveChanges();
                var pId = this.get('pId');
                var url = window.routers.productions.toggleStatus + '/' + pId;
                var model = this;
                $.post(url, {c: comment}, function(newStatus)
                {
                    /// Muy importante para evitar lanzar un nuevo evento de cambio
                    /// de estatus
                    model.attributes.pStatus = newStatus;
                    renderProduction(model);
                    var totalEnabled = 0;
                    window.collections.productions.each(function(production) {
                        var v = parseInt(production.get('pValue'));
                        var s = parseInt(production.get('pStatus'));
                        if (s == 1)
                        {
                            totalEnabled += v;
                        }
                    });
                    if (window.collections.operations !== undefined)
                    {
                        var operation = window.collections.operations.first();
                        if (operation !== undefined)
                        {
                            operation.set('oProduction', totalEnabled);
                        }
                    }
                }, 'json');
            }
        }, this);
    },
    startSaveChanges: function()
    {
        var pId = this.get('pId');
        $('tr[data-id="' + pId + '"] .status .fa').addClass('hidden');
        $('tr[data-id="' + pId + '"] .status .fa-spin').removeClass('hidden');
    }
});

function renderProduction(m)
{
    var view = new Project.Views.Production({model: m});
    var pId = m.get('pId');
    view.render();
    $('tr[data-id="' + pId + '"]').replaceWith(view.$el);
}