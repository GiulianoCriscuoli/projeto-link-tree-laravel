@extends('admin.pages.page')

@section('body')

    <div class="btn-large--area">
        <a class="btn-large" href="{{ url('/admin/'.$page->slug.'/novo-link')}}">Novo Link</a>

    </div>
    
    <ul id="link-order" class="links-area">
        <h2>Seus links</h2>
        @foreach($links as $link)
            <li class="link-item" data-id="{{ $link->id }}">
                <div class="link-informations">
                    <div class="link-title">Meu perfil do {{ $link->title }}</div>
                    <div class="link-address">Meu link de perfil: {{ $link->href }}</div>
                </div>
                <div class="link-button">
                    <a class="btn-edit" href="{{url('/admin/'.$page->slug.'/editar/'.$link->id) }}">Editar Links</a>
                    <a class="btn-destroy" href="{{ url('/admin/'.$page->slug.'/excluir/'.$link->id) }}">Excluir Links</a>
                </div>
            </li>
        @endforeach
    </ul>

    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.13.0/Sortable.min.js"></script>
    <script>
        new Sortable(document.querySelector("#link-order"),{
            animation: 150,
            onEnd: async(e) => {
                let id = e.item.getAttribute('data-id');
                let link = `{{url('/admin/link-order/${id}/${e.newIndex}')}}`;
                await fetch(link);
                window.location.href = window.location.href;
            }
        });

    </script>
@endsection