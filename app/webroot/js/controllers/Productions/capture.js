$(document).ready(function() {
    window.collections.productionUser = new Project.Collections.ProductionsUser();
    window.collections.productionUser.url = urlGetProductions;
    window.collections.productionUser.target = $('#operations');
    window.collections.productionUser.fetch();
});