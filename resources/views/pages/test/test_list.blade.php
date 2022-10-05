@extends('layout.lay')

@section('title','Tests')
@section('content')



<table class="table">
   <thead>
     <tr>
       <th scope="col">ID</th>
       <th scope="col">Name</th>
     </tr>
   </thead>
   <tbody>
      @foreach ($tests as $item)
      <tr>
         <td>{{$item['id']}}</td>
         <td>{{$item['test_name']}}</td>
       </tr>       
      @endforeach

   </tbody>
 </table>
@endsection