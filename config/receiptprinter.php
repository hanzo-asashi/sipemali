<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Printer connector type
    |--------------------------------------------------------------------------
    |
    | Connection protocol to communicate with the receipt printer.
    | Valid values are: cups, network, windows
    |
    */
    'connector_type' => 'windows',
    /*
    |--------------------------------------------------------------------------
    | Printer connector descriptor
    |--------------------------------------------------------------------------
    |
    | Typically printer name or IP address.
    |
    */
    'connector_descriptor' => 'EPSON TM-T82X Receipt',
    /*
    |--------------------------------------------------------------------------
    | Printer port
    |--------------------------------------------------------------------------
    |
    | Typically 9100.
    |
    */
    'connector_port' => 9100,
];
