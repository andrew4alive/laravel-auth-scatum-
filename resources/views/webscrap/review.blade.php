@extends("mainlayout")

@section("content")

<x-navbar1></x-navbar1><br />
<x-craw-header></x-craw-header>




@if( count( $reviews )>0)
<div class="container">
    <div class="row">
        <div class="col-1"></div>
        <ul class="list-group col">
            @foreach ($reviews as $review)
            <li class="list-group-item container">
                <div class="row">
                    <p class="col-lg-8">{{-- "id:".$review->id --}} {{$review->data}}</p>
                    <div class="row col-lg-4">
                        <form class="col" method="post" action="/webscrap/review/approve">
                            @csrf
                            <input type="hidden" name="id" value="{{$review->id}}" />
                            <input class="btn btn-primary" type="submit" value="approve" />
                        </form>
                        <form class="col" method="post" action="/webscrap/review/{{$review->id}}">
                            @csrf
                            @method("DELETE")
                            <input type="hidden" name="id" value="{{$review->id}}" />
                            <input class="btn btn-secondary" type="submit" value="delete">
                        </form>
                        <div class="col-lg-0 col"></div>
                        <div class="col-lg-0 col"></div>
                    </div>
                </div>
            </li>
            @endforeach
        </ul>
        <div class="col-1"></div>
    </div>
</div>


<br />
<div class="container">
    <div class="row">
        <div class="col-lg-9">{{$reviews->links()}}</div>
        <div class="col-log-3">
            <form method="post" action="/webscrap/review"
                onsubmit="return confirm('Are you sure want to delete all?');">
                @csrf
                @method("DELETE")
                <input class="btn btn-danger" type="submit" value="Delete All" />
            </form>
        </div>
    </div>
</div>

@else
<x-container-row>
    <div class="jumbotron col">
        <h1 class="display-4 text-center">No review, please webscrap</h1>

    </div>
</x-container-row>


@endif

<x-craw-footer></x-craw-footer>
@endsection