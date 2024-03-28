<x-layout bodyClass="g-sidenav-show bg-gray-200">

    <x-navbars.sidebar activePage="candidates"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Candidates Management"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-body px-0 pb-2">
                             @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                  </button>
                               </div>
                            @endif
                    
                           @if (session('error'))
                              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                     <span aria-hidden="true">&times;</span>
                                  </button>
                              </div>
                           @endif
                            <div class="table-responsive p-0">
                                @foreach($positions as $position)
                                    <h3>{{ $position->title }}</h3>
                                    <form action="{{ route('save_leader') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="position_id" value="{{ $position->id }}">
                                        <table class="datatable table align-items-center mb-0">
                                            <thead>
                                                <tr>
                                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID</th>
                                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">PHOTO</th>
                                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">FULL NAME</th>
                                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">COURSE</th>
                                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Choose Leader</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($candidates->where('position_id', $position->id) as $candidate)
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex px-2 py-1">
                                                                <div class="d-flex flex-column justify-content-center">
                                                                    <p class="mb-0 text-sm">{{ $candidate->id }}</p>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex px-2 py-1">
                                                                <div>
                                                                    <img src="{{ asset('storage/' . $candidate->photo) }}" class="avatar avatar-xl me-3 border-radius-lg" alt="Candidate Photo">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex flex-column justify-content-center">
                                                                <h6 class="mb-0 text-sm">{{ $candidate->name }}</h6>
                                                            </div>
                                                        </td>
                                                        <td class="align-middle text-center">
                                                            <span class="text-secondary text-xs font-weight-bold">{{ $candidate->course }}</span>
                                                        </td>
                                                        <td class="align-middle text-center">
                                                            <input type="radio" name="candidate_id" value="{{ $candidate->id }}">
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <button type="submit" class="btn btn-primary">Save Leader</button>
                                    </form>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <x-footers.auth></x-footers.auth>
        </div>
    </main>
    <x-plugins></x-plugins>

</x-layout>
