/*
 *  Document   : be_tables_datatables.js
 *  Author     : pixelcave
 *  Description: Custom JS code used in Tables Datatables Page
 */

var BeTableDatatables = function() {
    // Override a few DataTable defaults, for more examples you can check out https://www.datatables.net/
    var exDataTable = function() {
        jQuery.extend( jQuery.fn.dataTable.ext.classes, {
            sWrapper: "dataTables_wrapper dt-bootstrap4"
        });
    };

    // Init full DataTable, for more examples you can check out https://www.datatables.net/
    var initDataTableFull = function() {
        jQuery('.js-dataTable-full').dataTable({
            columnDefs: [ { orderable: false, targets: [ 4 ] } ],
            pageLength: 8,
            lengthMenu: [[5, 8, 15, 20], [5, 8, 15, 20]],
            autoWidth: false,
            language: {
                processing: "В процессе",
                search: "Поиск&nbsp;:",
                lengthMenu: "Количество _MENU_ элементов",
                info: "Показаны с _START_ по _END_ из _TOTAL_ элементов",
                // infoEmpty: "Affichage de l'&eacute;lement 0 &agrave; 0 sur 0 &eacute;l&eacute;ments",
                // infoFiltered: "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
                infoPostFix: "",
                loadingRecords: "Загрузка...",
                zeroRecords: "Не найдено",
                emptyTable: "Пустая",
                paginate: {
                    first: "Первая",
                    previous: "Предыдущая",
                    next: "Следующая",
                    last: "Последняя"
                },
                paging: false,
            },
        });
        $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
            $($.fn.dataTable.tables(true)).DataTable()
                .columns.adjust();
        });
    };


    return {
        init: function() {
            // Override a few DataTable defaults
            exDataTable();

            // Init Datatables
            initDataTableFull();
        }
    };
}();

// Initialize when page loads
jQuery(
    function(){ BeTableDatatables.init();

    });