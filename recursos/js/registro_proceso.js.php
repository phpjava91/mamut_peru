<?php require_once('../../globales_sistema.php'); ?>
jQuery.fn.reset = function () {
$(this).each (function() { this.reset(); });
}

function insert(){
var id = $('#id').val();

var id_registro = $('#id_registro').val();

var id_proceso = $('#id_proceso').val();

var fecha_inicio = $('#fecha_inicio').val();

var hora_inicio = $('#hora_inicio').val();

var fecha_fin = $('#fecha_fin').val();

var hora_fin = $('#hora_fin').val();

var tipo_extra = $("#tipo_extra").val();
var id_valor_proceso = $("#id_extra").val();
var dato = "";
switch(tipo_extra){
    case '1':
        var dato = $('#dato_extra_sino').find('option:selected').val();
    break;
    
    case '2':
        var dato = $('#dato_extra_valores').find('option:selected').val();
    break;
    
    case '3':
        var dato = $("#dato_extra").val();
    break;
}

$.post('ws/registro_proceso.php', {op: 'add',id:id,id_registro:id_registro,id_proceso:id_proceso,fecha_inicio:fecha_inicio,hora_inicio:hora_inicio,fecha_fin:fecha_fin,hora_fin:hora_fin,tipo_extra:tipo_extra,id_valor_proceso:id_valor_proceso,dato:dato}, function(data) {
if(data === 0){
$('body,html').animate({
scrollTop: 0
}, 800);
$('#merror').show('fast').delay(4000).hide('fast');
}
else{
$('#frmall').reset();
$('body,html').animate({
scrollTop: 0
}, 800);
$('#msuccess').show('fast').delay(4000).hide('fast');
    location.href = 'registro_proceso.php?fecha_inicio='+fecha_inicio+"&fecha_fin="+fecha_fin+"&idr="+id_registro;
}
}, 'json');
}

function update(){
var id = $('#id').val();

var id_registro = $('#id_registro').val();

var id_proceso = $('#id_proceso').val();

var fecha_inicio = $('#fecha_inicio').val();

var hora_inicio = $('#hora_inicio').val();

var fecha_fin = $('#fecha_fin').val();

var hora_fin = $('#hora_fin').val();

var tipo_extra = $("#tipo_extra").val();
var id_valor_proceso = $("#id_extra").val();
var dato = "";
switch(tipo_extra){
    case '1':
        var dato = $('#dato_extra_sino').find('option:selected').val();
    break;
    
    case '2':
        var dato = $('#dato_extra_valores').find('option:selected').val();
    break;
    
    case '3':
        var dato = $("#dato_extra").val();
    break;
}

$.post('ws/registro_proceso.php', {op: 'mod',id:id,id_registro:id_registro,id_proceso:id_proceso,fecha_inicio:fecha_inicio,hora_inicio:hora_inicio,fecha_fin:fecha_fin,hora_fin:hora_fin,tipo_extra:tipo_extra,id_valor_proceso:id_valor_proceso,dato:dato}, function(data) {
if(data === 0){
$('body,html').animate({
scrollTop: 0
}, 800);
$('#merror').show('fast').delay(4000).hide('fast');
}
else{
$('#frmall').reset();
$('body,html').animate({
scrollTop: 0
}, 800);
$('#msuccess').show('fast').delay(4000).hide('fast');
    location.href = 'registro_proceso.php?fecha_inicio='+fecha_inicio+"&fecha_fin="+fecha_fin+"&idr="+id_registro;
}
}, 'json');
}

function del(id){
$.post('ws/registro_proceso.php', {op: 'del', id: id}, function(data) {
if(data === 0){
$('body,html').animate({
scrollTop: 0
}, 800);
$('#merror').show('fast').delay(4000).hide('fast');
}
else{
$('body,html').animate({
scrollTop: 0
}, 800);
$('#msuccess').show('fast').delay(4000).hide('fast');
location.reload();
}
}, 'json');
}

