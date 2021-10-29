<?php
$html = ob_get_clean();
echo view('obclean', ['html' => $html ]);
