<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

/**
 * Registration verification codes.
 * - student / teacher : list of valid ID numbers
 * - admin / coordinator : single secret code
 */
class RegistrationCodes extends BaseConfig
{
    /** Valid student ID numbers */
    public array $studentIds = [
        '423001937',
        '423001938',
        '423001939',
        '423001940',
        '423001941',
        '423001942',
        '423001943',
        '423001944',
        '423001945',
        '423001946',
    ];

    /** Valid teacher ID numbers */
    public array $teacherIds = [
        'TCH-001',
        'TCH-002',
        'TCH-003',
    ];

    /** Secret code required to register as Admin */
    public string $adminCode = 'ADMIN@JURADO2024';

    /** Secret code required to register as Coordinator */
    public string $coordinatorCode = 'COORD@JURADO2024';
}
