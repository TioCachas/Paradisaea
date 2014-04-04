$(document).ready(function() {
    dataSource = new kendo.data.DataSource({
        transport: {
            /**
             * TIP!
             * Las objetos CREATE, READ, UPDATE y DESTROY corresponden aun objeto
             * que se invoca utilizando $.ajax
             * https://api.jquery.com/jQuery.ajax/
             */
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
            /**
             * Esta funcion permite especificar como se envia el modelo dependiendo
             * del tipo de operacion que se invoca.
             */
            parameterMap: function(options, operation) {
                var params = {};
                switch (operation)
                {
                    case 'create':
                        /// Arreglo de modelos
                        params = {models: kendo.stringify(options.models)};
                    case 'read':
                        /// Sin parametros
                        break;
                    case 'update':
                        /// Arreglo de modelos
                        params = {models: kendo.stringify(options.models)};
                        break;
                    case 'destroy':
                        /// Id del modelo a eliminar
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
                    comment: {
                        type: "string",
                        validation: {
                            required: true
                        }
                    }
                }
            }
        }
    });
    $("#grid").kendoGrid({
        dataSource: dataSource,
        pageable: false,
        scrollable: true,
        filterable: false,
        selectable: true,
        navigatable: true,
        resizable: true,
        sortable: {
            mode: "single",
            allowUnsort: false
        },
        height: '100%',
        toolbar: [{name: "create", text: "Agregar comentario de pérdida de calidad"}],
        columns: [
            {
                field: "comment",
                title: "Comentario"
            },
            {
                command: [
                    {
                        name: "edit",
                        text: {
                            edit: "",
                            update: "",
                            cancel: ""
                        }
                    },
                    {
                        name: "destroy",
                        text: ""
                    }
                ],
                title: "&nbsp;"
            }
        ],
        editable: {
            confirmation: "¿Estas seguro que deseas eliminar este comentario de pérdida de calidad?",
            mode: "inline"
        }
    });
});