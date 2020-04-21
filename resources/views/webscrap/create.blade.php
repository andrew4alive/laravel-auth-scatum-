@extends("mainlayout")

@section("content")

<x-navbar1></x-navbar1><br/>
<x-craw-header></x-craw-header>
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div id="main" style="min-height:70vh">
   
   
</div>

<x-craw-footer></x-craw-footer>



@endsection