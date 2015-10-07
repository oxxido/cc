<?php

return [
    'validation' => [
        'required'  => 'File is required',
        'max_size'  => 'Max file size is 3MB',
        'invalid'   => 'Uploaded file is not valid',
        'mime_type' => 'Soported files are CSV (comma separated values) or XSL e.g. Excel. (Uploaded: :mimetype)',
        'format'    => 'Invalid format file. Check example file for CSV and XLS',
    ],
    'parse' => [
        'initializing'   => 'Initializing file processing',
        'line'           => 'Processing line :line',
        'line_not_saved' => 'Line :line not saved',
        'line_error'     => 'Error on file line validation',
        'line_saved'     => 'Line :line was saved',
    ],
    'admin' => [
        'not_found'     => 'Admin not found or not created',
        'asigned'       => 'User :email asigned as admin',
        'asigned_email' => 'Email send to :email for new admin',
    ],
    'user' => [
        'found'    => 'User :email was found',
        'is_admin' => 'User :email is already an admin',
        'created'  => 'New user created. Email sent to :email',
    ],
    'location' => [
        'city_not_found' => 'City not found or not created',
    ],
    'business' => [
        'email_sent' => 'Email sent to admin :email for new business',
    ]
];
