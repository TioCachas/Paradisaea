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
                        }
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
        height: '100%',
        toolbar: [{name: "create", text: "Agregar pérdida técnica"}],
        columns: [
            {
                field: "value",
                title: "Valor",
                width: "80px",
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
            confirmation: "¿Estas seguro que deseas eliminar está pérdida técnica?",
            mode: "inline"
        }
    });
});
function workstationDropDownEditor(container, options) {
    $('<input id="workstations" required data-text-field="text" data-value-field="value" data-bind="value:' + options.field + '"/>')
            .appendTo(container)
            .kendoDropDownList({
                autoBind: false,
                dataSource: appBosch.workstationsByLine,
            });
}

function defectDropDownEditor(container, options) {
    $('<input required data-text-field="text" data-value-field="value" data-bind="value:' + options.field + '"/>')
            .appendTo(container)
            .kendoDropDownList({
                cascadeFrom: "workstations",
                autoBind: false,
                dataSource: {
                    type: "json",
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