<?php //printf($_GET['id']);


?>
<!DOCTYPE html>
<html>
<head>
<style>
table, th, td {
    border: 1px solid black;
}
</style>
</head>
<body>

<style>

    #loadImg{
      position:absolute;
      left:35%;
      top:35%;

    }

  </style>
  <script>
  var stopurl="<?php printf($_GET['stopurl']); ?>";
  console.log('stop url in temp:'+encodeURI(stopurl));
  </script>
      <div id="loadImg"><div><img src="ajax-loader3.gif" /></div></div>
         <iframe border=0 name=iframe src="orari.php?id=<?php printf($_GET['id']); ?>&amp;stopurl=<?php printf(urlencode($_GET['stopurl'])); ?>" width="100%" height="733" scrolling="no" frameborder="0" onload="document.getElementById('loadImg').style.display='none';"></iframe>
       </body>
       </html>
