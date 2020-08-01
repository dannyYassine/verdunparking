<?php namespace App\Utils\Firebase;

use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

class FirestoreUtil
{
    private $firebase;
    private $database;

    public function __construct()
    {
        $this->firebase = (new Factory)
            ->withServiceAccount(__DIR__ . '/verdunbeach-75d51-firebase-adminsdk-4i670-d1ab143da6.json')
            ->withDatabaseUri('https://verdunbeach-75d51.firebaseio.com')
            ->create();

        $this->database = $this->firebase->getDatabase();
    }

    public function getValue()
    {
        return get_class($this->database->getReference('beachupdate')->getChild('FtLqSncuHc9TYwigX6rK')->getValue());//$this->>database->getReference('beachupdate')->getChild('FtLqSncuHc9TYwigX6rK')->getValue();
    }

    public function getPath()
    {
        return $this->database->getReference('beachupdate')->getChildKeys();
    }

}
