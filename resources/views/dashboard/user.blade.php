@extends('layouts.main')
{{-- @section('title', 'Data Categories') --}}

@php
    use App\Models\UserRole;
    $user = Auth::user();
    $roleId = $user ? UserRole::where('user_id', $user->id)->value('role_id') : null;
@endphp

@if ($roleId === 4)
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
                                                data-bs-target="#add-user">
                                                Add User
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table mb-3" id="table">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Name</th>
                                                        <th>Email</th>
                                                        <th>Created At</th>
                                                        <th>Update At</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $no = 1;
                                                    @endphp
                                                    @foreach ($datas as $user)
                                                        <tr>
                                                            <td>{{ $no++ }}. </td>
                                                            <td>{{ $user->name }}</td>
                                                            <td>{{ $user->email }}</td>
                                                            <td>{{ $user->created_at }}</td>
                                                            <td>{{ $user->updated_at }}</td>
                                                            <td>
                                                                <a href="javascript:void(0)" class="btn btn-secondary"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#edit-user-{{ $user->id }}">EDIT</a>
                                                                <form action="{{ route('users.destroy', $user->id) }}"
                                                                    method="POST" style="display: inline;">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-light"
                                                                        onclick="return confirm('Are you sure you want to delete this class?')">DELETE</button>
                                                                </form>
                                                            </td>
                                                        </tr>

                                                        <!-- MODAL EDIT -->
                                                        <div class="modal fade" id="edit-user-{{ $user->id }}"
                                                            tabindex="-1" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">Edit User</h5>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form
                                                                            action="{{ route('users.update', $user->id) }}"
                                                                            method="post">
                                                                            @csrf
                                                                            @method('PUT')
                                                                            <div class="row">
                                                                                <div class="col mb-3">
                                                                                    <label
                                                                                        for="editClassyName{{ $user->id }}"
                                                                                        class="form-label">User Name</label>
                                                                                    <input type="text" name="name"
                                                                                        id="editClassName{{ $user->id }}"
                                                                                        class="form-control"
                                                                                        value="{{ $user->name }}" />
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col mb-3">
                                                                                    <label
                                                                                        for="editClassyName{{ $user->id }}"
                                                                                        class="form-label">Email</label>
                                                                                    <input type="text" name="email"
                                                                                        class="form-control"
                                                                                        value="{{ $user->email }}">
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col mb-3">
                                                                                    <label
                                                                                        for="editClassyName{{ $user->id }}"
                                                                                        class="form-label">Password</label>
                                                                                    <input type="text" name="password"
                                                                                        class="form-control">
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
                                    <div class="modal fade" id="add-user" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel1">Add New Users</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('users.store') }}" method="post">
                                                        @csrf
                                                        <div class="row">
                                                            <div class="col mb-3">
                                                                <label for="nameBasic" class="form-label">User Name</label>
                                                                <input type="text" name="name" id="nameBasic"
                                                                    class="form-control" placeholder="Enter Name" />
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col mb-3">
                                                                <label for="nameBasic" class="form-label">Email</label>
                                                                <input type="text" name="email" id="nameBasic"
                                                                    class="form-control" placeholder="Enter Email" />
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col mb-3">
                                                                <label for="nameBasic" class="form-label">Password</label>
                                                                <input type="password" name="password" id="nameBasic"
                                                                    class="form-control" placeholder="Enter Password" />
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
@else
    @section('content')
        <div class="d-flex justify-content-center align-items-center vh-100">
            <div class="container-xxl container-p-y text-center">
                <div class="misc-wrapper">
                    <h2 class="mb-2 mx-2">Page Not Found :(</h2>
                    <p class="mb-4 mx-2">Oops! 😖 The requested URL was not found on this server.</p>
                    {{-- <a href="index.html" class="btn btn-primary">Back to home</a> --}}
                    <div class="mt-3">
                        <img src="../assets/img/illustrations/page-misc-error-light.png" alt="page-misc-error-light"
                            width="500" class="img-fluid" data-app-dark-img="illustrations/page-misc-error-dark.png"
                            data-app-light-img="illustrations/page-misc-error-light.png" />
                    </div>
                </div>
            </div>
        </div>
    @endsection
@endif
