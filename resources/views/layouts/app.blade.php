<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

    <script>
        $(function() {
            $('.datepicker').datepicker({
                format: "yyyy-mm-dd",

            });
        });
    </script>
    <style>
        .datepicker {
            cursor: pointer;
        }
    </style>
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark shadow-sm bg-dark">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->

                        <li class="nav-item">
                            <a class="nav-link active" href="{{ route('home') }}">Home</a>
                        </li>

                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            <div class="container">
                @yield('content')
        </main>
    </div>
    </div>
</body>


<script>
    $(document).ready(function() {
        var currentAudio = null;

        function playAudio(audioId, playPauseButton) {
            if (currentAudio !== null && currentAudio !== audioId) {
                var currentAudioPlayer = document.getElementById('audioPlayer-' + currentAudio);
                currentAudioPlayer.pause();
                $('#playPauseButton-' + currentAudio).html('<i class="bi bi-play-fill"></i>');
            }

            var audioPlayer = document.getElementById('audioPlayer-' + audioId);

            if (audioPlayer.paused) {
                audioPlayer.play();
                audioPlayer.currentTime = 0;
                playPauseButton.html('<i class="bi bi-stop-fill"></i>');
                currentAudio = audioId;
            } else {
                audioPlayer.pause();
                playPauseButton.html('<i class="bi bi-play-fill"></i>');
                currentAudio = null;
            }
        }

        $('.playPauseButton').on('click', function() {
            var audioId = $(this).data('audio-control');
            var playPauseButton = $('#playPauseButton-' + audioId);

            playAudio(audioId, playPauseButton);
        });

        $('audio').on('ended', function() {
            var audioId = $(this).attr('id').replace('audioPlayer-', '');
            $('#playPauseButton-' + audioId).html('<i class="bi bi-play-fill"></i>');
            currentAudio = null;
        });
    });
</script>

</html>
