<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * UsersFixture
 */
class UsersFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'username' => 'Lorem ipsum dolor sit amet',
                'email' => 'Lorem ipsum dolor sit amet',
                'password' => 'Lorem ipsum dolor sit amet',
                'first_name' => 'Lorem ipsum dolor sit amet',
                'last_name' => 'Lorem ipsum dolor sit amet',
                'token' => 'Lorem ipsum dolor sit amet',
                'token_expires' => '2025-04-24 14:07:38',
                'api_token' => 'Lorem ipsum dolor sit amet',
                'activation_date' => '2025-04-24 14:07:38',
                'secret' => 'Lorem ipsum dolor sit amet',
                'secret_verified' => 1,
                'tos_date' => '2025-04-24 14:07:38',
                'active' => 1,
                'is_superuser' => 1,
                'role' => 'Lorem ipsum dolor sit amet',
                'additional_data' => '',
                'last_login' => '2025-04-24 14:07:38',
                'lockout_time' => '2025-04-24 14:07:38',
                'login_token' => 'Lorem ipsum dolor sit amet',
                'login_token_date' => '2025-04-24 14:07:38',
                'token_send_requested' => 1,
                'created' => '2025-04-24 14:07:38',
                'modified' => '2025-04-24 14:07:38',
            ],
            [
                'id' => 2,
                'username' => 'Lorem ipsum dolor sit amet',
                'email' => 'Lorem ipsum dolor sit amet',
                'password' => 'Lorem ipsum dolor sit amet',
                'first_name' => 'Lorem ipsum dolor sit amet',
                'last_name' => 'Lorem ipsum dolor sit amet',
                'token' => 'Lorem ipsum dolor sit amet',
                'token_expires' => '2025-04-24 14:07:38',
                'api_token' => 'Lorem ipsum dolor sit amet',
                'activation_date' => '2025-04-24 14:07:38',
                'secret' => 'Lorem ipsum dolor sit amet',
                'secret_verified' => 1,
                'tos_date' => '2025-04-24 14:07:38',
                'active' => 1,
                'is_superuser' => 1,
                'role' => 'Lorem ipsum dolor sit amet',
                'additional_data' => '',
                'last_login' => '2025-04-24 14:07:38',
                'lockout_time' => '2025-04-24 14:07:38',
                'login_token' => 'Lorem ipsum dolor sit amet',
                'login_token_date' => '2025-04-24 14:07:38',
                'token_send_requested' => 1,
                'created' => '2025-04-24 14:07:38',
                'modified' => '2025-04-24 14:07:38',
            ],
        ];
        parent::init();
    }
}
