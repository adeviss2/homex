@extends('master')
@section('content')
<section class="jumbotron text-center">
    <div class="container">
        <h1 class="jumbotron-heading">Extract property</h1>
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">By URL</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">By ID</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">History</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <p class="lead text-muted">Extract home by property url address.</p>
                <form method="POST" id="submiturl">
                    @csrf
                    <input type="hidden" name="action" value="url">
                    <div class="form-group">
                        <input name="search" type="url" class="form-control form-control-lg" placeholder="URL of property - Ex: https://www.homeaway.es/p4254766" required>
                    </div>
                    <button id="btnurl" type="submit" class="btn btn-primary btn-lg ld-ext-right">Extract by URL <div class="ld ld-ring ld-spin"></div></button>
                </form>
            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <p class="lead text-muted">Extract home by property ID.</p>
                <form method="POST" id="submitid">
                    @csrf
                    <input type="hidden" name="action" value="id">
                    <div class="form-group">
                        <input name="search" type="text" class="form-control form-control-lg" placeholder="ID of property - Ex: p4254766" required>
                    </div>
                    <button id="btnid" type="submit" class="btn btn-primary btn-lg ld-ext-right">Extract by ID <div class="ld ld-ring ld-spin"></div></button>
                </form>
            </div>
            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                <br>asdasdasdasd
                <table class="table">
                    <thead>
                        <th>ID</th>
                    </thead>
                    <tbody>
                        @foreach ($homes as $home)
                            <td>{{ $home->id }}</td>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<div class="album py-5 bg-light">
    <div class="container">

        <div class="row">

        </div>
    </div>
</div>

@endsection
