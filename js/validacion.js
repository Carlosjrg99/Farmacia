//validación del formulario

function validaBuscar()
{
	var laboratorio = document.getElementById('laboratorio');
	if(laboratorio.selectedIndex == 0)
	{
		alert('El laboratorio es obligatorio');
		laboratorio.focus();
		return false;
	}
	return true;
}

function validaGuardar()
{
	var expNombre = /^[A-Z][a-z]+$/;
	var nombre = document.getElementById('nombre');
	if(!nombre.value.match(expNombre))
	{
		alert('Error: El nombre es obligatorio, debe ser texto y no admite espacios');
		nombre.focus();
		return false;
	}
	var laboratorio = document.getElementById('laboratorioGuardar');
	if(laboratorio.selectedIndex == 0)
	{
		alert('Error: Seleccionar laboratorio');
		laboratorio.focus();
		return false;
	}
	var stock = document.getElementById('stock');
	if (stock.value < 1)
	{
		alert('Error: El stock debe ser un número positivo');
		stock.focus();
		return false;
	}
	var precio = document.getElementById('precio');
	if (precio.value < 1) 
	{
		alert('Error: El precio debe ser positivo');
		precio.focus();
		return false;
	}
	var expObservacion = /^[A-Za-z\s,\.]+$/;
	var observacion = document.getElementById('observacion');
	if(!observacion.value.match(expObservacion))
	{
		alert('Error: Hacer observacion');
		nombre.focus();
		return false;
	}
	return true;
}