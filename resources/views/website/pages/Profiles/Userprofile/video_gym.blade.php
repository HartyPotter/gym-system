@extends('website.layouts.master')

@section('title', 'Gym Videos')

@section('main-content')
<style>
    body {
        background: linear-gradient(to right, #0b3d2e, #1a5e46);
        color: white;
        font-family: Arial, sans-serif;
    }
    .container {
        max-width: 1200px;
        margin: auto;
        text-align: center;
        padding: 20px;
    }
    .video-grid {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 20px;
        padding: 20px 0;
    }
    .video-card {
        background:white;
        color: black;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        padding: 20px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        width: 300px;
    }
    .video-card:hover {
        transform: scale(1.05);
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.5);
    }
    video {
        width: 100%;
        height: 200px;
        border-radius: 8px;
    }
    .btn-watch {
        background-color: #2ecc71;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        transition: background 0.3s ease;
        margin-top: 10px;
        disabled: true;
    }
    .btn-watch:hover {
        background-color: #27ae60;
    }
    .btn-back {
        margin-top: 20px;
        background-color: #2ecc71;
        color: white;
        padding: 12px 25px;
        border-radius: 5px;
        text-decoration: none;
        display: inline-block;
        transition: background 0.3s ease;
    }
    .btn-back:hover {
        background-color: #117864;
    }
    h2 {
        font-size: 28px;
        margin-bottom: 20px;
        text-transform: uppercase;
    }
</style>

<div class="container">
    <h2>Choose a Video to Watch</h2>
    <div class="video-grid">
        @foreach($videos as $video)
            <div class="video-card">
                <h4>{{ $video['title'] }}</h4>
                <video controls>
                    <source src="{{ $video['url'] }}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
                <form action="{{ route('video.watched', $video['id']) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-watch" disabled>Watched</button>
                </form>
            </div>
        @endforeach
    </div>
    <a href="{{ route('profileuser.show', ['username' => auth()->user()->username]) }}" class="btn-back">Back to Profile</a>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const videos = document.querySelectorAll("video");

        videos.forEach((video) => {
            const form = video.nextElementSibling;
            const button = form.querySelector(".btn-watch");

            
            const warningMessage = document.createElement("p");
            warningMessage.textContent = "⚠️ You must watch the video completely before marking it as watched!";
            warningMessage.style.color = "red";
            warningMessage.style.fontSize = "14px";
            warningMessage.style.marginTop = "8px";
            warningMessage.style.fontWeight = "bold";
            warningMessage.style.textAlign = "center";
            warningMessage.style.display = 'none';
            form.appendChild(warningMessage);
            button.disabled = true; 

           
            video.addEventListener("ended", function () {
                button.disabled = false;
                warningMessage.style.display = "none";
                console.log("✅ Video watched completely, button enabled.");
            });

            button.addEventListener("click", function (event) {
                if (button.disabled) {
                    event.preventDefault();
                    warningMessage.style.display = "block"; 
                    console.log("❌ You must watch the video completely before submitting.");
                }
            });
        });
    });
</script>
@endsection