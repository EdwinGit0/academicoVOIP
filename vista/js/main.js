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
        	theme:"light-thin",
        	scrollbarPosition: "inside",
        	autoHideScrollbar: true,
        	scrollButtons: {enable: true}
        });
        $(".page-content").mCustomScrollbar({
        	theme:"dark-thin",
        	scrollbarPosition: "inside",
        	autoHideScrollbar: true,
        	scrollButtons: {enable: true}
        });
    });
})(jQuery);

$(function(){
  $('[data-toggle="popover"]').popover()
});

// funcion para clonar
var i = 1;
function add(){
    let nuevo = $('#itemDate').clone();
    nuevo.attr('id', '');
    nuevo.addClass('itemDate');
    nuevo.find('input').each(function() {
        this.value = '';
		this.id = i;
    });
	nuevo.find('button').each(function() {
		this.id = i;
    });

    $(nuevo).append('<div class="col-12 col-md-1"><button class="item-delete btn btn-raised btn-danger"><i class="fas fa-times"></i></button></div>');
    $(nuevo).insertBefore('#item-add');
	i++;
}

function removeThisFile(ele) {
    $(this).closest('.itemDate').remove();
}

$('#item-add .button').on('click', add);

$(document.body).on('click', '.item-delete', removeThisFile);

// Solo para probar
$('#item-check button').on('click', function() {
    // Recorrer todos los campos
    // Todos tienen el mismo nombre, pero cada uno tiene índice
    $('[name="date[]"]').each(function(index) {
        console.log(index, $(this)[0]);
		alert(index);
    });
});

var fila;
function buscarTutor(ele) {
    fila = $(this).attr('id');
}

$(document.body).on('click', '.item-update', buscarTutor);
