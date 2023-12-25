#!/usr/local/bin/php
<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width" />
        <script src="post.jsv1" defer></script>
        <title>Our Posts</title>
    </head>

    <body>
        <header><h1>Blog posts</h1></header>
         
        <main>
            <form method="POST" action="post.php">
                <label for="author">Author: </label>
                <input type="text" id="author" name="author" value= "<?php echo $_COOKIE["username"] ?>">
                
                <br>

                <label for="content">Content: </label>
                <textarea id="content" name="content"></textarea>

                <input type="submit" value="Submit Post"> 
            </form>

            <section>
                <h2>Posts by other users:</h2>
                
                
                
                
                <?php
                if(file_exists('post.txt')){
                    readfile('post.txt');
                }
        
        ?>
               
            
            </section>
            <script>

const authorTextbox = document.getElementById('author');
const defaultUsername = get_username();
    
function get_username() {
    const nvs = document.cookie.split(';');

    for (const nv of nvs) {
        if (nv.startsWith("username=")) {
            return nv.substring("username=".length); 
        }
    }
    return "";
}
        

    </script>
        </main>

   

    <footer>
      <hr>
      <small>
        &copy; Armine Meseldzhyan, 2023
      </small>
    </footer>


    </body>
</html>
