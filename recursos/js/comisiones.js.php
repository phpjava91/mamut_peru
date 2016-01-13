<?php require_once('../../globales_sistema.php'); ?>
jQuery.fn.reset = function () {
$(this).each (function() { this.reset(); });
}

function insert(){
var id = $('#id').val();

var fecha = $('#fecha').val();

var id_turno = $('#id_turno').val();

var id_conductor = $('#id_conductor').val();

var vueltas_por_comision = $('#vueltas_por_comision').val();

var monto = $('#monto').val();

var motivo = $('#motivo').val();

var id_supervisor = $('#id_supervisor').val();

$.post('ws/comisiones.php', {op: 'add',id:id,fecha:fecha,id_turno:id_turno,id_conductor:id_conductor,vueltas_por_comision:vueltas_por_comision,monto:monto,motivo:motivo,id_supervisor:id_supervisor}, function(data) {
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
location.href = "comisiones.php?fecha="+fecha+"&id_turno="+turno+"&id_conductor="+id_conductor+"&id_supervisor="+id_supervisor;
}
}, 'json');
}
function update(){
var id = $('#id').val();

var fecha = $('#fecha').val();

var id_turno = $('#id_turno').val();

var id_conductor = $('#id_conductor').val();

var vueltas_por_comision = $('#vueltas_por_comision').val();

var monto = $('#monto').val();

var motivo = $('#motivo').val();

var id_supervisor = $('#id_supervisor').val();

$.post('ws/comisiones.php', {op: 'mod',id:id,fecha:fecha,id_turno:id_turno,id_conductor:id_conductor,vueltas_por_comision:vueltas_por_comision,monto:monto,motivo:motivo,id_supervisor:id_supervisor}, function(data) {
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
$.post('ws/comisiones.php', {op: 'get', id: id}, function(data) {
if(data !== 0){

$('#id').val(data.id);

$('#fecha').val(data.fecha);

sel_id_turno(data.id_turno.id);
sel_id_conductor(data.id_conductor.id);
$('#vueltas_por_comision').val(data.vueltas_por_comision);

$('#monto').val(data.monto);

$('#motivo').val(data.motivo);

sel_id_supervisor(data.id_supervisor.id);
}
}, 'json');
}
function del(id){
$.post('ws/comisiones.php', {op: 'del', id: id}, function(data) {
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
var tbl = $('#tb').DataTable({
    "dom": 'T<"clear">lfrtip',
    "oTableTools": {
            "sSwfPath": "recursos/swf/copy_csv_xls_pdf.swf",
             "aButtons": [ "pdf", "xls", "print" ]
    }
    });

$('#fecha').datepicker({dateFormat: 'yy-mm-dd',
changeMonth: true,
changeYear: true
});
$.post('ws/turno.php', {op: 'list'}, function(data) {
if(data != 0){
$('#data_tbl_modal_id_turno').html('');
var ht = '';
$.each(data, function(key, value) {
ht += '<tr>';
    ht += '<td><a href="#" onclick="sel_id_turno('+value.id+')">SEL</a></td>';ht += '<td>'+value.id+'</td>';ht += '<td>'+value.nombre+'</td>';ht += '<td>'+value.descripcion+'</td>';ht += '<td>'+value.duracion_en_horas+'</td>';
    ht += '</tr>';
});
$('#data_tbl_modal_id_turno').html(ht);
$('#tbl_modal_id_turno').dataTable();
}
}, 'json');
$.post('ws/conductor.php', {op: 'list'}, function(data) {
if(data != 0){
$('#data_tbl_modal_id_conductor').html('');
var ht = '';
$.each(data, function(key, value) {
ht += '<tr>';
    ht += '<td><a href="#" onclick="sel_id_conductor('+value.id+')">SEL</a></td>';ht += '<td>'+value.id+'</td>';ht += '<td>'+value.codigo+'</td>';ht += '<td>'+value.nombres+'</td>';ht += '<td>'+value.apellidos+'</td>';ht += '<td>'+value.dni+'</td>';ht += '<td>'+value.numero_licencia+'</td>';ht += '<td>'+value.tipo_licencia+'</td>';ht += '<td>'+value.id_grupo_conductor.<?php
        echo $gl_conductor_id_grupo_conductor;
        ?>+'</td>';
    ht += '</tr>';
});
$('#data_tbl_modal_id_conductor').html(ht);
$('#tbl_modal_id_conductor').dataTable();
}
}, 'json');
$.post('ws/supervisor.php', {op: 'list'}, function(data) {
if(data != 0){
$('#data_tbl_modal_id_supervisor').html('');
var ht = '';
$.each(data, function(key, value) {
ht += '<tr>';
    ht += '<td><a href="#" onclick="sel_id_supervisor('+value.id+')">SEL</a></td>';ht += '<td>'+value.id+'</td>';ht += '<td>'+value.codigo+'</td>';ht += '<td>'+value.nombres+'</td>';ht += '<td>'+value.apellidos+'</td>';ht += '<td>'+value.dni+'</td>';
    ht += '</tr>';
});
$('#data_tbl_modal_id_supervisor').html(ht);
$('#tbl_modal_id_supervisor').dataTable();
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

function sel_id_turno(id_e){
$.post('ws/turno.php', {op: 'get', id:id_e}, function(data) {
if(data != 0){
$('#id_turno').val(data.id);
$('#txt_id_turno').html(data.<?php
echo $gl_comisiones_id_turno;
?>);
$('#modal_id_turno').modal('hide');
}
}, 'json');
}
function sel_id_conductor(id_e){
$.post('ws/conductor.php', {op: 'get', id:id_e}, function(data) {
if(data != 0){
$('#id_conductor').val(data.id);
$('#txt_id_conductor').html(data.nombres+" "+data.apellidos);
$('#modal_id_conductor').modal('hide');
}
}, 'json');
}
function sel_id_supervisor(id_e){
$.post('ws/supervisor.php', {op: 'get', id:id_e}, function(data) {
if(data != 0){
$('#id_supervisor').val(data.id);
$('#txt_id_supervisor').html(data.nombres+" "+data.apellidos);
$('#modal_id_supervisor').modal('hide');
}
}, 'json');
}