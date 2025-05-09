<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/scss/_compiled/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="assets/js/script.js"></script>
    <title>Registration Form</title>
</head>
<body>
    <div class="container">
        <div class="container__image">
            <img src="./assets/images/form-image.svg" alt="" role="presentation">
        </div>
        <div class="container__form">
            <div class="container__form-heading">
                <h1>Nice To Meet You</h1>
                <p class="lead">Let's get you registered</p>
            </div>
            <form id="registration-form" action="registration.php" method="POST">      
            <div class="form-control">
                    <label for="accountType">Account type</label>
                    <select name="accountType" id="accountType" required>
                        <option value="" selected disabled>Choose an option</option>
                        <option value="Individual">Individual</option>
                        <option value="Company">Company</option>
                    </select>
                </div>
                <div class="form-control">
                    <label for="username">Username</label>
                    <input type="text" name="username" autocomplete="username" id="username" required>
                </div>
                <div class="form-control">
                    <label for="password">Password</label>
                    <input type="password" name="password" autocomplete="new-password" minlength="8" id="password" required>
                    <i class="fa fa-eye-slash" id="togglePassword" style="cursor: pointer;"></i>
                </div>
                <div class="form-control">
                    <label for="fullName" id="fullNameLabel">Full name</label>
                    <input type="text" name="fullName" autocomplete="name" id="fullName" required>
                </div>
                <div class="form-control" id="titleContainer" style="display: none;">
                    <label for="title">Contact title</label>
                    <input type="text" name="title" id="title">
                </div>
                <div class="form-control">
                    <label for="phoneNumber">Phone number</label>
                    <input type="tel" name="phoneNumber" autocomplete="tel" id="phoneNumber" required>
                </div>
                <div class="form-control">
                    <label for="email">Email address</label>
                    <input type="email" name="email" autocomplete="email" id="email" required>
                </div>
                <?php
                    $status = isset($_GET['status']) ? htmlspecialchars($_GET['status']) : '';
                ?>

                <?php if ($status === 'success'): ?>
                    <div class="registration-success">
                        <p>Registration successful!</p>
                    </div>
                <?php elseif ($status === 'error'): ?>
                    <div class="registration-error">
                        <p>There was an error with your registration. Please try again.</p>
                    </div>
                <?php elseif ($status === 'email_exists'): ?>
                    <div class="registration-exists">
                        <p>Email already exists. Please use a different one.</p>
                    </div>
                <?php elseif ($status === 'username_exists'): ?>
                    <div class="registration-exists">
                        <p>Username already exists. Please use a different one.</p>
                    </div>
                <?php endif; ?>
                <button type="submit">Register</button>
            </form>
        </div>
    </div>

</body>
</html>