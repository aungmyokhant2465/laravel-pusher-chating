@extends('layouts.app')

@section('title')
    Home
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    <div class="card-title">Users</div>
                    <ul style="list-style-type: none">
                        <div class="list-group">
                            @foreach ($users as $user)
                                <div class="list-group-item list-group-item-action">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-10 col-sm-10">
                                                <a href="#" style="text-decoration: none">
                                                    <img src="{{URL::to('images/boy.png')}}" width="30" height="30" class="img rounded-circle d-inline-block align-top" alt="N" loading="lazy">
                                                    <span class="ml-3">{{$user->name}}</span>
                                                </a>
                                            </div>
                                            <div class="col-2 col-sm-2">
                                                <form action="{{route('get.friends.request')}}">
                                                    @csrf
                                                    <input type="hidden" name="from" value="{{Auth::id()}}">
                                                    <input type="hidden" name="to" value="{{$user->id}}">
                                                    <button type="submit" class="btn btn-outline-primary">
                                                        @if($done == $user->id)
                                                            <i class="fas fa-check-square"></i>
                                                        @else
                                                            <i class="fa fa-user-plus"></i>
                                                        @endif
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
