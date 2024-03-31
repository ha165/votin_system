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
                            <div class="table-responsive p-0">
                                @foreach($results as $positionTitle => $candidates)
                                    <h3>{{ $positionTitle }}</h3>
                                    <table class="datatable table align-items-center mb-0">
                                        <thead>
                                            <tr>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Candidate</th>
                                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Photo</th>
                                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Votes</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($candidates as $candidate)
                                            <tr>
                                                <td><img src="{{ $candidate['photo'] }}" class="avatar avatar-xl me-3 border-radius-lg" alt="Candidate Photo"></td>
                                                <td>{{ $candidate['name'] }}</td>
                                                <td class="text-center">{{ $candidate['votes'] }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
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
