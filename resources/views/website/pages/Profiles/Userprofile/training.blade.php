@extends('website.layouts.master')

@section('title', 'Gym Videos')

@section('main-content')
<style>
    .card {
        border-radius: 10px;
        overflow: hidden;
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .card:hover {
        transform: scale(1.05);
        box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.2);
    }

    .video-player {
        width: 100%;
        height: 250px; /* حدد ارتفاعًا ثابتًا */
        border-bottom: 5px solid #f7f7f7;
        border-radius: 10px 10px 0 0;
        object-fit: cover; /* للحفاظ على نسبة العرض إلى الارتفاع */
    }

    .back-button {
        margin: 20px 0;
        background: transparent;
        color: black;
        border: none;
        font-size: 24px;
        cursor: pointer;
        transition: color 0.3s;
    }

    .back-button:hover {
        color: rgb(31, 197, 31);
    }

    .back-button i {
        font-size: 28px;
    }

    .watched {
        background-color: #d4edda !important;
        border: 1px solid #c3e6cb !important;
    }

    .watched .card-title::after {
        color: #155724;
        font-size: 14px;
        margin-left: 5px;
    }
</style>

<div class="container my-5">
    <!-- زر العودة مع Font Awesome -->
    <button class="back-button" onclick="history.back()">
        <i class="fas fa-arrow-left"></i> Back
    </button>

    <h1 class="text-center mb-4">Gym Videos Training</h1>
    <div class="row">
        @php
            $videos = [
                'assets/videos/4761426-uhd_4096_2160_25fps.mp4',
                'assets/videos/3195943-uhd_3840_2160_25fps.mp4',
                'assets/videos/18941351-hd_1080_1920_50fps.mp4',
                'assets/videos/5320011-uhd_2160_3840_25fps.mp4'
            ];
        @endphp

        @foreach($videos as $index => $video)
        <div class="col-md-6 mb-4">
            <div class="card shadow" id="card-{{ $index }}">
                <video 
                    class="video-player w-100" 
                    data-video-id="{{ $index }}" 
                    controls 
                    preload="metadata" 
                    data-updated="false">
                    <source src="{{ asset($video) }}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
                <div class="card-body text-center">
                    <h5 class="card-title">Video {{ $index + 1 }}</h5>
                    <p class="card-text">Get stronger with this workout video! Keep going and earn rewards!</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<script>
    document.querySelectorAll('.video-player').forEach(video => {
        video.addEventListener('timeupdate', function () {
            const watchedPercentage = (this.currentTime / this.duration) * 100;
    
            if (watchedPercentage >= 100 && this.dataset.updated === "false") {
                this.dataset.updated = "true";
    
                const videoId = this.getAttribute('data-video-id');
                const card = document.getElementById(`card-${videoId}`);
                const userId = "{{ auth()->user()->id }}";
    
                card.classList.add('watched');
    
                // تحديث التقدم في السيرفر
                fetch(`/user-profile/update-progress/${userId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        videos_watched: 1
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Progress updated successfully!');
                    }
                });
            }
        });
    });
    </script>

@endsection
