@extends('layouts.app')

@section('content')
<div class="container">
    <div class="text-center upload">
        <form action="{{ route('pictures.add') }}" enctype="multipart/form-data" method="post">
            @csrf
            <input id="custom" type="file" name="picture[]" onchange="this.form.submit()" required="" multiple>
            <label class="btn">
                Add Photos
                <input type="file" name="picture[]" onchange="this.form.submit()" multiple>
            </label>
        </form>
    </div>

    @if(count($pictures) == 0)
        <div class="text-center empty">
            <h2>Nothing to show here yet...</h2>
        </div>
    @else
        <div class="row">
            @foreach($pictures as $picture)
                <div class="col-md-4">
                    <div class="picture-card">
                        <div class="picture">
                            <img src="{{ $picture->getPicture() }}" alt="User Image">
                            <form action="{{ route('pictures.destroy', $picture->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <button class="delete-btn" type="submit">X</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection

<style>
/* General Styling */
body {
    background-color: #f9f9f9;
    font-family: 'Nunito', sans-serif;
}

/* Upload Section */
.text-center.upload input {
    display: none;
}

.text-center.upload {
    font-weight: bold;
    text-decoration: underline;
    margin-bottom: 20px;
}

.text-center .btn {
    color: white;
    background-color: #ff69b4;
    border: none;
    padding: 10px 25px;
    border-radius: 8px;
    font-size: 18px;
    font-weight: bold;
    transition: all 0.3s ease;
    margin-top: 20px;
}

.text-center .btn:hover {
    background-color: #ff85c0;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
}

/* Empty State */
.empty {
    margin-top: 30%;
    color: #777;
    font-weight: bold;
}

/* Picture Card Styling */
.picture-card {
    margin-bottom: 30px;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    background-color: white;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.picture-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
}

/* Picture Styling */
.picture {
    position: relative;
    width: 100%;
    height: 0;
    padding-bottom: 75%; /* Aspect ratio 4:3 */
}

.picture img {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 10px;
}

/* Delete Button Styling */
.delete-btn {
    position: absolute;
    top: 10px;
    right: 10px;
    background-color: rgba(255, 69, 58, 0.8);
    border: none;
    color: white;
    padding: 5px 10px;
    font-size: 12px;
    font-weight: bold;
    border-radius: 50%;
    cursor: pointer;
    opacity: 0;
    transition: opacity 0.3s ease, transform 0.3s ease;
}

.picture-card:hover .delete-btn {
    opacity: 1;
    transform: scale(1.1);
}

.delete-btn:hover {
    background-color: rgba(255, 69, 58, 1);
}
</style>
