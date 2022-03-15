<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use PDOException;

class CreateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "This command create a new user in database";

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        try {

            do {
                $userData = $this->askForUserDetails();
            } while (!$this->confirm("Create user {$userData['name']} <{$userData['email']}>?", true));

            $user = User::create($userData);

            $this->info("Created new user #$user->id");

            return 0;

        } catch (PDOException $e) {
            report(__CLASS__ . "::handle, {$e->getMessage()}");

            $this->error("Can't create a new user. Please check log file.");

            return 1;
        }
    }

    /**
     * @return array
     */
    protected function askForUserDetails(): array
    {
        $name = $this->askWithValidation("name", "Full name of user?", [
            "required",
            "max:255",
            "min:3",
        ]);

        $email = $this->askWithValidation("email", "Email Address for user?", [
            "required",
            "email:rfc,dns",
            Rule::unique("users", "email"),
        ]);

        $password = $this->askWithValidation("password", "Password for user? (will be visible)", [
            "required",
            "min:8",
            "max:255"
        ]);

        $password = Hash::make($password);

        return compact('name', 'email', 'password');
    }

    /**
     * @param string $fieldName
     * @param string $question
     * @param array<string> $rules
     * @return mixed
     */
    protected function askWithValidation(string $fieldName, string $question, array $rules = [])
    {
        $answer = $this->ask($question);

        $validator = Validator::make(
            [$fieldName => $answer],
            [$fieldName => $rules]
        );

        if ($validator->passes()) {
            return $answer;
        }

        foreach ($validator->errors()->all() as $error) {
            $this->error($error);
        }

        return $this->askWithValidation($fieldName, $question, $rules);
    }
}
