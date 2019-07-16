<?php
/**/
include_once 'genericoDAO.php';

class actorDAO
{

    use GenericoDAO;

    public $q_general;

    //Funciones------------------------------------------
    //Espacio para las funciones en general de esta clase.
    public function getcpm()
    {

        return $this->getCookieProyectoM();
    }

    public function getActores()
    {

        $query = "select actor.*, tipo_actor.nombre as nom_tipo

                    FROM `actor`

                    INNER JOIN tipo_actor ON tipo_actor.pkID = actor.fkID_tipo

                    where estadoV=1";

        return $this->EjecutarConsulta($query);
    }

    public function getTipoActor()
    {

        $query = "select * FROM `tipo_actor`";

        return $this->EjecutarConsulta($query);
    }

    public function getAnio()
    {

        $query = "select * FROM anio";

        return $this->EjecutarConsulta($query);
    }

    public function getTipoVinculacion()
    {

        $query = "select * FROM `tipo_vinculacion`";

        return $this->EjecutarConsulta($query);
    }

    public function getDepartamentos()
    {

        $query = "select * FROM `departamento`";

        return $this->EjecutarConsulta($query);
    }

    public function getMunicipios()
    {

        $query = "select * FROM `municipio`";

        return $this->EjecutarConsulta($query);
    }

    public function getProyectosMarcoId($pkID)
    {

        $query = "select proyecto_marco.*, departamento.nombre_departamento as nom_departamento

                      FROM proyecto_marco

                      INNER JOIN departamento ON departamento.pkID = proyecto_marco.fkID_departamento

                      WHERE proyecto_marco.pkID = " . $pkID;

        return $this->EjecutarConsulta($query);
    }
}
