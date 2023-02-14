<?php

declare(strict_types=1);

$finder = PhpCsFixer\Finder::create()
  ->ignoreDotFiles(false)
  ->ignoreVCSIgnored(true)
  ->in('src');

return (new PhpCsFixer\Config())
  ->setRiskyAllowed(true)
  ->setRules([
    '@PSR2' => true,
    '@Symfony' => true,
    'array_syntax' => ['syntax' => 'short'],
    'declare_strict_types' => true,
    'no_empty_phpdoc' => false,
    'no_superfluous_phpdoc_tags' => false,
    'phpdoc_separation' => false,
    'strict_param' => true,
    'native_function_invocation' => ['include' => ['@internal']],
  ])
  ->setFinder($finder)
;
