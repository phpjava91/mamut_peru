<?php require_once('../../globales_sistema.php'); ?>
jQuery.fn.reset = function () {
$(this).each (function() { this.reset(); });
}

function update(){
var id = $('#id').val();

var id_conductor = $('#id_conductor').val();

var id_supervisor = $('#id_supervisor').val();

var id_turno = $('#id_turno').val();

var id_trayecto = $('#id_trayecto').val();

var fecha = $('#fecha').val();

var id_configuracion_vehiculo = $('#id_configuracion_vehiculo').val();

var peso_bruto = $('#peso_bruto').val();

var tara = $('#tara').val();

var peso_neto = $('#peso_neto').val();

var id_estado_carga = $('#id_estado_carga').val();

var facturado = $('#facturado').find('option:selected').val();

var numero_facturacion = $('#numero_facturacion').val();

$.post('ws/registro.php', {op: 'mod',id:id,id_conductor:id_conductor,id_supervisor:id_supervisor,id_turno:id_turno,id_trayecto:id_trayecto,fecha:fecha,id_configuracion_vehiculo:id_configuracion_vehiculo,peso_bruto:peso_bruto,tara:tara,peso_neto:peso_neto,id_estado_carga:id_estado_carga,facturado:facturado,numero_facturacion:numero_facturacion}, function(data) {
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
location.reload();
}
}, 'json');
}

function sel(id){
$.post('ws/registro.php', {op: 'get', id: id}, function(data) {
if(data !== 0){

$('#id').val(data.id);

sel_id_conductor(data.id_conductor.id);
sel_id_supervisor(data.id_supervisor.id);
sel_id_turno(data.id_turno.id);
sel_id_trayecto(data.id_trayecto.id);
$('#fecha').val(data.fecha);
sel_id_configuracion_vehiculo(data.id_configuracion_vehiculo.id);
$('#peso_bruto').val(data.peso_bruto);
$('#tara').val(data.tara);
$('#peso_neto').val(data.peso_neto);
if(data.peso_neto !== ''){
    sel_id_estado_carga(data.id_estado_carga.id);
}
$('#facturado option[value="'+data.facturado+'"]').attr('selected', true);
$('#numero_facturacion').val(data.numero_facturacion);

$("#panel_busqueda").hide("fast");
$("#panel_data").show("fast");
document.getElementById("peso_bruto").focus();
}
}, 'json');
}

function del(id){
$.post('ws/registro.php', {op: 'del', id: id}, function(data) {
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

$('#fecha_busqueda').datepicker({dateFormat: 'yy-mm-dd',
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

function sel_id_conductor(id_e){
$.post('ws/conductor.php', {op: 'get', id:id_e}, function(data) {
if(data != 0){
$('#id_conductor').val(data.id);
$('#txt_id_conductor').html(data.nombres+" "+data.apellidos);
}
}, 'json');
}

function sel_id_supervisor(id_e){
$.post('ws/supervisor.php', {op: 'get', id:id_e}, function(data) {
if(data != 0){
$('#id_supervisor').val(data.id);
$('#txt_id_supervisor').html(data.nombres+" "+data.apellidos);
}
}, 'json');
}

function sel_id_turno(id_e){
$.post('ws/turno.php', {op: 'get', id:id_e}, function(data) {
if(data != 0){
$('#id_turno').val(data.id);
$('#txt_id_turno').html(data.<?php echo $gl_registro_id_turno;?>);
}
}, 'json');
}

function sel_id_trayecto(id_e){
$.post('ws/trayecto.php', {op: 'get', id:id_e}, function(data) {
if(data != 0){
$('#id_trayecto').val(data.id);
$('#txt_id_trayecto').html(data.<?php echo $gl_registro_id_trayecto;?>);
}
}, 'json');
}

function sel_id_configuracion_vehiculo(id_e){
$.post('ws/configuracion_vehiculo.php', {op: 'get', id:id_e}, function(data) {
if(data != 0){
    $('#id_configuracion_vehiculo').val(data.id);
    $('#txt_id_configuracion_vehiculo').html(data.id_unidad.placa+"("+data.tipo.nombre+")"+" "+data.acoples) 
    $.post('ws/tipo_unidad.php', {op: 'get', id: data.id_unidad.id_tipo_unidad}, function(data1) {
    if(data1 != 0){
       $("#minimo").val(data1.carga_minima);
       $("#maximo").val(data1.carga_maxima);
    }
    }, 'json');
}
}, 'json');
}

function sel_id_estado_carga(id_e){
$.post('ws/estado_carga.php', {op: 'get', id:id_e}, function(data) {
if(data != 0){
$('#id_estado_carga').val(data.id);
$('#txt_id_estado_carga').html(data.<?php echo $gl_registro_id_estado_carga;?>);
}
}, 'json');
}

function calcula_neto(){
    var peso_bruto = $('#peso_bruto').val();
    var tara = $('#tara').val();
    pneto = parseFloat(peso_bruto) - parseFloat(tara);
    $('#peso_neto').val(pneto);
    var minimo = parseFloat($("#minimo").val());
    var maximo = parseFloat($("#maximo").val());
    if(pneto < minimo){
        sel_id_estado_carga(1);
    }
    if(pneto >= minimo && pneto <= maximo){
        sel_id_estado_carga(2);
    }
    if(pneto > maximo){
        sel_id_estado_carga(3);
    }
}

function filtrar(){
    var fecha_busqueda = $("#fecha_busqueda").val();
    var turno_busqueda = $("#turno_busqueda").find('option:selected').val();
    
    location.href = "registro_pendiente.php?fb="+fecha_busqueda+"&tu="+turno_busqueda;
}