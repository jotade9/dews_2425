{{-- - indico la plantilla a partir de la cual se genera la vista --}}
@extends('layout.layout')
{{-- modifico el titulo --}}
@section('titulo', 'Panel Control Productos')

{{-- modifico el contenido --}}
@section('contenido')

    @include('products.partials.menu')

    <table class="table">

        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Descripción</th>
                <th scope="col">Modelo</th>
                <th scope="col">Precio</th>
                <th scope="col">Unidades</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $product['id'] }}</td>
                    <td>{{ $product['descripcion'] }}</td>
                    <td>{{ $product['modelo'] }}</td>
                    <td>{{ $product['precio'] }}</td>
                    <td>{{ $product['unidades'] }}</td>
                    <td>
                        <a href="{{ route('products.show', $product['id']) }}" class="btn btn-primary">Ver</a>
                        <a href="{{ route('products.edit', $product['id']) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('products.destroy', $product['id']) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection




