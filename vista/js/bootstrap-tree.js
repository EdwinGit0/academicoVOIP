$(function () {
  $('.tree li:has(ul)').addClass('parent_li').find(' > span').attr('title', 'Collapse this branch');
  $('.tree li.parent_li > span').parent('li.parent_li').find(' > ul > li').hide('fast');
  $('.tree li.parent_li > span').on('click', function (e) {
      var children = $(this).parent('li.parent_li').find(' > ul > li');
      if (children.is(":visible")) {
          children.hide('fast');
          $(this).attr('title', 'Expand this branch').find(' > i').addClass('fa-plus-circle').removeClass('fa-minus-circle');
      } else {
          children.show('fast');
          $(this).attr('title', 'Collapse this branch').find(' > i').addClass('fa-minus-circle').removeClass('fa-plus-circle');
      }
      e.stopPropagation();
  });
});

$(function () {
   $('.card-body').addClass('desplazar_body');
   $('.btn-tool').attr('title', 'Collapse body');
   $('.btn-tool').on('click', function (e) {
         var cuerpo = $(this).closest('.card').find('.desplazar_body');;
         if (cuerpo.is(":visible")) {
            cuerpo.hide('fast');
            $(this).attr('title', 'Expand body').find(' > i').addClass('fa-plus').removeClass('fa-minus');
         } else {
            cuerpo.show('fast');
            $(this).attr('title', 'Collapse body').find(' > i').addClass('fa-minus').removeClass('fa-plus');
         }
         e.stopPropagation();
   });
 });

var tipo_user="";

/**Arbol para asignar alumnos */
function asignacionAlum(ele) {
    fila = $(this).closest('li');
    tipo_user = "alumno";
    asignacion(tipo_user);
 }
 $(document.body).on('click', '.asigAlum', asignacionAlum);

 /**Arbol para asignar docentes */
 function asignacionDoc(ele) {
    fila = $(this).closest('li');
    tipo_user = "docente";
    asignacion(tipo_user);
 }
 $(document.body).on('click', '.asigDoc', asignacionDoc);

  /**Arbol para cuadreno pedagogico */
  function bookPedagogico(ele) {
   fila = $(this).closest('li');
   datosReferenciales();
}
$(document.body).on('click', '.bookPedago', bookPedagogico);

/**modales para asignar docentes y alumnos a curso */
 $(document.body).on('click', '.alumno', function(){
    $('#ModalAlumno').modal('show');
 });
 $(document.body).on('click', '.docente', function(){        
    $('#ModalDocente').modal('show');
 });

 /***Selector para seleccionar anio academico */
 function anioAcademico(e) {
    asignacion(tipo_user);
 }
 $(document.body).on('click', '.btnAnioAcademico', anioAcademico)

