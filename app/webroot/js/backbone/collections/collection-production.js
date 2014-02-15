Project.Collections.Productions = Backbone.Collection.extend({
    model: Project.Models.Production,
    url: urlGetProductions,
    initialize: function() {
        this.on('add', function(model) {
            var view = new Project.Views.Production({model: model});
            view.render();
            view.$el.appendTo('#productions table.detail tbody');
        }, this);
        this.fetch({
            success: function()
            {
                var total = 0;
                var totalEnabled = 0;
                var totalDisabled = 0;
                window.collections.productions.each(function(m) {
                    var p = m.get('p');
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
                if (window.collections.productions.length > 0)
                {
                    $('#productions div.panel').removeClass('hidden');
                }
                else
                {
                    $('#productions div.empty').removeClass('hidden');
                }
                $('#productions div.loader').addClass('hidden');
            }
        });
    }
});