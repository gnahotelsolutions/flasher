<?php

namespace Tests;

use Flasher\Flasher;
use Flasher\Message;

class FlasherTest extends TestCase
{

    /** @test */
    public function can_find_notification_by_id()
    {
        $id = Flasher::info('notification');

        $message = Flasher::find($id);

        $this->assertNotNull($message);

        $this->assertInstanceOf(Message::class, $message);
    }

    /** @test */
    public function can_get_all_notifications_as_array()
    {
        Flasher::success('ok');
        Flasher::error('ko');

        $this->assertIsArray(Flasher::all());

        $this->assertEquals(2, count(Flasher::all()));
    }

    /** @test */
    public function can_get_the_first_notification()
    {
        Flasher::success('ok');

        $this->assertInstanceOf(Message::class, Flasher::first());

        $this->assertEquals('ok', Flasher::first()->getMessage());
    }

    /** @test */
    public function first_notification_returns_null_if_there_is_no_notification()
    {
        $this->assertNull(Flasher::first());
    }

    /** @test */
    public function can_add_a_success_notification()
    {
        $this->assertEmpty(session('notifications'));

        $notificationId = Flasher::success('user created');

        $notification = Flasher::find($notificationId);

        $this->assertEquals(1, count(session('notifications')));

        $this->assertInstanceOf(Message::class, $notification);

        $this->assertEquals('user created', $notification->getMessage());

        $this->assertEquals('success', $notification->getType());
    }

    /** @test */
    public function can_add_a_error_notification()
    {
        $this->assertEmpty(session('notifications'));

        $notificationId = Flasher::error('forbidden access');

        $notification = Flasher::find($notificationId);

        $this->assertEquals(1, count(session('notifications')));

        $this->assertInstanceOf(Message::class, $notification);

        $this->assertEquals('forbidden access', $notification->getMessage());

        $this->assertEquals('error', $notification->getType());
    }

    /** @test */
    public function can_add_a_info_notification()
    {
        $this->assertEmpty(session('notifications'));

        $notificationId = Flasher::info('you have a new email');

        $notification = Flasher::find($notificationId);

        $this->assertEquals(1, count(session('notifications')));

        $this->assertInstanceOf(Message::class, $notification);

        $this->assertEquals('you have a new email', $notification->getMessage());

        $this->assertEquals('info', $notification->getType());
    }

    /** @test */
    public function can_add_a_warning_notification()
    {
        $this->assertEmpty(session('notifications'));

        $notificationId = Flasher::warning('your account will be closed in 2 days');

        $notification = Flasher::find($notificationId);

        $this->assertEquals(1, count(session('notifications')));

        $this->assertInstanceOf(Message::class, $notification);

        $this->assertEquals('your account will be closed in 2 days', $notification->getMessage());

        $this->assertEquals('warning', $notification->getType());
    }

    /** @test */
    public function can_check_if_session_has_notifications()
    {
        Flasher::warning('A notification about nothing');

        $this->assertTrue(Flasher::any());
    }
}
