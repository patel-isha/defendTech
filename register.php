<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'config/connection.php';

function sanitize_input($data)
{
  return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Retrieve and sanitize form data
  $fname = sanitize_input($_POST["fname"]);
  $lname = sanitize_input($_POST["lname"]);
  $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
  $contact_no = sanitize_input($_POST["phone"]);
  $designation = sanitize_input($_POST["designation"]);
  $gender = sanitize_input($_POST["gender"]);
  $password = SHA1($_POST["password"]);
  $last_id = "";

  // Validate email
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Invalid email format");
  }

    // Check if email exist
    $sqlEmail = "SELECT * FROM users WHERE email = '$email'";

    $result = $conn->query($sqlEmail);

    if ($result->num_rows > 0) {
        throw new InvalidArgumentException('Email already exists');
    }

  // Validate phone number (optional: add more specific validation if needed)
  if (!preg_match('/^[0-9]{10,11}$/', $contact_no)) {
    die("Invalid phone number format");
  }

  //SQL query to insert data into the database
  $sql = "INSERT INTO `users`(`first_name`, `last_name`, `email`, `contact_no`, `designation`, `gender`, `password`) 
  VALUES ('$fname', '$lname', '$email', '$contact_no', '$designation', '$gender', '$password')";

  //Execute the query
  if ($conn->query($sql) === TRUE) {
    $last_id = mysqli_insert_id($conn);

    echo "<h3>User Added Successfully!</h3>";
    echo "<script> location.href='login.php'; </script>";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
    die;
  }
}
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

  <!-- ================================
       START CONTACT AREA
