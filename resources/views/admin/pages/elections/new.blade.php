<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="Elections"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Elections"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row justify-content-center">
                <div class="col-lg-12 ">
                    <div class="card my-4">
                        <div class="card-body">
                            <form method="POST" action="{{ route('elections.store') }}" enctype="multipart/form-data">
                                <div class="row">
                                    @csrf
                                    <div class="col-md-6 mb-3">
                                        <label for="election_title" class="form-label">Election Title</label>
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
                                        <label for="election_title" class="form-label">Start</label>
                                        <input type="datetime-local" class="form-control bg-gray-200" id="start" name="start" required>
                                        @error('start')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="end" class="form-label">End</label>
                                        <input type="datetime-local" class="form-control bg-gray-200" id="end" name="end" required>
                                        @error('end')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">New Election</button>
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
