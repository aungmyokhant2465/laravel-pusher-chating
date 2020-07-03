@extends('layouts.app')

@section('title')
    Friends
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Friends</div>
                <div class="card-body">
                    <div class="row mb-5">
                        <div class="card-title">Friend Request</div>
                        <div class="col-12">
                            <div class="list-group">
                                @foreach ($requests as $friend)
                                    <div class="list-group-item list-group-item-action">
                                        <div class="row">
                                            <div class="col-10">
                                                <a href="#" style="text-decoration: none">
                                                    <img src="{{URL::to('images/boy.png')}}" width="30" height="30" class="img rounded-circle d-inline-block align-top" alt="N" loading="lazy">
                                                    <span class="ml-3">{{$friend->User->name}}</span>
                                                </a>
                                            </div>
                                            <div class="col-2">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <a href="{{route('get.friends.confirm',['friend_id'=>$friend->friend_id])}}" class="btn btn-outline-primary"><i class="fas fa-user-check"></i></a>
                                                    </div>
                                                    <div class="col-6">
                                                        <a href="{{route('get.friends.reject',['friend_id'=>$friend->friend_id])}}" class="btn btn-outline-danger"><i class="fas fa-user-times"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="card-title">Your Friends</div>
                        <div class="col-12">
                            <div class="list-group">
                                @foreach ($friends as $friend)
                                    <a href="#" class="list-group-item list-group-item-action">
                                        <div class="row">
                                            <div class="col-10">
                                                <img src="{{URL::to('images/boy.png')}}" width="30" height="30" class="img rounded-circle d-inline-block align-top" alt="N" loading="lazy">
                                                <span class="ml-3">{{$friend->User->name}}</span>
                                            </div>
                                            <div class="col-2">
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <ul style="list-style-type: none">
                        <div class="list-group">
                            
                        </div>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
