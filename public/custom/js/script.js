function initalizeDatatable(route,columns,table="data-table"){
    $(function () {
        $('.'+table).DataTable({
            "processing": true,
            "retrieve": true,
            "serverSide": true,
            'paginate': true,
            'searchDelay': 700,
            "bDeferRender": true,
            "responsive": true,
            "autoWidth": true,
            "order": [ [0, 'asc'] ],
            lengthMenu: [[5,10,15, 25, 50, -1], [5,10,15, 25, 50, "All"]],
            pageLength: 15,
            ajax: route,
            columns: columns
        });
      });
}


function previewImage(event,id) {
    var input = event.target;

    if (input.files && input.files[0]) {

        var fileSize = input.files[0].size; // in bytes
        var maxSize = (1024 * 1024) * 2; // 1 MB

        if (fileSize > maxSize) {
            alert('File size exceeds 1 MB. Please choose a smaller file.');
            input.value = ""
        }else{
            var reader = new FileReader();

            reader.onload = function (e) {
                var preview = document.getElementById(id);
                preview.src = e.target.result;
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
}
