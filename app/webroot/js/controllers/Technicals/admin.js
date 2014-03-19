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
                        nullable: false
                    },
                    defect_id: {
                        field: "defect_id",
                        editable: true,
                        nullable: false
                    }
                }
            }
        }
    });
    $("#grid").kendoGrid({
        dataSource: dataSource,
        pageable: false,
        height: '100%',
        toolbar: [{name: "create", text: "Agregar pérdida técnica"}],
        columns: [
            {field: "value", title: "Valor", width: "80px"},
            {
                field: "workstation_id",
                title: "Estación de trabajo",
                id: 'workstations',
                editor: workstationDropDownEditor,
                values: appBosch.workstations,
                defaultValue: appBosch.workstations[0].value,
                width: "150px"
            },
            {field: "defect_id", title: "Código de pérdida", editor: defectDropDownEditor, values: appBosch.defects, width: "350px"},
            {command: [
                    {
                        name: "edit",
                        text: {
                            edit: "",
                            update: "",
                            cancel: ""
                        },
                    },
                    {
                        name: "destroy",
                        text: ""
                    }], title: "&nbsp;"}],
        editable: {
            confirmation: "¿Estas seguro que deseas eliminar está estación de trabajo?",
            mode: "inline",
        }
    });
});

function workstationDropDownEditor(container, options) {
    $('<input id="workstations" required data-text-field="text" data-value-field="value" data-bind="value:' + options.field + '"/>')
            .appendTo(container)
            .kendoDropDownList({
                autoBind: true,
                dataSource: appBosch.workstations,
                dataBound: function(){
                    this.select(0);
                }
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