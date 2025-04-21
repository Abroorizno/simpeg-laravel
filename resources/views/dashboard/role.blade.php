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
                                            data-bs-target="#add-role">
                                            Add Role
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
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $no = 1;
                                                @endphp
                                                @foreach ($datas as $role)
                                                    <tr>
                                                        <td>{{ $no++ }}. </td>
                                                        <td>{{ $role->name }}</td>
                                                        <td>
                                                            <a href="javascript:void(0)" class="btn btn-secondary"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#edit-role-{{ $role->id }}">EDIT</a>
                                                            <form action="{{ route('roles.destroy', $role->id) }}"
                                                                method="POST" style="display: inline;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-light"
                                                                    onclick="return confirm('Are you sure you want to delete this class?')">DELETE</button>
                                                            </form>
                                                        </td>
                                                    </tr>

                                                    <!-- MODAL EDIT -->
                                                    <div class="modal fade" id="edit-role-{{ $role->id }}"
                                                        tabindex="-1" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Edit Class</h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form action="{{ route('roles.update', $role->id) }}"
                                                                        method="post">
                                                                        @csrf
                                                                        @method('PUT')
                                                                        <div class="row">
                                                                            <div class="col mb-3">
                                                                                <label
                                                                                    for="editClassyName{{ $role->id }}"
                                                                                    class="form-label">Role Name</label>
                                                                                <input type="text" name="name"
                                                                                    id="editClassName{{ $role->id }}"
                                                                                    class="form-control"
                                                                                    value="{{ $role->name }}" />
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col mb-3">
                                                                                <label
                                                                                    for="editClassyName{{ $role->id }}"
                                                                                    class="form-label">Is Active</label>
                                                                                <input type="text" name="is_active"
                                                                                    class="form-control"
                                                                                    value="{{ $role->is_active }}">
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
                                <div class="modal fade" id="add-role" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel1">Add New Role</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('roles.store') }}" method="post">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col mb-3">
                                                            <label for="nameBasic" class="form-label">Role Name</label>
                                                            <input type="text" name="name" id="nameBasic"
                                                                class="form-control" placeholder="Enter Name" />
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
