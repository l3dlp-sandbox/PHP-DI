<?php

declare(strict_types=1);
use DI\ContainerBuilder;

require_once __DIR__ . '/vendor/autoload.php';

$builder = new ContainerBuilder();
$builder->useAutowiring(true);
$builder->useAnnotations(false);
$builder->compile(__DIR__ . '/tmp/call.php');
$builder->addDefinitions([
    'link' => 'Hello',
]);
$container = $builder->build();

for ($i = 0; $i < 100; $i++) {
    $container->call(function ($foo, $bar) {
    }, [
        'foo',
        'bar',
    ]);
}

for ($i = 0; $i < 100; $i++) {
    $container->call(function ($foo, $bar) {
    }, [
        'foo' => 'foo',
        'bar' => 'bar',
    ]);
}

for ($i = 0; $i < 100; $i++) {
    $container->call(function (stdClass $foo) {
    });
}

for ($i = 0; $i < 100; $i++) {
    $container->call(function ($foo, $bar) {
    }, [
        'foo' => \DI\get('link'),
        'bar' => \DI\get('link'),
    ]);
}
