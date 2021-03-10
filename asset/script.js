function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#blah').attr('src', e.target.result).css("border", "none");
        };

        reader.readAsDataURL(input.files[0]);
    }
}
$("#paymentForm").submit(function (e) {

    e.preventDefault();

    let handler = PaystackPop.setup({

        key: 'pk_test_4b6445904b1a995c375eb343140d9bc0c7751d76', // Replace with your public key

        email: document.getElementById("email").value,

        amount: 1500 * 100,

        onClose: function () {
            alert('Window closed.');
        },

        callback: function (response) {
            $('#cover-spin').show(0);
            var passport = $('#passport')[0].files;

            let myForm = document.getElementById('paymentForm');
            let formData = new FormData(myForm);
            formData.append('submit', 'submit');

            // Check file selected or not
            if (passport.length > 0) {
                formData.append('passport', passport);
            }
            $.ajax({
                type: "POST",
                url: 'logic/index.php',
                data: formData,
                contentType: false,
                processData: false,
                success: function (data) {
                    console.log('closingg');
                    $('#cover-spin').hide();
                    let message = 'Payment complete! Reference: ' + response.reference + '. Please check your email for your examination card and further instructions.';
                    swal("Successful payment", message, "success");
                  
                },
                error: function (xhr) {
                    $('#cover-spin').hide();
                    responseText = JSON.parse(xhr.responseText)
                    swal("Error Occurred", xhr.status + " " + responseText.message, "error");
                }
            });
        }
    });

    handler.openIframe();

});