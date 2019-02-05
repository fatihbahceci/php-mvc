var DTConstants = new Object();
DTConstants.Language = {
    "sProcessing": "İşleniyor...",
    "sLengthMenu": "Sayfada _MENU_ Kayıt Göster",
    "sZeroRecords": "Eşleşen Kayıt Bulunmadı",
    "sInfo": "  _START_ - _END_ / _TOTAL_ ",
    "sInfoEmpty": "Kayıt Yok",
    "sInfoFiltered": "(_MAX_ Kayıt)",
    "sInfoPostFix": "",
    "sSearch": "",
    "sSearchPlaceholder": "Filtrele",
    "sUrl": "",
    "oPaginate": {
        "sFirst": "İlk",
        "sPrevious": "Önceki",
        "sNext": "Sonraki",
        "sLast": "Son"
    }
}


$.extend(true, $.fn.dataTable.defaults, {
    //"searching": false,
    //"ordering": false
    "language": DTConstants.Language
});
