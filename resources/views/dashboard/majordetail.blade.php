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
                                            data-bs-target="#add-major">
                                            Add User Major
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table mb-3" id="table">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Class On Hold</th>
                                                    <th>Instructor Name</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $no = 1;
                                                @endphp
                                                @foreach ($datas as $major_detail)
                                                    <tr>
                                                        <td>{{ $no++ }}. </td>
                                                        <td>{{ $major_detail->majors->name }}</td>
                                                        <td>{{ $major_detail->user->name }}</td>
                                                        <td>
                                                            <a href="javascript:void(0)" class="btn btn-secondary"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#edit-major-{{ $major_detail->id }}">EDIT</a>
                                                            <form
                                                                action="{{ route('major_details.destroy', $major_detail->id) }}"
                                                                method="POST" style="display: inline;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-light"
                                                                    onclick="return confirm('Are you sure you want to delete this class?')">DELETE</button>
                                                            </form>
                                                        </td>
                                                    </tr>

                                                    <!-- MODAL EDIT -->
                                                    <div class="modal fade" id="edit-major-{{ $major_detail->id }}"
                                                        tabindex="-1" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Edit Class</h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form
                                                                        action="{{ route('major_details.update', $major_detail->id) }}"
                                                                        method="post">
                                                                        @csrf
                                                                        @method('PUT')
                                                                        <div class="row">
                                                                            <div class="col mb-3">
                                                                                <label for="nameBasic"
                                                                                    class="form-label">Major Name</label>
                                                                                <select class="form-select" name="major">
                                                                                    <option value="">Select Major
                                                                                    </option>
                                                                                    @foreach ($majors as $major)
                                                                                        <option
                                                                                            {{ $major->id == $major_detail->majors_id ? 'selected' : '' }}
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
                                                                                    class="form-label">User Name</label>
                                                                                <select class="form-select" name="user">
                                                                                    <option value="">Select PIC Name
                                                                                    </option>
                                                                                    {{-- @foreach ($user_roles as $user_role)
                                                                                        <option
                                                                                            {{ $user_role->user->id == $major_detail->user_id ? 'selected' : '' }}
                                                                                            value="{{ $user_role->user->id }}">
                                                                                            {{ $user_role->user->name }}
                                                                                        </option>
                                                                                    @endforeach --}}
                                                                                    @foreach ($user_roles as $user)
                                                                                        <option
                                                                                            {{ $user->users->id == $major_detail->user_id ? 'selected' : '' }}
                                                                                            value="{{ $user->users->id }}">
                                                                                            {{ $user->users->name }}
                                                                                        </option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="submit"
                                                                        class="btn btn-primary">Save</button>
                                                                    <button type="button" class="btn btn-outline-secondary"
                                                                        data-bs-dismiss="modal">Close</button>
                                                                </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                {{-- MODAL --}}
                                <div class="modal fade" id="add-major" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel1">Add New Major</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('major_details.store') }}" method="post">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col mb-3">
                                                            <label for="nameBasic" class="form-label">Major Name</label>
                                                            <select class="form-select" name="major">
                                                                <option value="">Select Major</option>
                                                                @foreach ($majors as $major)
                                                                    <option value="{{ $major->id }}">
                                                                        {{ $major->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col mb-3">
                                                            <label for="nameBasic" class="form-label">User Name</label>
                                                            <select class="form-select" name="user">
                                                                <option value="">Select Major</option>
                                                                @foreach ($user_roles as $user)
                                                                    <option value="{{ $user->users->id }}">
                                                                        {{ $user->users->name }}</option>
                                                                @endforeach
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