$(document).ready(function() {
var tbl = $('#tb').dataTable({
"iDisplayLength": 5
});
tbl.fnSort( [ [0,'desc'] ] );

$.post('ws/proceso.php', {op: 'list'}, function(data) {
if(data != 0){
$('#data_tbl_modal_id_proceso').html('');
var ht = '';
$.each(data, function(key, value) {
    ht += '<tr>';
    ht += '<td><a href="#" onclick="sel_id_proceso('+value.id+')">SEL</a></td>';
    ht += '<td>'+value.id+'</td>';
    ht += '<td>'+value.nombre+'</td>';
    ht += '<td>'+value.control_tiempos+'</td>';
    ht += '</tr>';
});
$('#data_tbl_modal_id_proceso').html(ht);
$('#tbl_modal_id_proceso').dataTable();
}
}, 'json');

$('#fecha_inicio').datepicker({dateFormat: 'yy-mm-dd',
changeMonth: true,
changeYear: true
});
$('#fecha_fin').datepicker({dateFormat: 'yy-mm-dd',
changeMonth: true,
changeYear: true
});
});

function save(){
var vid = $('#id').val();
if(vid === '0')
{
insert();
}
else
{
update();
}
}


function sel_id_proceso(id_e){
$.post('ws/proceso.php', {op: 'get', id:id_e}, function(data) {
if(data != 0){
$('#id_proceso').val(data.id);
$('#txt_id_proceso').html(data.nombre);
switch(data.control_tiempos){
    case '0':
        $("#panel_inicio").hide("fast");
        $("#panel_fin").hide("fast");
    break;
    
    case '1':
        $("#panel_inicio").show("fast");
        $("#panel_fin").hide("fast");
    break;
    
    case '2':
        $("#panel_inicio").show("fast");
        $("#panel_fin").show("fast");
    break;
}

switch(data.data_necesaria){
    case 'nope':
        $("#panel_extra_sino").hide("fast");
        $("#panel_extra_valores").hide("fast");
        $("#panel_extra_dato").hide("fast");
        
        $("#tipo_extra").val(0);
    break;
    
    case '1':
        $("#panel_extra_sino").show("fast");
        $("#panel_extra_valores").hide("fast");
        $("#panel_extra_dato").hide("fast");
        
        $("#label_extra_sino").html(data.nombre_data);
        $("#tipo_extra").val(1);
        $("#id_extra").val(data.id_valor_proceso);
    break;
    
    case '2':
        $("#panel_extra_sino").hide("fast");
        $("#panel_extra_valores").show("fast");
        $("#panel_extra_dato").hide("fast");
        
        $("#label_extra_valores").html(data.nombre_data);
        var valores = data.valores_data;
        valores = valores.split(";");
        var htmlvalores = "";
        for (i = 0; i < valores.length; i++) { 
            htmlvalores += "<option value='"+valores[i]+"'>"+valores[i]+"</option>";
        }
        $("#dato_extra_valores").html(htmlvalores);
        $("#tipo_extra").val(2);
        $("#id_extra").val(data.id_valor_proceso);
    break;
    
    case '3':
        $("#panel_extra_sino").hide("fast");
        $("#panel_extra_valores").hide("fast");
        $("#panel_extra_dato").show("fast");
        
        $("#label_extra_dato").html(data.nombre_data);
        $("#tipo_extra").val(3);
        $("#id_extra").val(data.id_valor_proceso);
    break;
    
    
}
$('#modal_id_proceso').modal('hide');
}
}, 'json');
}

function sel(id_e){
$.post('ws/registro_proceso.php', {op: 'get', id: id_e}, function(data) {
if(data !== 0){
        sel_id_proceso(data.id_proceso.id);
        $('#id').val(data.id);
        $('#id_registro').val(data.id_registro.id);
        $('#fecha_inicio').val(data.fecha_inicio);
        $('#hora_inicio').val(data.hora_inicio);
        $('#fecha_fin').val(data.fecha_fin);
        $('#hora_fin').val(data.hora_fin);
        switch(tipo_extra){
            case '1':
                $('#dato_extra_sino option[value="'+data.dato_extra+'"]').attr('selected', true);
            break;

            case '2':
                $('#dato_extra_valores option[value="'+data.dato_extra+'"]').attr('selected', true);
            break;

            case '3':
                $("#dato_extra").val(data.dato_extra);
            break;
        }
}
},'json');

}