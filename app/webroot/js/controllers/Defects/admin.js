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
                    code: {
                        editable: true,
                        nullable: false,
                        validation: {
                            required: true,
                            min: 1
                        }
                    },
                    description: {
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
            {field: "code", title: "Codigo"},
            {field: "description", title: "Descripcion"},
            {command: ["edit", "destroy"], title: "&nbsp;"}],
        editable: 'inline'
    });
});