@extends('layouts.app')
 
@section('content')
    <div class="user-dashboard">
        <div class="table-wrapper">
            <div class="table-title">
            
            </div class="row">
            <div class="col-md-6 col-sm-6">
                <a class="btn btn-success" href="{{ route('hospitals.create') }}"> Create New Hospital</a>
            </div>
        </div>
    </div>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
   
    <table class="table table-striped table-hover" >
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>URL</th>
            <th width="280px">logo</th>
            <th>created_at</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($hospitals as $hospital)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $hospital->hospital_name }}</td>
            <td>{{ $hospital->hospital_url }}</td>
            <td class="logo" width="280px" >
                            <img  style="max-height:100px; max-width:100%" src="{{$hospital->photo_full_path}}" alt="">
                        </td>
                        <td>{{$hospital->created_at->diffForHumans()}}</td>
            <td>
                <form action="{{ route('hospitals.destroy',$hospital->id) }}" method="POST">
   
                   
                    <a class="btn btn-primary" href="{{ route('hospitals.edit',$hospital->id) }}">Edit</a>
   
                    @csrf
                    @method('DELETE')
      
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
  
    {!! $hospitals->links() !!}
    
@endsection