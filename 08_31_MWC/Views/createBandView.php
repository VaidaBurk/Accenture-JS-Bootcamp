<?php 
include('header.php');
include('message.php');
?>

 <div class="container">
        <div class="row d-flex justify-content-center mt-5">
            <div class="col-6 rounded-2 bg-dark shadow p-5">
                <h3 class="mb-5 text-bg-dark">Add new band:</h3>
                <form action="addCustomer.php" method="POST">
                    <div class="form-group">
                        <div class="mb-3">
                            <label for="title" class="form-label text-bg-dark">Title</label>
                            <input type="text" class="form-control" name="title">
                        </div>
                        <div class="mb-3">
                            <label for="lead-artist" class="form-label text-bg-dark">Lead Artist</label>
                            <input type="text" class="form-control" name="lead-artist">
                        </div>
                        <div class="mb-3">
                            <label for="genres" class="form-label text-bg-dark">Genres</label>
                            <input type="text" class="form-control" name="genres">
                        </div>
                        <div class="mb-3">
                            <label for="year-foundation" class="form-label text-bg-dark">Year of Foundation</label>
                            <input type="text" class="form-control" name="year-foundation">
                        </div>
                        <div class="mb-3">
                            <label for="origin" class="form-label text-bg-dark">Origin</label>
                            <input type="text" class="form-control" name="origin">
                        </div>
                        <div class="mb-3">
                            <label for="website" class="form-label text-bg-dark">Website</label>
                            <input class="form-control" type="text" name="website">
                        </div>
                        <button class="btn btn-light mt-3">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php include('footer.php') ?>