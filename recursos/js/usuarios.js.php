<?php require_once('../../globales_sistema.php'); ?>
jQuery.fn.reset = function () {
$(this).each (function() { this.reset(); });
}

function insert(){
var id = $('#id').val();

var nombres = $('#nombres').val();

var apellidos = $('#apellidos').val();

var usuario = $('#usuario').val();

var clave = $('#clave').val();

var tipo = $('#tipo').find('option:selected').val();

$.post('ws/usuarios.php', {op: 'add',id:id,nombres:nombres,apellidos:apellidos,usuario:usuario,clave:clave,tipo:tipo}, function(data) {
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

var nombres = $('#nombres').val();

var apellidos = $('#apellidos').val();

var usuario = $('#usuario').val();

var clave = $('#clave').val();

var tipo = $('#tipo').find('option:selected').val();

$.post('ws/usuarios.php', {op: 'mod',id:id,nombres:nombres,apellidos:apellidos,usuario:usuario,clave:clave,tipo:tipo}, function(data) {
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
$.post('ws/usuarios.php', {op: 'get', id: id}, function(data) {
if(data !== 0){

$('#id').val(data.id);

$('#nombres').val(data.nombres);

$('#apellidos').val(data.apellidos);

$('#usuario').val(data.usuario);

$('#clave').val(data.clave);

$('#tipo option[value="'+data.tipo+'"]').attr('selected', true);

}
}, 'json');
}
function del(id){
$.post('ws/usuarios.php', {op: 'del', id: id}, function(data) {
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
