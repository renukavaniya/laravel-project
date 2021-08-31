@extends('layouts.master1')
@section('content')


<section id="contact" class="contact">
<!--<h1>Welcome</h1>
@if(isset(Auth::user()->email))
    <div class="alert alert-danger success-block">
     <strong>Welcome {{ Auth::user()->email }}</strong>
     <br />
     <a href="">Change Password</a><br>
     <a href="{{ url('/admin/logout') }}">Logout</a>
    </div>
   @else
    <script>window.location = "/admin";</script>
   @endif-->
   @if ($message = Session::get('error'))
  <!-- <div class="alert alert-succses alert-block">-->
<div class="alert alert-success col-sm-6">

    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>{{ $message }}</strong>
   </div>
   @endif
   
                     <form method="GET" action="booklist">
                      <label for="search" class="text-right">Search:</label>
                      <input class="col-md-2" type="search" value="{{request()->query('search')}}" name="search" placeholder="Search" id="search">
                     <button type="submit">Submit</button>
                      </form>
    
   <div class="row">
                        <div class="col-md-12">
                            <div class="card strpied-tabled-with-hover">
                                
                                <div class="card-body table-full-width table-responsive">
                                    <table class="table table-hover table-striped">
                                        <thead>
                                            <th>id</th>
                                            <th>title</th>
                                            <th>author</th>
                                            <th>publisher</th>
                                            <th>isbn</th>
                                            <th>description</th>
                                            <th>language</th>
                                            <th>genres</th>
                                            <th>image</th>
                                            <th>Delete</th>
                                            
                                        </thead>
                                        <tbody>
                                        <?php $total = 0 ?>
<!-- by this code session get all product that user chose -->
        @if(session('cart'))
            @foreach(session('cart') as $id => $details)

               
                <tr>
                    <td>{{ $details['title'] }}</td>
                        <td>{{ $details['author'] }} </td>
                        <td>{{ $details['publisher'] }} </td>
                        <td>{{ $details['isbn'] }} </td>

                    <td class="actions" data-th="">
                    <!-- this button is to update card -->
                        <button class="btn btn-info btn-sm update-cart" "><i class="fa fa-refresh"></i></button>
                       <!-- this button is for update card -->
                        <button class="btn btn-danger btn-sm remove-from-cart delete" data-id="{{ $id }}"><i class="fa fa-trash-o"></i>bhh</button>
                        <td><a href="/deletecart/{{ $id}}" class="btn btn-danger btn-fill">Delete</a></td>
                    </td>
                </tr>
            @endforeach
        @endif
                                                
                                        </tbody>
                                    </table>
                                    
                            
                                </div>
                            </div>
                        </section>
   
 @endsection
 </div>
 </div>
