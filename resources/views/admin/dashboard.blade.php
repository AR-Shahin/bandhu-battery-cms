@extends("admin.layouts.master")

@section("title","Dashboard")

@section("master_content")
<div class="card">
    <div class="card-body">
        <form action="{{ route("admin.backup") }}" method="POST" class="d-inline mx-2">
            @csrf
            <button class="btn btn-sm btn-success"><i class="fas fa-trash-restore-alt mr-1"></i> Backup Site Data</button>
        </form>
        <form action="{{ route("admin.backup_db") }}" method="POST" class="d-inline">
            @csrf
            <button class="btn btn-sm btn-info"><i class="fas fa-trash-restore-alt mr-1"></i> Database Backup Only</button>
        </form>
    </div>
</div>
<div class="row" bis_skin_checked="1">
    <div class="col-lg-3 col-6" bis_skin_checked="1">
        <div class="small-box bg-info" bis_skin_checked="1">
            <div class="inner" bis_skin_checked="1">
                <h3>{{ $message }}</h3>
                <p>New Message</p>
            </div>
            <div class="icon" bis_skin_checked="1">
                <i class="ion ion-bag"></i>
            </div>
            <a href="{{ route('admin.contacts.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-3 col-6" bis_skin_checked="1">
        <div class="small-box bg-success" bis_skin_checked="1">
            <div class="inner" bis_skin_checked="1">
                <h3>{{ $product }}<sup style="font-size: 20px;"></sup></h3>
                <p>Total Product</p>
            </div>
            <div class="icon" bis_skin_checked="1">
                <i class="ion ion-stats-bars"></i>
            </div>
            <a href="{{ route("admin.product.index") }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-3 col-6" bis_skin_checked="1">
        <div class="small-box bg-warning" bis_skin_checked="1">
            <div class="inner" bis_skin_checked="1">
                <h3>44</h3>
                <p>User Registrations</p>
            </div>
            <div class="icon" bis_skin_checked="1">
                <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-3 col-6" bis_skin_checked="1">
        <div class="small-box bg-danger" bis_skin_checked="1">
            <div class="inner" bis_skin_checked="1">
                <h3>65</h3>
                <p>Unique Visitors</p>
            </div>
            <div class="icon" bis_skin_checked="1">
                <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>

@stop
