@extends("layout.admin")

@section("css")
@endsection

@section("content")

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Kateqoriyalar Cədvəli</h3>
{{--        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">Əlavə et</button>--}}
    </div>

    <table class="table table-bordered table-hover text-center  ">
        <thead class="table-light">
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Description</th>
            <th>Image</th>
            <th>Experience</th>
            <th>Projects</th>
            <th>Clients</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>

        <tr>
            <td>{{$home->id}}</td>
            <td>{{$home->title}}</td>
            <td>{{$home->description}}</td>
            <td>
                <img src="{{ asset('storage/' . $home->image) }}" alt="Image" class="img-thumbnail zoom-image" style="width: 50px; height: 50px;" data-bs-toggle="modal" data-bs-target="#imageModal">
            </td>
            <td>{{$home->experience}}</td>
            <td>{{$home->projects}}</td>
            <td>{{$home->clients}}</td>
            <td>

                    @if($home->status === 1)
                        <button class="btn btn-sm btn-success">Aktif</button>
                    @else
                        <button class="btn btn-sm btn-danger">Passif</button>
                    @endif

            </td>
            <td>
                <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#updateModal" data-id="1">Edit</button>
                <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#showModal">Show</button>
            </td>
        </tr>

        </tbody>
    </table>

    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <img id="modalImage" src="{{$home->image}}" class="img-fluid rounded" alt="Zoomed Image">
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title " id="updateModalLabel">Edit</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="updateForm" action="{{ route('home.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{ $home->id }}"> <!-- ID-ni gizli olaraq göndəririk -->

                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{ $home->title }}" placeholder="Ozunuz haqqinda esas seyi yazin">
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3" placeholder="Ozunuz haqqinda aciqlama yazin">{{ $home->description }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Image</label>
                            <input type="file" class="form-control" name="image" placeholder="Seklinizi elave edin">
                            @if($home->image)
                                <img src="{{ asset('storage/' . $home->image) }}" alt="Image" class="img-thumbnail zoom-image" style="width: 50px; height: 50px;" data-bs-toggle="modal" data-bs-target="#imageModal">

                            @endif
                        </div>

                        <div class="mb-3">
                            <label for="experience" class="form-label">Experience</label>
                            <input type="text" class="form-control" name="experience" value="{{ $home->experience }}" id="experience" placeholder="Nece il tecrubeniz var ?">
                        </div>

                        <div class="mb-3">
                            <label for="projects" class="form-label">Projects</label>
                            <input type="text" class="form-control" name="projects" value="{{ $home->projects }}" id="projects" placeholder="Nece dene proyekt tamamlamisiniz?">
                        </div>

                        <div class="mb-3">
                            <label for="clients" class="form-label">Clients</label>
                            <input type="text" class="form-control" name="clients" value="{{ $home->clients }}" id="clients" placeholder="Musteri memnuniyeti nece faizdir">
                        </div>

                        <div class="mb-3">
                            <label for="updateStatus" class="form-label">Status</label>
                            <select class="form-select" name="status" id="updateStatus">
                                <option value="1" @if($home->status === 1) selected @endif>Active</option>
                                <option value="0" @if($home->status === 0) selected @endif>Inactive</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Yenilə</button>
                        <br><br>
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                    </form>

                </div>
            </div>
        </div>
    </div>
    <div class="modal fade modal-xl" id="showModal" tabindex="-1" aria-labelledby="showModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="showModalLabel">Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <main class="main container-fluid">
                    <section id="hero" class="hero section">
asdasdasd
                        <div class="container" data-aos="fade-up" data-aos-delay="100">

                            <div class="row align-items-center content">
                                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
                                    <h2>{{$home->title}}</h2>
                                    <p class="lead">{{$home->description}}</p>

                                    <div class="hero-stats" data-aos="fade-up" data-aos-delay="400">
                                        <div class="stat-item">
                                            <span class="stat-number">{{$home->experience}}</span>
                                            <span class="stat-label">Years Experience</span>
                                        </div>
                                        <div class="stat-item">
                                            <span class="stat-number">{{$home->projects}}</span>
                                            <span class="stat-label">Projects Completed</span>
                                        </div>
                                        <div class="stat-item">
                                            <span class="stat-number">{{$home->clients}}</span>
                                            <span class="stat-label">Happy Clients</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="hero-image">
                                        <img src="{{asset('assets/img/Screenshot_7.jpg')}}" alt="Portfolio Hero Image" class="img-fluid" data-aos="zoom-out" data-aos-delay="300">
                                        <div class="shape-1"></div>
                                        <div class="shape-2"></div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </section><!-- /Hero Section -->
                    </main>
                </div>
            </div>
        </div>
    </div>

@endsection

@section("js")
    <script>
        document.querySelector('.zoom-image').addEventListener('click', function() {
            const imgSrc = this.getAttribute('src');
            document.getElementById('modalImage').setAttribute('src', imgSrc);
            const imageModal = new bootstrap.Modal(document.getElementById('imageModal'));
            imageModal.show();
        });
    </script>

@endsection
