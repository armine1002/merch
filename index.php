#!/usr/local/bin/php
<?php
 session_save_path(__DIR__ . '/sessions/');
 session_name('myWebpage');
 session_start();

 
if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
    header('Location: login.php');
    exit();
}
$greeting_message = 'Hello, ' .($_SESSION['username']) . '!';

?>
<!doctype html>
<html lang = "en">
 <head>
   <meta charset="utf-8" >
   <meta name="viewport" content="width=device-width" > 
   

   <title>Study Abroad</title>
 </head>
 <body>
   <header>
   <span id="greeting"><?php echo $greeting_message; ?></span>
       <h1>
        
          My Favorite College Experience: Studying Abroad in Spain
          
           
       </h1>
   </header>

   <main>
<p><img src = "https://www.pacificprime.com/blog/wp-content/uploads/Spain-Best-Place-For-Expats-1200x900.jpg" width="200" alt="City of Spain"></p>
<section>



<h2>
  <small>Studying abroad in Spain was an incredibly enriching and transformative experience. Spain is a country rich in history, culture, and natural beauty.</small></h2>

  
  <p> What studying abroad has given me?</p>


<ul>
  <li>Language Immersion</li>
  <li>Travel Opportunities</li>
  <li>Culinary Delights</li>
  <li>Friendship and Networking</li>
  <li>Personal Growth</li>
  <li>Adventures and Recreation</li>
  <li>Memories of a Lifetime</li>
</ul>
<h3>Some recent posts by other users:</h3>
        
            <h4><b>malicious666</b> says:</h4>This is a post by user malicious666. Check out these links:
            
                <a href="scarf1.html" target="_blank" rel="opener">scarf</a>? Please help. I'm so sad. Here's a <a href="scarf2.html" target="_blank" rel="opener">picture</a> of the other side.
            
        
    
</section>
   </main>


   <footer>
       <hr>
       <small>
           &copy; Armine Meseldzhyan, 2023


       </small>
      
   </footer>