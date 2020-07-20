@extends('layouts.header')
@section('title', 'followings')
    
@section('content')
    @if (count($errors) > 0)
        <ul>
            @foreach($errors->all() as $e)
                <li>{{ $e }}</li>
            @endforeach
        </ul>
    @endif
    @foreach($following_users as $following_user)
        <div class="card">
            <div class="card-haeder p-3 w-100 d-flex">
                <img src="{{ $following_user->user_icon_image }}" class="rounded-circle" width="50" height="50">
                <div class="ml-2 d-flex flex-column">
                    <a href="{{ action('User\PagesController@show', ['id' => $following_user->id] )}}" class="text-secondary">{{ $following_user->id }}</a>
                    <p class="mb-0">{{ $following_user->name }}</p>
                </div>
                @if (Auth::user()->is_following($following_user->id))
                    <div class="px-2">
                        <span class="px-1 bg-secondary text-light">フォローされています</span>
                    </div>
                @endif
                <div class="d-flex justify-content-end flex-grow-1">
                    @if (Auth::user()->is_following($following_user->id))
                        <form action="{{ route('unfollow', ['id' => $following_user->id]) }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}

                            <button type="submit" class="btn btn-danger">フォロー解除</button>
                        </form>
                    @else
                        <form action="{{ route('follow', ['id' => $following_user->id]) }}" method="POST">
                            {{ csrf_field() }}

                            <button type="submit" class="btn btn-primary">フォローする</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    @endforeach
    
@endsection