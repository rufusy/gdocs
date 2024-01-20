<?php
/**
 * @author Rufusy Idachi <idachirufus@gmail.com>
 * @date: 1/20/2024
 * @time: 2:29 PM
 */

namespace App\Subscribers\Models;

use App\Events\Models\User\UserCreated;
use App\Listeners\SendWelcomeEmail;
use Illuminate\Events\Dispatcher;

class UserSubscriber
{
    public function subscribe(Dispatcher $events): void
    {
        $events->listen(UserCreated::class, SendWelcomeEmail::class);
    }
}
