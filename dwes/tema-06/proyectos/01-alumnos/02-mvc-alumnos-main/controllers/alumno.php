<?php

    Class Alumno Extends Controller{
        function __construct()
        {
            parent::__construct();
        }

        public function render(){

            // Creo la propiedad title de la vista
            $this->view->title = "Home - Panel de contol de Alumnos";

            // Creo la propiedad alumnos para usar en la vista
            $this->view->alumno = $this->model->get();
            $this->view->render('alumno/main/index');
        }
    }
