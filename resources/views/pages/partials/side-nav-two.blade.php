<div id="sidebar-wrapper-two">
    <ul class="sidebar-nav" style="padding-top: 20px;width:100%;position:relative;">
        <li class="green-text bold-700">{{config('label')->brand}}</li>
        <div class="li-brand">
            @foreach ($brands as $brand)
            <li>
                <a href="{{ url('brand', $brand->id) }}">
                    {{ $brand->brand_name }}
                </a>
            </li>
            @endforeach
        </div>
        
        <br><br>
        <li class="green-text bold-700">{{config('label')->category}}</li>
        @foreach($categories as $category)
        <li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                    {{ $category->category }} <span class="caret"></span>
                    <ul class="dropdown-menu">
                        @foreach($category->children as $children)
                        <li id="dropdown-category">
                            <a href="{{ url('category', $children->id) }}">
                                {{ $children->category }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </a>
            </li>
        </li>
        @endforeach
    </ul>
</div>