Project.Views.Operation = Backbone.View.extend({
    events: {
        'click .fa-eye, .fa-eye-slash': function()
        {
            selectedModel = this.model;
            this.model.collection.target.find('.modal.status .comment').val('');
            this.model.collection.target.find('.modal.status .save').attr('disabled', 'disabled');
            this.model.collection.target.find('.modal.status').modal('show');
//        var oId = this.model.get('oId');
//        var oStatus = this.model.get('oStatus');
//        $('tr[data-id="' + oId + '"] .status .fa').addClass('hidden');
//        $('tr[data-id="' + oId + '"] .status .fa-refresh').removeClass('hidden');
//        this.model.set('oStatus', oStatus === '1' ? 0 : 1);
        },
        'click td.hour': function()
        {
            selectedModel = this.model;
            this.collection.target.find('.modal.hours .hour').val('');
            this.collection.target.find('.modal.hours .save').attr('disabled', 'disabled');
            this.collection.target.find('.modal.hours').modal('show');
        }
        ,
        'click td.line'
                : function()
        {
            selectedModel = this.model;
            $('#modalLines .save').attr('disabled', 'disabled');
            $('#modalLines select').attr('disabled', 'disabled');
            $('#modalLines').modal('show');
            var l = this.model.get('l');
            var url = urlGetLines + '/' + l.id;
            $.post(url, {}, function(code) {
                $('#modalLines select').html(code);
                $('#modalLines select').removeAttr('disabled');
                $('#modalLines .save').removeAttr('disabled', 'disabled');
            });
        }
    },
    initialize: function()
    {
        this.template = swig.compile($('#rowOperation').html());
    },
    render: function() {
        var data = this.model.toJSON();
        this.setElement(this.template(data));
        return this;
    }
});