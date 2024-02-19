<x-layout bodyClass="g-sidenav-show bg-gray-200">

    <x-navbars.sidebar activePage="user-management"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Edit Candidate"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-body px-0 pb-2">
                            <form method="POST" action="{{ route('candidates.update', $candidate->id) }}">
                                <div class="row">
                                @csrf
                                @method('PUT')
                                <div class=" col-md-6 mb-3">
                                    <label for="name" class="form-label">Full Name</label>
                                    <input type="text" class="form-control bg-gray-200" id="name" name="name" value="{{ $candidate->name }}">
                                </div>
                                <div class=" col-md-6 mb-3">
                                    <label for="student_id" class="form-label">Student ID</label>
                                    <input type="text" class="form-control bg-gray-200" id="student_id" name="student_id" readonly value="{{ $candidate->student_id }}">
                                </div>
                                <div class=" col-md-6 mb-3">
                                    <label for="course" class="form-label">Course</label>
                                    <input type="text" class="form-control bg-gray-200" id="course" name="course" value="{{ $candidate->course }}">
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
                                <button type="submit" class="btn btn-primary">Update Candidate</button>
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
