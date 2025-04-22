@extends('layouts.main')
{{-- @section('title', 'Data Categories') --}}

@section('content')
    <section class="section">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                <div class="col-lg-12 mb-4 order-0">
                    <div class="card">
                        <div class="d-flex align-items-end row">
                            <div class="col-sm-12">
                                <div class="card-header">
                                    <div
                                        class="d-flex justify-content-between align-items-start flex-column flex-sm-row mt-3">
                                        <h5 class="card-title text-primary">{{ $title ?? '' }}</h5>
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#add-instructor">
                                            Add Instructor
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-sm mb-3" id="table">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Profile Picture</th>
                                                    <th>User Name</th>
                                                    <th>Class Major</th>
                                                    <th>Title</th>
                                                    <th>Gender</th>
                                                    <th>Address</th>
                                                    <th>Phone</th>
                                                    <th>Created At</th>
                                                    <th>Update At</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $no = 1;
                                                @endphp
                                                @foreach ($instructors as $inst)
                                                    <tr>
                                                        <td>{{ $no++ }}. </td>
                                                        <td><img src="{{ asset('storage/' . $inst->photo) }}" alt=""
                                                                width="100px"></td>
                                                        <td>{{ $inst->users->name }}</td>
                                                        <td>{{ $inst->majors->name }}</td>
                                                        <td>{{ $inst->title }}</td>
                                                        <td>
                                                            @if ($inst->gender == 1)
                                                                Male
                                                            @elseif ($inst->gender == 2)
                                                                Female
                                                            @else
                                                                Non-Binary
                                                            @endif
                                                        </td>
                                                        <td>{{ $inst->address }}</td>
                                                        <td>{{ $inst->phone }}</td>
                                                        <td>{{ $inst->created_at }}</td>
                                                        <td>{{ $inst->updated_at }}</td>
                                                        <td>
                                                            <div class="d-flex justify-content-end">
                                                                <a href="javascript:void(0)" class="btn btn-secondary"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#edit-instructor-{{ $inst->id }}">EDIT</a>
                                                                <form
                                                                    action="{{ route('instructors.destroy', $inst->id) }}"
                                                                    method="POST" style="display: inline;">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-light"
                                                                        onclick="return confirm('Are you sure you want to delete this class?')">DELETE</button>
                                                                </form>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <!-- MODAL EDIT -->
                                                    <div class="modal fade" id="edit-instructor-{{ $inst->id }}"
                                                        tabindex="-1" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Edit Instructor</h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form
                                                                        action="{{ route('instructors.update', $inst->id) }}"
                                                                        method="post" enctype="multipart/form-data">
                                                                        @csrf
                                                                        @method('PUT')
                                                                        <div class="row">
                                                                            <div class="d-flex justify-content-center mb-3">
                                                                                <img src="{{ asset('storage/' . $inst->photo) }}"
                                                                                    alt="" width="100px"
                                                                                    class="col-sm-5">
                                                                            </div>
                                                                            <div class="col mb-3">
                                                                                <label for="nameBasic"
                                                                                    class="form-label">Profile
                                                                                    Picture</label>
                                                                                <input type="file" name="photo_profile"
                                                                                    id="photo" class="form-control" />
                                                                            </div>
                                                                        </div>
                                                                        <div class="row mb-2">
                                                                            <div class="col-sm-6 mb-3">
                                                                                <label for="nameBasic"
                                                                                    class="form-label">User Name</label>
                                                                                <select name="user" id="user"
                                                                                    class="form-control">
                                                                                    <option value="#" disabled
                                                                                        selected>Select Category
                                                                                    </option>
                                                                                    @foreach ($user_roles as $user_role)
                                                                                        <option
                                                                                            {{ $user_role->users->id == $inst->user_id ? 'selected' : '' }}
                                                                                            value="{{ $user_role->users->id }}">
                                                                                            {{ $user_role->users->name }}
                                                                                        </option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                            <div class="col-sm-6 mb-3">
                                                                                <label for="nameBasic"
                                                                                    class="form-label">Class Major</label>
                                                                                <select name="major" id="major"
                                                                                    class="form-control">
                                                                                    <option value="#" disabled
                                                                                        selected>Select Category
                                                                                    </option>
                                                                                    @foreach ($majors as $major)
                                                                                        <option
                                                                                            {{ $major->id == $inst->majors_id ? 'selected' : '' }}
                                                                                            value="{{ $major->id }}">
                                                                                            {{ $major->name }}
                                                                                        </option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col mb-3">
                                                                                <label for="nameBasic"
                                                                                    class="form-label">Title</label>
                                                                                <input type="text" name="title"
                                                                                    id="nameBasic" class="form-control"
                                                                                    value="{{ $inst->title }}" />
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col mb-3">
                                                                                <label for="nameBasic"
                                                                                    class="form-label">Gender</label>
                                                                                <select name="gender" id="gender"
                                                                                    class="form-control">
                                                                                    <option value="0" disabled>Select
                                                                                        Gender</option>
                                                                                    <option value="1"
                                                                                        {{ $inst->gender == 1 ? 'selected' : '' }}>
                                                                                        Male</option>
                                                                                    <option value="2"
                                                                                        {{ $inst->gender == 2 ? 'selected' : '' }}>
                                                                                        Female</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col mb-3">
                                                                                <label for="nameBasic"
                                                                                    class="form-label">Phone</label>
                                                                                <div class="input-group">
                                                                                    <span class="input-group-text">+62
                                                                                    </span>
                                                                                    <input type="number" name="phone"
                                                                                        id="phone"
                                                                                        class="form-control"
                                                                                        value="{{ $inst->phone }}" />
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col mb-3">
                                                                                <label for="nameBasic"
                                                                                    class="form-label">Address</label>
                                                                                <textarea name="address" id="address" class="form-control">{{ $inst->address }}</textarea></textarea>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="submit"
                                                                                class="btn btn-primary">Save</button>
                                                                            <button type="button"
                                                                                class="btn btn-outline-secondary"
                                                                                data-bs-dismiss="modal">Close</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                {{-- MODAL --}}
                                <div class="modal fade" id="add-instructor" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel1">Add New Users</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('instructors.store') }}" method="post"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col mb-3">
                                                            <label for="nameBasic" class="form-label">Profile
                                                                Picture</label>
                                                            <input type="file" name="photo_profile" id="photo"
                                                                class="form-control" />
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <div class="col-sm-6 mb-3">
                                                            <label for="nameBasic" class="form-label">User Name</label>
                                                            <select name="user" id="user" class="form-control">
                                                                <option value="#" disabled selected>Select Category
                                                                </option>
                                                                @foreach ($user_roles as $user_role)
                                                                    <option value="{{ $user_role->users->id }}">
                                                                        {{ $user_role->users->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-sm-6 mb-3">
                                                            <label for="nameBasic" class="form-label">Class Major</label>
                                                            <select name="major" id="major" class="form-control">
                                                                <option value="#" disabled selected>Select Category
                                                                </option>
                                                                @foreach ($majors as $major)
                                                                    <option value="{{ $major->id }}">
                                                                        {{ $major->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col mb-3">
                                                            <label for="nameBasic" class="form-label">Title</label>
                                                            <input type="text" name="title" id="nameBasic"
                                                                class="form-control" placeholder="Enter Title" />
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col mb-3">
                                                            <label for="nameBasic" class="form-label">Gender</label>
                                                            <select name="gender" id="gender" class="form-control">
                                                                <option value="0" selected disabled>Select Gender
                                                                </option>
                                                                <option value="1">Male</option>
                                                                <option value="2">Female</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col mb-3">
                                                            <label for="nameBasic" class="form-label">Phone</label>
                                                            <div class="input-group">
                                                                <span class="input-group-text">+62 </span>
                                                                <input type="number" name="phone" id="phone"
                                                                    class="form-control" placeholder="Enter Phone" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col mb-3">
                                                            <label for="nameBasic" class="form-label">Address</label>
                                                            <textarea name="address" id="address" class="form-control" placeholder="Enter Address"></textarea>
                                                        </div>
                                                    </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Save</button>
                                                <button type="button" class="btn btn-outline-secondary"
                                                    data-bs-dismiss="modal">
                                                    Close
                                                </button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ Transactions -->
            </div>
        </div>
    </section>
@endsection
