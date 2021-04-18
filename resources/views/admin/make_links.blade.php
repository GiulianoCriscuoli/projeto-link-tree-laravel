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
                <option {{ isset($link) ? $link->order == '1' ? 'selected' : '' : '' }} value="1">Sim</option>
                <option {{ isset($link) ? $link->order == '0' ? 'selected' : '' : '' }} value="0">Não</option>
            </select>
        </label>

        <label for="title">
            Título do link: 
            <input type="text" name="title" value="{{ $link->title ?? '' }}">
        </label>

        <label for="href">
            Url do link: 
            <input type="url" name="href" value="{{ $link->href ?? '' }}">
        </label>

        
        <label for="bgColor">
            Cor de fundo do link: 
            <input type="color" name="bgColor" value="{{ $link->bgColor ?? '#FFF' }}">
        </label>

        
        <label for="textColor">
            Cor de texto do link: 
            <input type="color" name="textColor" value="{{ $link->bgText ?? '#000' }}">
        </label>

        <label for="active">
            Tipo de borda: 
            <select name="borderType">
                <option {{ isset($link->borderType) ? $link->borderType == 'rounded' ? 'selected' : '' : '' }} value="rounded">Arredondada</option>
                <option {{ isset($link->boderType) ? $link->borderType == 'square' ? 'selected' : '' : '' }}value="square">Quadrada</option>
            </select>
        </label>

        <label>
            <input type="submit" value="Criar">
        </label>

    </form>
@endsection