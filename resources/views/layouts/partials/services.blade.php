<!-- Services -->
<section id="services">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading">Categories</h2>
                <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3>
            </div>
        </div>
        <div class="row text-center">
            @foreach($categories as $category)
            <div class="col-md-4 category-block-home">
                <img src="/img/portfolio/category/{{ $category->preview }}" class="category-img" alt="">
                <p><a class="category-home" href="/category/{{ $category->category }}">{{ $category->category }} ({{$category->proj}})</a></p>
                <p class="text-muted"></p>
            </div>
            @endforeach
        </div>
    </div>
</section>