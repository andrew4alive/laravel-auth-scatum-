{{-- header for web craw  --}}
<h3 class="text-center">
    Webscrap Operation :
</h3>
<h4 class="text-center">
    <a href="/webscrap">View pick up line </a>
</h4>
<h4 class="text-center">
    <a href="/webscrap/create">scrap web for pick up line</a>
</h4>
<h4 class="text-center">
    <a href="/webscrap/review">scrap web review</a>
</h4>

@if(session("message"))
<div class="container">

    <div class=" row alert alert-success">
        {{ session('message') }}
    </div>
</div>
@endif


@if(session("messagefail"))
<div class="container">

    <div class=" row alert alert-danger">
        {{ session('messagefail') }}
    </div>
</div>
@endif