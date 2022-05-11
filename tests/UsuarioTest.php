<?php

use PHPUnit\Framework\TestCase;
use admin\controlador_alumno;
use adminModel\main_model;

class UsuarioTest extends TestCase{

    /** @test */
    public function test_add_estudent() {
        
            //Setup
            $add_student = new controlador_alumno;

            //Action
            $result = $add_student->agregar_alumno_controlador();

            //Test / Assert
            $alerta=[
                "Alerta"=>"simple",
                "Titulo"=>"Ocurrio un error inesperado",
                "Texto"=>"No has llenado todos los campos obligatorios",
                "Tipo"=>"error"
            ];
            
            $alerta = json_encode($alerta);
            $this->assertEquals($alerta,  $result);
    }
}