<?php

class Alumno extends Controller
{

    function __construct()
    {
        parent::__construct();
    }

    public function render()
    {
        // Creo la propiedad title de la vista
        $this->view->title = "Home - Panel de control de Alumnos";

        // Creo la propiedad alumnos para usar en la vista
        $this->view->alumnos = $this->model->get();

        $this->view->render('alumno/main/index');
    }



    /*
        Método nuevo()

        Muestra el formulario que permite añadir nuevo alumno

        url asociada: /alumno/nuevo
    */


    public function nuevo()
    {

        $this->view->title = "Nuevo alumno - Gestiçon FP";

        // Creo la propiedad cursos en la vista
        $this->view->cursos = $this->model->get_cursos();

        // Cargo la vista asociada a este método
        $this->view->render('alumno/nuevo/index');
    }
}
