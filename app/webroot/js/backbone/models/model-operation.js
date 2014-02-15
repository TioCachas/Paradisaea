Project.Models.Operation = Backbone.Model.extend({
    initialize: function() {
        this.on('change:o.status', function() {
            var o = this.get('o');
            var url = urlToggleStatus + '/' + o.id;
            var m = this;
            $.post(url, {}, function()
            {
                render(m);
            });
        }, this);
        this.on('change:h.id', function() {
            var o = this.get('o');
            var h = this.get('h');
            var url = urlChangeHour + '/' + o.id;
            $('tr[data-id="' + o.id + '"] .status .fa').addClass('hidden');
            $('tr[data-id="' + o.id + '"] .status .fa-refresh').removeClass('hidden');
            $.post(url, {h: h.id, c: h.comment}, function(newHourStr)
            {
                var a = selectedModel.get('a');
                a.hour = newHourStr;
                selectedModel.set('a.hour', newHourStr);
                $('tr[data-id="' + o.id + '"] .status .fa').removeClass('hidden');
                $('tr[data-id="' + o.id + '"] .status .fa-refresh').addClass('hidden');
                render(selectedModel);
            }, 'json');
        }, this);
        this.on('change:l.id', function() {
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
    console.log(1);
    var view = new Project.Views.Operation({model: m});
    var m = m.get('o');
    view.render();
    $('tr[data-id="' + m.id + '"]').replaceWith(view.$el);
}