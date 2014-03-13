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
                id: "id",
                fields: {
                    name: {
                        editable: true,
                        nullable: false,
                        validation: {
                            required: true,
                            min: 1
                        }
                    }
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
            {field: "name", title: "Nombre"},
            {command: {text: "Estaciones de trabajo", click: showWorkstations}, title: "Estaciones de trabajo"},
            {command: ["edit", "destroy"], title: "&nbsp;"}],
        editable: 'inline'
    });
});

function showWorkstations(e)
{
    e.preventDefault();
    var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
    var id = dataItem.id;
    var url = appBosch.urlWorkstations + '/' + id;
    $(location).attr('href', url);
}