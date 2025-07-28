@extends('layouts.app')

   @section('content')
  <section class="blog_area single-post-area section-padding">
      <div class="container">
         <div class="row">
            <div class="col-lg-8 posts-list">
               <div class="single-post">
                  <div class="feature-img">
                     <img class="img-fluid" src="assets/img/blog/single_blog_1.png" alt="">
                  </div>
                  <div class="blog_details">
                     <h2>{{ $data->title }}
                     </h2>
                     <ul class="blog-info-link mt-3 mb-4">
                        <li><a href="#"><i class="fa fa-user"></i> {{ $data->category_name }}</a></li>
                        <li><a href="#"><i class="fa fa-comments"></i> 03 Comments</a></li>
                     </ul>
                     <p class="excert">
                        {{ $data->body }}
                     </p>
               
                        MCSE boot camps have its supporters and its detractors. Some people do not understand why you
                        should have to spend money on boot camp when you can get the MCSE study materials yourself at a
                        fraction of the camp price. However, who has the willpower to actually sit through a
                        self-imposed MCSE training. who has the willpower to actually
                     </p>
                  </div>
               </div>
               <div class="comments-area" id="comments">
                    <h4>{{ count($comments) }} Comments</h4>
                  @foreach ($comments as $comment )
                  
                
                  <div class="comment-list">
                     <div class="single-comment justify-content-between d-flex">
                        <div class="user justify-content-between d-flex">
                           <div class="thumb">
                              <img src="assets/img/comment/comment_3.png" alt="">
                           </div>
                           <div class="desc">
                              <p class="comment">
                                {{ $comment->content }}
                              </p>
                              <div class="d-flex justify-content-between">
                                 <div class="d-flex align-items-center">
                                    <h5>
                                       <a href="#">{{ $comment->user->name }}</a>
                                    </h5>
                                    <p class="date">{{  $comment->updated_at->format('F j, Y H:i')  }}</p>
                                 </div>
                                 <div class="reply-btn">
                                 Reply
                                 </div>

                              </div>
                            
                           </div>
                        </div>
                     </div>
                  </div>
                  @endforeach
               </div>
               <div class="comment-form">
                  <h4>Leave a Reply</h4>
                  <form class="form-contact comment_form" id="comment-form" method="POST" action="{{ route('comments.store',$data->id) }}" id="commentForm">

                          @csrf
                        <input type="hidden" name="article_id" value="{{ $data->id }}">

                     <div class="row">
                        <div class="col-12">
                           <div class="form-group">
                              <textarea class="form-control w-100" name="content" id="comment" cols="30" rows="9"
                                 placeholder="Write Comment"></textarea>
                           </div>
                        </div>
                     </div>
                     <div class="form-group">
                        <button type="submit" class="button button-contactForm btn_1 boxed-btn">Post Comment</button>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </section>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<script>

     



    $('#comment-form').on('submit', function(e) {
        e.preventDefault(); // Prevent page reload

        $.ajax({
            url: '{{ route("comments.store",$data->id) }}',
            method: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                // Optionally clear the form
                $('#comment-form')[0].reset();

                // Append new comment to the comment list
                $('#comments').append(`
                    <div class="comment">
                        <strong>${response.user.name}</strong>: ${response.content}
                    </div>
                `);
            },
            error: function (xhr) {
    alert("Something went wrong!\n" + xhr.responseText);
}
        });
    });
</script>







   
   @endsection
   