================================= -->
  <section class="contact-area position-relative pt-20">
    <span class="ring-shape ring-shape-1"></span>
    <span class="ring-shape ring-shape-2"></span>
    <span class="ring-shape ring-shape-3"></span>
    <span class="ring-shape ring-shape-4"></span>
    <span class="ring-shape ring-shape-5"></span>
    <span class="ring-shape ring-shape-6"></span>
    <span class="ring-shape ring-shape-7"></span>
    <div class="container">
      <div class="row">
        <div class="col-lg-7 mx-auto">
          <div class="card card-item">
            <div class="card-body pt-0">
              <h3 class="card-title text-center fs-24 lh-35 pb-4">
                Create an Account and <br />
                Start Learning!
              </h3>
              <div class="section-block"></div>
              <form method="post" class="pt-4">
                <div class="row">
                  <div class="col-lg-6 mx-auto">
                    <div class="input-box">
                      <label class="label-text">First Name <span class="text-danger">*</span></label>
                      <div class="form-group">
                        <input class="form-control form--control" type="text" name="fname" id="fname" placeholder="First name" required />
                        <span class="la la-user input-icon"></span>
                      </div>
                    </div>
                  </div>
                  <!-- end input-box -->
                  <div class="col-lg-6 mx-auto">
                    <div class="input-box">
                      <label class="label-text">Last Name <span class="text-danger">*</span></label>
                      <div class="form-group">
                        <input class="form-control form--control" type="text" name="lname" id="lname" placeholder="Last name" required />
                        <span class="la la-user input-icon"></span>
                      </div>
                    </div>
                  </div>
                  <!-- end input-box -->
                  <div class="col-lg-6 mx-auto">
                    <div class="input-box">
                      <label class="label-text">Email Address <span class="text-danger">*</span></label>
                      <div class="form-group">
                        <input class="form-control form--control" type="email" name="email" id="email" placeholder="Enter email address" required />
                        <span class="la la-envelope input-icon"></span>
                      </div>
                    </div>
                  </div>
                  <!-- end input-box -->
                  <div class="col-lg-6 mx-auto">
                    <div class="input-box">
                      <label class="label-text">Contact No. <span class="text-danger">*</span></label>
                      <div class="form-group">
                        <input class="form-control form--control" type="tel" name="phone" id="phone" placeholder="1234567890" pattern="[0-9]{10,11}" required />
                        <span class="la la-phone input-icon"></span>
                      </div>
                    </div>
                  </div>
                  <!-- end input-box -->

                  <div class="col-lg-6 mx-auto">
                    <div class="input-box">
                      <label class="label-text">Gender <span class="text-danger">*</span></label>
                      <div class="form-control-wrap">
                        <ul class="custom-control-group d-flex justify-content-between">
                          <li>
                            <div class="custom-control custom-radio">
                              <input type="radio" class="custom-control-input" name="gender" value="male" id="sex-male" checked required>
                              <label class="custom-control-label" for="sex-male">Male</label>
                            </div>
                          </li>
                          <li>
                            <div class="custom-control custom-radio">
                              <input type="radio" class="custom-control-input" name="gender" value="female" id="sex-female" required>
                              <label class="custom-control-label" for="sex-female">Female</label>
                            </div>
                          </li>
                          <li>
                            <div class="custom-control custom-radio">
                              <input type="radio" class="custom-control-input" name="gender" value="other" id="sex-other" required>
                              <label class="custom-control-label" for="sex-other">Others</label>
                            </div>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                  <!-- end input-box -->
                  <div class="col-lg-6 mx-auto"></div>

                  <div class="col-lg-6 mx-auto">
                    <div class="input-box">
                      <label class="label-text">Designation <span class="text-danger">*</span></label>
                      <div class="form-group select2-full-wrapper">
                        <div class="select-container w-auto">
                          <select class="select-container-select" name="designation" id="designation" required >
                            <option value="">
                              Select your designation
                            </option>
                            <option value="student/Learner">Student/Learner</option>
                            <option value="tutor">Tutor</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <!-- end input-box -->
                  </div>
                  <!-- end input-box -->
                  <div class="col-lg-6 mx-auto">
                    <div class="input-box">
                      <label class="label-text">Password <span class="text-danger">*</span></label>
                      <div class="input-group mb-3">
                        <span class="la la-lock input-icon z-index-6"></span>
                        <input class="form-control form--control top-bottom-left-radius-5 password-field" type="password" name="password" id="password" placeholder="Enter your password" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required />

                        <button class="btn theme-btn theme-btn-transparent toggle-password" type="button">
                          <svg class="eye-on" xmlns="http://www.w3.org/2000/svg" height="22px" viewBox="0 0 24 24" width="22px" fill="#7f8897">
                            <path d="M0 0h24v24H0V0z" fill="none" />
                            <path d="M12 6c3.79 0 7.17 2.13 8.82 5.5C19.17 14.87 15.79 17 12 17s-7.17-2.13-8.82-5.5C4.83 8.13 8.21 6 12 6m0-2C7 4 2.73 7.11 1 11.5 2.73 15.89 7 19 12 19s9.27-3.11 11-7.5C21.27 7.11 17 4 12 4zm0 5c1.38 0 2.5 1.12 2.5 2.5S13.38 14 12 14s-2.5-1.12-2.5-2.5S10.62 9 12 9m0-2c-2.48 0-4.5 2.02-4.5 4.5S9.52 16 12 16s4.5-2.02 4.5-4.5S14.48 7 12 7z" />
                          </svg>
                          <svg class="eye-off" xmlns="http://www.w3.org/2000/svg" height="22px" viewBox="0 0 24 24" width="22px" fill="#7f8897">
                            <path d="M0 0h24v24H0V0zm0 0h24v24H0V0zm0 0h24v24H0V0zm0 0h24v24H0V0z" fill="none" />
                            <path d="M12 6c3.79 0 7.17 2.13 8.82 5.5-.59 1.22-1.42 2.27-2.41 3.12l1.41 1.41c1.39-1.23 2.49-2.77 3.18-4.53C21.27 7.11 17 4 12 4c-1.27 0-2.49.2-3.64.57l1.65 1.65C10.66 6.09 11.32 6 12 6zm-1.07 1.14L13 9.21c.57.25 1.03.71 1.28 1.28l2.07 2.07c.08-.34.14-.7.14-1.07C16.5 9.01 14.48 7 12 7c-.37 0-.72.05-1.07.14zM2.01 3.87l2.68 2.68C3.06 7.83 1.77 9.53 1 11.5 2.73 15.89 7 19 12 19c1.52 0 2.98-.29 4.32-.82l3.42 3.42 1.41-1.41L3.42 2.45 2.01 3.87zm7.5 7.5l2.61 2.61c-.04.01-.08.02-.12.02-1.38 0-2.5-1.12-2.5-2.5 0-.05.01-.08.01-.13zm-3.4-3.4l1.75 1.75c-.23.55-.36 1.15-.36 1.78 0 2.48 2.02 4.5 4.5 4.5.63 0 1.23-.13 1.77-.36l.98.98c-.88.24-1.8.38-2.75.38-3.79 0-7.17-2.13-8.82-5.5.7-1.43 1.72-2.61 2.93-3.53z" />
                          </svg>
                        </button>
                      </div>
                    </div>
                    <!-- end input-box -->
                  </div>
                  <!-- end input-box -->
                </div>

                <div class="custom-control custom-checkbox mb-4 fs-15">
                  <input type="checkbox" class="custom-control-input" id="agreeCheckbox" required />
                  <label class="custom-control-label custom--control-label" for="agreeCheckbox">by signing I agree to the
                    <a href="terms-and-conditions.php" class="text-color hover-underline">terms and conditions</a>
                    and
                    <a href="privacy-policy.php" class="text-color hover-underline">privacy policy</a>
                  </label>
                </div>
                <!-- end custom-control -->
                <div class="btn-box">
                  <button class="btn theme-btn" type="submit">
                    Register
                    <i class="la la-arrow-right icon ms-1"></i>
                  </button>
                  <p class="fs-14 pt-2">
                    Already have an account?
                    <a href="login.php" class="text-color hover-underline">Log in</a>
                  </p>
                </div>
                <!-- end btn-box -->
              </form>
            </div>
            <!-- end card-body -->
          </div>
          <!-- end card -->
        </div>
        <!-- end col-lg-7 -->
      </div>
      <!-- end row -->
    </div>
    <!-- end container -->
  </section>
  <!-- end contact-area -->
  <!-- ================================
       END CONTACT AREA
