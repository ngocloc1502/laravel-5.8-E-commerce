function create_new_input(id) {
	alert("1");
	var row = document.createElement("section");
	var phancung = document.createElement("input");
	var thongso = document.createElement("input");
	var id_new = id + 1;

	row.className = "row";

	phancung.className += "form-control col-md-2";

	thongso.placeholder = "Nhập thông số phần cứng";
	thongso.className += "form-control col-md-4";
	thongso.addEventListener("click", create_new_input); 

	row.appendChild(phancung);
	row.appendChild(thongso);

	var section = document.getElementById('thongso');
	
	section.appendChild(row);

	del_func_input(id);
}

function del_func_input(id) {
	x = document.getElementById(id);

	x.removeEventListener('click', create_new_input);
}

function next_slide() {
	alert("1");
}

function list_accessories() {
	var filter = 		
}

function show_slide(id) {
	alert("1");
	var src = document.getElementById(0).src;
	
	document.getElementById("show_slide").src = src; 
}