$(document).ready(function()
{
    $('#operations div[role="dialog"] textarea.comment').on('change', changeComment);
    $('#operations div[role="dialog"].status button.save').on('click', changeStatus);
    $('#operations div[role="dialog"].hour button.save').on('click', changeHour);
    $('#operations div[role="dialog"].line button.save').on('click', changeLine);
    $('#operations i.fa-download').on('click', exportOperations);
});


/**
 * Checamos el comentario y si su valor es diferente a cadena vacia entonces
 * activamos el boton de guardar.
 * IMPORTANTE!!! 
 * Esta función afecta a todos los dialgos que contengan un campo comentario
 * tener cuidado al cambiar está función ya que afecta a todos los dialogos.
 */
function changeComment()
{
    var comment = $(this).val().trim();
    var dialog = $(this).parents('div[role="dialog"]');
    dialog.find('.save').attr('disabled', 'disabled');
    if (comment !== '')
    {
        dialog.find('.save').removeAttr('disabled');
    }
}

/**
 * Cambiamos el estatus y mostramos el dialogo.
 * De aqui deberias ir a ver el evento de cambio de estatus del modelo ;)
 */
function changeStatus() {
    var dialog = $(this).parents('div[role="dialog"].status');
    var oStatus = parseInt(selectedModel.get('oStatus'));
    var newStatus = oStatus === 0 ? 1 : 0;
    selectedModel.set('oStatus', newStatus);
    dialog.modal('hide');
}

/**
 * Cambiamos la hora
 * De aqui deberias ir a ver el evento de cambio de hora del modelo ;)
 */
function changeHour() {
    var dialog = $(this).parents('div[role="dialog"].hour');
    var hourId = dialog.find('select.hour').val();
    selectedModel.set('hId', hourId);
    dialog.modal('hide');
}

/**
 * Cambiamos la hora
 * De aqui deberias ir a ver el evento de cambio de linea del modelo ;)
 */
function changeLine() {
    var dialog = $(this).parents('div[role="dialog"].line');
    var lineId = dialog.find('select.line').val();
    selectedModel.set('lId', lineId);
    dialog.modal('hide');
}

/**
 * Inicamos la descarga de las operaciones
 */
function exportOperations() {
    $(location).attr('href', window.collections.operations.urlExport);
}