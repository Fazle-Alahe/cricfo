
$(document).ready(function() {
    $('.upload-button').on('click', handleUploadButtonClick);
});

function handleUploadButtonClick(event) {
    event.preventDefault();
    const button = $(this); // this refers to the button that was clicked
    const inputId = button.data('inputid'); // Get the data-inputid attribute
    const fileInput = $('#' + inputId + '_file');

    // Trigger file input click
    fileInput.click();

    fileInput.off('change').on('change', function() {
        const file = this.files[0];
        if (file) {
            const formData = new FormData();
            formData.append('image', file);
            // formData.append('_token', csrf_token);
        $.ajax({
                // url: site_url+'/upload-image',
                url: '/upload-image',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                // headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function(data) {
                    if (data.success) {

                        $('#' + inputId).val(data.filePath);
                        const previewImage = $('#' + inputId + '_preview');
                        previewImage.attr('src', data.previewPath);
                        previewImage.show(); 
                    } else {
                        alert('Failed to upload the image.');
                    }
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
        }
       });
    }

// $('.btn').click(function() {
//     $('#inputid_file').click();

//     handleUploadButtonClick();
// });
