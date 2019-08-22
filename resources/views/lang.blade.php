@extends('layouts.app')
@section('content')
    @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
    @endif
choose lang

<div class="album py-5 bg-light">
    <div class="container">

        <div class="row">

        </div>
    </div>
</div>
@endsection
