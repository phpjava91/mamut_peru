<?php require_once('../../globales_sistema.php'); ?>
jQuery.fn.reset = function () {
$(this).each (function() { this.reset(); });
}

function insert(){
var id = $('#id').val();

var codigo = $('#codigo').val();

var nombres = $('#nombres').val();

var apellidos = $('#apellidos').val();

var dni = $('#dni').val();

var numero_licencia = $('#numero_licencia').val();

var tipo_licencia = $('#tipo_licencia').val();

var id_grupo_conductor = $('#id_grupo_conductor').val();

$.post('ws/conductor.php', {op: 'add',id:id,codigo:codigo,nombres:nombres,apellidos:apellidos,dni:dni,numero_licencia:numero_licencia,tipo_licencia:tipo_licencia,id_grupo_conductor:id_grupo_conductor}, function(data) {
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

var codigo = $('#codigo').val();

var nombres = $('#nombres').val();

var apellidos = $('#apellidos').val();

var dni = $('#dni').val();

var numero_licencia = $('#numero_licencia').val();

var tipo_licencia = $('#tipo_licencia').val();

var id_grupo_conductor = $('#id_grupo_conductor').val();

$.post('ws/conductor.php', {op: 'mod',id:id,codigo:codigo,nombres:nombres,apellidos:apellidos,dni:dni,numero_licencia:numero_licencia,tipo_licencia:tipo_licencia,id_grupo_conductor:id_grupo_conductor}, function(data) {
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
$.post('ws/conductor.php', {op: 'get', id: id}, function(data) {
if(data !== 0){

$('#id').val(data.id);

$('#codigo').val(data.codigo);

$('#nombres').val(data.nombres);

$('#apellidos').val(data.apellidos);

$('#dni').val(data.dni);

$('#numero_licencia').val(data.numero_licencia);

$('#tipo_licencia').val(data.tipo_licencia);

sel_id_grupo_conductor(data.id_grupo_conductor.id);
}
}, 'json');
}
function del(id){
$.post('ws/conductor.php', {op: 'del', id: id}, function(data) {
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

$.post('ws/grupo_conductor.php', {op: 'list'}, function(data) {
if(data != 0){
$('#data_tbl_modal_id_grupo_conductor').html('');
var ht = '';
$.each(data, function(key, value) {
ht += '<tr>';
    ht += '<td><a href="#" onclick="sel_id_grupo_conductor('+value.id+')">SEL</a></td>';ht += '<td>'+value.id+'</td>';ht += '<td>'+value.nombre+'</td>';ht += '<td>'+value.descripcion+'</td>';
    ht += '</tr>';
});
$('#data_tbl_modal_id_grupo_conductor').html(ht);
$('#tbl_modal_id_grupo_conductor').dataTable();
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

function sel_id_grupo_conductor(id_e){
$.post('ws/grupo_conductor.php', {op: 'get', id:id_e}, function(data) {
if(data != 0){
$('#id_grupo_conductor').val(data.id);
$('#txt_id_grupo_conductor').html(data.<?php
echo $gl_conductor_id_grupo_conductor;
?>);
$('#modal_id_grupo_conductor').modal('hide');
}
}, 'json');
}