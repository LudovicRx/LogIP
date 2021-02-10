<?php

/**
 * Verify if it is the active page
 *
 * @param string $pageName
 * @return boolean true if this is the active page, else false
 */
function isActivePage($pageName)
{
    if (basename($_SERVER["SCRIPT_FILENAME"]) == $pageName)
        return true;
    return false;
}

/**
 * Reads a file and return as a array all the lines
 *
 * @param string $path where is the file
 * @return array the result
 */
function getParsedFile($path)
{
    $result = array();
    if (file_exists($path)) {
        $handle = fopen($path, "r");
        if ($handle) {
            while (!feof($handle)) {
                $line = fgets($handle);
                array_push($result, parseLine($line));
            }
            fclose($handle);
        }
    }
    return $result;
}

/**
 * Parse the line
 *
 * @param string $line
 * @return array
 */
function parseLine($line)
{
    return explode(" ", $line);;
}

/**
 * Gets the ip of a line
 *
 * @param array $entry
 * @return string
 */
function getIpLine($entry)
{
    return $entry[0];
}

/**
 * Gets the date of an entry of the file array
 *
 * @param array $entry
 * @return string
 */
function getDateLine($entry)
{
    if (count($entry) >= 4) {
        return str_replace("[", "", $entry[3]);
    }
}

/**
 * rGets the city, the latitude and the longitude from the ip
 *
 * @param string $ip 
 * @return array latitude and longitud in an array
 */
function getLocationFromIp($ip)
{
    $answer = false;
    $url = "http://ipinfo.io/$ip?token=97ed47091800bb";
    $json = file_get_contents($url);

    $city = "";
    $location = array("", "");
    if ($json) {
        $content = json_decode($json, true);

        if ($content && count($content) > 2) {
            $city = $content["city"];
            $location = explode(",", $content["loc"]);
            $answer = array("city" => $city, "latlng" => array("lat" => $location[0], "lng" => $location[1]));
        }
    }

    return $answer;
}

/**
 * Format the data in order to send the to js
 *
 * @param array $parsedFile file that is parsed
 * @return array array that contains only what we need 
 */
function formatData($parsedFile)
{
    $result = array();
    foreach ($parsedFile as $entry) {
        $ip =  getIpLine($entry);
        // Si l'ip est valide
        if ($ip) {
            $location = getLocationFromIp($ip);
            // Si la location est valide
            if ($location) {
                array_push($result, array_merge(array("date" => getDateLine($entry), "ip" => $ip), $location));
            }
        }
    }
    return $result;
}
