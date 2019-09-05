function openPopup(obj) {

    // serialize() -> client_name=Paulo&periodo1=2017-05-16&periodo2=2017-05-23&status=1&order=date_desc
    var data = $(obj).serialize();    
    var url = BASE_URL + "/Reports/entsaiveiculos_pdf?" + data;    
    window.open(url, "reports", "width=700,height=500");

    return false;
}

$(document).ready(function () {

});