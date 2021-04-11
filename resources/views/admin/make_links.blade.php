@extends('admin.pages.page');

@section('body')

    @if($errors->any())
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form method="POST" class="formLinks">
        @csrf
        <label for="active">
            Ativo: 
            <select name="active">
                <option value="1">Sim</option>
                <option value="0">Não</option>
            </select>
        </label>

        <label for="title">
            Título do link: 
            <input type="text" name="title">
        </label>

        <label for="href">
            Url do link: 
            <input type="url" name="href">
        </label>

        
        <label for="bgColor">
            Cor de fundo do link: 
            <input type="color" name="bgColor" value="#FFF">
        </label>

        
        <label for="textColor">
            Cor de texto do link: 
            <input type="color" name="textColor" value="#000">
        </label>

        <label for="active">
            Tipo de borda: 
            <select name="borderType">
                <option value="rounded">Arredondada</option>
                <option value="square">Quadrada</option>
            </select>
        </label>

        <label>
            <input type="submit" value="Criar">
        </label>

    </form>
@endsection