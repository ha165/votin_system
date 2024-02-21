<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="position"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Position"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row justify-content-center">
                <div class="col-lg-12 ">
                    <div class="card my-4">
                        <div class="card-body">
                            <form method="POST" action="{{ route('positions.store') }}" enctype="multipart/form-data">
                                <div class="row">
                                    @csrf
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
                                    <div class="col-md-6 mb-3">
                                        <label for="fullname" class="form-label">Title</label>
                                        <input type="text" class="form-control bg-gray-200" id="title" name="title" required>
                                        @error('title')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="regno" class="form-label">Description</label>
                                        <textarea class="form-control bg-gray-200" id="description" name="description" rows="3"></textarea>
                                        @error('description')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="created_at" class="form-label">Created at</label>
                                        <input type="date" class="form-control bg-gray-200" id="created_at" name="created_at" required>
                                        @error('created_at')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">New Party</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <x-footers.auth></x-footers.auth>
    </main>
    <x-plugins></x-plugins>
</x-layout>
