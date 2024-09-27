<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'quiz-config/connection.php';
include 'include/session.php';
?>

<!DOCTYPE html>
<html lang="en">

<?php
include 'include/header-links.php';
?>

<body>
    <!-- start cssload-loader -->
    <div class="preloader">
        <div class="loader">
            <svg class="spinner" viewBox="0 0 50 50">
                <circle class="path" cx="25" cy="25" r="20" fill="none" stroke-width="5"></circle>
            </svg>
        </div>
    </div>
    <!-- end cssload-loader -->

    <?php
    include 'include/header.php';
    ?>
    <!-- MultiStep Form -->
    <div class="container-fluid overflowx-hidden">
        <div class="row justify-content-center align-items-center">
            <div class="col-12 p-0 mt-3 mb-2">
                <div class="card px-0 pb-0 mt-3 mb-3">
                    <div class="row">
                        <div class="col-md-12 mx-0">
                            <form id="msform">
                                <!-- progressbar -->
                                <ul id="progressbar">
                                    <li class="active" id="step0"></li>
                                    <li id="step1"></li>
                                    <li id="step2"></li>
                                    <li id="step3"></li>
                                    <li id="step4"></li>
                                    <li id="step5"></li>
                                    <li id="step6"></li>
                                </ul>
                                <h3 class="navy-blue mb-30"><strong>Cybersecurity Basics <span class="orange">Quiz</span></strong></h3>
                                <!-- fieldsets -->
                                <fieldset name="step0">
                                    <input type="button" name="next" class="next action-button" value="Get Started" />
                                </fieldset>
                                <fieldset class="col-11 col-sm-9 col-md-7 col-lg-6 m-auto p-0 mt-3 mb-2">
                                    <fieldset name="step1">
                                        <div class="form-card">
                                            <div class="mb-30">
                                                <h6 class="navy-blue">1) Which of the following is the strongest password?</h6>
                                                <div class="radio">
                                                    <label><input type="radio" name="travel" value="Less than once" qid="2">password123</label>
                                                </div>
                                                <div class="radio">
                                                    <label><input type="radio" name="travel" value="1-2 times" qid="2">qwerty</label>
                                                </div>
                                                <div class="radio">
                                                    <label><input type="radio" name="travel" value="3-5 times" qid="2">P@55w0rD!</label>
                                                </div>
                                                <div class="radio">
                                                    <label><input type="radio" name="travel" value="More than 5 times" qid="2">mydogname</label>
                                                </div>
                                            </div>
                                            <div class="mb-30">
                                                <h6 class="navy-blue">2) What should you do if you receive a suspicious email?</h6>
                                                <div class="radio">
                                                    <label><input type="radio" name="travel" value="Less than once" qid="2">Open it to see if it's important.</label>
                                                </div>
                                                <div class="radio">
                                                    <label><input type="radio" name="travel" value="1-2 times" qid="2">Click the link to find out more.</label>
                                                </div>
                                                <div class="radio">
                                                    <label><input type="radio" name="travel" value="3-5 times" qid="2">Mark it as spam or delete it.</label>
                                                </div>
                                                <div class="radio">
                                                    <label><input type="radio" name="travel" value="More than 5 times" qid="2">Reply to ask for more details.</label>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                                        <input type="button" name="next" class="next action-button" value="Next" onclick="saveDataAndSend('step2');" />
                                    </fieldset>
                                    <fieldset name="step2">
                                        <div class="form-card">
                                            <div class="mb-30">
                                                <h6 class="navy-blue mb-3">3) Which of these is a common type of cyberattack?</h6>
                                                <div class="radio">
                                                    <label><input type="radio" name="travel" value="Less than once" qid="2">Phishing</label>
                                                </div>
                                                <div class="radio">
                                                    <label><input type="radio" name="travel" value="1-2 times" qid="2">Surfing</label>
                                                </div>
                                                <div class="radio">
                                                    <label><input type="radio" name="travel" value="3-5 times" qid="2">Listening</label>
                                                </div>
                                                <div class="radio">
                                                    <label><input type="radio" name="travel" value="More than 5 times" qid="2">Sharing</label>
                                                </div>
                                            </div>
                                            <div class="mb-30">
                                                <h6 class="navy-blue mb-3">4) What does two-factor authentication (2FA) add to your account security?</h6>
                                                <div class="radio">
                                                    <label><input type="radio" name="travel" value="Less than once" qid="2">A second password</label>
                                                </div>
                                                <div class="radio">
                                                    <label><input type="radio" name="travel" value="1-2 times" qid="2">A backup email address
                                                    </label>
                                                </div>
                                                <div class="radio">
                                                    <label><input type="radio" name="travel" value="3-5 times" qid="2">An additional layer of verification</label>
                                                </div>
                                                <div class="radio">
                                                    <label><input type="radio" name="travel" value="More than 5 times" qid="2">Extra permissions to access your account</label>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                                        <input type="button" name="next" class="next action-button" value="Next" onclick="saveDataAndSend('step3');" />
                                    </fieldset>
                                    <fieldset name="step3">
                                        <div class="form-card">
                                            <div class="mb-30">
                                                <h6 class="navy-blue mb-3">5) Which of the following is a safe practice for using public Wi-Fi</h6>
                                                <div class="radio">
                                                    <label><input type="radio" name="travel" value="Less than once" qid="2">Accessing sensitive information like bank accounts</label>
                                                </div>
                                                <div class="radio">
                                                    <label><input type="radio" name="travel" value="1-2 times" qid="2">Using a VPN (Virtual Private Network)</label>
                                                </div>
                                                <div class="radio">
                                                    <label><input type="radio" name="travel" value="3-5 times" qid="2">Disabling your device's firewall</label>
                                                </div>
                                                <div class="radio">
                                                    <label><input type="radio" name="travel" value="More than 5 times" qid="2">Connecting without security concerns</label>
                                                </div>
                                            </div>
                                            <div class="mb-30">
                                                <h6 class="navy-blue">6) What should you do if you suspect your device is infected with malware?</h6>
                                                <div class="radio">
                                                    <label><input type="radio" name="travel" value="Less than once" qid="2">Ignore it and continue using your device</label>
                                                </div>
                                                <div class="radio">
                                                    <label><input type="radio" name="travel" value="1-2 times" qid="2">Disconnect from the internet and run a full antivirus scan </label>
                                                </div>
                                                <div class="radio">
                                                    <label><input type="radio" name="travel" value="3-5 times" qid="2">Delete all your files</label>
                                                </div>
                                                <div class="radio">
                                                    <label><input type="radio" name="travel" value="More than 5 times" qid="2">Restart your computer to solve the issue</label>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                                        <input type="button" name="make_payment" class="next action-button" value="Next" />
                                    </fieldset>
                                    <fieldset name="step4">
                                        <div class="form-card">
                                            <div class="mb-30">
                                                <h6 class="navy-blue mb-3">7) What activities do you enjoy most while traveling? (Select all that apply)</h6>
                                                <textarea class="form-control" rows="3" qid="7"></textarea>
                                            </div>
                                            <div class="mb-30">
                                                <h6 class="navy-blue mb-3">8) How do you prefer to book your travel arrangements?</h6>
                                                <textarea class="form-control" rows="3" qid="8"></textarea>
                                            </div>
                                        </div>
                                        <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                                        <input type="button" name="next" class="next action-button" value="Next" />
                                    </fieldset>
                                    <fieldset name="step5">
                                        <div class="form-card">
                                            <div class="mb-30">
                                                <h6 class="navy-blue mb-3">9) How important is sustainable/eco-friendly travel to you?</h6>
                                                <textarea class="form-control" rows="3" qid="9"></textarea>
                                            </div>
                                            <div class="mb-30">
                                                <h6 class="navy-blue mb-3">10) How do you typically document your travel experiences?</h6>
                                                <textarea class="form-control" rows="3" qid="10"></textarea>
                                            </div>
                                        </div>
                                        <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                                        <input type="button" name="next" class="next action-button" value="Finish" />
                                    </fieldset>
                                    <fieldset name="step6">
                                        <div class="form-card">
                                            <h2 class="fs-title text-center">Success !</h2>
                                            <br>
                                            <div class="row justify-content-center">
                                                <div class="col-3">
                                                    <img src="https://img.icons8.com/color/96/000000/ok--v2.png" class="fit-image">
                                                </div>
                                            </div>
                                            <div class="row justify-content-center mt-3">
                                                <div class="col-6 text-center">
                                                    <a href="#" id="viewInvoiceLink" class="btn btn-primary action-button w-75">View Your Invoice</a>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row justify-content-center">
                                                <div class="col-7 text-center">
                                                    <h5>You Have Successfully Completed The Survey</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                </fieldset>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    include 'include/footer.php';
    include 'include/footer-scripts.php';
    ?>

    <script type="text/javascript">
        function saveDataAndSend(fieldID) {
            var formDataArray = [];
            var fieldset = $('fieldset[name="' + fieldID + '"]');
            var ResponsID = $('#hdnMainEnrollId').val();

            // Loop through selected input elements within the fieldset
            fieldset.find('input:checked, input[type="text"], select, textarea').each(function() {
                var fieldName = $(this).attr('name');
                var qidValue = $(this).attr('qid'); // Retrieve the qid attribute value
                var value = $(this).val();

                if (fieldName !== "txtFullname") {
                    // Debug information
                    console.log("Fieldname- " + fieldName + " -- qid-" + qidValue + "--" + value);

                    // Store field name, qid, and value in a field data object
                    var fieldData = {
                        qid: qidValue,
                        answer: value,
                        SR_Id: ResponsID
                    };

                    // Push the field data object into the formDataArray
                    formDataArray.push(fieldData);
                }
            });

            console.log(formDataArray);

            // Send data to the server using AJAX
            $.ajax({
                url: 'save_answers.php',
                type: 'POST',
                data: {
                    formData: formDataArray
                },
                success: function(response) {
                    console.log('Data saved successfully:', response);
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        }
    </script>

</body>

</html>