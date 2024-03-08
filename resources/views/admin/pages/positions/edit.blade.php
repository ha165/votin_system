<x-layout bodyClass="g-sidenav-show bg-gray-200">

    <x-navbars.sidebar activePage="Positions"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Positions"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-body px-0 pb-2">
                            <form method="POST" action="{{ route('positions.update', $positions->id) }}" enctype="multipart/form-data">
                                <div class="row">
                                @csrf
                                @method('PUT')
                                <div class=" col-md-6 mb-3">
                                    <label for="name" class="form-label">Title</label>
                                    <input type="text" class="form-control bg-gray-200" id="name" name="title" value="{{ $positions->title }}">
                                </div>
                                <div class=" col-md-6 mb-3">
                                    <label for="student_id" class="form-label">Description</label>
                                    <textarea class="form-control bg-gray-200" id="description" name="description" rows="3"  >{{$positions->description}}</textarea>
                                </div>
                                <div class="col-md-6 mb-3">
                                        <label for="election" class="form-label">Election</label>
                                        <select class="form-select bg-gray-200" id="election_id" name="election_id" required>
                                            <option value="">Select Election</option>
                                            @foreach($elections as $election)
                                            <option value="{{ $election->id }}">{{ $election->title }}</option>
                                            @endforeach
                                        </select>
                                        @error('election_id')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                <button type="submit" class="btn btn-primary">Update Party</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <x-footers.auth></x-footers.auth>
        </div>
    </main>
    <x-plugins></x-plugins>

</x-layout>
