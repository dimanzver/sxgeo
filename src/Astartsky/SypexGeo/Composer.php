<?php
namespace Astartsky\SypexGeo;

use Composer\Script\Event;

class Composer 
{
    /**
     * @param Event $event
     * @return bool
     */
    public static function installDatabases(Event $event)
    {
        $event->getIO()->write("<warning> *** SxGeo database update *** </warning>");

        $extra = $event->getComposer()->getPackage()->getExtra();

        if (false === isset($extra['sypex_geo_update'])) {
            $event->getIO()->write("<error>No database update url `sypex_geo_update` specified in composer extra, skipping update...</error>");
            return false;
        }

        $updateUrl = $extra['sypex_geo_update'];
        $event->getIO()->write(sprintf("Database update url is `%s`...", $updateUrl));

        if (false === isset($extra['sypex_geo_database'])) {
            $event->getIO()->write("<error>No database install path `sypex_geo_database` specified in composer extra, skipping update...</error>");
            return false;
        }

        $databasePath = $extra['sypex_geo_database'];
        $event->getIO()->write(sprintf("Database install path is `%s`...", $databasePath));

        $event->getIO()->write("Starting download...");
        $zipFile = "/tmp/sypex_update" . md5(microtime()) . ".zip";
        $zipResource = fopen($zipFile, "w");

        $last = null;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $updateUrl);
        curl_setopt($ch, CURLOPT_FAILONERROR, true);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_AUTOREFERER, true);
        curl_setopt($ch, CURLOPT_BINARYTRANSFER,true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_NOPROGRESS, 0);
        curl_setopt($ch, CURLOPT_PROGRESSFUNCTION, function ($clientp, $dltotal, $dlnow, $ultotal, $ulnow) use ($event, & $last) {
            if ($dltotal != 0) {
                $now = number_format($dlnow / (1024 * 1024), 2);
                $total = number_format($dltotal / (1024 * 1024), 2);
                if ($last != $now) {
                    $percent = $now / ($total / 100);
                    $event->getIO()->overwrite($now . "MB/" . $total . "MB" . ", " . number_format($percent, 2) . "%", false);
                    $last = $now;
                }
            }
        });
        curl_setopt($ch, CURLOPT_FILE, $zipResource);
        $result = curl_exec($ch);
        if(!$result) {
            $event->getIO()->write(sprintf("<error>Download failed: %s</error>", curl_error($ch)));
        }
        curl_close($ch);

        $event->getIO()->write(sprintf("Downloaded to `%s`.", $zipFile));
        $event->getIO()->write("Download complete.");
        $event->getIO()->write("Starting extraction...");

        $zip = new \ZipArchive();
        $extractPath = "/tmp/sypex_update" . md5(microtime());
        $zipResult = $zip->open($zipFile);
        if($zipResult != true){
            $event->getIO()->write(sprintf("<error>Extraction failed: error code %s</error>", $zipResult));
        }
        /* Extract Zip File */
        $zip->extractTo($extractPath);
        $zip->close();

        $event->getIO()->write(sprintf("Extracted to `%s`.", $extractPath));
        $event->getIO()->write("Extraction complete.");

        $event->getIO()->write("Starting file copy...");
        $copyResult = copy($extractPath . DIRECTORY_SEPARATOR . "SxGeoCity.dat", $databasePath);

        if ($copyResult) {
            $event->getIO()->write("Copy complete.");
        } else {
            $event->getIO()->write("<error>Copy failed</error>");
        }

        $event->getIO()->write("<warning> *** SxGeo database update finished *** </warning>");
    }
}