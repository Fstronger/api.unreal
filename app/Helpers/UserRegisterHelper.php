<?php

namespace App\Helpers;

use App\Models\RefHeroesFactionCharacteristics;
use App\Models\User;
use App\Models\UserCharacteristics;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserRegisterHelper
{
    private mixed $requset;

    public function __construct($request)
    {
        $this->requset = $request;
    }

    public function register()
    {
        try {
            DB::beginTransaction();

            $user = User::create([
                'name' => $this->requset['name'],
                'email' => $this->requset['email'],
                'password' => Hash::make($this->requset['password']),
                'faction_id' => $this->requset['faction_id'],
                'heroes_id' => $this->requset['heroes_id'],
                'last_login' => ''
            ]);

            $this->upsertUserCharacteristics($user['id'] ,$this->requset['heroes_id']);

            DB::commit();
            return $user;
        } catch (\Exception $e) {
            DB::rollback();

            throw new Exception($e);
        }

    }


    public function upsertUserCharacteristics($userId, $heroId): void
    {
        $heroesCharacteristics = RefHeroesFactionCharacteristics::where('heroes_id', $heroId);
        $checkHeroes = $heroesCharacteristics->exists();
        if ($checkHeroes){
            $upsert = [];

            foreach ($heroesCharacteristics->get() as $characteristic) {
                $upsert[] = [
                    'user_id' => $userId,
                    'characteristic_id' => $characteristic->characteristic_id,
                    'current_amount' => $characteristic->amount,
                    'amount' => 9999
                ];
            }


           UserCharacteristics::upsert($upsert, ['user_id', 'characteristic_id'], ['amount']);
        } else {
            throw new Exception('Не найден герой фракции');
        }


    }

}
