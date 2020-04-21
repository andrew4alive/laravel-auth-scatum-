@extends("mainlayout")

@section("content")

<x-navbar1></x-navbar1><br />
<x-craw-header></x-craw-header>
<hr />
<x-container-row>
    <div class="col-1"></div>
    <h4 class="col text-center alert alert-primary">Approve list</h4>
    <div class="col-1"></div>
</x-container-row>
@if( count($datas) >0 )
<x-container-row>
    <div class="col-1"></div>
    <ul class="list-group col ">
        @foreach ($datas as $data)
        <li class="list-group-item container">
            <div class="row">
                <p class="col-9"> {{ $data->data  }} </p>
                <form class="col-3" method="post" action="/webscrap/{{$data->id}}">
                    @csrf
                    @method("DELETE")
                    <input type="hidden" name="id" value="{{$data->id}}" />
                    <input class="btn btn-secondary" type="submit" value="delete">
                </form>
            </div>
        </li>
        @endforeach

    </ul>
    <div class="col-1"></div>
</x-container-row>

@endif
<br />
<div class="container"> {{$datas->links()}}</div>

<x-craw-footer></x-craw-footer>

@endsection