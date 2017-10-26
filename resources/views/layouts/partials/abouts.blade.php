<!-- About -->
<section id="about">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading">About</h2>
                <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <ul class="timeline">
                    @foreach($abouts as $about)
                    <li>
                        <div class="timeline-image">
                            <img class="rounded-circle img-fluid image-abouts" src="/img/portfolio/abouts/{{ $about->preview }}" alt="">
                        </div>

                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4>{{ $about->date }}</h4>
                                <h4 class="subheading">{{ $about->name }}</h4>
                            </div>
                            <div class="timeline-body">
                                <p class="text-muted">{{ $about->description }}</p>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</section>