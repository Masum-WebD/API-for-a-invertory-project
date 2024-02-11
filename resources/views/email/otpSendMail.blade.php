<h2 class="text-center">{{$otp}}</h2>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>OTP Verification</title>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <h3 class="text-center">OTP Verification</h3>
          </div>
          <div class="card-body">
            <p>Dear User,</p>
            <p>Your One-Time Password (OTP) for verification is:</p>
            <h2 class="text-center">{{$otp}}</h2>
            <p>Please use this code to complete the verification process. The code is valid for a limited time.</p>
            <p>Thank you for using our service!</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS and Popper.js (Optional) -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
