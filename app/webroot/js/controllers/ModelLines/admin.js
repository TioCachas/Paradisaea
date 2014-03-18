$(document).ready(function() {
    dataSource = new kendo.data.DataSource({
        transport: {
            create: {
                url: appBosch.crud.create,
                dataType: "json",
                statusCode: {
                    404: function() {
                        alert("El modelo ya está asociado a está línea");
                    }
                }
            },
            read: {
                url: appBosch.crud.read,
                dataType: "json"
            },
            update: {
                url: appBosch.crud.update,
                dataType: "json",
                statusCode: {
                    404: function() {
                        alert("El modelo ya está asociado a está línea");
                    }
                }
            },
            destroy: {
                url: appBosch.crud.destroy,
                dataType: "json"
            },
            parameterMap: function(options, operation) {
                var params = {};
                switch (operation)
                {
                    case 'create':
                        params = {models: kendo.stringify(options.models)};
                    case 'read':
                        break;
                    case 'update':
                        params = {models: kendo.stringify(options.models)};
                        break;
                    case 'destroy':
                        params = {id: options.models[0].id};
                }
                return params;
            }
        },
        batch: true,
        pageSize: 10,
        schema: {
            model: {
                id: "id",
                fields: {
                    model_id: {
                        field: "model_id",
                        defaultValue: appBosch.models[0].value,
                        editable: true,
                        nullable: false
                    }
                }
            }
        }
    });

    $("#grid").kendoGrid({
        dataSource: dataSource,
        pageable: true,
        height: 520,
        toolbar: [{name: "create", text: "Asociar modelo"}],
        columns: [
            {field: "model_id", title: "Modelo", values: appBosch.models, },
            {command: [
                    {
                        name: "edit",
                        text: {
                            edit: "Editar",
                            update: "Actualizar",
                            cancel: "Cancelar"
                        },
                    },
                    {
                        name: "destroy",
                        text: "Eliminar"
                    }], title: "&nbsp;"}],
        editable: {
            confirmation: "¿Estas seguro que deseas desasociar este modelo?",
            mode: "inline",
        }
    });
});