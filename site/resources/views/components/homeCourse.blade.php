<div class="container section-marginTop mb-5 text-center">
    <h1 class="section-title">কোর্স সমূহ </h1>
    <h1 class="section-subtitle">আইটি কোর্স, প্রজেক্ট ভিত্তিক সোর্স কোড সহ আরো যে সকল সার্ভিস আমরা প্রদান করি </h1>
    <div class="row">

        @foreach($coursesData as $course)
        <div class="col-md-4 thumbnail-container">
                <img src="{{$course->image}}" alt="Avatar" class="thumbnail-image ">
                <div class="thumbnail-middle">
                    <h1 class="thumbnail-title"> {{$course->name}} </h1>
                    <h1 class="thumbnail-subtitle">{{$course->description}} </h1>
                    <a target="_blank" href="{{$course->link}}" class="normal-btn btn">Now Start</a>
                </div>
        </div>
        @endforeach
    </div>
</div>
