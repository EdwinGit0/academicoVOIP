<?php
   if($peticionAjax){
        require_once "../../modelo/admin/main_model.php";
    }else{
        require_once "./modelo/admin/main_model.php";
    }
    
    class modelo_agenda extends main_model{

        /**Modelo datos agenda */
        protected static function datos_agenda_modelo($datos){
            $sql=main_model::conectar()->prepare("SELECT AGENDA_ID as id, TITULO_AG as title, DESCRIPCION_AG as descripcion,
            COLOR_AG as color, START_AG as start, END_AG as end, SALA_AG as sala, CANTMAX_AG as cantmax, COD_CUR as idcur FROM agenda WHERE PROFESOR_ID=:ProfesorId AND COD_ANIO=:CodAnio");
            $sql->bindParam(":ProfesorId",$datos['ProfesorId']);
            $sql->bindParam(":CodAnio",$datos['CodAnio']);
            $sql->execute();

            return $sql;
        }

        /**Modelo registrar agenda */
        protected static function register_agenda_modelo($datos){
            $sql=main_model::conectar()->prepare("INSERT INTO agenda(TITULO_AG,DESCRIPCION_AG,COLOR_AG,START_AG,END_AG,SALA_AG,CANTMAX_AG,
            COD_CUR,PROFESOR_ID,COD_ANIO) 
            VALUES(:Title,:Description,:Color,:Start,:End,:Sala,:Max,:Curso,:DocenteId,:AnioId)");
            $sql->bindParam(":Title",$datos['Title']);
            $sql->bindParam(":Description",$datos['Description']);
            $sql->bindParam(":Curso",$datos['Curso']);
            $sql->bindParam(":Start",$datos['Start']);
            $sql->bindParam(":End",$datos['End']);
            $sql->bindParam(":Sala",$datos['Sala']);
            $sql->bindParam(":Color",$datos['Color']);
            $sql->bindParam(":Max",$datos['Max']);
            $sql->bindParam(":DocenteId",$datos['DocenteId']);
            $sql->bindParam(":AnioId",$datos['AnioId']);
            $sql->execute();

            return $sql;
        }

        /**Modelo actulaizar agenda */
        protected static function update_agenda_modelo($datos){
            $sql=main_model::conectar()->prepare("UPDATE agenda SET TITULO_AG=:Title,DESCRIPCION_AG=:Description,
            COLOR_AG=:Color,START_AG=:Start,END_AG=:End,
            CANTMAX_AG=:Max,COD_CUR=:Curso,PROFESOR_ID=:DocenteId,COD_ANIO=:AnioId WHERE AGENDA_ID=:ID");
            $sql->bindParam(":ID",$datos['ID']);
            $sql->bindParam(":Title",$datos['Title']);
            $sql->bindParam(":Description",$datos['Description']);
            $sql->bindParam(":Curso",$datos['Curso']);
            $sql->bindParam(":Start",$datos['Start']);
            $sql->bindParam(":End",$datos['End']);
            $sql->bindParam(":Color",$datos['Color']);
            $sql->bindParam(":Max",$datos['Max']);
            $sql->bindParam(":DocenteId",$datos['DocenteId']);
            $sql->bindParam(":AnioId",$datos['AnioId']);
            $sql->execute();

            return $sql;
        }

        /* modelo eliminar agenda */
        protected static function delete_agenda_modelo($id){
            $sql=main_model::conectar()->prepare("DELETE FROM agenda WHERE AGENDA_ID=:ID");
            $sql->bindParam(":ID",$id);
            $sql->execute();

            return $sql;
        }

    }