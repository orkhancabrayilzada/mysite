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
            <th>Name</th>
            <th>Title</th>
            <th>Description</th>
            <th>Phone</th>
            <th>Age</th>
            <th>Image</th>
            <th>Email</th>
            <th>Occupation</th>
            <th>Nationality</th>
            <th>Short description</th>
            <th>Long description</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>

        <tr>
            <td>{{$about->id}}</td>
            <td>{{$about->name}}</td>
            <td>{{$about->title}}</td>
            <td>{{$about->description}}</td>
            <td>{{$about->phone}}</td>
            <td>{{$about->age}}</td>
            <td>
                <img src="{{ asset('storage/' . $about->image) }}" alt="Image" class="img-thumbnail zoom-image" style="width: 50px; height: 50px;" data-bs-toggle="modal" data-bs-target="#imageModal">
            </td>
            <td>{{$about->email}}</td>
            <td>{{$about->occupation}}</td>
            <td>{{$about->nationality}}</td>
            <td>{{$about->short_description}}</td>
            <td>{{$about->long_description}}</td>
            <td>

                @if($about->status === 1)
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
                    <img id="modalImage" src="{{$about->image}}" class="img-fluid rounded" alt="Zoomed Image">
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
                    <form id="updateForm" action="{{ route('about.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{ $about->id }}"> <!-- ID-ni gizli olaraq göndəririk -->

                        <div class="mb-3">
                            <label for="name" class="form-label">name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $about->name }}" >
                        </div>

                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{ $about->title }}" >
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <input type="text" class="form-control" id="description" name="description" value="{{ $about->description }}" >
                        </div>

                        <div class="mb-3">
                            <label for="age" class="form-label">Description</label>
                            <input type="number" class="form-control" id="age" name="age" value="{{ $about->age }}" >
                        </div>


                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <textarea class="form-control" id="phone" name="phone" rows="3" >{{ $about->phone }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Image</label>
                            <input type="file" class="form-control" name="image" placeholder="Seklinizi elave edin">
                            @if($about->image)
                                <img src="{{ asset('storage/' . $about->image) }}" alt="Image" class="img-thumbnail zoom-image" style="width: 50px; height: 50px;" data-bs-toggle="modal" data-bs-target="#imageModal">

                            @endif
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" value="{{ $about->email }}" id="email" >
                        </div>

                        <div class="mb-3">
                            <label for="occupation" class="form-label">Occupation</label>
                            <input type="text" class="form-control" name="occupation" value="{{ $about->occupation }}" id="occupation" >
                        </div>

                        <div class="mb-3">
                            <label for="nationality" class="form-label">Nationality</label>
                            <input type="text" class="form-control" name="nationality" value="{{ $about->nationality }}" id="nationality" placeholder="Musteri memnuniyeti nece faizdir">
                        </div>

                        <div class="mb-3">
                            <label for="short_description" class="form-label">Short Description</label>
                            <textarea class="form-control" id="short_description" name="short_description" rows="3" >{{ $about->short_description }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="long_description" class="form-label">Long Description</label>
                            <textarea class="form-control" id="long_description" name="long_description" rows="3" >{{ $about->long_description }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="updateStatus" class="form-label">Status</label>
                            <select class="form-select" name="status" id="updateStatus">
                                <option value="1" @if($about->status === 1) selected @endif>Active</option>
                                <option value="0" @if($about->status === 0) selected @endif>Inactive</option>
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
    <div class="modal fade modal-xl " id="showModal" tabindex="1" aria-labelledby="showModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="showModalLabel">Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <section id="about" class="about section light-background">

                        <!-- Section Title -->
                        <div class="container section-title" data-aos="fade-up">
                            <h2>About</h2>
                            <div class="title-shape">
                                <svg viewBox="0 0 200 20" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M 0,10 C 40,0 60,20 100,10 C 140,0 160,20 200,10" fill="none" stroke="currentColor" stroke-width="2"></path>
                                </svg>
                            </div>
                            <p>{{$about->title}}</p>
                        </div><!-- End Section Title -->

                        <div class="container" data-aos="fade-up" data-aos-delay="100">

                            <div class="row align-items-center">
                                <div class="col-lg-6 position-relative" data-aos="fade-right" data-aos-delay="200">
                                    <div class="about-image">
                                        <img src="{{asset('assets/img/mezun.jpg')}}" alt="Profile Image" class="img-fluid rounded-4">
                                    </div>
                                </div>

                                <div class="col-lg-6" data-aos="fade-left" data-aos-delay="300">
                                    <div class="about-content">
                                        <span class="subtitle">About Me</span>

                                        <h2>{{$about->description}}</h2>

                                        <p class="lead mb-4">{!!  nl2br($about->short_description) !!}</p>

                                        <p class="mb-4">{!!  nl2br($about->long_description) !!}</p>

                                        <div class="personal-info">
                                            <div class="row g-4">
                                                <div class="col-6">
                                                    <div class="info-item">
                                                        <span class="label">Name</span>
                                                        <span class="value">{{$about->name}}</span>
                                                    </div>
                                                </div>

                                                <div class="col-6">
                                                    <div class="info-item">
                                                        <span class="label">Phone</span>
                                                        <span class="value">{{$about->phone}}</span>
                                                    </div>
                                                </div>

                                                <div class="col-6">
                                                    <div class="info-item">
                                                        <span class="label">Age</span>
                                                        <span class="value">{{$about->age}}</span>
                                                    </div>
                                                </div>

                                                <div class="col-6">
                                                    <div class="info-item">
                                                        <span class="label">Email</span>
                                                        <span class="value">{{$about->email}}</span>
                                                    </div>
                                                </div>

                                                <div class="col-6">
                                                    <div class="info-item">
                                                        <span class="label">Occupation</span>
                                                        <span class="value">{{$about->email}}</span>
                                                    </div>
                                                </div>

                                                <div class="col-6">
                                                    <div class="info-item">
                                                        <span class="label">Nationality</span>
                                                        <span class="value">{{$about->nationality}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="signature mt-4">
                                            <div class="signature-image">
                                                <img src="{{asset('assets/img/imza.jpg')}}" alt="" class="img-fluid">
                                            </div>
                                            <div class="signature-info">
                                                <h4>Orkhan Cabrayilzade</h4>
                                                <p>Adipiscing Elit, Lorem Ipsum</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section><!-- /About Section -->
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
