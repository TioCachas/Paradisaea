$(document).ready(function() {
    dataSource = new kendo.data.DataSource({
        transport: {
            create: {
                url: appBosch.crud.create,
                dataType: "json",
                statusCode: {
                    404: function() {
                        alert("El código de pérdida no está disponible");
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
                        alert("El código de pérdida no está disponible");
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
                    code: {
                        editable: true,
                        nullable: false,
                        validation: {
                            required: true
                        }
                    },
                    description: {
                        editable: true,
                        nullable: false,
                        validation: {
                            required: true
                        }
                    },
                    type: {
                        field: "type",
                        defaultValue: appBosch.typesLosses[0].value,
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
        toolbar: [{name: "create", text: "Agregar código de pérdida"}],
        columns: [
            {field: "code", title: "Código"},
            {field: "description", title: "Descripción"},
            {field: "type", title: "Tipo de pérdida", values: appBosch.typesLosses, },
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
            confirmation: "¿Estas seguro que deseas eliminar este código de pérdida?",
            mode: "inline",
        }
    });
});