@extends('layouts.main')
{{-- @section('title', 'Data Categories') --}}

@php
    use App\Models\UserRole;
    $user = Auth::user();
    $roleId = $user ? UserRole::where('user_id', $user->id)->value('role_id') : null;
@endphp

@if ($roleId === 5)
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
                                            {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#add-modul">
                                                Add Modul
                                            </button> --}}
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table mb-3" id="table">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Title</th>
                                                        <th>Instructor</th>
                                                        <th>Description</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $no = 1;
                                                    @endphp
                                                    @foreach ($moduls as $modul)
                                                        <tr>
                                                            <td>{{ $no++ }}.</td>
                                                            <td>{{ $modul->name }}</td>
                                                            <td>{{ $modul->instructor->users->name ?? '-' }}</td>
                                                            <td>{{ $modul->description }}</td>
                                                            <td>
                                                                <ul>
                                                                    @foreach ($modul->modulDetails as $detail)
                                                                        <li>
                                                                            File: {{ $detail->file_name }}<br>
                                                                            <a href="{{ asset('storage/' . $detail->file) }}"
                                                                                target="_blank">View</a> |
                                                                            <a href="{{ asset('storage/' . $detail->file) }}"
                                                                                download>Download</a><br>
                                                                            Link Referensi:
                                                                            <a href="{{ $detail->reference_link }}"
                                                                                target="_blank">
                                                                                Link
                                                                            </a>
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            </td>
                                                        </tr>

                                                        {{-- MODAL EDIT MODUL TITLE --}}
                                                        {{-- <div class="modal fade" id="edit-modul-{{ $data->id }}"
                                                            tabindex="-1" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel1">Add
                                                                            New
                                                                            Modul</h5>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form
                                                                            action="{{ route('moduls.update', $data->id) }}"
                                                                            method="post">
                                                                            @csrf
                                                                            @method('PUT')
                                                                            <div class="row">
                                                                                <div class="col mb-3">
                                                                                    <label for="editClassyName"
                                                                                        class="form-label">
                                                                                        Title</label>
                                                                                    <input type="text" name="name"
                                                                                        id="name" class="form-control"
                                                                                        value="{{ $data->name }}" />
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col mb-3">
                                                                                    <label for="editClassyName"
                                                                                        class="form-label">
                                                                                        Description
                                                                                    </label>
                                                                                    <textarea name="desc" id="" cols="30" rows="5" class="form-control">{{ $data->description }}</textarea>
                                                                                </div>
                                                                            </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="submit"
                                                                            class="btn btn-primary">Save</button>
                                                                        <button type="button"
                                                                            class="btn btn-outline-secondary"
                                                                            data-bs-dismiss="modal">
                                                                            Close
                                                                        </button>
                                                                    </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div> --}}

                                                        <!-- MODAL ADD MODULS DETAIL -->
                                                        {{-- <div class="modal fade" id="add-modulDetail-{{ $data->id }}"
                                                            tabindex="-1" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">Edit Course</h5>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form
                                                                            action="{{ route('modul_details.store', $data->id) }}"
                                                                            method="post" enctype="multipart/form-data">
                                                                            @csrf
                                                                            <input type="hidden" name="modul_id"
                                                                                value="{{ $data->id }}" />
                                                                            <div class="row mb-3">
                                                                                <div class="col">
                                                                                    <label for="editClassyName"
                                                                                        class="form-label">File
                                                                                        Name</label>
                                                                                    <input type="text" name="file_name"
                                                                                        id="file_name" class="form-control"
                                                                                        placeholder="Input File Name" />
                                                                                </div>
                                                                            </div>
                                                                            <div class="row mb-3">
                                                                                <div class="col">
                                                                                    <label for="editClassyName"
                                                                                        class="form-label">Upload
                                                                                        File</label>
                                                                                    <input type="file" name="upload_file"
                                                                                        id="upload_file"
                                                                                        class="form-control" />
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col">
                                                                                    <label for="editClassyName"
                                                                                        class="form-label">Link
                                                                                        References</label>
                                                                                    <input type="text"
                                                                                        name="link_references"
                                                                                        id="link_references"
                                                                                        class="form-control"
                                                                                        placeholder="Insert Link Reference (Optional)">
                                                                                </div>
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
                                                        </div> --}}

                                                        {{-- <div class="modal fade" id="edit-modulDetail-{{ $data->id }}"
                                                            tabindex="-1" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered"
                                                                role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">Edit Course</h5>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        @foreach ($data->modulDetails as $detail)
                                                                            <form
                                                                                action="{{ route('modul_details.update', $detail->id) }}"
                                                                                method="post"
                                                                                enctype="multipart/form-data">
                                                                                @csrf
                                                                                @method('PUT')
                                                                                <input type="hidden" name="modul_id"
                                                                                    value="{{ $data->id }}" />
                                                                                <div class="col">
                                                                                    <iframe
                                                                                        src="{{ asset('storage/moduls/' . $detail->fileName) }}"
                                                                                        width="100%"
                                                                                        height="600px"></iframe>
                                                                                </div>
                                                                                <div class="row mb-3">
                                                                                    <div class="col">
                                                                                        <label for="editClassyName"
                                                                                            class="form-label">File
                                                                                            Name</label>
                                                                                        <input type="text"
                                                                                            name="file_name"
                                                                                            id="file_name"
                                                                                            class="form-control"
                                                                                            value="{{ $detail->file_name }}" />
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row mb-3">
                                                                                    <div class="col">
                                                                                        <label for="editClassyName"
                                                                                            class="form-label">Upload
                                                                                            File</label>
                                                                                        <input type="file"
                                                                                            name="upload_file"
                                                                                            id="upload_file"
                                                                                            class="form-control" />
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class="col">
                                                                                        <label for="editClassyName"
                                                                                            class="form-label">Link
                                                                                            References</label>
                                                                                        <input type="text"
                                                                                            name="link_references"
                                                                                            id="link_references"
                                                                                            class="form-control"
                                                                                            value="{{ $detail->reference_link }}">
                                                                                    </div>
                                                                                </div>
                                                                        @endforeach
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
                                                            </div> --}}
                                                    @endforeach
                                                </tbody>
                                            </table>
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
                                                data-bs-target="#add-modul">
                                                Add Modul
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table mb-3" id="table">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Title</th>
                                                        <th>Instructor</th>
                                                        <th>Description</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $no = 1;
                                                    @endphp
                                                    @foreach ($datas as $data)
                                                        <tr>
                                                            <td>{{ $no++ }}. </td>
                                                            <td>{{ $data->name }}</td>
                                                            <td>{{ $data->instructor->users->name }}</td>
                                                            <td>{{ $data->description }}</td>
                                                            <td>{{ $data->created_at }}</td>
                                                            <td>
                                                                <div class="d-flex justify-content-center mb-3">
                                                                    <a href="javascript:void(0)"
                                                                        class="btn btn-primary me-2" data-bs-toggle="modal"
                                                                        data-bs-target="#add-modulDetail-{{ $data->id }}">ADD
                                                                        MODULS</a>
                                                                    <a href="javascript:void(0)" class="btn btn-light me-2"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#edit-modulDetail-{{ $data->id }}">
                                                                        EDIT MODULS</a>
                                                                </div>
                                                                <div class="d-flex justify-content-center">
                                                                    <a href="javascript:void(0)"
                                                                        class="btn btn-secondary me-2"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#edit-modul-{{ $data->id }}">EDIT</a>
                                                                    <form action="{{ route('moduls.destroy', $data->id) }}"
                                                                        method="POST" style="display: inline;">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit" class="btn btn-light"
                                                                            onclick="return confirm('Are you sure you want to delete this instructor?')">DELETE</button>
                                                                    </form>
                                                                </div>
                                                            </td>
                                                        </tr>

                                                        {{-- MODAL EDIT MODUL TITLE --}}
                                                        <div class="modal fade" id="edit-modul-{{ $data->id }}"
                                                            tabindex="-1" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel1">
                                                                            Add
                                                                            New
                                                                            Modul</h5>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form
                                                                            action="{{ route('moduls.update', $data->id) }}"
                                                                            method="post">
                                                                            @csrf
                                                                            @method('PUT')
                                                                            <div class="row">
                                                                                <div class="col mb-3">
                                                                                    <label for="editClassyName"
                                                                                        class="form-label">
                                                                                        Title</label>
                                                                                    <input type="text" name="name"
                                                                                        id="name" class="form-control"
                                                                                        value="{{ $data->name }}" />
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col mb-3">
                                                                                    <label for="editClassyName"
                                                                                        class="form-label">
                                                                                        Description
                                                                                    </label>
                                                                                    <textarea name="desc" id="" cols="30" rows="5" class="form-control">{{ $data->description }}</textarea>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row mb-2">
                                                                                <div class="col mb-5">
                                                                                    <label for="nameBasic"
                                                                                        class="form-label">Publish
                                                                                        Status</label>
                                                                                    <br>
                                                                                    <div class="col-sm-6 mb-2">
                                                                                        <input type="radio"
                                                                                            name="is_active"
                                                                                            class="form-check-input"
                                                                                            value="1"
                                                                                            {{ $data->is_active ? 'checked' : '' }}
                                                                                            id="1">
                                                                                        <label class="form-check-label"
                                                                                            for="defaultCheck2"> Publish
                                                                                        </label>
                                                                                    </div>
                                                                                    <div class="col-sm-6 mb-3">
                                                                                        <input type="radio"
                                                                                            name="is_active"
                                                                                            class="form-check-input"
                                                                                            id="0" value="0"
                                                                                            {{ $data->is_active ? '' : 'checked' }}>
                                                                                        <label class="form-check-label"
                                                                                            for="defaultCheck2"> Draft
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="submit"
                                                                            class="btn btn-primary">Save</button>
                                                                        <button type="button"
                                                                            class="btn btn-outline-secondary"
                                                                            data-bs-dismiss="modal">
                                                                            Close
                                                                        </button>
                                                                    </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- MODAL ADD MODULS DETAIL -->
                                                        <div class="modal fade" id="add-modulDetail-{{ $data->id }}"
                                                            tabindex="-1" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered"
                                                                role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">Edit Course</h5>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form
                                                                            action="{{ route('modul_details.store', $data->id) }}"
                                                                            method="post" enctype="multipart/form-data">
                                                                            @csrf
                                                                            <input type="hidden" name="modul_id"
                                                                                value="{{ $data->id }}" />
                                                                            <div class="row mb-3">
                                                                                <div class="col">
                                                                                    <label for="editClassyName"
                                                                                        class="form-label">File
                                                                                        Name</label>
                                                                                    <input type="text" name="file_name"
                                                                                        id="file_name"
                                                                                        class="form-control"
                                                                                        placeholder="Input File Name" />
                                                                                </div>
                                                                            </div>
                                                                            <div class="row mb-3">
                                                                                <div class="col">
                                                                                    <label for="editClassyName"
                                                                                        class="form-label">Upload
                                                                                        File</label>
                                                                                    <input type="file"
                                                                                        name="upload_file"
                                                                                        id="upload_file"
                                                                                        class="form-control" />
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col">
                                                                                    <label for="editClassyName"
                                                                                        class="form-label">Link
                                                                                        References</label>
                                                                                    <input type="text"
                                                                                        name="link_references"
                                                                                        id="link_references"
                                                                                        class="form-control"
                                                                                        placeholder="Insert Link Reference (Optional)">
                                                                                </div>
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

                                                        <div class="modal fade" id="edit-modulDetail-{{ $data->id }}"
                                                            tabindex="-1" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered"
                                                                role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">Edit Course</h5>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        @foreach ($data->modulDetails as $detail)
                                                                            <form
                                                                                action="{{ route('modul_details.update', $detail->id) }}"
                                                                                method="post"
                                                                                enctype="multipart/form-data">
                                                                                @csrf
                                                                                @method('PUT')
                                                                                <input type="hidden" name="modul_id"
                                                                                    value="{{ $data->id }}" />
                                                                                <div class="col">
                                                                                    <iframe
                                                                                        src="{{ asset('storage/moduls/' . $detail->fileName) }}"
                                                                                        width="100%"
                                                                                        height="600px"></iframe>
                                                                                </div>
                                                                                <div class="row mb-3">
                                                                                    <div class="col">
                                                                                        <label for="editClassyName"
                                                                                            class="form-label">File
                                                                                            Name</label>
                                                                                        <input type="text"
                                                                                            name="file_name"
                                                                                            id="file_name"
                                                                                            class="form-control"
                                                                                            value="{{ $detail->file_name }}" />
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row mb-3">
                                                                                    <div class="col">
                                                                                        <label for="editClassyName"
                                                                                            class="form-label">Upload
                                                                                            File</label>
                                                                                        <input type="file"
                                                                                            name="upload_file"
                                                                                            id="upload_file"
                                                                                            class="form-control" />
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class="col">
                                                                                        <label for="editClassyName"
                                                                                            class="form-label">Link
                                                                                            References</label>
                                                                                        <input type="text"
                                                                                            name="link_references"
                                                                                            id="link_references"
                                                                                            class="form-control"
                                                                                            value="{{ $detail->reference_link }}">
                                                                                    </div>
                                                                                </div>
                                                                        @endforeach
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
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    {{-- MODAL ADD MODUL TITLE --}}
                                    <div class="modal fade" id="add-modul" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel1">Add New Modul</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('moduls.store') }}" method="post"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="row">
                                                            <div class="col mb-3">
                                                                <label for="editClassyName" class="form-label">
                                                                    Title</label>
                                                                <input type="text" name="name" id="name"
                                                                    class="form-control" placeholder="Input Title" />
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col mb-3">
                                                                <label for="editClassyName" class="form-label">
                                                                    Description
                                                                </label>
                                                                <textarea name="desc" id="" cols="30" rows="5" class="form-control"></textarea>
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
@endif
