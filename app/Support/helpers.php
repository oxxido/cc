<?php

function notification_csv($notification, $type = "info", $line = false, $activate = false)
{
    static $active;
    static $current_line;

    if($activate)
        $active = true;

    if($line)
        $current_line = $line;

    if($active)
        \Event::fire(new App\Events\EventCsvImporterLog(\Auth::id(), $notification, $type, $current_line));
}
