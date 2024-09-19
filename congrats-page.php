<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<style>
     @import url(http://fonts.googleapis.com/css?family=Calibri:400,300,700);

body {
    

    background-image: linear-gradient(120deg, #F3842D, #E8E3C6) !important; 
    font-family: 'Calibri', sans-serif !important
}

.mt-100 {
    margin-top: 100px
}

.container {
    margin-top: 200px
}

p {
    font-size: 14px
}

h4 {
    margin-top: 18px
}

.action-button {
    width: 100px;
    background: #151328;
    font-weight: bold;
    color: white;
    border: 0 none;
    border-radius: 5px;
    cursor: pointer;
    padding: 10px 5px;
    margin: 10px 5px;
}


</style>

<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
        <div class="card">
            <div class="text-right cross"> <i class="fa fa-times"></i> </div>
            <div class="card-body text-center">
                <img src="https://img.icons8.com/bubbles/200/000000/trophy.png">
                <h4>CONGRATULATIONS!</h4>
                <img src="../survey-fox/assets/img/logo/logo.png">
                <p class="mt-3">You have completed the survey, please click on the below button to proceed to your payment credit information.</p>
                <a href="invoice.php" class="next action-button">Open To see your Winnings</a>
            </div>
        </div>
    </div>
</div>

<!-- jQuery and Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
$(document).ready(function() {
    $('#myModal').modal('show');
});
</script>
