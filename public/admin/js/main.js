$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
function deleteRow(id, url) {
    if (confirm('Nếu xóa bạn không thể khôi phục !!!. Bạn có chắc ?')) {
        $.ajax({
            type: 'DELETE',
            datatype: 'JSON',
            data: { id },
            url: url,
            success: function (result) {
                if (result.error === false) {
                    location.reload();
                    location.reload();
                    alert(result.message);
                } else {
                    alert('Xóa lỗi vui lòng thử lại sau');
                }
            }
        })
    }
}

