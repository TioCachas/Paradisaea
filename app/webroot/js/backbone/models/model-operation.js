Project.Models.Operation = Backbone.Model.extend({
    initialize: function() {
        this.on('change:oStatus', function() {
            var comment = this.collection.target.find('div[role="dialog"].status textarea.comment').val();
            if (comment !== '')
            {
                this.startSaveChanges();
                var oId = this.get('oId');
                var url = urlToggleStatus + '/' + oId;
                var model = this;
                $.post(url, {c: comment}, function(newStatus)
                {
                    /// Muy importante para evitar lanzar un nuevo evento de cambio
                    /// de estatus
                    model.attributes.oStatus = newStatus;
                    render(model);
                }, 'json');
            }
        }, this);
        this.on('change:hId', function() {
            var comment = this.collection.target.find('div[role="dialog"].hour textarea.comment').val();
            if (comment !== '')
            {
                this.startSaveChanges();
                var oId = this.get('oId');
                var hId = this.get('hId');
                var url = urlChangeHour + '/' + oId;
                var model = this;
                $.post(url, {h: hId, c: comment}, function(newHourStr)
                {
                    /// Muy importante para evitar lanzar un nuevo evento de cambio
                    /// de hora
                    model.attributes.hour = newHourStr;
                    render(model);
                }, 'json');
            }
        }, this);
        this.on('change:lId', function() {
            var comment = this.collection.target.find('div[role="dialog"].line textarea.comment').val();
            if (comment !== '')
            {
                this.startSaveChanges();
                var oId = this.get('oId');
                var lId = this.get('lId');
                var url = urlChangeLine + '/' + oId;
                var model = this;
                $.post(url, {l: lId, c: comment}, function(newLineStr)
                {
                    /// Muy importante para evitar lanzar un nuevo evento de cambio
                    /// de linea
                    model.attributes.lName = newLineStr;
                    render(selectedModel);
                }, 'json');
            }
        }, this);
        this.on('change:oProduction', function() {
            render(this);
        }, this);
    },
    startSaveChanges: function()
    {
        var oId = this.get('oId');
        $('tr[data-id="' + oId + '"] .status .fa').addClass('hidden');
        $('tr[data-id="' + oId + '"] .status .fa-spin').removeClass('hidden');
    }
});

function render(m)
{
    var view = new Project.Views.Operation({model: m});
    var oId = m.get('oId');
    view.render();
    $('tr[data-id="' + oId + '"]').replaceWith(view.$el);
}