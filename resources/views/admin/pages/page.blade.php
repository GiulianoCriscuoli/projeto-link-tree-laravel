@extends('admin.app')

@section('title', $page->title.' - Links')

@section('content')

    <div class="page-name">
        Página: {{ $page->title }}
    </div>

    <div class="area-page--links">
        <div class="leftside">
            <header>
                <ul>
                    <li><a href="/admin/{{ $page->slug }}/links">Links</a></li>
                    <li><a href="/admin/{{ $page->slug }}/design">Aparência</a></li>
                    <li><a href="/admin/{{ $page->slug }}/estatisticas">Estatísticas</a></li>
                </ul>
            </header>

            @yield('body')
        </div>
        <div class="rightside">
            <iframe src="/{{ $page->slug }}" frameborder="0"></iframe>
        </div>
    </div>
@endsection