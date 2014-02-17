Project.Models.Operation = Backbone.Model.extend({
    initialize: function() {
        this.on('change:oStatus', function() {
            var oId = this.get('oId');
            var url = urlToggleStatus + '/' + oId;
            var model = this;
            $.post(url, {}, function()
            {
                render(model);
            });
        }, this);
        this.on('change:hId', function() {
            var oId = this.get('oId');
            var hId = this.get('hId');
            var url = urlChangeHour + '/' + oId;
            $('tr[data-id="' + oId + '"] .status .fa').addClass('hidden');
            $('tr[data-id="' + oId + '"] .status .fa-refresh').removeClass('hidden');
            $.post(url, {h: hId, c: hComment}, function(newHourStr)
            {
                selectedModel.set('hour', newHourStr);
                $('tr[data-id="' + oId + '"] .status .fa').removeClass('hidden');
                $('tr[data-id="' + oId + '"] .status .fa-refresh').addClass('hidden');
                render(selectedModel);
            }, 'json');
        }, this);
        this.on('change:lId', function() {
            var o = this.get('o');
            var l = this.get('l');
            var url = urlChangeLine + '/' + o.id;
            $('tr[data-id="' + o.id + '"] .status .fa').addClass('hidden');
            $('tr[data-id="' + o.id + '"] .status .fa-refresh').removeClass('hidden');
            $.post(url, {l: l.id}, function(newLineStr)
            {
                var l = selectedModel.get('l');
                l.name = newLineStr;
                selectedModel.set('l.name', newLineStr);
                $('tr[data-id="' + o.id + '"] .status .fa').removeClass('hidden');
                $('tr[data-id="' + o.id + '"] .status .fa-refresh').addClass('hidden');
                render(selectedModel);
            }, 'json');
        }, this);
        this.on('change:o.production', function() {
            render(this);
        }, this);
    }
});

function render(m)
{
    var view = new Project.Views.Operation({model: m});
    var oId = m.get('oId');
    view.render();
    $('tr[data-id="' + oId + '"]').replaceWith(view.$el);
}