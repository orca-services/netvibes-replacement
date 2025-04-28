<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use App\Model\Entity\Dashboard;
use App\Model\Table\DashboardsTable;
use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\MethodNotAllowedException;
use Cake\ORM\Locator\LocatorAwareTrait;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;
use CakeDC\Users\Model\Entity\User;
use CakeDC\Users\Model\Table\UsersTable;

/**
 * App\Controller\DashboardsController Test Case
 *
 * @coversDefaultClass \App\Controller\DashboardsController
 */
class DashboardsControllerTest extends TestCase
{
    use IntegrationTestTrait;
    use LocatorAwareTrait;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.Dashboards',
        'app.Users',
    ];

    /**
     * Test index method
     *
     * @return void
     * @covers ::index
     */
    public function testIndex(): void
    {
        $this->logInAsUser();
        $this->get('/dashboards');

        $dashboards =  $this->viewVariable('dashboards');
        $this->assertCount(1, $dashboards);

        $this->assertResponseOk();
    }

    /**
     * Test view method
     *
     * @return void
     * @covers ::view
     */
    public function testView(): void
    {
        $this->logInAsUser();
        $this->get('/dashboards/view/1');

        $this->assertResponseOk();
        $this->assertEquals(1, $this->viewVariable('dashboard')->id);
    }

    /**
     * Test view method for dashboard of another user
     *
     * @return void
     * @covers ::view
     */
    public function testViewOtherUser(): void
    {
        $this->disableErrorHandlerMiddleware();
        $this->logInAsUser();

        $this->expectException(ForbiddenException::class);

        $this->get('/dashboards/view/2'); // Belongs to a different user than logged-in
    }

    /**
     * Test add method with GET
     *
     * @return void
     * @covers ::add
     */
    public function testAddGet(): void
    {
        $this->logInAsUser();

        $this->get('/dashboards/add');

        $this->assertResponseOk();

        $this->assertInstanceOf(Dashboard::class, $this->viewVariable('dashboard'));
    }

    /**
     * Test add method with POST
     *
     * @return void
     * @covers ::add
     */
    public function testAddPost(): void
    {
        $this->enableRetainFlashMessages();
        $this->logInAsUser();
        $this->enableCsrfToken();
        $newDashboard = [
            'name' => 'New Dashboard',
        ];

        $this->post('/dashboards/add', $newDashboard);

        $this->assertRedirect('/dashboards');
        $this->assertFlashMessage('The dashboard has been saved.');

        /** @var DashboardsTable $dashboardsTable */
        $dashboardsTable = $this->fetchTable('Dashboards');

        $dashboardCount = $dashboardsTable->find()->where($newDashboard)->count();
        $this->assertEquals(1, $dashboardCount);
    }

    /**
     * Test add method with POST with injected user id
     *
     * @return void
     * @covers ::add
     */
    public function testAddPostInjectedUserId(): void
    {
        $this->enableRetainFlashMessages();
        $this->logInAsUser();
        $this->enableCsrfToken();
        $newDashboard = [
            'name' => 'New Dashboard',
            'user_id' => 2, // Different user than logged-in
        ];

        $this->post('/dashboards/add', $newDashboard);

        $this->assertRedirect('/dashboards');
        $this->assertFlashMessage('The dashboard has been saved.');

        /** @var DashboardsTable $dashboardsTable */
        $dashboardsTable = $this->fetchTable('Dashboards');

        /** @var Dashboard $dashboard */
        unset($newDashboard['user_id']);
        $dashboard = $dashboardsTable->find()->where($newDashboard)->firstOrFail();
        $this->assertEquals(1, $dashboard->user_id);
    }

    /**
     * Test add method with POST with invalid Data
     *
     * @return void
     * @covers ::add
     */
    public function testAddPostInvalid(): void
    {
        $this->enableRetainFlashMessages();
        $this->logInAsUser();
        $this->enableCsrfToken();

        $newDashboard = [
            'name' => '', // Must not be empty
        ];

        $this->post('/dashboards/add', $newDashboard);

        $this->assertResponseOk();
        $this->assertFlashMessage('The dashboard could not be saved. Please, try again.');
        $this->assertInstanceOf(Dashboard::class, $this->viewVariable('dashboard'));
    }

    /**
     * Test edit method with GET
     *
     * @return void
     * @covers ::edit
     */
    public function testEditGet(): void
    {
        $this->logInAsUser();

        $this->get('/dashboards/edit/1');

        $this->assertResponseOk();

        $this->assertInstanceOf(Dashboard::class, $this->viewVariable('dashboard'));
        $this->assertEquals(1, $this->viewVariable('dashboard')->id);
    }

    /**
     * Test edit method with POST
     *
     * @return void
     * @covers ::edit
     */
    public function testEditPost(): void
    {
        $this->enableRetainFlashMessages();
        $this->logInAsUser();
        $this->enableCsrfToken();
        $newDashboard = [
            'name' => 'Edited Dashboard',
        ];

        $this->post('/dashboards/edit/1', $newDashboard);

        $this->assertRedirect('/dashboards');
        $this->assertFlashMessage('The dashboard has been saved.');

        /** @var DashboardsTable $dashboardsTable */
        $dashboardsTable = $this->fetchTable('Dashboards');

        $dashboardCount = $dashboardsTable->find()->where($newDashboard)->count();
        $this->assertEquals(1, $dashboardCount);
    }

    /**
     * Test edit method with POST with injected user id
     *
     * @return void
     * @covers ::edit
     */
    public function testEditPostInjectedUserId(): void
    {
        $this->enableRetainFlashMessages();
        $this->logInAsUser();
        $this->enableCsrfToken();
        $newDashboard = [
            'name' => 'Edited Dashboard',
            'user_id' => 2, // Different user than logged-in
        ];

        $this->post('/dashboards/edit/1', $newDashboard);

        $this->assertRedirect('/dashboards');
        $this->assertFlashMessage('The dashboard has been saved.');

        /** @var DashboardsTable $dashboardsTable */
        $dashboardsTable = $this->fetchTable('Dashboards');

        /** @var Dashboard $dashboard */
        unset($newDashboard['user_id']);
        $dashboard = $dashboardsTable->find()->where($newDashboard)->firstOrFail();
        $this->assertEquals(1, $dashboard->user_id);
    }

    /**
     * Test edit method with POST with invalid Data
     *
     * @return void
     * @covers ::edit
     */
    public function testEditPostInvalid(): void
    {
        $this->enableRetainFlashMessages();
        $this->logInAsUser();
        $this->enableCsrfToken();
        $newDashboard = [
            'name' => '', // Must not be empty
        ];

        $this->post('/dashboards/edit/1', $newDashboard);

        $this->assertResponseOk();
        $this->assertFlashMessage('The dashboard could not be saved. Please, try again.');
        $this->assertInstanceOf(Dashboard::class, $this->viewVariable('dashboard'));
        $this->assertEquals(1, $this->viewVariable('dashboard')->id);
    }

    /**
     * Test delete method with GET
     *
     * @return void
     * @covers ::delete
     */
    public function testDeleteGet(): void
    {
        $this->disableErrorHandlerMiddleware();
        $this->logInAsUser();

        $this->expectException(MethodNotAllowedException::class);

        $this->get('/dashboards/delete/1');
    }

    /**
     * Test delete method with POST
     *
     * @return void
     * @covers ::delete
     */
    public function testDeletePost(): void
    {
        $this->enableRetainFlashMessages();
        $this->logInAsUser();
        $this->enableCsrfToken();

        $this->post('/dashboards/delete/1');

        $this->assertRedirect('/dashboards');
        $this->assertFlashMessage('The dashboard has been deleted.');
    }

    /**
     * Test delete method with POST with invalid
     *
     * @return void
     * @covers ::delete
     */
    public function testDeletePostInvalid(): void
    {
        $this->markTestIncomplete('Failure case could not be simulated');

        $this->enableRetainFlashMessages();
        $this->logInAsUser();
        $this->enableCsrfToken();

        $this->post('/dashboards/delete/999999');

        $this->assertRedirect('/dashboards');
        $this->assertFlashMessage('The dashboard could not be deleted. Please, try again.');
    }

    /**
     * Test delete method with POST for dashboard of another user
     *
     * @return void
     * @covers ::delete
     */
    public function testDeletePostOtherUser(): void
    {
        $this->disableErrorHandlerMiddleware();
        $this->logInAsUser();
        $this->enableCsrfToken();

        $this->expectException(ForbiddenException::class);

        $this->post('/dashboards/delete/2'); // Belongs to a different user than logged-in

    }

    /**
     * Log in as user with role user
     *
     * @return void
     */
    public function logInAsUser(): void
    {
        $this->session([
            'Auth' => new User([
                'id' => 1,
                'role' => UsersTable::ROLE_USER,
            ]),
        ]);
    }
}
