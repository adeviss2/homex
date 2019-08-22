@extends('master')
@section('content')
<section class="jumbotron text-center">
    <div class="container">
        @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
        @endif
        @if (session('message'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Notice!</strong> {{ session('message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
        @endif
        <h1 class="jumbotron-heading">Extract Property</h1>
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">By URL <i class="fas fa-globe-europe"></i></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">By ID <i class="fas fa-hashtag"></i></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">History <i class="fas fa-history"></i></a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <p class="lead text-muted">Extract home by property url address.</p>
                <form method="POST" id="submiturl" action="{{ url('home/extract') }}">
                    @csrf

                    <input type="hidden" name="lang" value="{{ Lang::getLocale() }}">
                    <input type="hidden" name="action" value="url">
                    <div class="form-group">
                        <input name="search" type="url" class="form-control form-control-lg" placeholder="URL of property - Ex: https://www.homeaway.es/p4254766" required>
                    </div>
                    <button id="btnurl" type="submit" class="btn btn-primary btn-lg ld-ext-right">{{ trans('general.btn_by_url') }} <div class="ld ld-ring ld-spin"></div></button>
                </form>
            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <p class="lead text-muted">Extract home by property ID.</p>
                <form method="POST" id="submitid">
                    @csrf

                    <input type="hidden" name="lang" value="{{ Lang::getLocale() }}">
                    <input type="hidden" name="action" value="id">
                    <div class="form-group">
                        <input name="search" type="text" class="form-control form-control-lg" placeholder="ID of property - Ex: p4254766" required>
                    </div>
                    <button id="btnid" type="submit" class="btn btn-primary btn-lg ld-ext-right">{{ trans('general.btn_by_id') }} <div class="ld ld-ring ld-spin"></div></button>
                </form>
            </div>
            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                <div class="table-responsive-sm">
                    <table class="table">
                        <thead>
                            <th><i class="fas fa-list-ol"></i></th>
                            <th><i class="fas fa-external-link-alt"></i></th>
                            <th style="text-align: left;"><i class="fas fa-home"></i></th>
                            <th><i class="far fa-images"></i></th>
                            <th><i class="far fa-clock"></i></th>
                            <th colspan="2"><i class="fas fa-sliders-h"></i></th>
                        </thead>
                        <tbody>
                            @foreach ($homes as $home)
                                @php
                                    $imgs = \App\Image::where('property_id', $home->id)->take(3)->get();
                                @endphp
                                <tr>
                                    <td>{{ $home->id }}</td>
                                    <td>
                                        <a class="text-muted font-weight-light" target="_blank" href="{{ trans('general.host') . $home->home_id }}">
                                            {{$home->home_id}}
                                        </a>
                                    </td>
                                    <td style="text-align: left;">
                                        <a href="/home/view/{{ $home->id }}">
                                            <span class="text-muted font-weight-normal"> {{ Str::limit($home->home_title, 40) }} </span>
                                        </a>

                                    </td>
                                    <td>
                                        @foreach ($imgs as $img)
                                        <div class="thumbnail" style="display: inline-block;">
                                            <img src="{{ Storage::url($img->img) }}" alt="{{ $home->home_title }}" class="imgt">
                                        </div>
                                        @endforeach
                                    </td>
                                    <td><small class="text-muted">{{ $home->created_at }}</small></td>
                                    <td class="compact"><a class="btn btn-outline-secondary btn-sm" href="/home/view/{{ $home->id }}"><i class="far fa-eye"></i></a></td>
                                    <td class="compact"><a class="btn btn-outline-info btn-sm" href="/home/download/{{ $home->id }}"><i class="fas fa-download"></i></a></td>
                                    <td class="compact"><a class="btn btn-outline-danger btn-sm" href="/home/delete/{{ $home->id }}"><i class="fas fa-trash-alt"></i></a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <hr>
                <nav aria-label="Page navigation example">
                    {{ $homes->links() }}
                </nav>
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
