$(document).ready(function()
{
    $('#productions div[role="dialog"] textarea.comment').on('change', changeCommentProduction);
    $('#productions div[role="dialog"].status button.save').on('click', changeStatusProduction);
    $('#productions i.fa-download').on('click', exportProductions);
});


/**
 * Checamos el comentario y si su valor es diferente a cadena vacia entonces
 * activamos el boton de guardar.
 * IMPORTANTE!!! 
 * Esta función afecta a todos los dialgos que contengan un campo comentario
 * tener cuidado al cambiar está función ya que afecta a todos los dialogos.
 */
function changeCommentProduction()
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
function changeStatusProduction() {
    var dialog = $(this).parents('div[role="dialog"].status');
    var pStatus = parseInt(window.collections.productions.selectedModel.get('pStatus'));
    var newStatus = pStatus === 0 ? 1 : 0;
    window.collections.productions.selectedModel.set('pStatus', newStatus);
    dialog.modal('hide');
}

/**
 * Inicamos la descarga de las producciones de piezas ok
 */
function exportProductions() {
    $(location).attr('href', window.collections.productions.urlExport);
}