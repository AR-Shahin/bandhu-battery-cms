@extends("admin.layouts.master")

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Edit Unit</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form action="{{ route('unit.update', $unit->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="name_en">Name (English)</label>
                                <input type="text" name="name_en" id="name_en" class="form-control" value="{{ $unit->name_en }}" required>
                            </div>
                            <div class="form-group">
                                <label for="name_bn">Name (Bengali)</label>
                                <input type="text" name="name_bn" id="name_bn" class="form-control" value="{{ $unit->name_bn }}" required>
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
