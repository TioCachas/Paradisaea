$(document).ready(function() {
    window.collections.operations = new Project.Collections.Operations();
    window.collections.operations.target = $('#operations');
    window.collections.operations.fetch();

    window.collections.productions = new Project.Collections.Productions();
    window.collections.productions.target = $('#productions');
    window.collections.productions.fetch();
});