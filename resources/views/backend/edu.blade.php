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
                                    <strong class="card-title">Education Information</strong>
                                </div>
                                <div class="card-body">
                                    <form class="needs-validation" method="POSt" action="{{ route('save.edu') }}">
                                        @csrf

                                        <div class="form-group mb-3">
                                            <label for="address-wpalaceholder">University/school/institute</label>
                                            <input type="text" name="eduName" id="address-wpalaceholder"
                                                class="form-control" placeholder="Enter ...">

                                        </div>

                                        <div class="form-row">
                                            <div class="col-md-8 mb-3">
                                                <label for="date-input1">Start Date</label>
                                                <input type="text" class="form-control drgpicker" name="startDate" id="date-input1" value="04/24/2020" aria-describedby="button-addon2">

                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="date-input2">End Date</label>
                                                <input type="text" class="form-control drgpicker" name="endDate" id="date-input2" value="04/24/2020" aria-describedby="button-addon2">
                                            </div>
                                        </div> <!-- /.form-row -->
                                        <div class="form-group mb-3">
                                            <label for="example-select">Select Kind Of Edu</label>
                                            <select name="level_id" class="form-control" id="example-select">
                                                <option disabled selected>Choose Your Kind</option>
                                                @foreach ($kinds as $kind )
                                                <option value="{{$kind->id}}">{{$kind->levelName}}</option>

                                                @endforeach
                                              </select>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="address-wpalaceholder">Filde/Position</label>
                                            <input type="text" name="filde" id="address-wpalaceholder"
                                                class="form-control" placeholder="Enter ...">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="example-textarea">Discrip what you have got</label>
                                            <textarea class="form-control" name="desc" id="example-textarea" rows="4"></textarea>
                                        </div>
                                        <button class="btn btn-primary" type="submit">Save</button>
                                        <div class="d-flex justify-content-end">
                                            <a class="btn btn-danger" href="{{route('user.lang')}}">Next</a>

                                        </div>
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
