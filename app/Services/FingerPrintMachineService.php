<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Log;
use Rats\Zkteco\Lib\Helper\Util;
use Rats\Zkteco\Lib\ZKTeco;

class FingerPrintMachineService
{
    /**
     * Create a new class instance.
     */
    public static $machine = null;
    public function __construct()
    {
        if (self::$machine == null) {
            self::$machine = new ZKTeco(env('FINGERPRINT_MACHINE_IP'), env('FINGERPRINT_MACHINE_PORT'));
            self::$machine->connect();
        }
    }

    public static function createUser(User $user): bool
    {
        try {
            // Assuming setUser is an API call to a machine or external system
            if (!self::$machine || null === self::$machine->platform()) {
                return false;
            }

            $isCreated = self::$machine->setUser(
                $user->uid,
                $user->id,
                $user->name,
                $user->password,
                Util::LEVEL_USER,
                $user->cardno
            );
            return $isCreated;
        } catch (\Exception $e) {
            Log::error('Error creating user: ' . $e->getMessage());
            return false;
        }

    }
    public function getUsers()
    {
        return self::$machine->getUser() ?? [];
    }
    public static  function getUserAttendance()
    {
        return self::$machine->getAttendance() ?? [];
    }
}
