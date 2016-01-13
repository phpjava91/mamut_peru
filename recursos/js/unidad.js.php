<?php require_once('../../globales_sistema.php'); ?>
jQuery.fn.reset = function () {
$(this).each (function() { this.reset(); });
}

function insert(){
var id = $('#id').val();

var id_tipo_unidad = $('#id_tipo_unidad').val();

var placa = $('#placa').val();

$.post('ws/unidad.php', {op: 'add',id:id,id_tipo_unidad:id_tipo_unidad,placa:placa}, function(data) {
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
function update(){
var id = $('#id').val();

var id_tipo_unidad = $('#id_tipo_unidad').val();

var placa = $('#placa').val();

$.post('ws/unidad.php', {op: 'mod',id:id,id_tipo_unidad:id_tipo_unidad,placa:placa}, function(data) {
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
$.post('ws/unidad.php', {op: 'get', id: id}, function(data) {
if(data !== 0){

$('#id').val(data.id);

sel_id_tipo_unidad(data.id_tipo_unidad.id);
$('#placa').val(data.placa);

}
}, 'json');
}
function del(id){
$.post('ws/unidad.php', {op: 'del', id: id}, function(data) {
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

$.post('ws/tipo_unidad.php', {op: 'list'}, function(data) {
if(data != 0){
$('#data_tbl_modal_id_tipo_unidad').html('');
var ht = '';
$.each(data, function(key, value) {
ht += '<tr>';
    ht += '<td><a href="#" onclick="sel_id_tipo_unidad('+value.id+')">SEL</a></td>';ht += '<td>'+value.id+'</td>';ht += '<td>'+value.nombre+'</td>';ht += '<td>'+value.carga_minima+'</td>';ht += '<td>'+value.carga_maxima+'</td>';ht += '<td>'+value.precio_fijo+'</td>';ht += '<td>'+value.precio_variable+'</td>';
    ht += '</tr>';
});
$('#data_tbl_modal_id_tipo_unidad').html(ht);
$('#tbl_modal_id_tipo_unidad').dataTable();
}
}, 'json');
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

function sel_id_tipo_unidad(id_e){
$.post('ws/tipo_unidad.php', {op: 'get', id:id_e}, function(data) {
if(data != 0){
$('#id_tipo_unidad').val(data.id);
$('#txt_id_tipo_unidad').html(data.<?php
echo $gl_unidad_id_tipo_unidad;
?>);
$('#modal_id_tipo_unidad').modal('hide');
}
}, 'json');
}