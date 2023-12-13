<?php

namespace common\components;

use yii\base\ErrorException;
use yii\base\InvalidArgumentException;
use yii\base\Exception;

/**
 * FileUtils was created to be used as an general file helper.
 */
class FileUtils {

   /**
     * Deletes a directory and its contents recursively.
     *
     * @param string $path The path to the directory to be deleted.
     * @throws InvalidParamException If the provided path is not a directory.
     * @throws ErrorException If an error occurs during deletion.
     */
    public static function deleteDirectory($folderPath) {
        
        // Validate that the path is not empty
        if (empty($folderPath)) {
            throw new InvalidArgumentException('Diretório não pode ser vazio.');
        }

        // Normalize the path to avoid potential issues with different directory separators
        $folderPath = rtrim($folderPath, DIRECTORY_SEPARATOR);

        // Validate that the folder exists
        if (!file_exists($folderPath) || !is_dir($folderPath)) {
            throw new InvalidArgumentException('Diretório não exist.');
        }

        // Validate that the folder is writable
        if (!is_writable($folderPath)) {
            throw new Exception('Diretório sem permissão de escrita.');
        }

        // Open the directory handle
        $dirHandle = opendir($folderPath);

        // Check if the directory handle was opened successfully
        if (!$dirHandle) {
            throw new Exception('Unable to open directory handle.');
        }

        // Loop through the directory contents
        while (false !== ($file = readdir($dirHandle))) {
            if ($file !== '.' && $file !== '..') {
                $filePath = $folderPath . DIRECTORY_SEPARATOR . $file;

                // Recursively delete subdirectories
                if (is_dir($filePath)) {
                    self::deleteDirectory($filePath);
                } else {
                    // Delete files
                    unlink($filePath);
                }
            }
        }

        // Close the directory handle
        closedir($dirHandle);

        // Remove the empty folder
        if (!rmdir($folderPath)) {
            throw new Exception('Unable to remove folder.');
        }
    }

 }