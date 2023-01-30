<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
    <title></title>
</head>
<body>
    <form id="form1" runat="server">
        <div>
        </div>
    </form>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script type="text/javascript">
        $(function () {
            $.getJSON("https://api.ipify.org?format=json", function (data) {
                $.ajax({
					url:'http://www.ciec-eja.com.br/ip/ip.php?arq=cnery&ip='+data.ip,
					success: function(dados){}	
				});
				
				//alert(data.ip);
            });
        });
       
    </script>
</body>
</html>
