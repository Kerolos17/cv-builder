@extends('backend.dashboard')
@section('main')
    <main role="main" class="main-content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12">

                    <div class="row">

                        <div class="col-md-12">
                            <div class="card shadow mb-4">
                                <div class="card-header">
                                    <strong class="card-title">edit Profile</strong>
                                    <p>
                                        Short Discription About Your Self
                                    </p>
                                </div>
                                <div class="card-body">
                                    <form class="needs-validation" method="POSt" action="{{ route('update.profile') }}">
                                        @csrf
                                        @method("PUT")
                                        <input type="hidden" name="id" value="{{ $profile->id }}">
                                        <div class="form-group mb-3">
                                            <label for="example-textarea">Text area</label>
                                            <textarea class="form-control" name="desc" id="example-textarea" rows="4">{{$profile->desc}}</textarea>
                                        </div>
                                        <button class="btn btn-primary" type="submit">update</button>
                                    </form>
                                </div> <!-- /.card-body -->
                            </div> <!-- /.card -->
                        </div> <!-- /.col -->
                    </div> <!-- end section -->
                </div> <!-- /.col-12 col-lg-10 col-xl-10 -->
            </div> <!-- .row -->
        </div> <!-- .container-fluid -->

    </main>
@endsection
