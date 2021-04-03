@extends('admin.app')

@section('title'. 'Home')

@section('content')

    <header>
        <h2>Suas páginas customizáveis</h2>
    </header>

    <table>
        <thead>
            <tr>
                <th>Título das páginas</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @if($pages)
                @foreach($pages as $page)
                    <td style="text-align: center;">{{ $page->title}}</td>
                    <td class="actions-area">
                      <a href="{{'/'.$page->slug }}" class="actions" target="_blank"> Abrir a página </a> 
                      <a href="{{url('/admin'.$page->slug.'/links')}}" class="actions">Links</a>
                      <a href="{{url('/admin'.$page->slug.'/design')}}" class="actions">Aparência</a>
                      <a href="{{url('/admin'.$page->slug.'/estaticas')}}" class="actions">Estatísticas</a>
                    </td>
                @endforeach
            @endif
        </tbody>
    </table>

@endsection