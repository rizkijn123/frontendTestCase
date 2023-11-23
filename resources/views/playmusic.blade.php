@extends('layouts.app')
@section('content')
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addNew">
        Add New
    </button>
    @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if ($allmusic->status == 'error')
        <div class="alert alert-danger mt-3" role="alert">

            Tidak ada data music

        </div>
    @else
        <div class="table-responsive pt-2">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Package Name</th>
                        <th scope="col">Artist Name</th>
                        <th scope="col">Date Release</th>
                        <th scope="col">Audio</th>
                        <th scope="col">Price</th>
                        <th scope="col"></th>

                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($allmusic->data as $music)
                        <tr>
                            <th scope="row">{{ $no++ }}</th>
                            <td><img src="{{ $music->imageurl }}" alt="" height="100px" width="100px">
                                {{ $music->artistname }}</td>
                            <td>{{ $music->packagename }}</td>
                            <td>{{ \Carbon\Carbon::parse($music->releasedate)->format('d M Y') }}
                            </td>
                            <td>
                                <div class=" mt-5">
                                    <audio id="audioPlayer-{{ $no }}" loop>
                                        <source src="{{ $music->sampleurl }}" type="audio/mp3">
                                    </audio>
                                    <button class="playPauseButton btn btn-primary" id="playPauseButton-{{ $no }}"
                                        data-audio-control="{{ $no }}"><i class="bi bi-play-fill"></i></button>
                                </div>
                            </td>
                            <td>{{ $music->price }}</td>
                            <td>
                                <div class="mb-3 mt-4">
                                    <button type="submit" class="btn btn-primary" id="editmusic"
                                        data-music-id="{{ $music->id }}">edit</button>
                                </div>
                                <div class="mb-3">
                                    <form action="/delete/{{ $music->id }}" method="POST">@csrf<input type="hidden"
                                            class="form-control" id="id" name="id"><button type="submit"
                                            class="btn btn-danger">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach


                </tbody>
            </table>
        </div>
    @endif
    <!-- Modal -->
    <div class="modal fade" id="addNew" tabindex="-1" aria-labelledby="addNew" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addNew">Add New Music</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('addMusic') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="artistname" class="form-label">Artist Name</label>
                            <input type="text" class="form-control" id="artistname" name="artistname">
                        </div>
                        <div class="mb-3">
                            <label for="packagename" class="form-label">Package Name</label>
                            <input type="text" class="form-control" id="packagename" name="packagename">
                        </div>
                        <div class="mb-3">
                            <label for="imageurl" class="form-label">Image Url</label>
                            <input type="text" class="form-control" id="imageurl" name="imageurl">
                        </div>
                        <div class="mb-3">
                            <label for="date">Date Release</label>
                            <div class="input-group date datepicker">
                                <input type="text" class="form-control" id="date" name="releasedate" />
                                <span class="input-group-append">
                                    <span class="input-group-text bg-light d-block">
                                        <i class="bi bi-calendar-week-fill"></i>
                                    </span>
                                </span>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="sampleurl" class="form-label">Audio Url</label>
                            <input type="text" class="form-control" id="sampleurl" name="sampleurl">
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Price</label>
                            <input type="text" class="form-control" id="price" name="price">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add Music</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- edit modal --}}
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Music</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editForm" action="{{ route('edit') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="artistname" class="form-label">Artist Name</label>
                            <input type="text" class="form-control" id="artistname2" name="artistname">
                        </div>
                        <div class="mb-3">
                            <label for="packagename" class="form-label">Package Name</label>
                            <input type="text" class="form-control" id="packagename2" name="packagename">
                        </div>
                        <div class="mb-3">
                            <label for="imageurl" class="form-label">Image Url</label>
                            <input type="text" class="form-control" id="imageurl2" name="imageurl">
                        </div>
                        <div class="mb-3">
                            <label for="date">Date Release</label>
                            <div class="input-group date datepicker">
                                <input type="text" class="form-control" id="date2" name="releasedate" />
                                <span class="input-group-append">
                                    <span class="input-group-text bg-light d-block">
                                        <i class="bi bi-calendar-week-fill"></i>
                                    </span>
                                </span>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="sampleurl" class="form-label">Audio Url</label>
                            <input type="text" class="form-control" id="sampleurl2" name="sampleurl">
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Price</label>
                            <input type="text" class="form-control" id="price2" name="price">
                        </div>
                        <input type="hidden" class="form-control" id="id2" name="id">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Edit Music</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            function fetchData(id) {

            }
            $(document).on('click', '#editmusic', function() {
                var musicId = $(this).data('music-id');
                $('#editModal').modal('show');
                $.ajax({
                    type: 'GET',
                    url: 'http://localhost:3000/api/v1/music/' + musicId,
                    success: function(response) {
                        // Mengisikan data ke dalam modal
                        $('#id2').val(response.data[0].id);
                        $('#artistname2').val(response.data[0].artistname);
                        $('#packagename2').val(response.data[0].packagename);
                        $('#imageurl2').val(response.data[0].imageurl);
                        $('#date2').val(response.data[0].releasedate);
                        $('#sampleurl2').val(response.data[0].sampleurl);
                        $('#price2').val(response.data[0].price);

                    },

                    error: function(error) {
                        console.log('Error:', error);
                    }
                });
            });
        });
    </script>
@endsection
