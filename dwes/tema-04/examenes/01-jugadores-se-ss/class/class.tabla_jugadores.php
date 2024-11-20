<?php

/*
    clase: class.tabla_posiciones.php
    descripcion: define la clase que va a contener el array de objetos de la clase posiciones.
*/
class Class_tabla_jugadores
{
    public $tabla;

    public function __construct()
    {
        $this->tabla = [];
    }

    function getDatos()
    {
        #Jugador 1
        $jugador = new Class_jugador(
            1,
            "Lionel Messi",
            "1987-06-24",
            1.70,
            72,
            "Argentina",
            10,
            50000000,
            1,
            [7, 10]
        );
        $this->tabla[] = $jugador;


        // Jugador 2
        $jugador = new Class_jugador(
            2,
            "Cristiano Ronaldo",
            "1985-02-05",
            1.87,
            83,
            "Portugal",
            7,
            40000000,
            2,
            [7, 8, 9, 10]
        );
        $this->tabla[] = $jugador;

        // Jugador 3
        $jugador = new Class_jugador(
            3,
            "Kylian Mbappé",
            "1998-12-20",
            1.78,
            73,
            "Francia",
            7,
            180000000,
            3,
            [7, 9]
        );
        $this->tabla[] = $jugador;

        // Jugador 4
        $jugador = new Class_jugador(
            4,
            "Virgil van Dijk",
            "1991-07-08",
            1.93,
            92,
            "Países Bajos",
            4,
            65000000,
            4,
            [2]
        );
        $this->tabla[] = $jugador;

        // Jugador 5
        $jugador = new Class_jugador(
            5,
            "Kevin De Bruyne",
            "1991-06-28",
            1.81,
            70,
            "Bélgica",
            17,
            85000000,
            5,
            [6, 8]
        );
        $this->tabla[] = $jugador;
    }
    public function getEquipos()
    {
        $equipo = [
            "FC Barcelona",
            "Real Madrid",
            "Atlético de Madrid",
            "Sevilla FC",
            "Real Betis",
            "Real Sociedad",
            "Villarreal CF",
            "Athletic Club",
            "RCD Espanyol",
            "Valencia CF",
            "Getafe CF",
            "Celta de Vigo",
            "Rayo Vallecano",
            "RCD Mallorca",
            "Osasuna",
            "Girona FC",
            "UD Las Palmas",
            "Deportivo Alavés",
            "CD Leganés",
            "Real Valladolid"
        ];
        return $equipo;
    }

    public function getPosiciones()
    {
        $posiciones = [
            "Portero",
            "Defensa central",
            "Lateral derecho",
            "Lateral izquierdo",
            "Pivote defensivo",
            "Mediocentro",
            "Mediocentro ofensivo",
            "Extremo derecho",
            "Extremo izquierdo",
            "Delantero centro",
            "Segundo delantero"
        ];
        return $posiciones;
    }
    /**
     * Método: mostrar_nombre_posiciones()
     * descripcion: devuelve un array con el nombre de las posiciones
     * parámetros:
     *      -indice_posiciones
     */

    public function mostrar_nombre_posiciones($indice_posiciones = [])
    {
        # Creo un array de nombre de posiciones vacio
        $nombre_posiciones = [];

        # Cargo el array de posiciones
        $posiciones_jugador = $this->getPosiciones();

        foreach ($indice_posiciones as $indice_posiciones) {
            $nombre_posiciones[] = $posiciones_jugador[$indice_posiciones];
        }
        # Ordeno
        asort($nombre_posiciones);
        return $nombre_posiciones;
    }
    /*
        método: create()
        descripcion: permite añadir un objeto de la clase jugador a la tabla
        parámetros:

            - $jugador - objeto de la clase jugadors

    */
    public function create(Class_jugador $jugador)
    {
        $this->tabla[] = $jugador;
    }



    /*
        método: read()
        descripción: permite obtener el objeto de la clase jugador  correspondiente a un índice de la tabla
        parámetros:
            - $indice - índice de la tabla
    */

    public function read($indice)
    {
        return $this->tabla[$indice];
    }


    

    
}
