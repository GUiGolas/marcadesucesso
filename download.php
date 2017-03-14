<?php
	header('Content-type: application/pdf');
	header('Content-Disposition: attachment; filename="ebook.pdf"');
	readfile('files/sample.pdf');
?> 