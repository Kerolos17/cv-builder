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
                                    <strong class="card-title">Language</strong>
                                </div>
                                <div class="card-body">
                                    <form class="needs-validation" method="POST" action="{{route('save.lang')}}" >
                                        @csrf

                                        <div class="form-group mb-3">
                                            <label for="address-wpalaceholder">language</label>
                                            <input type="text" name="langName" id="address-wpalaceholder"
                                                data-role="tagsinput" class="form-control" placeholder="Enter your Skill">

                                        </div>
                                        <button class="btn btn-primary" type="submit">Save</button>
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
