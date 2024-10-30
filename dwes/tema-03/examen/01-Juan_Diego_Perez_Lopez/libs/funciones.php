<?php




/*
        Genera una tabla

            - Salida. Devuelve array con la tabla generada
    */

function generar_tabla()
{

    $tabla = [

        [
            'id' => 1,
            'descripcion' => 'Portátil HP MD12345',
            'modelo' => 'HP 15-1234-20',
            'categoria' => 'Portátiles',
            'unidades' => 12,
            'precio' => 550.50
        ],
        [
            'id' => 2,
            'descripcion' => 'Tablet - Samsung Galaxy Tab A (2019)',
            'modelo' => 'Exynos',
            'categoria' => 'Tablets',
            'unidades' => 200,
            'precio' => 300
        ],
        [
            'id' => 3,
            'descripcion' => 'Impresora multifunción - HP',
            'modelo' => 'DeskJet 3762',
            'categoria' => 'Dispositivo Salida',
            'unidades' => 2000,
            'precio' => 69.99
        ],
        [
            'id' => 4,
            'descripcion' => 'TV LED 40" - Thomson 40FE5606 - Full HD',
            'modelo' => 'Thomson 40FE5606',
            'categoria' => 'Televisión',
            'unidades' => 300,
            'precio' => 259
        ],
        [
            'id' => 5,
            'descripcion' => 'PC Sobremesa - Acer Aspire XC-830',
            'modelo' => 'Acer Aspire XC-830',
            'categoria' => 'PC',
            'unidades' => 20,
            'precio' => 329
        ]
    ];
    return $tabla;
}

/*
        Function: buscar_registro()
    */

/*
    Function: nuevo()
    descripcion: Añade un nuevo elemento a la tabla
    Entrada:
            - tabla (array)
            - nuevo registro de la tabla (array indexado)
    Salida:
            - tabla actualizada
    */

function nuevo($tabla, $registro)
{

    #Extraemos los valores del formulario
    $id = $_POST['id'];
    $descripcion= $_POST['descripcion'];
    $modelo = $_POST['modelo'];
    $categoria = $_POST['categoria'];
    $unidades = $_POST['unidades'];
    $precio = $_POST['precio'];

    # Cargar tabla productos
    $tabla = generar_tabla();

    # Creo un array asociativo con los detalles del nuevo producto
    $registro = [
        'id' => $id,
        'descripcion' => $descripcion,
        'modelo' => $modelo,
        'categoria' => $categoria,
        'unidades' => $unidades,
        'precio' => $precio
    ];

    # Añadir el nuevo producto a la tabla
    $tabla[] = $registro;
}



/*
    Function: update()
    descripcion: Actualiza los datos de un libro
    Entrada:
            - tabla (array)
            - registro
            - indice
    Salida:
            - tabla actualizada
    */
function update($tabla, $registro, $indice) {}
function buscar_registro($tabla, $columna, $valor)
{
    $columna_id = array_column($tabla, $columna);
    $tabla_actualizada = array_search($valor, $columna_id);
    return $tabla_actualizada;
}
