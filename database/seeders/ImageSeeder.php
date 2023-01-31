<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $this->copyImages();
    }

    private function copyImages(): void
    {
        $source = storage_path('seeders');
        $destination = storage_path('app/public');
        $this->recurseCopy($source, $destination);
    }

    private function recurseCopy(
        string $sourceDirectory,
        string $destinationDirectory,
        string $childFolder = ''
    ): void {
        $directory = opendir($sourceDirectory);

        if ((is_dir($destinationDirectory) === false) && !mkdir($destinationDirectory) && !is_dir($destinationDirectory)) {
            throw new \RuntimeException(sprintf('Directory "%s" was not created', $destinationDirectory));
        }

        if ($childFolder !== '') {
            if ((is_dir("$destinationDirectory/$childFolder") === false) && !mkdir("$destinationDirectory/$childFolder") && !is_dir("$destinationDirectory/$childFolder")) {
                throw new \RuntimeException(sprintf('Directory "%s" was not created', "$destinationDirectory/$childFolder"));
            }

            while (($file = readdir($directory)) !== false) {
                if ($file === '.' || $file === '..') {
                    continue;
                }

                if (is_dir("$sourceDirectory/$file") === true) {
                    $this->recurseCopy("$sourceDirectory/$file", "$destinationDirectory/$childFolder/$file");
                } else {
                    copy("$sourceDirectory/$file", "$destinationDirectory/$childFolder/$file");
                }
            }

            closedir($directory);

            return;
        }

        while (($file = readdir($directory)) !== false) {
            if ($file === '.' || $file === '..') {
                continue;
            }

            if (is_dir("$sourceDirectory/$file") === true) {
                $this->recurseCopy("$sourceDirectory/$file", "$destinationDirectory/$file");
            }
            else {
                copy("$sourceDirectory/$file", "$destinationDirectory/$file");
            }
        }

        closedir($directory);
    }
}
