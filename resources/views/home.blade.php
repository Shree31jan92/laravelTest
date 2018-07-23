@extends('layouts.app')

@section('content')
<style>
    .fa{
        cursor: pointer !important;
    }
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">View All Posts 
                <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#addPost" style="margin-left: 400px;">Add My Own Post</button>
                    <!-- <button class="btn pull-right" > 
                        Add My Own Post
                    </button></div> -->

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if(count($posts)>0)
                        <table class='table'>
                            <tr>
                                <th>Action</th>
                                <th>Title</th>
                                <th>Created By</th>
                                <th>Created On</th>
                            </tr>
                        
                        @foreach($posts as $key=>$post)
                            <tr><!--
                            user_type
                            1:- General User
                            2:- Administrator
                            -->
                                <td>@if($post->created_by==Auth::id() || Auth::user()->user_type==2)<span data-toggle="modal" data-target="#editPost" onclick="editPost({{$post->id}})" style="color: orange; cursor: pointer;"><i class="fa fa-edit"></i>Edit</span><span data-toggle="modal" data-target="#deletePost" onclick="deletePost({{$post->id}})" style="color:red; cursor: pointer;"><i class="fa fa-trash"></i>Delete</span>@endif <span  data-toggle="modal" data-target="#viewPost" onclick="viewPost({{$post->id}})" style="color:blue; cursor: pointer;"><i class="fa fa-search"></i>View</span></td>
                                <td>{{$post->title}}</td>
                                <td>@if($post->created_by==Auth::user()->id) You @else {{$post->createdBy->name}} @endif</td>
                                <td>{{$post->created_at}}</td>
                            </tr>
                        @endforeach
                        </table>
                    @else
                    There are no posts to show!!    
                    @endif
                    
                </div>
            </div>
        </div>
    </div>
</div>

<!-- add post Modal -->
<div id="addPost" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
    <form method="POST" action="/posts" aria-label="{{ __('Register') }}">
      <div class="modal-header">
        <h4 class="modal-title">Add New Post</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
            
                @csrf

                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">Title</label>

                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control" name="title" required>                                
                    </div>
                </div>
                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">Content</label>

                    <div class="col-md-6">
                        <textarea id="content" class="form-control" name="content" required > </textarea>                                 
                    </div>
                </div>        
                     
      </div>
      <div class="modal-footer">
          <button type="submit" class="btn btn-primary">
            Create Post
        </button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
      </form>
    </div>

  </div>
</div>
<!--add post modal emd-->

<!-- view post Modal -->
<div id="viewPost" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">View Post</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
            
                <div class="form-group row">
                    <label class="col-md-4 col-form-label text-md-right">Title</label>

                    <div class="col-md-6">
                        <input id="viewTitle" type="text" class="form-control" name="title" required readonly>                                
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-4 col-form-label text-md-right">Content</label>

                    <div class="col-md-6">
                        <textarea id="viewContent" class="form-control" name="content" required  readonly> </textarea>                                 
                    </div>
                </div>        
                     
      </div>
      <div class="modal-footer">
          
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<!--view post modal emd-->

<!-- edit post Modal -->
<div id="editPost" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
    <form id='editPostForm' method="POST" action="/posts" aria-label="{{ __('Register') }}">
      <div class="modal-header">
        <h4 class="modal-title">Edit Post</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
            
                @csrf
                <input type="hidden" name="_method" value="PUT">
                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">Title</label>

                    <div class="col-md-6">
                        <input id="editname" type="text" class="form-control" name="title" required>                                
                    </div>
                </div>
                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">Content</label>

                    <div class="col-md-6">
                        <textarea id="editcontent" class="form-control" name="content" required > </textarea>                                 
                    </div>
                </div>        
                     
      </div>
      <div class="modal-footer">
          <button type="submit" class="btn btn-primary">
            Edit Post
        </button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
      </form>
    </div>

  </div>
</div>
<!--edit post modal emd-->

<!-- delete post Modal -->
<div id="deletePost" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
    <form id='deletePostForm' method="POST" action="/posts" aria-label="{{ __('Register') }}">
      <div class="modal-header">
        <h4 class="modal-title">Delete Post</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
            
                @csrf
                <input type="hidden" name="_method" value="DELETE">
                Are You Sure Want To Delete The Post????
      </div>
      <div class="modal-footer">
          <button type="submit" class="btn btn-primary">
            Delete Post
        </button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
      </form>
    </div>

  </div>
</div>
<!--delete post modal emd-->
 <script
  src="https://code.jquery.com/jquery-1.12.4.min.js"
  integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="
  crossorigin="anonymous"></script>
<script src="/js/post.js"></script>
</div>
@endsection
