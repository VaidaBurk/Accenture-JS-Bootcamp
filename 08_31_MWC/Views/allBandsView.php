<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
    </script>
    <title>Bands</title>
</head>

<body>
    <div class='shadow pt-5 pb-3 px-5 m-5'>
        <table class='table table-hover table-striped table-borderless'>
            <thead class='table-dark'>
                <tr>
                    <th>Id</th>
                    <th>Title</th>
                    <th>Lead artist</th>
                    <th>Genres</th>
                    <th>Year of foundation</th>
                    <th>Origin</th>
                    <th>Website</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            <?php
            foreach ($bands as $band){
                echo (
                    "<tr>
                        <td>" . $band->getId() . "</td>
                        <td>" . $band->getTitle() . "</td>
                        <td>" . $band->getLeadArtist() . "</td>
                        <td>" . $band->getGenres() . "</td>
                        <td>" . $band->getYearFoundation() . "</td>
                        <td>" . $band->getOrigin() . "</td>
                        <td>" . $band->getWebsite() . "</td>
                        <td><a href='displayEditBand.php?id=" . $band->getId() . "' class='btn btn-primary'>Edit</a></td>
                    </tr>"
                );
            }
            ?>

            </tbody>
        </table>
    </div>
</body>

</html>