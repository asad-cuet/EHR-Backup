@extends('layout.lay')

@section('title','Tests')
@section('content')


<div style="overflow-x:auto;">
<table class="table">
   <thead>
     <tr>
       <th scope="col">ID</th>
       <th scope="col">Name</th>
     </tr>
   </thead>
   <tbody>
      @foreach ($departments as $item)
      <tr>
         <td>{{$item['id']}}</td>
         <td>{{$item['name']}}</td>
       </tr>       
      @endforeach

   </tbody>
 </table>
</div>
@endsection