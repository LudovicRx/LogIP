<?php

/**
 * Write the class active if this is the active page
 *
 * @param string $pageName name of the page
 * @return string active or nothing
 */
function writeActive($pageName) {
    return isActivePage($pageName) ? "active" : "";
}