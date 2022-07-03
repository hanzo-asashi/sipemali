<div>
    @section('title') Profil Pengguna @endsection

    @component('components.breadcrumb')
        @slot('li_1') Pengguna @endslot
        @slot('title') Profil @endslot
    @endcomponent
    <div class="row">
        <div class="col-xl-9 col-lg-8">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm order-2 order-sm-1">
                            <div class="d-flex align-items-start mt-3 mt-sm-0">
                                <div class="flex-shrink-0">
                                    <div class="avatar-xl me-3">
                                        <img src="{{ \App\Utilities\Helper::getAvatar() }}"
                                            alt="" class="img-fluid rounded-circle d-block">
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <div>
                                        <h5 class="font-size-16 mb-1">{{ Auth::user()->name }}</h5>
                                        <p class="text-muted font-size-13">{{ auth()->user()->getRoleNames()[0] }}</p>

                                        <div class="d-flex flex-wrap align-items-start gap-2 gap-lg-3 text-muted font-size-13">
                                            <div><i class="mdi mdi-circle-medium me-1 text-success align-middle"></i>{{ Auth::user()->nik }}</div>
                                            <div><i class="mdi mdi-circle-medium me-1 text-success align-middle"></i>{{ Auth::user()->email }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-auto order-1 order-sm-2">
                            <div class="d-flex align-items-start justify-content-end gap-2">
                                <div>
                                    <button type="button" class="btn btn-soft-light" data-bs-toggle="modal" data-bs-target="#updateProfileModal">
                                        <i class="bx bx-edit-alt align-middle font-size-14"></i>
                                        &nbsp;&nbsp;Ubah Profil
                                    </button>
                                    <button type="button" class="btn btn-soft-light" data-bs-toggle="modal" data-bs-target="#gantiKataSandiiModal">
                                        <i class="bx bx-lock align-middle font-size-14"></i>
                                        &nbsp;&nbsp;Ganti Kata Sandi
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Tentang</h5>
                </div>
                <div class="card-body">
                    <div>
                        <div class="pb-3">
                            <div class="row">
                                <div class="col-xl-2">
                                    <div>
                                        <h5 class="font-size-15">Bio :</h5>
                                    </div>
                                </div>
                                <div class="col-xl">
                                    <div class="text-muted">
                                        <p class="mb-2">Hi I'm Phyllis Gatlin, Lorem Ipsum is simply dummy text of
                                            the printing and typesetting industry. Lorem Ipsum has been the
                                            industry's standard dummy text ever since the 1500s, when an unknown
                                            printer took a galley of type and scrambled it to make a type specimen
                                            book. It has survived not only five centuries, but also the leap into
                                            electronic typesetting, remaining essentially unchanged. It was
                                            popularised in the 1960s with the release of Letraset sheets containing
                                            Lorem Ipsum passages</p>
                                        <p class="mb-0">It is a long established fact that a reader will be
                                            distracted by the readable content of a page when looking at it has a
                                            more-or-less normal distribution of letters</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="py-3">
                            <div class="row">
                                <div class="col-xl-2">
                                    <div>
                                        <h5 class="font-size-15">Experience :</h5>
                                    </div>
                                </div>
                                <div class="col-xl">
                                    <div class="text-muted">
                                        <p>If several languages coalesce, the grammar of the resulting language is
                                            more simple and regular than that of the individual languages. The new
                                            common language will be more simple and regular than the existing
                                            European languages. It will be as simple as Occidental; in fact, it will
                                            be Occidental. To an English person, it will seem like simplified
                                            English, as a skeptical Cambridge friend of mine told me what Occidental
                                            is. The European languages are members of the same family. Their
                                            separate existence is a myth. For science, music, sport, etc</p>

                                        <ul class="list-unstyled mb-0">
                                            <li class="py-1"><i class="mdi mdi-circle-medium me-1 text-success align-middle"></i>Donec
                                                vitae sapien ut libero venenatis faucibus
                                            </li>
                                            <li class="py-1"><i class="mdi mdi-circle-medium me-1 text-success align-middle"></i>Quisque
                                                rutrum aenean imperdiet
                                            </li>
                                            <li class="py-1"><i class="mdi mdi-circle-medium me-1 text-success align-middle"></i>Integer
                                                ante a consectetuer eget
                                            </li>
                                            <li class="py-1"><i class="mdi mdi-circle-medium me-1 text-success align-middle"></i>Phasellus
                                                nec sem in justo pellentesque
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end card body -->
            </div>
            <!-- end tab content -->
        </div>
        <!-- end col -->

        <div class="col-xl-3 col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-3">Portfolio</h5>
                    <div>
                        <ul class="list-unstyled mb-0">
                            <li>
                                <a href="#" class="py-2 d-block text-muted"><i class="mdi mdi-web text-primary me-1"></i>
                                    Website</a>
                            </li>
                            <li>
                                <a href="#" class="py-2 d-block text-muted"><i class="mdi mdi-note-text-outline text-primary me-1"></i> Blog</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->
    <div class="modal fade" id="updateProfileModal" tabindex="-1" aria-labelledby="updateProfileModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myLargeModalLabel">Ubah Profil</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="POST" enctype="multipart/form-data" wire:submit.prevent="submit" id="update-profile">
                        @csrf
                        <input type="hidden" value="{{ Auth::user()->id }}" id="data_id">
                        <div class="mb-3">
                            <label for="useremail" class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="useremail" value="{{ Auth::user()->email }}" name="email"
                                   placeholder="Enter email" autofocus>
                            <div class="text-danger" id="emailError" data-ajax-feedback="email"></div>
                        </div>

                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{ Auth::user()->name }}" id="username" name="name" autofocus
                                   placeholder="Enter username">
                            <div class="text-danger" id="nameError" data-ajax-feedback="name"></div>
                        </div>

                        <div class="mb-3">
                            <label for="avatar">Profile Picture</label>
                            <div class="input-group">
                                <input type="file" class="form-control @error('avatar') is-invalid @enderror" id="avatar" name="avatar" autofocus>
                                <label class="input-group-text" for="avatar">Upload</label>
                            </div>
                            <div class="text-start mt-2">
                                <img src="{{ asset(Auth::user()->avatar) }}" alt="" class="rounded-circle avatar-lg">
                            </div>
                            <div class="text-danger" role="alert" id="avatarError" data-ajax-feedback="avatar"></div>
                        </div>
                        <div class="mt-3 d-grid">
                            <button class="btn btn-primary waves-effect waves-light UpdateProfile" data-id="{{ Auth::user()->id }}" type="submit">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @push('script')
        <script>
            $('#update-profile').on('submit', function (event) {
                event.preventDefault();
                var Id = $('#data_id').val();
                let formData = new FormData(this);
                $('#emailError').text('');
                $('#nameError').text('');
                $('#avatarError').text('');
                $.ajax({
                    url: "{{ url('update-profile') }}" + "/" + Id,
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        $('#emailError').text('');
                        $('#nameError').text('');
                        $('#avatarError').text('');
                        if (response.isSuccess == false) {
                            alert(response.Message);
                        } else if (response.isSuccess == true) {
                            setTimeout(function () {
                                window.location.reload();
                            }, 1000);
                        }
                    },
                    error: function (response) {
                        $('#emailError').text(response.responseJSON.errors.email);
                        $('#nameError').text(response.responseJSON.errors.name);
                        $('#avatarError').text(response.responseJSON.errors.avatar);
                    }
                });
            });
        </script>

    @endpush
</div>
