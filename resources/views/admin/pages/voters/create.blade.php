<x-layout bodyClass="g-sidenav-show bg-gray-200">

    <x-navbars.sidebar activePage="user-management"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Add New Voter"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card my-4">
                        <div class="card-body">
                            <form method="POST" action="{{ route('voters.store') }}">
                                @csrf
                                <div class="mb-3">
                                    <label for="full_name" class="form-label">Full Name</label>
                                    <input type="text" class="form-control bg-gray-200" id="full_name" name="name" required>
                                    @error('Full Name')
                                          <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="student_id" class="form-label">Student ID</label>
                                    <input type="text" class="form-control bg-gray-200" id="student_id" name="student_id" required>
                                    @error('Student ID')
                                          <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                 <div class="mb-3">
                                    <label for="student_id" class="form-label">Email</label>
                                    <input type="text" class="form-control bg-gray-200" id="email" name="email" required>
                                    @error('email')
                                          <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="course" class="form-label">Course</label>
                                    <input type="text" class="form-control bg-gray-200" id="course" name="course" required>
                                    @error('Course')
                                          <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control bg-gray-200" id="password" name="password" required>
                                    @error('Password')
                                          <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">Add Voter</button>
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
