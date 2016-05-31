<!-- Carousel -->
<!-- <div id="carousel1" class="carousel slide carousel-fade hoverable"> -->
<div id="carousel1" class="carousel slide carousel-fade ">
    <!-- Indicators -->
    <ol class="carousel-indicators">
        
        @foreach ($slideshow as $index=>$element)
        <li data-target="#carousel1" data-slide-to="{{$index}}" class="{{ ($index==0)?'active':''  }}"></li>
        @endforeach
    </ol>
    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
        @foreach ($slideshow as $index=>$element)
        {{-- expr --}}
        <div class="item {{ ($index==0)?'active':''  }}" id="tf-home">
            <div class="view overlay hm-blue-slight">
                <a href="{{$element->link}}"><img src="{{url('/')}}/src/public/Slideshows/{{$element->image_name}}" alt="Shopify Welcome">
                    <div class="mask waves-effect waves-light"></div>
                </a>
                <div class="carousel-caption hidden-xs">
                    <div class="animated fadeInDown">
                        <!-- <h1><strong><span class="color">{{$element->title}}</span></strong></h1> -->
                        <h5 class="color">{{$element->title}}</h5>
                        <p class="lead">{{$element->short_desc}}</p>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <!-- /.carousel-inner -->
    <!-- Controls -->
    <a class="left carousel-control new-control" href="#carousel1" role="button" data-slide="prev">
        <span class="fa fa fa-angle-left waves-effect waves-light"></span>
        <span class="sr-only">{{config('label')->previous}}</span>
    </a>
    <a class="right carousel-control new-control" href="#carousel1" role="button" data-slide="next">
        <span class="fa fa fa-angle-right waves-effect waves-light"></span>
        <span class="sr-only">{{config('label')->previous}}</span>
    </a>
</div>
<!-- <div class="yellow-line"></div> -->
<!-- /.carousel -->