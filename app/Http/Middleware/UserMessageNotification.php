<?php

namespace App\Http\Middleware;

use App\Models\Admin\Message;
use App\Models\Admin\Mlmuser;
use App\Models\Admin\Offer;
use App\Models\Admin\Transection;
use Auth;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
class UserMessageNotification
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $notifications = Message::where('receiver_type', 'mlmuser')
            ->where('receiver_id', Auth::user()->id)
            ->where('sender_type', 'admin')
            ->where('is_read', 0)
            ->get();

        // Get transactions where admin has paid the user
        $adminPaidTransactions = Transection::where('formable_type', 'admin')
            ->where('formable_id', 1) // Replace with actual admin ID
            ->where('toable_type', 'user')
            ->where('toable_id', Auth::user()->id)
            ->orderBy('id','DESC')->get();

        $newUsers = Mlmuser::where('parent_id',Auth::user()->id)->orderBy('id','DESC')->get();
        $currentDate = Carbon::now()->format('d-m-Y');
        // Fetch all offers and filter based on the last_date format
        $offers = Offer::where('status',1)->where('offer_for','digitalproduct')->where('offer_type', 'normal')
        ->get()
        ->filter(function ($offer) use ($currentDate) {
            // Convert last_date to a valid date representation (Y-m-d) for comparison
            $lastDate = Carbon::createFromFormat('d-m-Y', $offer->last_date)->endOfDay();

            // Compare the last_date with the current date
            return $lastDate->isSameDay($currentDate) || $lastDate->isFuture();
        });
        view()->share([
            'notifications' => $notifications,
            'adminPaidTransactions' => $adminPaidTransactions,
            'newUsers' => $newUsers,
            'offers' => $offers
        ]);
        return $next($request);
    }
}
