Project.Models.ProductionUser = Backbone.Model.extend({
    initialize: function() {
        this.on('change:pStatus', function() {

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