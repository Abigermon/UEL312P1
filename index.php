
<?php
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

require_once 'vendor/autoload.php';

$loader = new FilesystemLoader('src/Template/');
$twig = new Environment($loader);

echo $twig->render('index.twig', ['auteurs' => 'Abigail Germon , Vincent Ackermann, Hillel Magnichewer et Hugo Rytlewski']);
