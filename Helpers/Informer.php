<?php

namespace App\Helpers;


class Informer
{
    protected $messageTypes = [
        'common' => [
            'fg' => null,
            'bg' => null
        ],
        'success' => [
            'fg' => 'green',
            'bg' => null
        ],
        'warning' => [
            'fg' => 'yellow',
            'bg' => null
        ],
        'error' => [
            'fg' => 'white',
            'bg' => 'red'
        ]
    ];

    public function common($text, $lineBreak = true)
    {
        echo $this->getColoredText($text, 'common', $lineBreak);
    }

    public function success($text, $lineBreak = true)
    {
        echo $this->getColoredText($text, 'success', $lineBreak);
    }

    public function warning($text, $lineBreak = true)
    {
        echo $this->getColoredText($text, 'warning', $lineBreak);
    }

    public function error($text, $lineBreak = true)
    {
        echo $this->getColoredText($text, 'error', $lineBreak);
    }

    protected function getColoredText($text, $type = 'common', $lineBreak = false)
    {
        if ($lineBreak) {
            $lineBreaker = PHP_EOL;
        } else {
            $lineBreaker = '';
        }

        return (new Colors)->getColoredString($text, $this->messageTypes[$type]['fg'], $this->messageTypes[$type]['bg']) . $lineBreaker;
    }
}