<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <link rel="icon" href="trial.png">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" 
    crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

<div class="container my-5 text-center">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8 col-sm-10">
                <div class="card">
                    <div class="card-header">
                    <a class="text-center">
                        <img src="trial.png" alt="Logo" class="logo">
                    </a>
                        <h3 class="text-center">Register</h3>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="form-group">
                                <label for="username">Username:</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="text" class="form-control" id="email" name="email" oninput="this.value= this.value.replace(/\s/g, '')" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="password" name="password" oninput="this.value= this.value.replace(/\s/g, '')" required
                                    pattern="^(?=.*[!@#$%^&*])\S{8,12}$"
                                    title="Password must be 8-12 characters long and contain at least one special character (!@#$%^&*)">
                                    <div class="input-group-append">
                                        <span class="input-group-text bg-transparent border-0" id="togglePassword">
                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="mobile">Mobile Number:</label>
                                <input type="text" class="form-control" id="mobile" name="mobile" maxlength="11" oninput="this.value=this.value.replace(/[^0-9]/g, '')" required
                                    pattern="[0-9]{11}"
                                    title="Mobile should have 11 numbers">
                            </div>
                            <div class="form-group">
                                <label for="secretword">Secret Word:</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="secretword" name="secretword" oninput="this.value= this.value.replace(/\s/g, '')" required
                                    pattern="^(?=.*[!@#$%^&*])\S{8,12}$" 
                                    title="Password must be 8-12 characters long and contain at least one special character (!@#$%^&*)">
                                    <div class="input-group-append">
                                        <span class="input-group-text bg-transparent border-0" id="toggleSecret">
                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>


                            <button type="submit" class="btn btn-primary btn-block">Register</button>
                        </form>
                    </div>
                    <div class="card-footer">
                        <p class="text-center">Already have an account?</p>
                        <p class="text-center"> <a href="login.php">Login here.</a><p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
// session_start();

$conn = mysqli_connect('localhost','root','','bdm_system');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $encpass = md5($password, $secretword);
    $mobile = $_POST["mobile"];
    $secretword = $_POST["secretword"];
    

    // check if user already exists in the table
    $check_query = "SELECT * FROM users WHERE username='$username'";
    $check_result = $conn->query($check_query);
    if ($check_result->num_rows > 0) {
        echo '<script>Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "Username already exists. Please choose a different username.",
            confirmButtonColor: "#3085d6",
            confirmButtonText: "OK"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href="register.php";
                }
            });
        </script>';
        exit;
    }

    // insert new user into table
    $insert_query = "INSERT INTO users (username, email, password, mobile, secretword) VALUES ('$username','$email', '$encpass','$mobile','$encpass')";
    if ($conn->query($insert_query) === TRUE) {
        // set session variable to indicate user is logged in
        $_SESSION["loggedin"] = true;

        // redirect to donation.php
        echo '<script>Swal.fire({
            icon: "success",
            title: "Registered successfully!",
            confirmButtonColor: "#3085d6",
            confirmButtonText: "OK"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href="login.php";
                }
            });
        </script>';
        exit;
    } else {
        echo '<script>Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "Error registering user. Please try again.",
            confirmButtonColor: "#3085d6",
            confirmButtonText: "OK"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href="register.php";
                }
            });
        </script>';
        exit;
    }
}

$conn->close();
?>

<style>

.logo {
    width: 80px; /* Adjust the width as needed */
    height: auto; /* Maintain aspect ratio */
    margin-right: 10px; /* Add some spacing between the logo and heading */
}

*{
    margin: 0;
    padding: 0;
    box-sizing:border-box;
}
body{
    background-image:url(bg.png);
    background-size: cover;
    height:auto;
    width:100%;
    background-position:center;
    background-repeat: no-repeat;

}

.card {
    box-shadow: 15px 15px 10px rgba(0, 0, 0, 0.8);
    border-radius: 10px;
}

.card-header h3 {
    font-size: 2.5rem;
    font-family: Arial, Helvetica, sans-serif;
    margin: 10px;
}

.form-control {
    padding: 12px;
    width: 93%;
    margin: 15px;
    border: 1px solid black;
    outline: none;
    border-radius: 20px;
}

.btn {
    padding: 12px 30px;
    width: 40%;
    margin: 40px auto 0;
    display: block;
    background-color: blue;
    color: white;
    font-weight: bold;
    border: none;
    outline: none;
    border-radius: 20px;
}

.input-group-text {
        cursor: pointer;
    }

    .input-group-text i {
        color: #000; /* Change this to the desired eye icon color */
        margin-top: 10px;
        
    }

    .input-group-text i:hover {
        color: #007bff; /* Change this to the desired eye icon color on hover */
    }

</style>
<script>
    const togglePassword = document.querySelector('#togglePassword');
    const toggleSecret = document.querySelector('#toggleSecret');
    const password = document.querySelector('#password');
    const secretword = document.querySelector('#secretword');

    togglePassword.addEventListener('click', function (e) {
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        this.querySelector('i').classList.toggle('fa-eye-slash');
    });

    toggleSecret.addEventListener('click', function (e) {
        const type = secretword.getAttribute('type') === 'password' ? 'text' : 'password';
        secretword.setAttribute('type', type);
        this.querySelector('i').classList.toggle('fa-eye-slash');
    });
</script>


    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" 
    integrity="sha384-q8i/X+965DzO0"
    crossorigin="anonymous"></script>

</body>
</html>


