<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;
use App\Http\Controllers\AppsCtrl;
use App\Apps;

class AppCtrlTest extends TestCase
{
    public $AppsCtrl;

    public function setUp()
    {
        parent::setUp();
        $this->AppsCtrl = new AppsCtrl();
        $user = User::find(1)->first();
        $this->be($user);
    }

    public function testIndex()
    {
         $response = $this->action('GET', 'AppsCtrl@index');
         $this->assertResponseOk();
         $this->see('Apps list');

    }

    public function testCreate()
    {
        $response = $this->action('GET', 'AppsCtrl@create');
        $this->assertResponseOk();
        $this->see('Apps creator');
    }

    public function testEdit()
    {
        $app = Apps::find(1)->get();
        $response = $this->call('GET', '/apps/edit/'.$app[0]->id);
        $this->assertResponseOk();
        $this->see('Apps editor');
    }

    public function testStore()
    {

        $response = $this->json(
            'POST', '/apps', array(
            '_token' => csrf_token(),
            'name' => 'testAssertion',
            'url' => 'test.com'
            )
        );
        $this->assertResponseOk();
        $this->seeJson(
            [
                 'msg' => 'success',
            ]
        );
    }

    public function testUpdate()
    {
        $app = Apps::orderBy('id', 'desc')->get();
        $response = $this->json(
            'PUT', '/apps/'.$app[0]->id, array(
            '_token' => csrf_token(),
            'name' => 'AssertionUpdate',
            'url' => 'Update.com'
            )
        );
        $this->assertResponseOk();
        $this->seeJson(
            [
                 'msg' => 'success',
            ]
        );
    }

    public function testDelete()
    {
        $app = Apps::orderBy('id', 'desc')->get();
        $response = $this->json(
            'delete', '/apps/'.$app[0]->id
        );
        $this->assertResponseOk();
        $this->seeJson(
            [
                 'msg' => 'success borrando',
            ]
        );
    }

    public function tearDown()
    {
        parent::tearDown();
        $this->AppsCtrl = null;
    }
}
