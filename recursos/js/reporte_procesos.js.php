jQuery.fn.reset = function () {
$(this).each (function() { this.reset(); });
}

$(document).ready(function() {
    var tbl = $('#tb').DataTable({
    "dom": 'T<"clear">lfrtip',
    "oTableTools": {
            "sSwfPath": "recursos/swf/copy_csv_xls_pdf.swf",
             "aButtons": [ "pdf", "xls", "print" ]
    }
    });
    
    $('#fecha_inicio').datepicker({dateFormat: 'yy-mm-dd',
    changeMonth: true,
    changeYear: true
    });
    
    $('#fecha_fin').datepicker({dateFormat: 'yy-mm-dd',
    changeMonth: true,
    changeYear: true
    });
});

function filtrar(){
    var fecha_inicio = $("#fecha_inicio").val();
    var fecha_fin = $("#fecha_fin").val();
    var trayecto = $("#trayecto").find('option:selected').val();
    var facturado = $("#facturado").find('option:selected').val();
    var numero_facturacion = $("#numero_facturacion").val();
    
    location.href = "reporte_procesos.php?fi="+fecha_inicio+"&ff="+fecha_fin+"&tr="+trayecto+"&fac="+facturado+"&nfac="+numero_facturacion;
}