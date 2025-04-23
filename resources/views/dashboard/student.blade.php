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
                                            data-bs-target="#add-student">
                                            Add Student
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
                                                    <th>Student Name</th>
                                                    <th>Class Major</th>
                                                    <th>Date of Birth</th>
                                                    <th>Place of Birth</th>
                                                    <th>Gender</th>
                                                    <th>Created At</th>
                                                    <th>Update At</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $no = 1;
                                                @endphp
                                                @foreach ($students as $student)
                                                    <tr>
                                                        <td>{{ $no++ }}. </td>
                                                        <td><img src="{{ asset('storage/' . $student->photo) }}"
                                                                alt="" width="100px"></td>
                                                        <td>{{ $student->users->name }}</td>
                                                        <td> {{ $student->majors ? $student->majors->name : '' }} </td>
                                                        <td>{{ $student->date_of_birth }}</td>
                                                        <td>{{ $student->place_of_birth }}</td>
                                                        <td>
                                                            @if ($student->gender == 1)
                                                                Male
                                                            @elseif ($student->gender == 2)
                                                                Female
                                                            @else
                                                                Non-Binary
                                                            @endif
                                                        </td>
                                                        <td>{{ $student->created_at }}</td>
                                                        <td>{{ $student->updated_at }}</td>
                                                        <td>
                                                            <div class="d-flex justify-content-end">
                                                                <a href="javascript:void(0)" class="btn btn-secondary"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#edit-student-{{ $student->id }}">EDIT</a>
                                                                <form
                                                                    action="{{ route('students.destroy', $student->id) }}"
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
                                                    <div class="modal fade" id="edit-student-{{ $student->id }}"
                                                        tabindex="-1" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Edit Student</h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form
                                                                        action="{{ route('students.update', $student->id) }}"
                                                                        method="post" enctype="multipart/form-data">
                                                                        @csrf
                                                                        @method('PUT')
                                                                        <div class="row">
                                                                            <div class="d-flex justify-content-center mb-3">
                                                                                <img src="{{ asset('storage/' . $student->photo) }}"
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
                                                                                            {{ $user_role->users->id == $student->user_id ? 'selected' : '' }}
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
                                                                                            {{ $major->id == $student->majors_id ? 'selected' : '' }}
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
                                                                                    class="form-label">Date of Birth</label>
                                                                                <input type="date" name="dob"
                                                                                    id="nameBasic" class="form-control"
                                                                                    value="{{ $student->date_of_birth }}"
                                                                                    placeholder="Enter Date" />
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col mb-3">
                                                                                <label for="nameBasic"
                                                                                    class="form-label">Place of
                                                                                    Birth</label>
                                                                                <input type="text" name="pob"
                                                                                    id="nameBasic" class="form-control"
                                                                                    value="{{ $student->place_of_birth }}" />
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
                                                                                        {{ $student->gender == 1 ? 'selected' : '' }}>
                                                                                        Male</option>
                                                                                    <option value="2"
                                                                                        {{ $student->gender == 2 ? 'selected' : '' }}>
                                                                                        Female</option>
                                                                                </select>
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
                                <div class="modal fade" id="add-student" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel1">Add New Student</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('students.store') }}" method="post"
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
                                                            <label for="nameBasic" class="form-label">Date of
                                                                Birth</label>
                                                            <input type="date" name="dob" id="nameBasic"
                                                                class="form-control" placeholder="Enter Date" />
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col mb-3">
                                                            <label for="nameBasic" class="form-label">Place of
                                                                Birth</label>
                                                            <input type="text" name="pob" id="nameBasic"
                                                                class="form-control" placeholder="Enter Place" />
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
