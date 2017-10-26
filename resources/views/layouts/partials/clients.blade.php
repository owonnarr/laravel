<!-- Clients -->
<section class="py-5">
    <div class="container">
        <div class="row">
            @foreach($categories as $category)
            <div class="col-cmd-1 col-sm-2">
                <a href="/category/{{ $category->category }}">
                    <img class="category-img" src="/img/portfolio/category/{{$category->preview}}" alt="">
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>