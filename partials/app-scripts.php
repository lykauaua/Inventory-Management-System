<script src="js/script.js?v=<?=time();?>"></script>
<script src="js/jquery/jquery-3.7.1.min.js"></script>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap3-dialog/1.35.4/js/bootstrap-dialog.js" integrity="sha512-AZ+KX5NScHcQKWBfRXlCtb+ckjKYLO1i10faHLPXtGacz34rhXU8KM4t77XXG/Oy9961AeLqB/5o0KTJfy2WiA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="js/sweetalert2.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function() {
    document.addEventListener("click", function() {
        toggleCursor();
        setTimeout(function() {
            revertCursor();
        }, 100); // Change the milliseconds value as needed
    });

    function toggleCursor() {
        document.body.classList.add("octoCursor1");
    }

    function revertCursor() {
        document.body.classList.remove("octoCursor1");
    }
});
</script>
<script>
    function toggleRemarksInput() {
        const selectElement = document.getElementById('remarksSelect');
        const inputElement = document.getElementById('remarksInput');
        if (selectElement.value === 'noRemarks') {
            inputElement.style.display = 'none';
            inputElement.removeAttribute('required');
            inputElement.value = ''; // Clear the input field when "No Remarks" is selected
        } else {
            inputElement.style.display = 'inline';
            inputElement.setAttribute('required', 'required');
        }
    }
</script>