<x-layout bodyClass="g-sidenav-show bg-gray-200">

    <x-navbars.sidebar activePage="user-management"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Add New Candidate"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card my-4">
                        <div class="card-body">
                            <form method="POST" action="{{ route('candidates.store') }}">
                                @csrf
                                <div class="mb-3">
                                    <label for="photo" class="form-label">Photo</label>
                                    <input type="file" class="form-control" id="photo" name="photo" required>
                                    @error('photo')
                                          <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="fullname" class="form-label">Full Name</label>
                                    <input type="text" class="form-control" id="full_name" name="name" required>
                                    @error('name')
                                          <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="course" class="form-label">Course</label>
                                    <input type="text" class="form-control" id="course" name="course" required>
                                    @error('Course')
                                          <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="position" class="form-label">Position</label>
                                    <input type="text" class="form-control" id="position" name="position" required>
                                    @error('Course')
                                          <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="party" class="form-label">Party</label>
                                    <input type="text" class="form-control" id="party" name="party" required>
                                    @error('Course')
                                          <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="Election" class="form-label">Election</label>
                                    <select class="form-select" id="election_id" name="election_id" required>
                                        <option value="">Select Election</option>
                                        @foreach($elections as $election)
                                            <option value="{{ $election->id }}">{{ $election->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('Election')
                                          <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="created_at" class="form-label">Created at</label>
                                    <input type="created_at" class="form-control" id="created_at" name="created_at" required>
                                    @error('Password')
                                          <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">Add Candidate</button>
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
