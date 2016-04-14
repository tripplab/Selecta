$(document).ready(function()
{
	$(".log_in").submit(function(){
		$.post("../Scripts/consulta.php", {usuario:$("#usuario").val(), contrasenia:$("#contrasenia").val(), opcion: "Logeo"}, function(data){
			if(data !== "ok")
				alert(data);
			else
				window.location.replace("../Perfil/");
		});		
		return false;
	});
});
