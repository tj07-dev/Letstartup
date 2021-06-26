<?php

$file = $_FILES['pitch_doc'];

if (!empty($_FILES['pitch_doc']['name']))
{
    $fileName = $_FILES['pitch_doc']['name'];
    $fileTmpName = $_FILES['pitch_doc']['tmp_name'];
    $fileSize = $_FILES['pitch_doc']['size'];
    $fileError = $_FILES['pitch_doc']['error'];
    $fileType = $_FILES['pitch_doc']['type']; 
    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('pdf');
    if (in_array($fileActualExt, $allowed))
    {
        if ($fileError === 0)
        {
            if ($fileSize < 25000000)
            {
                $PitchFileNameNew = uniqid('', true) . "." . $fileActualExt;
                $fileDestination = 'uploads/pdfs/' . $PitchFileNameNew;
                move_uploaded_file($fileTmpName, $fileDestination);

            }
            else
            {
                header("Location: create-post.php?error=filesizeexceeded");
                exit(); 
            }
        }
        else
        {
            header("Location: create-post.php?error=fileuploaderror");
            exit();
        }
    }
    else
    {
        header("Location: create-post.php?error=invalidfiletype");
        exit();
    }
}
