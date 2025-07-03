@extends('layouts.app')

@section('content')
   <main>
    <!-- Trending Area Start -->
    <div class="trending-area fix">
        <div class="container">
            <div class="trending-main">
                <!-- Trending Tittle -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="trending-tittle">
                            <strong>Trending now</strong>
                            <!-- <p>Rem ipsum dolor sit amet, consectetur adipisicing elit.</p> -->
                            <div class="trending-animated">
                                <ul id="js-news" class="js-hidden">
                                    <li class="news-item">Bangladesh dolor sit amet, consectetur adipisicing elit.</li>
                                    <li class="news-item">Spondon IT sit amet, consectetur.......</li>
                                    <li class="news-item">Rem ipsum dolor sit amet, consectetur adipisicing elit.</li>
                                </ul>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8">
                        <!-- Trending Top -->
                   @if($articles)
                             <div class="trending-top mb-30">
                            <div class="trend-top-img">
                                <img src="https://placehold.co/640x480.png?text=News+Article" alt="">
                                <div class="trend-top-cap">
                                    <span>{{ $articles->category_name }}</span>
                                    <h2><a href="details.html">{{$articles->title }}</a></h2>
                                </div>
                            </div>
                        </div>
                    @else
                        <p>No article found.</p>    
                   @endif
                        <!-- Trending Bottom -->
                        <div class="trending-bottom">
                            <div class="row">
                                @foreach($bottoms as $bottom)
                                <div class="col-lg-4">
                                <div class="single-bottom mb-35">
                                    <div class="trend-bottom-img mb-30">
                                        <img src="https://placehold.co/640x480.png?text=News+Article" alt="">
                                    </div>
                                    <div class="trend-bottom-cap">
                                        <span class="color1">{{ $bottom->category_name }}</span>
                                        <h4><a href="details.html">{{ $bottom->title }}</a></h4>
                                    </div>
                                </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <!-- Riht content -->
                    <div class="col-lg-4">
                       @foreach($right as $new)
                        <div class="trand-right-single d-flex">
                            <div class="trand-right-img">
                                <img src="https://placehold.co/640x480.png?text=News+Article" alt="" style="width: 120px;">
                            </div>
                            <div class="trand-right-cap">
                                <span class="color1">{{ $new->category_name }}</span>
                                <h4><a href="details.html">{{ $new->title }}</a></h4>
                            </div>
                        </div>
                       @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
<section class="whats-news-area pt-50 pb-20">
        <div class="container">
            <div class="row">
            <div class="col-lg-8">
                <div class="row d-flex justify-content-between">
                    <div class="col-lg-3 col-md-3">
                        <div class="section-tittle mb-30">
                            <h3>Whats New</h3>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-9">
                        <div class="properties__button">
                            <!--Nav Button  -->                                            
                            <nav>                                                                     
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <a class="nav-item nav-link " id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab"  data-slug="all"  daaria-controls="nav-home" aria-selected="true">All</a>
                                 @foreach($categories as $category)
                                    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#" role="tab"   data-slug="{{ $category->slug }}"aria-controls="nav-profile" aria-selected="false">{{ $category->name }}</a>

                                 @endforeach
                                </div>
                            </nav>
                            <!--End Nav Button  -->
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <!-- Nav Card -->
                        <div class="tab-content" id="nav-tabContent">
                            <!-- card one -->
                           
                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">           
                                <div class="whats-news-caption">
                                    <div class="row">
                                  <div class="row" id="filtered-articles-container">
                                    @include('partials.filtered-articles', ['filteredArticles' => $filteredArticles])
                                </div>

                                    </div>
                                </div>
                            </div>
                
                            
                        </div>
                    <!-- End Nav Card -->
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <!-- Section Tittle -->
                <div class="section-tittle mb-40">
                    <h3>Follow Us</h3>
                </div>
                <!-- Flow Socail -->
                <div class="single-follow mb-45">
                    <div class="single-box">
                        <div class="follow-us d-flex align-items-center">
                            <div class="follow-social">
                                <a href="#"><img src="assets/img/news/icon-fb.png" alt=""></a>
                            </div>
                            <div class="follow-count">  
                                <span>8,045</span>
                                <p>Fans</p>
                            </div>
                        </div> 
                        <div class="follow-us d-flex align-items-center">
                            <div class="follow-social">
                                <a href="#"><img src="assets/img/news/icon-tw.png" alt=""></a>
                            </div>
                            <div class="follow-count">
                                <span>8,045</span>
                                <p>Fans</p>
                            </div>
                        </div>
                            <div class="follow-us d-flex align-items-center">
                            <div class="follow-social">
                                <a href="#"><img src="assets/img/news/icon-ins.png" alt=""></a>
                            </div>
                            <div class="follow-count">
                                <span>8,045</span>
                                <p>Fans</p>
                            </div>
                        </div>
                        <div class="follow-us d-flex align-items-center">
                            <div class="follow-social">
                                <a href="#"><img src="assets/img/news/icon-yo.png" alt=""></a>
                            </div>
                            <div class="follow-count">
                                <span>8,045</span>
                                <p>Fans</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- New Poster -->
                <div class="news-poster d-none d-lg-block">
                    <img src="assets/img/news/news_card.jpg" alt="">
                </div>
            </div>
            </div>
        </div>
    </section>
    <div class="weekly2-news-area  weekly2-pading gray-bg">
        <div class="container">
            <div class="weekly2-wrapper">
                <!-- section Tittle -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-tittle mb-30">
                            <h3>Weekly Top News</h3>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="weekly2-news-active dot-style d-flex dot-style">
                          @foreach($trending as $new)
                            <div class="weekly2-single">
                                <div class="weekly2-img">
                                    <img src="https://placehold.co/640x480.png?text=News+Article" alt="">
                                </div>
                                <div class="weekly2-caption">
                                    <span class="color1">{{$new->category_name }}</span>
                                    <p>{{ \Carbon\Carbon::parse($new->created_at)->format('d M Y')  }}</p>
                                    <h4><a href="#">{{ $new->title }}</a></h4>
                                </div>
                            </div> 
                            @endforeach                     
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>           
    
       

    <!-- End pagination  -->
    </main>

    <script>

    document.querySelectorAll('.nav-link').forEach(link => {

        link.addEventListener('click', function(e){

            e.preventDefault();

            let slug = this.dataset.slug;

                    fetch(`/category/ajax/${slug}`)
            .then(res => res.text())
            .then(html => {
                document.querySelector('#filtered-articles-container').innerHTML = html;
            });

        })

    })



    </script>
    
@endsection