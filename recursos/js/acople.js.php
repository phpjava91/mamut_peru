<?php require_once('../../globales_sistema.php'); ?>
jQuery.fn.reset = function () {
$(this).each (function() { this.reset(); });
}

function insert(){
var id = $('#id').val();

var id_tipo_acople = $('#id_tipo_acople').val();

var placa = $('#placa').val();

$.post('ws/acople.php', {op: 'add',id:id,id_tipo_acople:id_tipo_acople,placa:placa}, function(data) {
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

var id_tipo_acople = $('#id_tipo_acople').val();

var placa = $('#placa').val();

$.post('ws/acople.php', {op: 'mod',id:id,id_tipo_acople:id_tipo_acople,placa:placa}, function(data) {
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
$.post('ws/acople.php', {op: 'get', id: id}, function(data) {
if(data !== 0){

$('#id').val(data.id);

sel_id_tipo_acople(data.id_tipo_acople.id);
$('#placa').val(data.placa);

}
}, 'json');
}
function del(id){
$.post('ws/acople.php', {op: 'del', id: id}, function(data) {
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

$.post('ws/tipo_acople.php', {op: 'list'}, function(data) {
if(data != 0){
$('#data_tbl_modal_id_tipo_acople').html('');
var ht = '';
$.each(data, function(key, value) {
ht += '<tr>';
    ht += '<td><a href="#" onclick="sel_id_tipo_acople('+value.id+')">SEL</a></td>';ht += '<td>'+value.id+'</td>';ht += '<td>'+value.nombre+'</td>';
    ht += '</tr>';
});
$('#data_tbl_modal_id_tipo_acople').html(ht);
$('#tbl_modal_id_tipo_acople').dataTable();
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

function sel_id_tipo_acople(id_e){
$.post('ws/tipo_acople.php', {op: 'get', id:id_e}, function(data) {
if(data != 0){
$('#id_tipo_acople').val(data.id);
$('#txt_id_tipo_acople').html(data.<?php
echo $gl_acople_id_tipo_acople;
?>);
$('#modal_id_tipo_acople').modal('hide');
}
}, 'json');
}