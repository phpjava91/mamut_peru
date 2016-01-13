<?php require_once('../../globales_sistema.php'); ?>
jQuery.fn.reset = function () {
$(this).each (function() { this.reset(); });
}

function insert(){
var id = $('#id').val();

var id_unidad = $('#id_unidad').val();

var fecha = $('#fecha').val();

$.post('ws/configuracion_vehiculo.php', {op: 'add',id:id,id_unidad:id_unidad,fecha:fecha}, function(data) {
if(data === 0){
$('body,html').animate({
scrollTop: 0
}, 800);
$('#merror').show('fast').delay(4000).hide('fast');
}
else{
    $("#frame_acoples").attr('src','acoples_configuracion.php?idc='+data);
    $("#panel_acoples").show("fast");
    $("#id").val(data);
}
}, 'json');
}
function update(){
var id = $('#id').val();

var id_unidad = $('#id_unidad').val();

var fecha = $('#fecha').val();

$.post('ws/configuracion_vehiculo.php', {op: 'mod',id:id,id_unidad:id_unidad,fecha:fecha}, function(data) {
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
$.post('ws/configuracion_vehiculo.php', {op: 'get', id: id}, function(data) {
if(data !== 0){

$('#id').val(data.id);

sel_id_unidad(data.id_unidad.id);
$('#fecha').val(data.fecha);

}
}, 'json');
}
function del(id){
$.post('ws/configuracion_vehiculo.php', {op: 'del', id: id}, function(data) {
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
var tbl = $('#tb').dataTable();
tbl.fnSort( [ [0,'desc'] ] );

$.post('ws/unidad.php', {op: 'list'}, function(data) {
if(data != 0){
$('#data_tbl_modal_id_unidad').html('');
var ht = '';
$.each(data, function(key, value) {
ht += '<tr>';
    ht += '<td><a href="#" onclick="sel_id_unidad('+value.id+')">SEL</a></td>';ht += '<td>'+value.id+'</td>';ht += '<td>'+value.id_tipo_unidad.<?php
        echo $gl_unidad_id_tipo_unidad;
        ?>+'</td>';ht += '<td>'+value.placa+'</td>';
    ht += '</tr>';
});
$('#data_tbl_modal_id_unidad').html(ht);
$('#tbl_modal_id_unidad').dataTable();
}
}, 'json');
$('#fecha').datepicker({dateFormat: 'yy-mm-dd',
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

function sel_id_unidad(id_e){
$.post('ws/unidad.php', {op: 'get', id:id_e}, function(data) {
if(data != 0){
$('#id_unidad').val(data.id);
$('#txt_id_unidad').html(data.<?php
echo $gl_configuracion_vehiculo_id_unidad;
?>);
$('#modal_id_unidad').modal('hide');
}
}, 'json');
}

function fin(){
    $('#frmall').reset();
    $('body,html').animate({
    scrollTop: 0
    }, 800);
    $('#msuccess').show('fast').delay(4000).hide('fast');
    location.reload();
}

function cancelar(){
var mid = $("#id").val();
$.post('ws/configuracion_vehiculo.php', {op: 'del', id: mid}, function(data) {
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