@extends('layouts.app')

@section('title')
    Chat Box
@endsection

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        {{-- <div class="col-md-10">
            <div class="card">
                <div class="card-header">Chat Box</div>
                <div class="card-body">
                    
                </div>
            </div>
        </div> --}}
        <div class="col-md-10 col-sm-12">
            <div class="row">
                <div class="col-md-4 col-sm-12 pl-0 pr-0" id="friend-list" style="border-right: 1px gray solid;">
                    <friends-list :friends="friends" :activeFriends="activeFriends"></friends-list>
                </div>
                <div class="col-md-8 col-sm-12 pl-0 pr-0">
                    <router-view id="chat_body" onmouseover="hide_friends()" :key="$route.fullPath" :user="{{ Auth::user() }}"></router-view>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
    document.getElementById('main').style.height = window.innerHeight+'px';
    document.getElementById('chat_body').style.height = (window.innerHeight - (window.innerHeight* (10/100)))+'px';
    if(window.innerWidth < 768) {
        document.getElementById('friend-list').style.display = 'none';
    }
    function show_friends() {
        if(window.innerWidth < 768) {
            document.getElementById('friend-list').style.display = 'block';
        }
    }
    function hide_friends() {
        if(window.innerWidth < 768) {
            document.getElementById('friend-list').style.display = 'none';
        }
    }
</script>
@endpush
