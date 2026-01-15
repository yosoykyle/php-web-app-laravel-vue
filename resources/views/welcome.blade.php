<!-- 
  =================================================================================================
  The HTML Shell (The "Frame")
  =================================================================================================
  
  ANALOGY:
  This file is like the empty picture frame or the stage of a theater.
  It sets up the basics (title, loading scripts) but stays mostly empty 
  until the actors (Vue components) come out and start performing.
-->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TaskMaster - Laravel + Vue</title>

    <!-- 
      @@vite: The "Magic Portal" 
      This line tells Laravel: "Please inject the CSS and JavaScript files here."
      It connects your backend (Laravel) to your frontend (Vue/Tailwind).
    -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <!-- 
       id="app": The "Anchor Point"
       This is where Vue "mounts" or attaches itself. 
       Vue will take control of EVERYTHING inside this div.
    -->
    <div id="app"></div>
</body>

</html>