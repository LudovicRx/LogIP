<?php
// Projet    :   Log IP
// Auteur    :   Ludovic Roux
// Desc.     :   Fonctions fonctionnelles du projets
// Version   :   1.0, 14.04.2021, LR, version initiale

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
    return explode(" ", $line);
}

/**
 * Gets the ip of a line
 *
 * @param array $entry
 * @return string ip
 */
function getIpLine($entry)
{
    return $entry[0];
}

/**
 * Gets the date of an entry of the file array
 *
 * @param array $entry
 * @return string date
 */
function getDateLine($entry)
{
    if (count($entry) >= 4) {
        return str_replace("[", "", $entry[3]);
    }
}

/**
 * Gte the url of an entrey of the file array
 *
 * @param array $entry
 * @return string url 
 */
function getUrlLine($entry)
{
    if (count($entry) >= 7) {
        return str_replace("\"", "", $entry[5] . $entry[6] . $entry[7]);
    }
}

/**
 * Get the code of the access of the line array
 *
 * @param array $entry
 * @return string code
 */
function getCodeLine($entry)
{
    if (count($entry) >= 8) {
        return $entry[8];
    }
}

/**
 * Get the agent of the parsed line
 *
 * @param array $entry
 * @return string agent that has attacked
 */
function getAgentLine($entry)
{
    if (count($entry) >= 11) {
        return str_replace("\"", "", $entry[11]);
    }
}

/**
 * Gets the city, the latitude and the longitude from the ip
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
            $country = $content["country"];
            $location = explode(",", $content["loc"]);
            $answer = array("city" => $city, "country" => $country, "latlng" => array("lat" => $location[0], "lng" => $location[1]));
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
    // All the ips that are invalid
    $invalidIp = array();
    foreach ($parsedFile as $entry) {
        $ip =  getIpLine($entry);
        // Si l'ip est valide
        if ($ip && !in_array($ip, $invalidIp)) {
            // Vérifie que l'ip n'existe pas déjà
            if (!array_key_exists($ip, $result)) {
                $location = getLocationFromIp($ip);
                // Si la location est valide
                if ($location) {
                    $result[$ip] = array_merge(
                        array(
                        "count" => 1,
                        "date" => getDateLine($entry),
                        "url" => getUrlLine($entry),
                        "code" => getCodeLine($entry),
                        "agent" => getAgentLine($entry)
                    ), $location);
                } else {
                    // Rajoute les ip invalides dans le tableau
                    array_push($invalidIp, $ip);
                }
            } else {
                // Ne réécrit pas si l'ip est la même et rajoute 1 dans le count
                $result[$ip]["count"]++;
                
                // On vérifie si c'est une attaque plus récente
                if(new DateTime(date_create($result[$ip]["date"])) < new DateTime(date_create(getDateLine($entry)))) {
                    // On remplace les champs concernés
                    $result[$ip]["date"] = getDateLine($entry);
                    $result[$ip]["url"] = getUrlLine($entry);
                    $result[$ip]["code"] = getCodeLine($entry);
                    $result[$ip]["agent"] = getAgentLine($entry);
                }
            }
        }
    }
    return $result;
}
