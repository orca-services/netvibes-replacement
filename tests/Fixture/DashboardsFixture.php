<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * DashboardsFixture
 */
class DashboardsFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            // Dashboard of user 1
            [
                'id' => 1,
                'user_id' => 1,
                'name' => 'Dashboard for user 1',
            ],
            // Dashboard of user 2
            [
                'id' => 2,
                'user_id' => 2,
                'name' => 'Dashboard for user 2',
            ],
        ];
        parent::init();
    }
}
