$(document).ready(function()
{
    $('div[role="dialog"] textarea.comment').on('change', changeComment);
    $('div[role="dialog"].status button.save').on('click', saveStatus);
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
function saveStatus() {
    var dialog = $(this).parents('div[role="dialog"]');
    var oStatus = parseInt(selectedModel.get('oStatus'));
    var newStatus = oStatus === 0 ? 1 : 0;
    selectedModel.set('oStatus', newStatus);
    dialog.modal('hide');
}

/**
 * Inicamos la descarga de las operaciones
 */
function exportOperations() {
    $(location).attr('href', window.collections.operations.urlExport);
}