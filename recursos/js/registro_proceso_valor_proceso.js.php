<?php require_once('../../globales_sistema.php'); ?>
jQuery.fn.reset = function () {
$(this).each (function() { this.reset(); });
}

function insert(){
var id = $('#id').val();

var id_registro_proceso = $('#id_registro_proceso').val();

var id_proceso = $('#id_proceso').val();

var id_valor_proceso = $('#id_valor_proceso').val();

var dato = $('#dato').val();

$.post('ws/registro_proceso_valor_proceso.php', {op: 'add',id:id,id_registro_proceso:id_registro_proceso,id_proceso:id_proceso,id_valor_proceso:id_valor_proceso,dato:dato}, function(data) {
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

var id_registro_proceso = $('#id_registro_proceso').val();

var id_proceso = $('#id_proceso').val();

var id_valor_proceso = $('#id_valor_proceso').val();

var dato = $('#dato').val();

$.post('ws/registro_proceso_valor_proceso.php', {op: 'mod',id:id,id_registro_proceso:id_registro_proceso,id_proceso:id_proceso,id_valor_proceso:id_valor_proceso,dato:dato}, function(data) {
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
$.post('ws/registro_proceso_valor_proceso.php', {op: 'get', id: id}, function(data) {
if(data !== 0){

$('#id').val(data.id);

sel_id_registro_proceso(data.id_registro_proceso.id);
sel_id_proceso(data.id_proceso.id);
sel_id_valor_proceso(data.id_valor_proceso.id);
$('#dato').val(data.dato);

}
}, 'json');
}
function del(id){
$.post('ws/registro_proceso_valor_proceso.php', {op: 'del', id: id}, function(data) {
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

$.post('ws/registro_proceso.php', {op: 'list'}, function(data) {
if(data != 0){
$('#data_tbl_modal_id_registro_proceso').html('');
var ht = '';
$.each(data, function(key, value) {
ht += '<tr>';
    ht += '<td><a href="#" onclick="sel_id_registro_proceso('+value.id+')">SEL</a></td>';ht += '<td>'+value.id+'</td>';ht += '<td>'+value.id_registro.<?php
        echo $gl_registro_proceso_id_registro;
        ?>+'</td>';ht += '<td>'+value.id_proceso.<?php
        echo $gl_registro_proceso_id_proceso;
        ?>+'</td>';ht += '<td>'+value.fecha_inicio+'</td>';ht += '<td>'+value.hora_inicio+'</td>';ht += '<td>'+value.fecha_fin+'</td>';ht += '<td>'+value.hora_fin+'</td>';
    ht += '</tr>';
});
$('#data_tbl_modal_id_registro_proceso').html(ht);
$('#tbl_modal_id_registro_proceso').dataTable();
}
}, 'json');
$.post('ws/proceso.php', {op: 'list'}, function(data) {
if(data != 0){
$('#data_tbl_modal_id_proceso').html('');
var ht = '';
$.each(data, function(key, value) {
ht += '<tr>';
    ht += '<td><a href="#" onclick="sel_id_proceso('+value.id+')">SEL</a></td>';ht += '<td>'+value.id+'</td>';ht += '<td>'+value.nombre+'</td>';ht += '<td>'+value.control_tiempos+'</td>';
    ht += '</tr>';
});
$('#data_tbl_modal_id_proceso').html(ht);
$('#tbl_modal_id_proceso').dataTable();
}
}, 'json');
$.post('ws/valor_proceso.php', {op: 'list'}, function(data) {
if(data != 0){
$('#data_tbl_modal_id_valor_proceso').html('');
var ht = '';
$.each(data, function(key, value) {
ht += '<tr>';
    ht += '<td><a href="#" onclick="sel_id_valor_proceso('+value.id+')">SEL</a></td>';ht += '<td>'+value.id+'</td>';ht += '<td>'+value.id_proceso.<?php
        echo $gl_valor_proceso_id_proceso;
        ?>+'</td>';ht += '<td>'+value.nombre+'</td>';ht += '<td>'+value.tipo+'</td>';ht += '<td>'+value.extra+'</td>';
    ht += '</tr>';
});
$('#data_tbl_modal_id_valor_proceso').html(ht);
$('#tbl_modal_id_valor_proceso').dataTable();
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

function sel_id_registro_proceso(id_e){
$.post('ws/registro_proceso.php', {op: 'get', id:id_e}, function(data) {
if(data != 0){
$('#id_registro_proceso').val(data.id);
$('#txt_id_registro_proceso').html(data.<?php
echo $gl_registro_proceso_valor_proceso_id_registro_proceso;
?>);
$('#modal_id_registro_proceso').modal('hide');
}
}, 'json');
}
function sel_id_proceso(id_e){
$.post('ws/proceso.php', {op: 'get', id:id_e}, function(data) {
if(data != 0){
$('#id_proceso').val(data.id);
$('#txt_id_proceso').html(data.<?php
echo $gl_registro_proceso_valor_proceso_id_proceso;
?>);
$('#modal_id_proceso').modal('hide');
}
}, 'json');
}
function sel_id_valor_proceso(id_e){
$.post('ws/valor_proceso.php', {op: 'get', id:id_e}, function(data) {
if(data != 0){
$('#id_valor_proceso').val(data.id);
$('#txt_id_valor_proceso').html(data.<?php
echo $gl_registro_proceso_valor_proceso_id_valor_proceso;
?>);
$('#modal_id_valor_proceso').modal('hide');
}
}, 'json');
}