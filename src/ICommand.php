<?php

/**
 * Created by Prowect
 * Author: Raffael Kessler
 * Date: 30.10.2015 - 17:00
 * Copyright: Prowect
 */

namespace Drips\CLI;

/**
 * Interface ICommand
 *
 * Definiert eine Schnittstelle für CLI-Kommandos.
 */
interface ICommand
{
    /**
     * Zeigt die Hilfe des entsprechenden Kommandos an.
     */
    public static function help();
}
