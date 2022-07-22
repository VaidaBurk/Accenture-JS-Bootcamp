<?php
// echo "Hello World";
// if (isset($_POST["myInput"])) {
//     echo ("Your input was : " . $_POST["myInput"]);
// }
?>

<html>
    <head>
        <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
        <!-- JavaScript Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>    
    </head>
    <body>
        <div class="container">
            <h2 class="mb-5 mt-5">Enter the customer:</h2>
            <form action="addCustomer.php" method="POST">
                <div class="form-group">
                    <div class="mb-3">
                        <label for="FirstName" class="form-label">First Name</label>
                        <input type="text" class="form-control" name="FirstName" id="FirstName">
                    </div>
                    <div class="mb-3">
                        <label for="LastName" class="form-label">Last Name</label>
                        <input type="text" class="form-control" name="LastName" id="LastName">
                    </div>
                    <div class="mb-3">
                        <label for="Email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="Email" id="Email">
                    </div>
                    <div class="mb-3">
                        <label for="Phone" class="form-label">Phone number</label>
                        <input type="number" class="form-control" name="Phone" id="Phone">
                    </div>
                    <button class="btn btn-secondary">Save</button>
                </div>
            </form>
        </div>
    </body>
</html>