@extends('public_master')
    @section('content')
        <section class="jumbotron" style="padding-top: 1rem !important;">
            <div class="container text-center" style="margin-bottom: 10px;">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <?php $i=0; foreach($images as $img): ?>
                            <li data-target="#carouselExampleIndicators" data-slide-to="<?=$i?>" class="<?= (($i === 0)? 'active': '')?>"></li>
                        <?php $i++ ?>
                        <?php endforeach; ?>
                    </ol>
                    <div class="carousel-inner" role="listbox" style=" width:100%; height: 500px !important;">
                        <?php $i=0; foreach($images as $img): ?>
                        <?php $img->img = str_replace($home->home_id, '.', $img->img); ?>
                            <div class="carousel-item <?= (($i === 0)? 'active': '')?>">
                                <img  src="{{ $img->img }}" class="d-block w-100">
                            </div>
                            <?php $i++ ?>
                        <?php endforeach; ?>
                    </div>

                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>

            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <h3 class="jumbotron-heading">{{ $home->home_title }}</h3>
                        <p><a href="{{ ('https://www.homeaway.com/vacation-rental/') . $home->home_id }}" class="link" target="_blank">{{ $home->home_id }}</a></p>
                        <p class="lead">{{ $home->home_summary }}</p><hr />
                        <p class="text-muted"><?=nl2br($home->home_description)?></p>
                        <ul class="list-group list-group-horizontal-sm">
                            <li class="list-group-item">Bedrooms: <span class="badge badge-info badge-pill">{{ $home->bedrooms }}</span></li>
                            <li class="list-group-item">Bathrooms: <span class="badge badge-info badge-pill">{{ json_decode($home->bathrooms)->full }}</span></li>
                            <li class="list-group-item">Max-guests: <span class="badge badge-info badge-pill">{{ $home->sleeps }}</span></li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <h3 class="jumbotron-heading">Amenities</h3><hr />
                        <dl>
                            <?php foreach(json_decode($home->amenities) as $amenity ): ?>
                            <dt>{{$amenity->title}}</dt>
                                <?php foreach($amenity->attributes as $attribute ): ?>
                                <dd class="text-muted" style="margin-bottom: 0; margin-left:6px;"><?=ucfirst($attribute)?></dd>
                                <?php endforeach;?>
                            <?php endforeach;?>
                        </dl>
                    </div>
                </div>
            </div>
        </section>
        @endsection
