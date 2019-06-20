<?php

namespace GNAHotelSolutions\Flasher;

class Flasher
{
    /**
     * Create a notification.
     *
     * @param string $type
     * @param string $message
     * @param int $duration
     * @return string
     */
    public static function createNotification($type, $message, $duration)
    {
        $notification = new Message($type, $message, $duration);
        session()->flash('notifications.' . $notification->getId(), $notification);

        return $notification->getId();
    }


    /**
     * Creates a success notification.
     *
     * @param string $message
     * @param int $duration
     * @return string
     */
    public static function success($message, $duration = 5000)
    {
        return self::createNotification('success', $message, $duration);
    }

    /**
     * Creates a warning notification.
     *
     * @param string $message
     * @param int $duration
     * @return string
     */
    public static function warning($message, $duration = 5000)
    {
        return self::createNotification('warning', $message, $duration);
    }

    /**
     * Creates an info notification.
     *
     * @param string $message
     * @param int $duration
     * @return string
     */
    public static function info($message, $duration = 5000)
    {
        return self::createNotification('info', $message, $duration);
    }

    /**
     * Creates an error notification.
     *
     * @param string $message
     * @param int $duration
     * @return string
     */
    public static function error($message, $duration = 5000)
    {
        return self::createNotification('error', $message, $duration);
    }

    /**
     * Get all notifications.
     *
     * @return array
     */
    public static function all()
    {
        return session('notifications');
    }

    /**
     * Find a notification by id.
     *
     * @param $id
     * @return Message
     */
    public static function find($id)
    {
        return session('notifications.'.$id);
    }

    /**
     * Get the first notification.
     *
     * @return Message|null
     */
    public static function first()
    {
        $notifications = session('notifications');

        return $notifications ? reset($notifications) : null;
    }

    /**
     * Check if there's any notification.
     *
     * @return mixed
     */
    public static function any()
    {
        return session()->has('notifications');
    }

}
