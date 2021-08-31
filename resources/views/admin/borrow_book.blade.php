@extends('layouts.master')
@section('content')
<div class="main-panel">
<nav class="navbar navbar-expand-lg " color-on-scroll="500">
<div class="container-fluid">
<a class="navbar-brand" href="#pablo"> Book List </a>
<button href="" class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
<span class="navbar-toggler-bar burger-lines"></span>
<span class="navbar-toggler-bar burger-lines"></span>
<span class="navbar-toggler-bar burger-lines"></span>
</button>
<div class="collapse navbar-collapse justify-content-end" id="navigation">
<ul class="nav navbar-nav mr-auto">
<li class="nav-item">
<a href="#" class="nav-link" data-toggle="dropdown">
<i class="nc-icon nc-palette"></i>
<span class="d-lg-none">Dashboard</span>
</a>
</li>
<ul class="navbar-nav ml-auto">
<li class="nav-item"  >
<a class="nav-link" href="{{ url('/admin/logout') }}">
<span class="no-icon">Logout</span>
</a>
</li>
</ul>
</div>
</div>
</nav>
<div class="container col-sm-12">
<!--<h1>Welcome</h1>
@if(isset(Auth::user()->email))
<div class="alert alert-danger success-block">
<strong>Welcome {{ Auth::user()->email }}</strong>
<br/>
<a href="">Change Password</a><br>
<a href="{{ url('/admin/logout') }}">Logout</a>
</div>
@else
<script>window.location = "/admin";</script>
@endif-->
@if ($message = Session::get('success'))
<!-- <div class="alert alert-succses alert-block">-->
<div class="alert alert-success col-sm-6">
<button type="button" class="close" data-dismiss="alert">×</button>
<strong>{{ $message }}</strong>
</div>
@endif
   
<!--<form method="GET" action="booklist">
<label for="search" class="text-right">Search:</label>
<input class="col-md-2" type="search" value="{{request()->query('search')}}" name="search" placeholder="Search" id="search">
<button type="submit">Submit</button>
<div>
<span class="paginationtextfield">Show</span>&nbsp;
<select id="limit_records" name="limit_records">-->
<?php
/*$record_per_page_arr = array("3","6","9","15","25");
foreach ($record_per_page_arr as $limit_records) {
    if (isset($_GET['limit_records']) && $_GET['limit_records'] == $limit_records) {
        echo '<option value="'.$limit_records.'" selected="selected">'.$limit_records.'</option>' ;
    } else {
        echo '<option value="'.$limit_records.'">'.$limit_records.'</option>';
    }
}*/
?>
</select>
<!--<span class="paginationtextfield">entries</span>&nbsp;
</div>
</form>-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
 $(document).ready(function(){
 $("#limit_records").change(function(){
   $('form').submit();
 })
})
</script>
<!--
<div class="col-md-5" >
     <a href="{{url('admin/export-excel')}}" class="btn btn-primary">Export in xlsx</a>
    </div><br>
    
    <form action="{{url('import.file')}}" method="post" enctype="multipart/form-data">
    @csrf
    <input type="file" name="file">
    <input type="submit" value="upload" name="submit">
    </form><br>-->
    <form action="{{url('admin/excel_bydate')}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="form-group ">
                        <label>From_date</label>
                        <input type="date" name="date" class="disableFuturedate" placeholder="YYYY/MM/DD" value ="">
                    </div>
                    <div class="form-group ">
                        <label>To_date</label>
                        <input type="date" name="todate" class="disableFuturedate" placeholder="YYYY/MM/DD" value ="">
                    </div>
    <input type="submit" value="ByDate" name="submit">
    
    </form><br>
<div class="row">
<div class="col-md-12">
<div class="card strpied-tabled-with-hover">
<div class="card-body table-full-width table-responsive">
<table class="table table-hover table-striped">
<thead>
 <th>@sortablelink('username')</th>
 <th>@sortablelink('title')</th>
 <th>@sortablelink('author')</th>
 
 <th>@sortablelink('isbn')</th>
 <th>@sortablelink('description')</th>
 <th>@sortablelink('language')</th>
 <th>@sortablelink('genres')</th>
 <th>@sortablelink('image')</th>
 <th>@sortablelink('quantity')</th>
 <th>@sortablelink('Issue_date')</th>
 <th>@sortablelink('Return_date')</th>
</thead>
<tbody>
@foreach($borrow as $book)

<tr>

<td>{{ $book->firstname;}} </td>
<td>{{ $book->title;}} </td>
<td>{{ $book->author;}} </td>
<td>{{ $book->isbn;}} </td>
<td>{{ $book->description;}} </td>
<td>{{ $book->language;}} </td>
<td>{{ $book->genres;}} </td>

<td><img src="{{ asset('upload/'.$book->image ) }} " width="70px" height="80px" class="img-thumbnail" /> </td>
<td>{{ $book->quantity;}} </td>
<td>{{ $book->issue_date;}} </td>
<td>{{ $book->return_date;}} </td>

@if($book->approved === 'return')
    <input type="text" value="{{$book->email}}">
<td><button href="admin/return_book/{{$book->id}}" class="btn btn-danger btn-fill" disabled>Return</button></td>
                                                
@else
                                                
<td><a href="returnbook/{{$book->id}}/{{$book->book_id}}"class="btn btn-danger btn-fill">Return</a></td>    
                                                
@endif
<form action="excel/{{$book->id}} " method="post">
@csrf
<input type="hidden" name="user" value="{{$book->user_id}}">
 <td><button class="btn btn-primary">Export in xlsx</button></td>
 </form>
<!--<td><a href="admin/export-excel/{{$book->id}}" class="btn btn-primary">Export in xlsx</a></td>
<!--<td><a href="approve_form" class="btn btn-success btn-fill">Approve</a></td>-->
<!--<td><a href="/approve_book" class="btn btn-success btn-fill">Approve Book</a></td>
<!--<td><a href="/edit/{{ $book->id;}}" class="btn btn-warning btn-fill">Edit</a></td>-->
</tr>

@endforeach;
@forelse($borrow as $book)
@empty
<p class ="text-center">
No result found for <strong> {{request()->query('search')}} </strong>
</p>
@endforelse;
</tbody>
</table>


</div>
</div>
</div>
</div>
</div>
@endsection
