<?php

namespace App\Http\Controllers;

use App\Helpers\FactionHelper;
use App\Helpers\UserRegisterHelper;
use App\Http\Resources\FactionsResource;
use App\Models\RefFactions;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Validator;
use Illuminate\Validation\Rules;


class AuthController extends ApiController
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        //TODO Сделать авторизацию приложения (через мидлтварь)
//        $this->middleware('auth:api', ['except' => ['login', 'register_step_one', 'verify_sms', 'send_sms', 'deleteUser']]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function checkUser(Request $request): JsonResponse
    {
        $request = $request->all();
        $email = $request['email'];

        $user = User::where('email', $email)->first();

        if (is_null($user)){
            return $this->sendError('Пользователь не найден, продолжай регистрацию');
        }

        return $this->sendResponse($email, 'Пользователь найден, открывай форму авторизации с паролем');
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function authUser(Request $request): JsonResponse
    {

        $requestAll = $request->all();
        $email = $requestAll['email'];

        $user = User::where('email', $email)->first();

        if (is_null($user)){
            return $this->sendError('Пользователь не найден, делай регистрацию');
        }

        $login = $this->loginUser($user, $request);

        if (!$login){
            return $this->sendError('Не верный логин или пароль', [], 500);
        }

        return $this->sendResponse($login, 'Пользователь авторизован');
    }


    /**
     * Получение всех фракций
     * @return JsonResponse
     */
    public function getFactions(): JsonResponse
    {
        $factions = RefFactions::all();

        $factionsResponse = FactionsResource::collection($factions);

        return $this->sendResponse($factionsResponse, 'Фракции успешно получены');
    }


    /**
     * Получение героев определенной фракции по ID фракции
     * @param int $factionId
     * @return JsonResponse
     */
    public function getFactionHeroes(int $factionId): JsonResponse
    {
        $faction = RefFactions::where('id', $factionId)->first();

        if (is_null($faction)) {
            return $this->sendError('Фракция не найдена', [], 404);
        }

        $factionHelper = new FactionHelper($faction);

        return $this->sendResponse($factionHelper->getFactionHeroes(), 'Герои выбранной фракции успешно получены');
    }

    /**
     * @throws \Exception
     */
    public function register(Request $request): JsonResponse
    {
        $errors = $this->validateUserRegistration($request);

        if ($errors) {
            return $this->sendError('Ошибка валидации данных попробуйте еще раз', $errors);
        }

        $userRegisterHelper = new UserRegisterHelper($request->all());

        $register = $userRegisterHelper->register();

        if ($register) {
            $login = $this->loginUser($register, $request);

            if (!$login){
                return $this->sendError('Авторизация не успешна', [], 500);
            }

            return $this->sendResponse($login, 'Пользователь зарегистрирован');
        }
        return $this->sendError('ОШИБКА БЛЯТ', [], '500');

    }

    public function loginUser($user,$request): bool|array
    {
        $credentials = $request->only('email', 'password');

        $token = Auth::attempt($credentials);

        if (!$token) {
            return false;
        }

        $success['name'] = $user->name;
        $success['email'] = $user->email;
        $success['auth_token'] = $this->createNewToken($token);

        return $success;
    }


    public function validateUserRegistration($request): bool|array
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:25|unique:users',
            'email' => 'required|email|max:100|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'faction_id' => 'required|integer',
            'heroes_id' => 'required|integer'
        ]);

        if ($validator->fails()) {
            $errors = [];
            $validateError = $validator->errors();

            if ($validateError->first('name') != '') {
                $errors['name'] = $validateError->first('name');
            }
            if ($validateError->first('email') != '') {
                $errors['email'] = $validateError->first('email');
            }
            if ($validateError->first('password') != '') {
                $errors['password'] = $validateError->first('password');
            }
            if ($validateError->first('faction_id') != '') {
                $errors['faction_id'] = $validateError->first('faction_id');
            }
            if ($validateError->first('heroes_id') != '') {
                $errors['heroes_id'] = $validateError->first('heroes_id');
            }

            return $errors;
        }
        return false;
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return $this->sendResponse([], 'Пользователь успешно разлогинен');
    }

    /**
     * Refresh a token.
     *
     * @return array
     */
    public function refresh()
    {
        return $this->createNewToken(auth()->refresh());
    }

    /**
     * Get the authenticated User.
     *
     * @return JsonResponse
     */
    public function userProfile()
    {
        $user = User::where('id', auth()->user()->id)->first();

        if ($user->active != true) {
            return $this->sendError('Данные пользователя не заполнены. Необходимо заполнить для продолжения', [], 424);
        }

        if ($user) {
            $success['iin'] = $user->iin;
            $success['phone'] = $user->phone;
            $success['name'] = $user->name;
            $success['surname'] = $user->surname;
            $success['family'] = $user->family;
            $success['email'] = $user->email;
            $success['device_key'] = $user->device_key;

            $user->touch();

            return $this->sendResponse($success, 'Данные пользователя успешно получены');
        }

        return $this->sendError('Произошла ошибка. Попробуйте позднее', [], 500);
    }


    /**
     * Get the token array structure.
     *
     * @param string $token
     *
     * @return array
     */
    protected function createNewToken($token): array
    {
        $jwt = [
            'token' => $token,
            'type' => 'bearer',
        ];
        return $jwt;
    }

    public function login(Request $request)
    {
        return $this->sendError('Неверный либо не валидный токен', [], 401);
    }


    public function deleteUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required|string',
        ]);

        if ($validator->fails()) {
            $errors = [];
            $validateError = $validator->errors();
            if ($validateError->first('phone') != '') {
                $errors['phone'] = $validateError->first('phone');
            }

            return $this->sendError('Ошибка валидации попробуйте еще раз', $errors);
        }

        $user = User::where('phone', $validator->validated()['phone'])->first();

        if (is_null($user)) {
            return $this->sendError('Пользователь не найден', [], 404);
        }

        if ($user->delete()) {

            return $this->sendResponse([], 'Пользователь успешно удален');
        }

        return $this->sendError('Неверный либо не валидный токен', [], 401);
    }

}
