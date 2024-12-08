@extends('layouts.app')

@section('content')
    <div class="container" style="background-color: #ffe4e1; padding: 20px; border-radius: 10px;">
        <div class="row">
            @if($user->info->profile_picture == null)
                <div class="col-8 offset-2 text-center" id="no_picture">
                    <h1 style="color: #ff69b4; font-family: 'Comic Sans MS', cursive, sans-serif; font-size: 28px;">
                        Please complete your profile by adding a profile picture!
                    </h1>
                </div>
            @elseif($pictures == null)
                <div class="col-8 offset-2 text-center" id="no_picture">
                    <h1 style="color: #ff69b4; font-family: 'Comic Sans MS', cursive, sans-serif; font-size: 36px; text-shadow: 2px 2px #ffb6c1;">
                        There is nobody to show 😔
                    </h1>
                    <br>
                    <h2 style="color: #ff69b4; font-family: 'Arial', sans-serif; font-size: 24px; text-shadow: 1px 1px #ffb6c1;">
                        Try adjusting your search settings.
                    </h2>
                </div>
            @else
                <div class="row justify-content-center">
                    <div class="col-6 text-right">
                        @if(count($pictures) == 0)
                            <img class="d-block w-100" src="{{ $otherUser->info->getPicture() }}" alt="First slide">
                        @else
                            <div id="carousel" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img class="d-block w-100" src="{{ $otherUser->info->getPicture() }}"
                                             alt="Profile picture of the user">
                                    </div>
                                    @foreach($pictures as $picture)
                                        <div class="carousel-item">
                                            <img class="d-block w-100" src="{{ $picture->getPicture() }}"
                                                 alt="Picture of the user">
                                        </div>
                                    @endforeach
                                </div>
                                <a class="carousel-control-prev" href="#carousel" role="button"
                                   data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carousel" role="button"
                                   data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                        @endif
                    </div>
                    <div class="col-6">
                        <h2 style="color: #ff69b4;">{{ $otherUser->info->name . ' ' . $otherUser->info->surname . ', ' . $otherUser->info->age }}</h2>
                        <br>
                        <div class="row">
                            <div class="col-4">
                                <h5 style="color: #ff69b4;">Country: {{ $otherUser->info->country }}</h5>
                            </div>
                            <div class="col-4">
                                <h5 style="color: #ff69b4;">Languages: {{ $otherUser->info->languages }}</h5>
                            </div>
                            <div class="col-4">
                                <h5 style="color: #ff69b4;">Relationship status: {{ $otherUser->info->relationship }}</h5>
                            </div>
                        </div>
                        <br>
                        <h3 style="color: #ff69b4;">Bio:</h3>
                        <p id="description" style="color: #ff69b4;">{{ $otherUser->info->description}}</p>
                        <div class="row reaction">
                            <div class="col-4">
                                <form action="{{ route('like', $otherUser->id) }}" method="post">
                                    @csrf
                                    <button class="btn" type="submit" style="background-color: #ff69b4; border: none; border-radius: 50%; width: 100px; height: 100px; box-shadow: 0 4px 6px rgba(0,0,0,0.2);">
                                        <img
                                            src="{{ $likeEmoji }}"
                                            alt="Like button picture"
                                            id="like_button">
                                    </button>
                                </form>
                            </div>

                            <div class="col-4 offset-4">
                                <form action="{{ route('dislike', $otherUser->id) }}" method="post">
                                    @csrf
                                    <button class="btn" type="submit" style="background-color: #ff69b4; border: none; border-radius: 50%; width: 100px; height: 100px; box-shadow: 0 4px 6px rgba(0,0,0,0.2);">
                                        <img
                                            src="{{ $dislikeEmoji }}"
                                            alt="Dislike button picture"
                                            id="dislike_button">
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
<style>
    body {
        background-color: #ffe4e1;
    }

    #no_picture {
        padding-top: 30px;
    }

    .col-6.text-right img {
        width: 100%;
        height: auto; /* Maintain aspect ratio */
        max-width: 400px; /* Limit the maximum width */
        max-height: 400px; /* Limit the maximum height */
        border-radius: 10px;
        object-fit: cover; /* Ensure consistent sizing by cropping edges if necessary */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2), 0 6px 20px rgba(0, 0, 0, 0.19);
    }

    .carousel-inner img {
        width: 100%;
        height: auto; /* Maintain aspect ratio */
        max-width: 400px; /* Limit the maximum width */
        max-height: 400px; /* Limit the maximum height */
        object-fit: cover; /* Consistent fit within the carousel */
        border-radius: 10px;
    }

    #description {
        font-size: 18px;
    }

    #like_button, #dislike_button {
        width: 100%;
    }

    .btn:hover {
        transform: scale(1.1);
        transition: 0.3s ease-in-out;
    }
</style>
