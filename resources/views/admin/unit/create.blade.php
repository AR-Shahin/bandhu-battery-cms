@extends("admin.layouts.master")

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Create Unit</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form action="{{ route('unit.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="name_en">Name (English)</label>
                                <input type="text" name="name_en" id="name_en" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="name_bn">Name (Bengali)</label>
                                <input type="text" name="name_bn" id="name_bn" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
@endsection
