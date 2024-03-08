<x-layout bodyClass="g-sidenav-show bg-gray-200">

    <x-navbars.sidebar activePage="Elections"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Election"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-body px-0 pb-2">
                            <form method="POST" action="{{ route('elections.update', $elections->id) }}" enctype="multipart/form-data">
                                <div class="row">
                                @csrf
                                @method('PUT')
                                <div class=" col-md-6 mb-3">
                                    <label for="name" class="form-label">Election Title</label>
                                    <input type="text" class="form-control bg-gray-200" id="name" name="title" value="{{ $elections->title }}">
                                </div>
                                <div class=" col-md-6 mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <input class="form-control bg-gray-200" id="status" name="status" value ="{{$elections->status}}" ></input>
                                </div>
                                <div class=" col-md-6 mb-3">
                                    <label for="status" class="form-label">Description</label>
                                    <textarea class="form-control bg-gray-200" id="description" name="description" rows="3"  >{{$elections->description}}</textarea>
                                </div>
                                <div class=" col-md-6 mb-3">
                                    <label for="start" class="form-label">Start</label>
                                    <input class="form-control bg-gray-200" id="start" name="start" value ="{{$elections->start}}" ></input>
                                </div>
                                <div class=" col-md-6 mb-3">
                                    <label for="start" class="form-label">End</label>
                                    <input class="form-control bg-gray-200" id="end" name="end" value ="{{$elections->end}}" ></input>
                                </div>
                                <button type="submit" class="btn btn-primary">Update Election</button>
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
