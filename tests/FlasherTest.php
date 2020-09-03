<?php

namespace Tests;

use GNAHotelSolutions\Flasher\Flasher;
use GNAHotelSolutions\Flasher\Message;

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

        $this->assertCount(2, Flasher::all());
    }

    /** @test */
    public function can_get_the_first_notification()
    {
        Flasher::success('ok');

        $this->assertInstanceOf(Message::class, Flasher::first());

        $this->assertSame('ok', Flasher::first()->getMessage());
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

        $this->assertCount(1, session('notifications'));

        $this->assertInstanceOf(Message::class, $notification);

        $this->assertSame('user created', $notification->getMessage());

        $this->assertSame('success', $notification->getType());
    }

    /** @test */
    public function can_add_a_error_notification()
    {
        $this->assertEmpty(session('notifications'));

        $notificationId = Flasher::error('forbidden access');

        $notification = Flasher::find($notificationId);

        $this->assertCount(1, session('notifications'));

        $this->assertInstanceOf(Message::class, $notification);

        $this->assertSame('forbidden access', $notification->getMessage());

        $this->assertSame('error', $notification->getType());
    }

    /** @test */
    public function can_add_a_info_notification()
    {
        $this->assertEmpty(session('notifications'));

        $notificationId = Flasher::info('you have a new email');

        $notification = Flasher::find($notificationId);

        $this->assertCount(1, session('notifications'));

        $this->assertInstanceOf(Message::class, $notification);

        $this->assertSame('you have a new email', $notification->getMessage());

        $this->assertSame('info', $notification->getType());
    }

    /** @test */
    public function can_add_a_warning_notification()
    {
        $this->assertEmpty(session('notifications'));

        $notificationId = Flasher::warning('your account will be closed in 2 days');

        $notification = Flasher::find($notificationId);

        $this->assertCount(1, session('notifications'));

        $this->assertInstanceOf(Message::class, $notification);

        $this->assertSame('your account will be closed in 2 days', $notification->getMessage());

        $this->assertSame('warning', $notification->getType());
    }

    /** @test */
    public function can_check_if_session_has_notifications()
    {
        Flasher::warning('A notification about nothing');

        $this->assertTrue(Flasher::any());
    }
}
