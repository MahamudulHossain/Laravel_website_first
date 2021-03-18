<div class="container section-marginTop text-center">
    <div class="row d-flex justify-content-center">
            <div class="col-md-6 text-center">
                <div id="two" class="owl-carousel mb-4 owl-theme">
            @foreach($reviews as $reviews)
                <div class="item m-1 text-center ">
                        <img class="review-img text-center" src="{{$reviews->image}}" alt="Card image cap">
                        <h5 class="service-card-title mt-3">{{$reviews->name}}</h5>
                        <h6 class="service-card-subTitle p-0 m-0">{{$reviews->desc}}</h6>
                </div>
            @endforeach
            </div>
        </div>
    </div>
</div>