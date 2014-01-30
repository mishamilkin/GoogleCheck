<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Pie Chart</title>
	<link href="views/pie/css/examples.css" rel="stylesheet" type="text/css">
	<!--[if lte IE 8]>
    <script language="javascript" type="text/javascript" src="views/js/excanvas.min.js"></script>
    <![endif]-->
	<script language="javascript" type="text/javascript" src="views/js/jquery.min.js"></script>
	<script language="javascript" type="text/javascript" src="views/pie/js/jquery.flot.min.js"></script>
	<script language="javascript" type="text/javascript" src="views/pie/js/jquery.flot.pie.min.js"></script>
	<script type="text/javascript">
	$(function() {
		var data = <?=$data;?>;
		var placeholder = $("#placeholder");
		$("#example").click(function() {
            $.get( "./", {c: "stat"}, function(res) {
                if(res!=0){
                    pie(placeholder,res);
                }else{
                    alert('ошибка!');
                }
            }, "json");
        });
        pie(placeholder,data);
	});
    function pie(placeholder, data){
        if(data=='') return false;
        placeholder.unbind();
        $.plot(placeholder, data, {
            series: {
                pie: {
                    show: true
                }
            },
            legend: {
                show: false
            }
        });
    }
	</script>
</head>
<body>
	<div id="header">
		<h2>Статистика</h2>
	</div>
	<div id="content">
		<div class="container">
			<div id="placeholder" class="placeholder"></div>
			<div id="menu">
				<button id="example">Обновить</button>
			</div>
		</div>
	</div>
</body>
</html>
