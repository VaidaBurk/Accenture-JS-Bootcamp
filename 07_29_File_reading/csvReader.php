<html>

<head>
    <?php include("header.php") ?>
</head>

<body>
    <div class="container border pt-5 pb-3 px-5 mt-5">
    <div>
        <form action="" method="POST">
            <input class="form-control" type="file" name="fileName">
            <button class="btn btn-secondary my-3">Read</button>
        </form>
    </div>

        <?php
        if (isset($_POST["fileName"])) {
            $fileName = $_POST["fileName"];
            $file = fopen($fileName, "r");
            if ($file == false) {
                echo ("<h2>File can't be opened.</h2>");
                exit();
            }


            $csvContentLineArr = fgetcsv($file, filesize($fileName), ",");
            if (!$csvContentLineArr) {
                exit();
            }
            echo ('<table class="table">');
            echo ('<thead>');
            echo ('<tr>');
            foreach ($csvContentLineArr as $fieldName) {
                echo ('<th scope="col">');
                echo $fieldName;
                echo ('</th>');
            }
            echo ('</tr>');
            echo ('</thead>');

            while ($csvContentLineArr = fgetcsv($file, filesize($fileName), ",")) {
                echo ('<tbody>');
                echo ('<tr>');
                foreach ($csvContentLineArr as $fieldValue) {
                    echo ('<td>');
                    echo $fieldValue;
                    echo ('</td>');
                }
                echo ('</tr>');
                echo ('</tbody>');
            }
            echo ('</table>');
            fclose($file);
        }
        ?>


        <?php
        if (isset($_POST["fileName"])) { ?>
            <form method="post" action="saveFromFile.php">
                <button class="btn btn-secondary mt-3" type="submit">Save to Database</button>
                <input hidden name="fileSave" id="fileSave" value="<?= $_POST["fileName"] ?>">
            </form> <?php
                } ?>

    </div>
    </div>
</body>

</html>