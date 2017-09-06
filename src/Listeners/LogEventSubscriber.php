<?php

namespace Kouz\LaravelLog\Listeners;

use Illuminate\Contracts\Logging\Log;

class LogEventSubscriber
{
    protected $eventMap = [
        'Illuminate\Auth\Events\Registered'                   => 'logRegisteredUser',
        'Illuminate\Auth\Events\Attempting'                   => 'logAuthAttempt',
        'Illuminate\Auth\Events\Authenticated'                => 'logAuth',
        'Illuminate\Auth\Events\Login'                        => 'logSuccessfulLogin',
        'Illuminate\Auth\Events\Failed'                       => 'logFailedLogin',
        'Illuminate\Auth\Events\Logout'                       => 'logSuccessfulLogout',
        'Illuminate\Auth\Events\Lockout'                      => 'logLockout',
        'Illuminate\Auth\Events\PasswordReset'                => 'logPasswordReset',
        'Illuminate\Cache\Events\CacheHit'                    => 'logCacheHit',
        'Illuminate\Cache\Events\CacheMissed'                 => 'logCacheMissed',
        'Illuminate\Cache\Events\KeyForgotten'                => 'logCacheKeyForgotten',
        'Illuminate\Cache\Events\KeyWritten'                  => 'logCacheKeyWritten',
        'Illuminate\Console\Events\ArtisanStarting'           => 'logArtisanStarting',
        'Illuminate\Console\Events\CommandStarting'           => 'logCommandStarting',
        'Illuminate\Console\Events\CommandFinished'           => 'logCommandFinished',
        'Illuminate\Database\Events\QueryExecuted'            => 'logDatabaseQuery',
        'Illuminate\Database\Events\TransactionBeginning'     => 'logDatabaseTransactionBegin',
        'Illuminate\Database\Events\TransactionCommitted'     => 'logDatabaseTransactionCommit',
        'Illuminate\Database\Events\TransactionRolledBack'    => 'logDatabaseTransactionRollBack',
        'Illuminate\Foundation\Events\LocaleUpdated'          => 'logLocaleUpdate',
        'Illuminate\Foundation\Http\Events\RequestHandled'    => 'logRequest',
        'Illuminate\Mail\Events\MessageSending'               => 'logMessageSending',
        'Illuminate\Mail\Events\MessageSent'                  => 'logMessageSent',
        'Illuminate\Notifications\Events\NotificationFailed'  => 'logFailedNotification',
        'Illuminate\Notifications\Events\NotificationSending' => 'logSendingNotification',
        'Illuminate\Notifications\Events\NotificationSent'    => 'logSentNotification',
        'Illuminate\Queue\Events\JobProcessed'                => 'logJobProcessed',
        'Illuminate\Queue\Events\JobProcessing'               => 'logJobProcessing',
        'Illuminate\Routing\Events\RouteMatched'              => 'logRouteMatched',
    ];

    protected $log;

    public function __construct(Log $log)
    {
        $this->log = $log;
    }

    public function subscribe($events)
    {
        $listenerClass = self::class;

        foreach ($this->eventMap as $eventName => $listenerName) {
            $events->listen($eventName, "{$listenerClass}@{$listenerName}");
        }
    }

    public function logRegisteredUser($event)
    {
        $this->log->info("Auth: {$this->getUserName($event->user)} has registered");
    }

    public function logAuthAttempt($event)
    {
        $this->log->info("Auth: {$this->getUserName()} attempts to login");
    }

    public function logAuth($event)
    {
        $this->log->info("Auth: {$this->getUserName($event->user)} has authenticated");
    }

    public function logSuccessfulLogin($event)
    {
        $this->log->info("Auth: {$this->getUserName($event->user)} has logged in");
    }

    public function logFailedLogin($event)
    {
        $this->log->info("Auth: {$this->getUserName($event->user)} has failed to login");
    }

    public function logSuccessfulLogout($event)
    {
        $this->log->info("Auth: {$this->getUserName($event->user)} has logged out");
    }

    public function logLockout($event)
    {
        $this->log->info("Auth: {$this->getUserName()} has been locked out");
    }

    public function logPasswordReset($event)
    {
        $this->log->info("Auth: {$this->getUserName($event->user)} has reset their password");
    }

    public function logCacheHit($event)
    {
        $this->log->info("Cache: {$event->key} has been retrieved");
    }

    public function logCacheMissed($event)
    {
        $this->log->info("Cache: {$event->key} has been missed");
    }

    public function logCacheKeyForgotten($event)
    {
        $this->log->info("Cache: {$event->key} has been forgotten");
    }

    public function logCacheKeyWritten($event)
    {
        $this->log->info("Cache: {$event->key} has been written");
    }

    public function logArtisanStarting($event)
    {
        $this->log->info("Console: artisan is starting");
    }

    public function logCommandStarting($event)
    {
        $this->log->info("Console: {$event->command} command has started");
    }

    public function logCommandFinished($event)
    {
        $this->log->info("Console: {$event->command} command has finished with exit code {$event->exitCode}");
    }

    public function logDatabaseQuery($event)
    {
        $this->log->info("Database: {$event->connectionName} has executed query", [$event->sql]);
    }

    public function logDatabaseTransactionBegin($event)
    {
        $this->log->info("Database: {$event->connectionName} has started a transaction");
    }

    public function logDatabaseTransactionCommit($event)
    {
        $this->log->info("Database: {$event->connectionName} has committed a transaction");
    }

    public function logDatabaseTransactionRollBack($event)
    {
        $this->log->info("Database: {$event->connectionName} has rolled back a transaction");
    }

    public function logDatabaseTransactionRollBack($event)
    {
        $this->log->info("Locale: locale has been updated to {$event->locale} has rolled back a transaction");
    }

    public function logRequest($event)
    {
        $this->log->info("Http: {$this->getUserName($event->request->user())} request for {$event->request->fullUrl()} was responded with {$event->response->status())}");
    }

    public function logMessageSending($event)
    {
        $this->log->info("Mail: sending '{$event->message->getSubject()}' mail");
    }

    public function logMessageSending($event)
    {
        $this->log->info("Mail: mail '{$event->message->getSubject()}' sent");
    }

    public function logFailedNotification($event)
    {
        $this->log->info("Notification: notification failed for channel {$event->channel}");
    }

    public function logSendingNotification($event)
    {
        $this->log->info("Notification: sending notification for channel {$event->channel}");
    }

    public function logSentNotification($event)
    {
        $this->log->info("Notification: sent notification for channel {$event->channel}");
    }

    public function logJobProcessed($event)
    {
        $this->log->info("Queue: processed {$event->job->getName()} job");
    }

    public function logJobProcessing($event)
    {
        $this->log->info("Queue: processing {$event->job->getName()} job");
    }

    public function logRouteMatched($event)
    {
        $this->log->info("Routing: {$this->getUserName($event->request->user())} matched route for {$event->request->fullUrl()}");
    }

    protected function getUserName($user = null)
    {
        if (!$user) {
            return 'anonymous user';
        }

        return "user ({$event->user->getAuthIdentifierName()} {$event->user->getAuthIdentifier()})";
    }
}
