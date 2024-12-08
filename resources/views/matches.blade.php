@extends('layouts.app')

@section('content')
    <div class="container" style="background-color: #ffe4e1; padding: 20px; border-radius: 10px;">
        @if(count($users) == 0)
            <div class="text-center empty">
                <h2 style="color: #ff69b4; font-family: 'Comic Sans MS', cursive, sans-serif; text-shadow: 2px 2px #ffb6c1;">
                    Nothing to show here yet...
                </h2>
            </div>
        @else
            <div class="row">
                @foreach($users as $otherUser)
                    <div class="card" style="background-color: #fff0f5; border-radius: 10px;">
                        <div class="row justify-content-center">
                            <div class="col-6 text-right">
                                <img src="{{ $otherUser->info->getPicture() }}"
                                     alt="Image of the person"
                                     id="profile_picture"
                                >
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
                                <p style="color: #ff69b4;">e-mail: {{ $otherUser->email }}</p>
                                <p style="color: #ff69b4;">phone number: {{ $otherUser->info->phone }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection

<style>
    body {
        background-color: #ffe4e1;
    }

    .empty {
        margin-top: 30%;
    }

    .card {
        padding: 20px;
        margin: 20px;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }

    #profile_picture {
        width: 100%;
        max-height: 100%;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2), 0 6px 20px rgba(0, 0, 0, 0.19);
    }

    #description {
        font-size: 18px;
    }
</style>