================================= -->
  <?php
  include 'include/footer.php';
  ?>

  <!-- start scroll top -->
  <div id="scroll-top">
    <i class="la la-arrow-up" title="Go top"></i>
  </div>
  <!-- end scroll top -->

  <?php
  include 'include/footer-scripts.php';
  ?>
  <script>
      $(document).ready(function () {
          $("#registerForm").validate({
              rules: {
                  fname: "required",
                  lname: "required",
                  password: {
                      required: true,
                      minlength: 5
                  },
                  email: {
                      required: true,
                      email: true,
                  },
              },
              messages: {
                  fname: "Enter your firstname",
                  lname: "Enter your lastname",
                  password: {
                      required: "Provide a password",
                      minlength: "Enter at least  characters"
                  },
                  email: {
                      required: "Please enter a valid email address",
                      minlength: "Please enter a valid email address",
                  },
              },
              // // the errorPlacement has to take the table layout into account
              // errorPlacement: function(error, element) {
              //     if (element.is(":radio"))
              //         error.appendTo(element.parent().next().next());
              //     else if (element.is(":checkbox"))
              //         error.appendTo(element.next());
              //     else
              //         error.appendTo(element.next());
              // },
              // specifying a submitHandler prevents the default submit, good for the demo
              // submitHandler: function() {
              //     alert("submitted!");
              // },
              // set this class to error-labels to indicate valid fields
              // success: function(label) {
              //     // set &nbsp; as text for IE
              //     label.html("&nbsp;").addClass("checked");
              // },
              // highlight: function(element, errorClass) {
              //     $(element).parent().next().find("." + errorClass).removeClass("checked");
              // }
          });
      });
  </script>
</body>

</html>
