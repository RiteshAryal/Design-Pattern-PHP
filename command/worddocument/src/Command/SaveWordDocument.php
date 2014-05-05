<?php
namespace Command;

use \Receiver\WordDocument;

class SaveWordDocument implements ICommand
{
    /** @var Receiver/WordDocument */
    protected $wordDoc;

    public function __construct(WordDocument $wd)
    {
        $this->wordDoc = $wd;
    }

    public function execute()
    {
        $this->wordDoc->save();
    }
}
