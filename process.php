<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body class="container">
    <?php
    if (isset($_FILES['uploadedName'])) {
        $imageFileType = mb_substr($_FILES['uploadedName']['type'], 0, mb_stripos($_FILES['uploadedName']['type'], '/'));

        $uploadSuccess = true;

        if ($_FILES['uploadedName']['error']) {
            $uploadSuccess = false;
        }

        if ($_FILES['uploadedName']['size'] > 8000000 || $_FILES['uploadedName']['size'] <= 0) {
            echo 'Soubor má špatnou velikost. ';
            $uploadSuccess = false;
        }

        if (!in_array($imageFileType, ['image', 'video', 'audio'])) {
            echo 'Bohužel nepodporovaný typ souboru. ';
            $uploadSuccess = false;
        }

        if (!$uploadSuccess) {
            echo 'Bohužel došlo k chybě uploadu. ';
        } else {
            $targetFile = './uploads/' . basename($_FILES['uploadedName']['name']);
            if (move_uploaded_file($_FILES['uploadedName']['tmp_name'], $targetFile)) {
                switch ($imageFileType) {
                    case 'image':
                        echo '<img class="rounded img-fluid" src="' . $targetFile . '" />';
                        break;
                    case 'video':
                        echo '<video class="container" src="' . $targetFile . '" controls>Bohužel nepodporovaný typ souboru</video>';
                        break;
                    case 'audio':
                        echo '<audio src="' . $targetFile . '" controls>Bohužel nepodporovaný typ souboru</audio>';
                        break;
                    default:
                        echo 'Bohužel nepodporovaný typ souboru. ';
                        break;
                }
            } else {
                echo 'Bohužel došlo k chybě uploadu. ';
            }
        }
    } else {
        echo 'Bohužel došlo k chybě uploadu. ';
    }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>