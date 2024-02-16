<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="user-management"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Add New Candidate"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row justify-content-center">
                <div class="col-lg-12 ">
                    <div class="card my-4">
                        <div class="card-body">
                            <form method="POST" action="{{ route('candidates.store') }}" enctype="multipart/form-data">
                                <div class="row">
                                    @csrf
                                    <div class="col-md-6 mb-3">
                                        <label for="photo" class="form-label">Photo</label>
                                        <input type="file" class="form-control bg-gray-200" id="photo" name="photo" required>
                                        @error('photo')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="fullname" class="form-label">Full Name</label>
                                        <input type="text" class="form-control bg-gray-200" id="full_name" name="name" required>
                                        @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="regno" class="form-label">Reg No</label>
                                        <input type="text" class="form-control bg-gray-200" id="student_id" name="student_id" required>
                                        @error('student_id')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="course" class="form-label">Course</label>
                                        <input type="text " class="form-control bg-gray-200" id="course" name="course" required>
                                        @error('course')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror 
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="position" class="form-label">Position</label>
                                        <select class="form-select bg-gray-200" name="position_id" id="position_id">
                                            <option value="">Select Position</option>
                                            @foreach ($positions as $position)
                                            <option value="{{ $position->id }}">{{ $position->title }}</option>
                                            @endforeach
                                        </select>
                                        @error('position_id')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="party" class="form-label">Party</label>
                                        <select class="form-select bg-gray-200" name="party_id" id="party_id">
                                            <option value="">Select Party</option>
                                            @foreach ($parties as $party)
                                            <option value="{{ $party->id }}">{{ $party->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('party_id')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
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
                                    <div class="col-md-6 mb-3">
                                        <label for="manifesto" class="form-label">Manifesto</label>
                                        <textarea class="form-control bg-gray-200" id="manifesto" name="manifesto" rows="3"></textarea>
                                        @error('manifesto')
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
                                <button type="submit" class="btn btn-primary">Add Candidate</button>
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
