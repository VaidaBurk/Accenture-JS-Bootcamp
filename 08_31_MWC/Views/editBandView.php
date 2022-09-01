<html>

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

    <div class="container">
        <div class="row d-flex justify-content-center mt-5">
            <div class="col-6 rounded-2 bg-dark shadow p-5">
                <h3 class="mb-5 text-bg-dark">Edit:</h3>
                <form action="editBand.php" method="POST">
                    <div class="form-group">
                    <div class="mb-3">
                            <input type="hidden" class="form-control" name="id" value="<?= $band->getId(); ?>">
                        </div>
                        <div class="mb-3">
                            <label for="title" class="form-label text-bg-dark">Title</label>
                            <input type="text" class="form-control" name="title" value="<?= $band->getTitle(); ?>">
                        </div>
                        <div class="mb-3">
                            <label for="lead-artist" class="form-label text-bg-dark">Lead Artist</label>
                            <input type="text" class="form-control" name="lead-artist" value="<?= $band->getLeadArtist(); ?>">
                        </div>
                        <div class="mb-3">
                            <label for="genres" class="form-label text-bg-dark">Genres</label>
                            <input type="text" class="form-control" name="genres" value="<?= $band->getGenres(); ?>">
                        </div>
                        <div class="mb-3">
                            <label for="year-foundation" class="form-label text-bg-dark">Year of Foundation</label>
                            <input type="text" class="form-control" name="year-foundation" value="<?= $band->getYearFoundation(); ?>">
                        </div>
                        <div class="mb-3">
                            <label for="origin" class="form-label text-bg-dark">Origin</label>
                            <input type="text" class="form-control" name="origin" value="<?= $band->getOrigin(); ?>">
                        </div>
                        <div class="mb-3">
                            <label for="website" class="form-label text-bg-dark">Website</label>
                            <input class="form-control" type="text" name="website" value="<?= $band->getOrigin(); ?>">
                        </div>
                        <button class="btn btn-warning mt-3" name="saveEdited">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>