<?php

require_once 'vendor/autoload.php';

use Hoa\Compiler\Llk\Llk;
use Hoa\File\Read;
use Hoa\Math\Sampler\Random;

function generateFixture($file)
{
    $jsonFileName = str_replace('.' . $file->getExtension(), '.json', $file->getFilename());
    $jsonDir = 'tmp/';

    if (!is_dir($jsonDir)) {
        mkdir($jsonDir);
    }

    $sampler = new \Hoa\Compiler\Llk\Sampler\Coverage(
        Llk::load(
            new Read($file->getPathName())
        ),
        new \Hoa\Regex\Visitor\Isotropic(
            new Random()
        )
    );

    $json = array();
    foreach ($sampler as $value) {
        $json[] = json_decode($value, true);
    }

    file_put_contents($jsonDir . $jsonFileName, json_encode($json));
}

generateFixture(new \SplFileInfo('test.pp'));
