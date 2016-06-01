<?php
$connection = new mysqli("localhost", "root", "", "sportnet");
if($connection -> connect_errno) {
    echo "Failed to connect to the database: (" . $connection -> connect_errno 
            . ") " . $connection -> connect_errno;
}

