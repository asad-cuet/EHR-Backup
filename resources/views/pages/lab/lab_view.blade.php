@extends('layout.lay')

@section('title','Lab View')
@section('css')
label {
      cursor: pointer;
      /* Style as you please, it will become the visible UI component. */
   }
   
   #upload-photo {
      opacity: 0;
      position: absolute;
      z-index: -1;
   }
@endsection
@section('content')

<div class="row">
      <div class="col">
            <ul class="list-group">
                  
                  <li class="list-group-item active" aria-current="true">Patient Details</li>  
                  <li class="list-group-item" aria-current="true">Name: {{$lab->patient->name}}</li>  
                  <li class="list-group-item" aria-current="true">Gender: {{$lab->patient->gender}}</li>  
                  <li class="list-group-item" aria-current="true">Age: {{$lab->patient->age}}</li>  
                  <li class="list-group-item" aria-current="true">Height: {{$lab->patient->height}} Fit</li>  
                  <li class="list-group-item" aria-current="true">Weight: {{$lab->patient->weight}} Kg</li>  
                  <li class="list-group-item" aria-current="true">Phone: {{$lab->patient->phone}}</li>  
                  <li class="list-group-item" aria-current="true">Guardian Phone: {{$lab->patient->guardian_phone}}</li>  
            </ul>
      </div>
      <div class="col">
            <form action="{{url('/submit-report/'.$lab->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            <ul class="list-group">
                  <li class="list-group-item bg-danger text-white" aria-current="true">Exam</li>
                  @for($i=0;$i<count($unique_test_id);$i++)
                  <li class="list-group-item">
                        <b>{{$unique_test_name[$i]}}</b>
                        {{-- <div class="badge bg-success">Submit Another</div> --}}
                        <div class="">
                              
                              <input type="file" name="image[]">
                              <input type="hidden" name="test_id[]" value="{{$unique_test_id[$i]}}">                              
                        </div>
                  </li>
                  @endfor
                  <li class="list-group-item text-center" aria-current="true">
                  <button type="submit" class="btn btn-dark">Submit Report</button>      
                  </li>    
            </ul>
            </form>
      </div>
</div>

<br>
<div class="row">
      <div class="col">
            <ul class="list-group">
                  
                  <li class="list-group-item bg-dark text-white" aria-current="true">Submitted Test</li> 
                  @foreach ($test as $item)
                        <li class="list-group-item" aria-current="true">
                        <div class="row">
                              <div class="col">
                                    <b>{{$item->test->test_name}}</b>
                                    @if($item->report!=0)
                                          <a href="{{asset('assets/report/'.$item->report)}}" class="btn btn-info badge" target="_blank">view</a>
                                          @if(!$item->is_resent)
                                                <a href="{{url('/lab-delete/'.$item->id.'/'.$item->consultation_id.'/'.$item->test_id)}}" onclick="return confirm('Are you sure? You want to delete?')" class="btn btn-danger badge">delete</a>
                                          @endif
                                          @if($item->is_resent)
                                                <span class="badge bg-primary">Re-Sent (Update this report)</span>
                                          @endif
                                          @if($item->comment)
                                                <div class="mt-3">
                                                      <h6>Comment from Laboratory:</h6> {{$item->comment}}
                                                </div>
                                          @endif
                                          <div class="mt-3">
                                                <form action="{{url('/lab-comment/'.$item->id)}}" method="POST">
                                                      @csrf
                                                      <input type="text" name="comment" placeholder="Write a comment if any">
                                                      <button type="submit" class="btn btn-warning badge">@if($item->comment)Update Comment @else Comment @endif</button>
                                                </form>
                                          </div>
                                    @else
                                          <div class="badge bg-danger">Didn't Submitted Yet</div>
                                    @endif
                              </div>
                              <div class="col">
                                    @if($item->report!=0)
                                          <b>Update Report</b>
                                          <div class="mt-2">
                                                <form action="{{url('/lab-update/'.$item->id)}}" method="POST" enctype="multipart/form-data">
                                                      @csrf
                                                      <input type="file" name="updated_report" style="font-size:14px"/>
                                                      <button type="submit" class="btn btn-dark badge">Update</button>
                                                </form>
                                          </div>
                                          

                                    @endif
                              </div>
                              
                        </div>          
                        </li>                     
                  @endforeach 

            </ul>
      </div>
</div>
<br>
<div class="row">
      <div class="col ">
            <a href="{{url('lab-clear/'.$lab->id)}}" class="btn btn-primary" onclick="return confirm('Are yo sure?')">Send Back to Consultation</a>
      </div>
</div>
<br>
<br>
<br>
<br>

@endsection