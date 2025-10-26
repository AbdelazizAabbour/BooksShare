<?php
function redirect($url){ header('Location: ' . $url); exit; }
function old($key){ return $_POST[$key] ?? ''; }
