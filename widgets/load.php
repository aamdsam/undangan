<head>

	<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
	<script type="text/javascript" >
       var auto_refresh = setInterval(
	    function ()
	    {
	      $('#load').load('tabel_dispenda.php').fadeIn("slow");

	    }, 1000); // setiap 10000 milliseconds (10 detik)
	</script>
	 <script type="text/javascript" >
       var auto_refresh = setInterval(
            function ()
            {
              $('#loadwaktu').load('loadwaktu.php').fadeIn("slow");

            }, 900); // setiap 10000 milliseconds (10 detik)
        </script>

</head>
<body><div id="loadwaktu"></div>
<br>
<div id="load"></div>
</body>
