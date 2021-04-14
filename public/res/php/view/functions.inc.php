<?php
// Projet    :   Log IP
// Auteur    :   Ludovic Roux
// Desc.     :   Fonctions du projet qui concernent la vue
// Version   :   1.0, 14.04.2021, LR, version initiale

/**
 * Write the class active if this is the active page
 *
 * @param string $pageName name of the page
 * @return string active or nothing
 */
function writeActive($pageName) {
    return isActivePage($pageName) ? "active" : "";
}