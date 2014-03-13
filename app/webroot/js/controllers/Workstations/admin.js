$(document).ready(function() {
    dataSource = new kendo.data.DataSource({
        transport: {
            create: {
                url: appBosch.crud.create,
                dataType: "json"
            },
            read: {
                url: appBosch.crud.read,
                dataType: "json"
            },
            update: {
                url: appBosch.crud.update,
                dataType: "json"
            },
            destroy: {
                url: appBosch.crud.destroy,
                dataType: "json"
            },
            parameterMap: function(options, operation) {
                if (operation !== "read" && options.models) {
                    return {models: kendo.stringify(options.models)};
                }
            }
        },
        batch: true,
        pageSize: 10,
        schema: {
            model: {
                id: "wId",
                fields: {
                    wName: {editable: true, nullable: false, validation: {required: true, min: 1}},
                    lName: {editable: false, nullable: false}
                }
            }
        }
    });

    $("#grid").kendoGrid({
        dataSource: dataSource,
        pageable: true,
        height: 520,
        toolbar: ["create"],
        columns: [
            {field: "wName", title: "Estacion"},
            {field: "lName", title: "Linea"},
            {command: {text: "Defectos", click: showDefects}, title: "Defectos"},
            {command: ["edit", "destroy"], title: "&nbsp;"}],
        editable: 'inline'
    });
});

function showDefects(e)
{
    e.preventDefault();
    var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
    var id = dataItem.id;
    var url = appBosch.urlDefects + '/' + id;
    $(location).attr('href', url);
}