#!/usr/local/bin/php
<?php
header('Content-Type: text/plain; charset=utf-8');
if (isset($_POST['content'])){
    echo "post successfully written";
    

    //empty author textbox
    if($_POST['author']=== ''){
        $_POST['author']= $_COOKIE['username'];

    }

    $author = ($_POST['author']);
    $content = ($_POST['content']);

    //file does not exist
    if(!file_exists('post.txt')){
        $file= fopen('post.txt', 'w');
        fwrite($file, "<p><b>$author</b> says: $content\n </p>");
        fclose($file);
    }

    //file exists
    else{
        $file= fopen('post.txt', 'a');
        fwrite($file, "<p><b>$author</b> says: $content\n </p>");
        fclose($file);
    }
}
else{ 
    echo"Nobody made a post";
}



?>
