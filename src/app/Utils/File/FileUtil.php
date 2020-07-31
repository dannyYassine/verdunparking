<?php namespace App\Utils;

class FileUtil
{
    /**
     * @param string $name
     * @param $file
     *
     * @return string
     */
    public function save(string $name, $file): string
    {
        $path = TMP.'/'.$name;
        file_put_contents($path, $file);
        return $path;
    }

    /**
     * @param string $name
     * @param $file
     *
     * @return string
     */
    public function saveAudio(string $name, $file): string
    {
        $this->save($name.'.wav', $file);
    }
}
