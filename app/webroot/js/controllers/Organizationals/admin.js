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
                beforeSend: function() {
                    /**
                     * Si blockUpdate === false el ajax no se ejecuta. Decimos 
                     * que la operacion UPDATE esta bloqueada.
                     */
                    return appBosch.blockEdit;
                },
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
        aggregate: [
            {field: "value", aggregate: "count"},
            {field: "value", aggregate: "sum"}],
        schema: {
            model: {
                id: "id",
                fields: {
                    value: {
                        type: "number",
                        validation: {
                            required: true,
                            min: 1
                        },
                        format: "0 min"
                    },
                    workstation_id: {
                        field: "workstation_id",
                        editable: true,
                        nullable: false,
                        defaultValue: appBosch.workstationsByLine[0].value,
                        validation: {
                            required: true
                        }
                    },
                    defect_id: {
                        field: "defect_id",
                        editable: true,
                        nullable: false,
                        defaultValue: appBosch.defectsByLine[0].value,
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
        filterable: true,
        selectable: true,
        navigatable: true,
        resizable: true,
        sortable: {
            mode: "single",
            allowUnsort: false
        },
        height: '100%',
        toolbar: [{name: "create", text: "Agregar pérdida organizacional"}],
        columns: [
            {
                field: "value",
                title: "Valor",
                width: "100px",
                format: "{0} min",
                footerTemplate: "#=sum # min"
            },
            {
                field: "workstation_id",
                title: "Estación de trabajo",
                editor: workstationDropDownEditor,
                values: appBosch.workstationsByLine,
                width: "150px"
            },
            {
                field: "defect_id",
                title: "Código de pérdida",
                editor: defectDropDownEditor,
                values: appBosch.defectsByLine,
                width: "350px"
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
            confirmation: "¿Estas seguro que deseas eliminar está pérdida organizacional?",
            mode: "inline"
        },
        edit: function() {
            /**
             * En UPDATE o CREATE bloqueamos. Se desbloquea cuando se cargan los
             * defectos.
             * Esta funcion se manda llamar cuando se da clic en el boton de nuevo
             * o editar.
             */
            appBosch.blockEdit = false;
        }
    });
});
function workstationDropDownEditor(container, options) {
    $('<input id="workstations" required data-text-field="text" data-value-field="value" data-bind="value:' + options.field + '"/>')
            .appendTo(container)
            .kendoDropDownList({
                autoBind: false,
                dataSource: appBosch.workstationsByLine,
                change: function() {
                    /**
                     * Si cambiamos una estación de trabajo bloqueamos la operación de
                     * CREATE o UPDATE. Se desbloquea hasta que se cargan los defectos
                     * asociados a la estación de trabajo que se ha seleccionado.
                     */
                    appBosch.blockEdit = false;
                }
            });
}

function defectDropDownEditor(container, options) {
    $('<input required data-text-field="text" data-value-field="value" data-bind="value:' + options.field + '"/>')
            .appendTo(container)
            .kendoDropDownList({
                cascadeFrom: "workstations",
                autoBind: false,
                dataBound: function() {
                    /**
                     * Cuando se termina la carga de los defectos, colocamos el
                     * primer defecto como default.
                     */
                    options.model.defect_id = this.dataSource.at(0).value;
                    /**
                     * Se ha terminado de cargar los defectos, desbloqueamos la operación
                     * UPDATE o CREATE.
                     */
                    appBosch.blockEdit = true;
                },
                dataSource: {
                    type: "json",
                    /**
                     * IMPORTANTE!!!
                     * En TRUE envia la estacion de trabajo que desencadeno este
                     * evento.
                     */
                    serverFiltering: true,
                    transport: {
                        read: {
                            url: appBosch.urlDefects,
                            data: {
                                type: appBosch.type
                            }
                        }
                    }
                }
            });
}