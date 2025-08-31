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
        <form action="{{ route("admin.download_storage_files") }}" method="POST" class="d-inline mx-2">
            @csrf
            <button class="btn btn-sm btn-warning" onclick="return confirmLargeDownload()"><i class="fas fa-download mr-1"></i> Download Storage Files</button>
        </form>
        <form action="{{ route("admin.create_storage_zip_background") }}" method="POST" class="d-inline">
            @csrf
            <button class="btn btn-sm btn-secondary"><i class="fas fa-cog mr-1"></i> Create ZIP in Background</button>
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

<!-- Ready Downloads Section -->
<div class="card mt-4">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-download mr-2"></i>Ready Downloads</h3>
        <div class="card-tools">
            <button class="btn btn-sm btn-primary" onclick="checkDownloadStatus()"><i class="fas fa-sync mr-1"></i> Refresh</button>
        </div>
    </div>
    <div class="card-body">
        <div id="ready-downloads">
            <p class="text-muted">Click "Refresh" to check for ready downloads...</p>
        </div>
    </div>
</div>

<script>
function confirmLargeDownload() {
    return confirm('This will download all files from storage/app as a ZIP. For large files (>5GB), this may take a long time and could timeout. Consider using "Create ZIP in Background" for very large datasets. Continue?');
}

function checkDownloadStatus() {
    fetch('{{ route("admin.check_download_status") }}')
        .then(response => response.json())
        .then(data => {
            const container = document.getElementById('ready-downloads');
            
            if (data.status === 'success' && data.downloads.length > 0) {
                let html = '<div class="table-responsive"><table class="table table-striped"><thead><tr><th>Filename</th><th>Size</th><th>Created</th><th>Action</th></tr></thead><tbody>';
                
                data.downloads.forEach(download => {
                    html += `<tr>
                        <td>${download.filename}</td>
                        <td>${download.size}</td>
                        <td>${download.created_at}</td>
                        <td><a href="${download.download_url}" class="btn btn-sm btn-success"><i class="fas fa-download mr-1"></i> Download</a></td>
                    </tr>`;
                });
                
                html += '</tbody></table></div>';
                container.innerHTML = html;
            } else if (data.status === 'no_downloads') {
                container.innerHTML = '<p class="text-muted">No downloads available</p>';
            } else {
                container.innerHTML = '<p class="text-danger">Error checking downloads: ' + data.message + '</p>';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            document.getElementById('ready-downloads').innerHTML = '<p class="text-danger">Error checking downloads</p>';
        });
}

// Auto-refresh every 30 seconds
setInterval(checkDownloadStatus, 30000);

// Check on page load
document.addEventListener('DOMContentLoaded', function() {
    checkDownloadStatus();
});
</script>

@stop
