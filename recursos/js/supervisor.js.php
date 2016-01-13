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

$.post('ws/supervisor.php', {op: 'add',id:id,codigo:codigo,nombres:nombres,apellidos:apellidos,dni:dni}, function(data) {
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

$.post('ws/supervisor.php', {op: 'mod',id:id,codigo:codigo,nombres:nombres,apellidos:apellidos,dni:dni}, function(data) {
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
$.post('ws/supervisor.php', {op: 'get', id: id}, function(data) {
if(data !== 0){

$('#id').val(data.id);

$('#codigo').val(data.codigo);

$('#nombres').val(data.nombres);

$('#apellidos').val(data.apellidos);

$('#dni').val(data.dni);

}
}, 'json');
}
function del(id){
$.post('ws/supervisor.php', {op: 'del', id: id}, function(data) {
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
