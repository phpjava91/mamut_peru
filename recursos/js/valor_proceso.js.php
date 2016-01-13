<?php require_once('../../globales_sistema.php'); ?>
jQuery.fn.reset = function () {
$(this).each (function() { this.reset(); });
}

function insert(){
var id = $('#id').val();

var id_proceso = $('#id_proceso').val();

var nombre = $('#nombre').val();

var tipo = $('#tipo').find('option:selected').val();

var extra = $('#extra').val();

$.post('ws/valor_proceso.php', {op: 'add',id:id,id_proceso:id_proceso,nombre:nombre,tipo:tipo,extra:extra}, function(data) {
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

var id_proceso = $('#id_proceso').val();

var nombre = $('#nombre').val();

var tipo = $('#tipo').find('option:selected').val();

var extra = $('#extra').val();

$.post('ws/valor_proceso.php', {op: 'mod',id:id,id_proceso:id_proceso,nombre:nombre,tipo:tipo,extra:extra}, function(data) {
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
$.post('ws/valor_proceso.php', {op: 'get', id: id}, function(data) {
if(data !== 0){

$('#id').val(data.id);

sel_id_proceso(data.id_proceso.id);
$('#nombre').val(data.nombre);

$('#tipo option[value="'+data.tipo+'"]').attr('selected', true);

$('#extra').val(data.extra);

}
}, 'json');
}

function del(id){
$.post('ws/valor_proceso.php', {op: 'del', id: id}, function(data) {
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
$('#txt_id_proceso').html(data.<?php
echo $gl_valor_proceso_id_proceso;
?>);
$('#modal_id_proceso').modal('hide');
}
}, 'json');
}

function muestra_extra(){
    var tipo = $('#tipo').find('option:selected').val();
    switch(parseInt(tipo)){
        case 1:
        case 4:
            $("#extra_valores").hide("fast");
            $("#extra_valores").val("");
        break;
        
        case 2:
        case 3:
            $("#extra_valores").show("fast");
        break;
    }
}