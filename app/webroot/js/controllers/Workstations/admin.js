$(document).ready(function() {
    dataSource = new kendo.data.DataSource({
        transport: {
            create: {
                url: appBosch.crud.create,
                dataType: "json",
                statusCode: {
                    404: function() {
                        alert("El nombre de la estación de trabajo no está disponible");
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
                        alert("El nombre de la estación de trabajo no está disponible");
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
        toolbar: [{name: "create", text: "Agregar estación de trabajo"}],
        columns: [
            {field: "name", title: "Estación"},
            {command: {text: "Defectos", click: showDefects}, title: "Defectos"},
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
            confirmation: "¿Estas seguro que deseas eliminar está estación de trabajo?",
            mode: "inline",
        }
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