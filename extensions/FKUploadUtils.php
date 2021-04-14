<?php

namespace app\extensions;

use Yii;

class FKUploadUtils {

    public static function generateFilename($filename, $path = NULL, $hideName = false, $overwrite = false) {
        if ($path === NULL)
            $path = Yii::getAlias('@web') . '/uploads/';

        if (!self::endsWith($path, '/'))
            $path .= '/';

        $ext = pathinfo($filename, PATHINFO_EXTENSION);

        if ($hideName)
            $retFilename = md5($filename) . "." . $ext;
        else
            $retFilename = $filename;


        if ($overwrite) {
            return $retFilename;
        } else {
            $i = 1;
            while (file_exists($path . $retFilename)) {
                if ($hideName) {
                    $retFilename = md5($i . "_" . $filename) . "." . $ext;
                    $i++;
                } else
                    $retFilename = rand(111111, 999999) . "_" . $filename;
            }

            return $retFilename;
        }
    }

    public static function generateAndSaveFile($file, $path = NULL, $hideName = false, $overwrite = false) {
        $filename = self::generateFilename($file->getBaseName() . "." . $file->getExtension(), $path, $hideName, $overwrite);

        if ($path == NULL)
            $path = Yii::getAlias('@web') . '/uploads/';

        $file->saveAs($path . "/" . $filename);

        return $filename;
    }


    public static function endsWith($haystack, $needle) {
        if ($haystack === "")
            return false;

        return substr($haystack, -1) === $needle;
    }

}
