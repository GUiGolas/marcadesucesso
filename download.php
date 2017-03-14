<?php
	header('Content-type: application/pdf');
	header('Content-Disposition: attachment; filename="marcadesucesso_ebook.pdf"');
	readfile('files/marcadesucesso_ebook.pdf');
?> 
