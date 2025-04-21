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
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <form action="{{ route('users.updateAccount', $data->id) }}" method="post">
                                            @csrf
                                            @method('PUT')
                                            {{-- <input type="hidden" name="phone" value="{{ $data->phone ?? '' }}"> --}}
                                            <div class="row mb-3">
                                                <div class="col-6">
                                                    <label for="" class="mb-2">Your Name</label>
                                                    <input type="text" name="name" class="form-control"
                                                        value="{{ $data->name }}">
                                                </div>
                                                <div class="col-6">
                                                    <label for="" class="mb-2">Email</label>
                                                    <input type="email" name="email" class="form-control"
                                                        value="{{ $data->email }}">
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col">
                                                    <label for="" class="mb-2">Password</label>
                                                    <input type="password" name="password" class="form-control">
                                                </div>
                                            </div>
                                            <div class="text-end">
                                                <button type="submit" class="btn btn-primary"> SAVE </button>
                                                <a href="{{ route('users.index') }}" class="btn btn-secondary">BACK</a>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                {{-- MODAL --}}
                                {{-- <div class="modal fade" id="add-class" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel1">Add New Class</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('class.store') }}" method="post">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col mb-3">
                                                            <label for="nameBasic" class="form-label">Class Name</label>
                                                            <input type="text" name="class_name" id="nameBasic"
                                                                class="form-control" placeholder="Enter Name" />
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col mb-3">
                                                            <label for="editClassDesc" class="form-label">Class
                                                                Description</label>
                                                            <textarea name="desc_major" id="" cols="30" rows="5" class="form-control"></textarea>
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
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ Transactions -->
            </div>
        </div>
    </section>
@endsection
