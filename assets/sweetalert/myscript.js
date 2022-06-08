const flashData = $('.flash-data').data('flashdata');

if (flashData) {
    Swal.fire(
        'OK Verified',
        flashData,
        'success'
    );
}