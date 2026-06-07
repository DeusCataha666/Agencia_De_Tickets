$(document).ready(function () {
    var $table = $('#example1');

    if ($table.length && !$.fn.dataTable.isDataTable($table)) {
        $table.DataTable({
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json',
            },
        });
    }

    var routeMap = {
        ticket: '/cambioestadoticket',
        comentario: '/cambioestadocomentario',
        usuario: '/cambioestadousuario',
        cliente: '/cambioestadocliente',
        tipousuario: '/cambioestadotipousuario',
    };

    $(document).on('change', '.toggle-class', function () {
        var $toggle = $(this);
        var isChecked = $toggle.prop('checked');
        var elementType = $toggle.data('type');
        var elementId = $toggle.data('id');
        var url = routeMap[elementType];

        if (!url || !elementId) {
            return;
        }

        $.ajax({
            type: 'GET',
            dataType: 'json',
            url: url,
            data: {
                id: elementId,
                estado: isChecked ? 1 : 0,
            },
            success: function (data) {
                if (!data.success) {
                    $toggle.prop('checked', !isChecked);
                }
            },
            error: function () {
                $toggle.prop('checked', !isChecked);
                alert('No se pudo guardar el cambio de estado. Intenta de nuevo.');
            },
        });
    });
});
