<?php require_once('../../globales_sistema.php'); ?>
jQuery.fn.reset = function () {
$(this).each (function() { this.reset(); });
}

function insert(){
var id = $('#id').val();

var nombre = $('#nombre').val();

var carga_minima = $('#carga_minima').val();

var carga_maxima = $('#carga_maxima').val();

var precio_fijo = $('#precio_fijo').val();

var precio_variable = $('#precio_variable').val();

$.post('ws/tipo_unidad.php', {op: 'add',id:id,nombre:nombre,carga_minima:carga_minima,carga_maxima:carga_maxima,precio_fijo:precio_fijo,precio_variable:precio_variable}, function(data) {
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

var nombre = $('#nombre').val();

var carga_minima = $('#carga_minima').val();

var carga_maxima = $('#carga_maxima').val();

var precio_fijo = $('#precio_fijo').val();

var precio_variable = $('#precio_variable').val();

$.post('ws/tipo_unidad.php', {op: 'mod',id:id,nombre:nombre,carga_minima:carga_minima,carga_maxima:carga_maxima,precio_fijo:precio_fijo,precio_variable:precio_variable}, function(data) {
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
$.post('ws/tipo_unidad.php', {op: 'get', id: id}, function(data) {
if(data !== 0){

$('#id').val(data.id);

$('#nombre').val(data.nombre);

$('#carga_minima').val(data.carga_minima);

$('#carga_maxima').val(data.carga_maxima);

$('#precio_fijo').val(data.precio_fijo);

$('#precio_variable').val(data.precio_variable);

}
}, 'json');
}
function del(id){
$.post('ws/tipo_unidad.php', {op: 'del', id: id}, function(data) {
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
