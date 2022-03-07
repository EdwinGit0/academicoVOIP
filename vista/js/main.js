$(document).ready(function(){

	/*  Show/Hidden Submenus */
	$('.nav-btn-submenu').on('click', function(e){
		e.preventDefault();
		var SubMenu=$(this).next('ul');
		var iconBtn=$(this).children('.fa-chevron-down');
		if(SubMenu.hasClass('show-nav-lateral-submenu')){
			$(this).removeClass('active');
			iconBtn.removeClass('fa-rotate-180');
			SubMenu.removeClass('show-nav-lateral-submenu');
		}else{
			$(this).addClass('active');
			iconBtn.addClass('fa-rotate-180');
			SubMenu.addClass('show-nav-lateral-submenu');
		}
	});

	/*  Show/Hidden Nav Lateral */
	$('.show-nav-lateral').on('click', function(e){
		e.preventDefault();
		var NavLateral=$('.nav-lateral');
		var PageConten=$('.page-content');
		if(NavLateral.hasClass('active')){
			NavLateral.removeClass('active');
			PageConten.removeClass('active');
		}else{
			NavLateral.addClass('active');
			PageConten.addClass('active');
		}
	});
    
});

(function($){
    $(window).on("load",function(){
        $(".nav-lateral-content").mCustomScrollbar({
			autoHideScrollbar: true,
        });
        $(".modal, .page-content").mCustomScrollbar({
			theme:"dark",
        	autoHideScrollbar: true,
        });
    });
})(jQuery);

$(function(){
  $('[data-toggle="popover"]').popover()
});



// funcion para clonar
function add(){
    let nuevo = $('#itemDate').clone();
    nuevo.attr('id', '');
    nuevo.addClass('itemDate');
    nuevo.find('input[type=text]').each(function() {
        this.value = '';
    });
	nuevo.find('input[type=hidden]').each(function() {
        this.value = '';
    });

    $(nuevo).append('&nbsp;<button class="item-delete btn btn-raised btn-danger"><i class="fas fa-times"></i></button>');
    $(nuevo).insertBefore('#item-add');
}
$('#item-add .button').on('click', add);

// funcion para eliminar una fila
function removeThisFile(ele) {
    $(this).closest('.itemDate').remove();
}
$(document.body).on('click', '.item-delete', removeThisFile);

// Obtener el id de la fila
var fila;
function buscarTutor(ele) {
   fila = $(this).closest('.itemDate');
   if(fila.length==0){
		fila = $(this).closest('#itemDate');
   }
}
$(document.body).on('click', '.item-update', buscarTutor);

/** Clonar campos para ver datos completo */
function add_alumno(){
    let nuevo = $('#itemDate').clone();
    nuevo.attr('id', '');
    nuevo.addClass('itemDate');
    nuevo.find('input[type=text]').each(function() {
        this.value = '';
    });

    $(nuevo).insertBefore('#item-add');
}

 /** Ver datos completo */
function ver_Datos() {
	fila = $(this).closest('td');
	verDatos();
}
$(document.body).on('click', '.btnVerDatos', ver_Datos);

/** calcular promedio parciales */
$(document).on('blur', '.campo_par', function () {
	var input = $(this);
	var columns = input.closest("tr").children();
	promedio_val(columns,'campo_par','prom_par');
});

/** calcular promedio actividades*/
$(document).on('blur', '.campo_act', function () {
	var input = $(this);
	var columns = input.closest("tr").children();
	promedio_val(columns,'campo_act','prom_act');
});

/** calcular promedio S-D*/
$(document).on('blur', '.campo_sd', function () {
	var input = $(this);
	var columns = input.closest("tr").children();
	promedio_valSD(columns,'campo_sd','prom_SD');
});

/** guardar cuaderno pedagogico */
$(document.body).on('click', '.btn_cp', function () {
	var table = $(this).closest(".desplazar_body");
	guardar_cuadernoP(table);
});

/** Exportar pdf documento */
$(document.body).on('click', '.btnCrearLibretaPdf', function () {
	const $documentoPdf = this.closest(".container-fluid").querySelector(".desgPDFDoc");
	descargarDocPdf($documentoPdf,'Libreta-Escolar-Electrónica.pdf');
});

/** Exportar pdf documento */
$(document.body).on('click', '.btnCrearPdf', function () {
	const $documentoPdf = this.closest(".card-body").querySelector(".table-responsive");
	descargarDocPdf($documentoPdf,'Documento.pdf');
});

/** Exportar excel documento */
$(document.body).on('click', '.btnCrearLibretaExcel', function () {
	tableToExcel('tableLibreta','LibretaEscolar');
});

