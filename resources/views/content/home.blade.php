@extends('index')



@section('content')

 
      <div class="container">
        <div class="row">
          <div class="col-md-8">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h3 class="panel-title">Wall</h3>
              </div>
              <div class="panel-body">
                <form method="POST" action="/home/store"  enctype="multipart/form-data">
                      {{ csrf_field () }}
                  <div class="form-group">
                      <label for="title">Title:</label>
                       <input type="text" class="form-control" name="title" placeholder="add titel">
                  </div>

                  <div class="form-group">
                    <textarea class="form-control" name="body"  placeholder="Write on the wall "></textarea>
                  </div>
                  <button type="submit" class="btn btn-default">Submit</button>


                  <div class="pull-right">
                    <div class="btn-group">
                    <button type="button" class="btn btn-default"><i class="fa fa-pencil" aria-hidden="true"></i> Text</button>
                    <button type="button" class="btn btn-default"><i class="fa fa-file-image-o" aria-hidden="true"></i> Image</button>
                    <button type="button" class="btn btn-default"><i class="fa fa-file-video-o" aria-hidden="true"></i> Video</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>

            @foreach($posts as $post)
             
            <div class="panel panel-default post">
              <div class="panel-body">
                <div class="row">

                     
                  <div class="col-sm-2">
                    <a class="post-avatar thumbnail" href="/profile"><img src="storage/images/{{$post->user->avatar}}" class="text-center"> {{$post->user->name}}</a>
                    <div class="likes text-center">7 Likes</div><!--col-sm-2 ends -->
                  </div>

                  
                  <div class="col-sm-10">
                  	      <!-- posts -->

                <h2>
                    <a href="/posts/{{$post->id}}">{{$post -> title}}</a>
                </h2>
                 
               <!-- <p class="lead">
                    by <a href="index.php">katib</a>
                </p>  -->

                <p><span class="glyphicon glyphicon-time"></span>

                    Posted on {{$post->created_at ->toDayDateTimeString()}}</p>

                    <div class="bubble">
                      <div class="pointer">
                        <p>{{$post -> body}}</p>
                      </div>

                      <div class="pointer-border"></div>

                    </div> 
                     @if((Auth::user()->id)===($post->user->id))
                    <div class="pointer-border">
                    <!-- bubble end -->
                        <div class="form-group">
                         <div class="panel-body">
                      
                    
                    

                    <form class="form-inline" method="POST" action="{{url('home/'.$post -> id.'/distroy')}}">

                      {{ csrf_field () }}
                       {{ method_field ('DELETE') }}
                        <a href="{{url('home/'.$post -> id.'/edit')}}" class="btn btn-info"><i class="fa fa-pencil" aria-hidden="true"></i> modifer</a>
                   

                      <button type='submit' class="btn btn-danger"><i class="fa fa-file-image-o" aria-hidden="true"></i> suprimmer</button>
                      </form>
                    </div>
                    
                    </div>
                    </div>
                   @endif
                   
                    
                 



                          <!-- add commenters-->
                    <p class="post-actions"><a href="#">Comment</a> - <a href="#">Like</a> - <a href="#">Follow</a> - <a href="#">Share</a></p>
                    <div class="comment-form">

                      <form class="form-inline" method="POST" action="/home/{{$post->id}}/user/{{Auth::user()->id }}/store">
                           {{ csrf_field () }}

                        <div class="form-group">
                          <input type="text"  name="body" class="form-control" id="exampleInputName2" placeholder="Enter Comment">
                        </div>

                        <button type="submit" class="btn btn-default">Add</button>
                      </form>
                    </div><!-- comment form ends -->

                      <!--  --> 

                    <div class="clearfix"></div>

                             @foreach ($post->comments as $comment)
                    <div class="comments">
                      <div class="comment">
                        <a class="comment-avatar pull-left" href="#"><img src=""></a>
                        <div class="comment-text">
                          <p>{{$comment-> body}}</p>
                        </div>
                      </div>
                     
                      <div class="clearfix"></div>
                    </div>
                    @endforeach
                  </div>
              </div>
            </div>
          </div>
          @endforeach

          
          
        </div><!--col-md-8 end -->
        <!-- frend 
        <div class="col-md-4">
              <div class="panel panel-default friends">
                <div class="panel-heading">
                  <h3 class="panel-title">My Friends</h3>
                </div>
                <div class="panel-body">
                  <ul>
                    <li><a class="thumbnail" href="profile.html"><img src="img/user.png"></a></li>
                    <li><a class="thumbnail" href="profile.html"><img src="img/user.png"></a></li>
                    <li><a class="thumbnail" href="profile.html"><img src="img/user.png"></a></li>
                    <li><a class="thumbnail" href="profile.html"><img src="img/user.png"></a></li>
                    <li><a class="thumbnail" href="profile.html"><img src="img/user.png"></a></li>
                    <li><a class="thumbnail" href="profile.html"><img src="img/user.png"></a></li>
                    <li><a class="thumbnail" href="profile.html"><img src="img/user.png"></a></li>
                    <li><a class="thumbnail" href="profile.html"><img src="img/user.png"></a></li>
                    <li><a class="thumbnail" href="profile.html"><img src="img/user.png"></a></li>
                    <li><a class="thumbnail" href="profile.html"><img src="img/user.png"></a></li>
                    <li><a class="thumbnail" href="profile.html"><img src="img/user.png"></a></li>
                    <li><a class="thumbnail" href="profile.html"><img src="img/user.png"></a></li>
                  </ul>
                  <div class="clearfix"></div>
                  <a class="btn btn-primary" href="#">View All Friends</a>
                </div>
              </div>    
              <div class="panel panel-default groups">
                <div class="panel-heading">
                  <h3 class="panel-title">Latest Groups</h3>
                </div>
                <div class="panel-body">
                  <div class="group-item">
                    <img src="img/group.png">
                    <h4><a href="#">Sample Group One</a></h4>
                    <p>This is a Dobble social network sample group</p>
                  </div>
                </div>
                <div class="clearfix"></div>
                <div class="panel-body">
                  <div class="group-item">
                    <img src="img/group.png">
                    <h4><a href="#">Sample Group One</a></h4>
                    <p>This is a Dobble social network sample group</p>
                  </div>
                </div>
                <div class="clearfix"></div>
                <div class="panel-body">
                  <div class="group-item">
                    <img src="img/group.png">
                    <h4><a href="#">Sample Group One</a></h4>
                    <p>This is a Dobble social network sample group</p>
                  </div>
                  <div class="clearfix"></div>
                  <a class="btn btn-primary" href="#">View All Groups</a>
                </div> 
              </div>
            </div>-->
        </div>
      </div>


    


@endsection