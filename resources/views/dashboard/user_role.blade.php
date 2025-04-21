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
                                            data-bs-target="#add-usrol">
                                            Add User Role
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-sm mb-3" id="table">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>User Name</th>
                                                    <th>User Role</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $no = 1;
                                                @endphp
                                                @foreach ($user_role as $usrol)
                                                    <tr>
                                                        <td>{{ $no++ }}. </td>
                                                        <td>{{ $usrol->users->name }}</td>
                                                        <td>{{ $usrol->roles->name }}</td>
                                                        <td>
                                                            <a href="javascript:void(0)" class="btn btn-secondary"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#edit-usrol-{{ $usrol->id }}">EDIT</a>
                                                            <form action="{{ route('user_role.destroy', $usrol->id) }}"
                                                                method="POST" style="display: inline;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-light"
                                                                    onclick="return confirm('Are you sure you want to delete this class?')">DELETE</button>
                                                            </form>
                                                        </td>
                                                    </tr>

                                                    <!-- MODAL EDIT -->
                                                    <div class="modal fade" id="edit-usrol-{{ $usrol->id }}"
                                                        tabindex="-1" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Edit User Role</h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form
                                                                        action="{{ route('user_role.update', $usrol->id) }}"
                                                                        method="post">
                                                                        @csrf
                                                                        @method('PUT')
                                                                        <div class="row mb-2">
                                                                            <div class="col-sm-6 mb-3">
                                                                                <label for="nameBasic"
                                                                                    class="form-label">User Name</label>
                                                                                <select name="user" id="user"
                                                                                    class="form-control">
                                                                                    <option value="#" disabled
                                                                                        selected>Select Category
                                                                                    </option>
                                                                                    @foreach ($users as $user)
                                                                                        <option
                                                                                            {{ $user->id == $usrol->user_id ? 'selected' : '' }}
                                                                                            value="{{ $user->id }}">
                                                                                            {{ $user->name }}
                                                                                        </option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                            <div class="col-sm-6 mb-3">
                                                                                <label for="nameBasic"
                                                                                    class="form-label">Role</label>
                                                                                <select name="role" id="role"
                                                                                    class="form-control">
                                                                                    <option value="#" disabled
                                                                                        selected>Select Category
                                                                                    </option>
                                                                                    @foreach ($roles as $role)
                                                                                        <option
                                                                                            {{ $role->id == $usrol->role_id ? 'selected' : '' }}
                                                                                            value="{{ $role->id }}">
                                                                                            {{ $role->name }}
                                                                                        </option>
                                                                                    @endforeach
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
                                <div class="modal fade" id="add-usrol" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel1">Add New User Role</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('user_role.store') }}" method="post">
                                                    @csrf
                                                    <div class="row mb-2">
                                                        <div class="col-sm-6 mb-3">
                                                            <label for="nameBasic" class="form-label">User Name</label>
                                                            <select name="user" id="user" class="form-control">
                                                                <option value="#" disabled selected>Select Category
                                                                </option>
                                                                @foreach ($users as $user)
                                                                    <option value="{{ $user->id }}">
                                                                        {{ $user->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-sm-6 mb-3">
                                                            <label for="nameBasic" class="form-label">User Role</label>
                                                            <select name="role" id="role" class="form-control">
                                                                <option value="#" disabled selected>Select Category
                                                                </option>
                                                                @foreach ($roles as $role)
                                                                    <option value="{{ $role->id }}">
                                                                        {{ $role->name }}</option>
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
