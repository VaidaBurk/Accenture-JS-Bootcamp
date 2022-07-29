<html>
    <head>
        <?php include("header.php")?>
    </head>
    <body>
        <div class="m-5">
            <form action="" method="POST">
                <input class="form-control" type="file" name="fileName">
                <button class="btn btn-secondary mt-3">Read</button>
            </form>
        </div>
        <?php
        if (isset($_POST["fileName"])) {

            if (is_array(getimagesize($_POST["fileName"]))) {
                echo ("<img class='mx-5 my-3 shadow' src='" . $_POST["fileName"] . "' height=300>");
            }

            else {
                $fileName = $_POST["fileName"];
                $file = fopen($fileName, "r");
                if($file == false){
                    echo("<h2>File can't be opened.</h2>");
                    exit();
                }

                $csvContentLineArr = fgetcsv($file, filesize($fileName), " ;");
                if ($csvContentLineArr){
                    exit();
                }
                
                echo("<div class='row'>");

                foreach ($csvContentLineArr as $fieldName) {
                    echo("<div class='col'>");
                    echo $fieldname;
                    echo ("</div>");
                }
                    
                echo("</div>");

                while($csvContentLineArr = fgetcsv($file, filesize($fileName), " ;")){
                    echo("<div class='row'>");
                    foreach ($csvContentLineArr as $fieldName) {
                        echo("<div class='col'>");
                        echo $fieldname;
                        echo ("</div>");
                    }
                    echo("</div>");
                }

                fclose($file);

                $text = fread($file, filesize($fileName));
                fclose($file);
                echo("<pre class='mx-5 my-3 p-5 border shadow'>$text</pre>");
            }
        }
        ?>
    </body>
</html>