<html>
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
   <script src="jquery.min.js" type="text/javascript"></script>
   <title>Test Page</title>
   <script>
    function passVal(){
        var id = 13;

        $.post("print.php", id);
    }
    passVal();
   </script>

</head>
<body>
</body>
</html>