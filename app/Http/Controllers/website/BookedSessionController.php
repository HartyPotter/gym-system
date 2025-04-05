<?php

namespace App\Http\Controllers\website;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BookedSession;
use App\Models\Trainer;
use App\Models\User;

class BookedSessionController extends Controller
{
    public function create()
    {
        $trainers = User::where('user_type', 'trainer')->simplePaginate(5);
        return view('website.pages.booksessions', compact('trainers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'session_title'    => 'required|string|max:255',
            'description'      => 'nullable|string|max:1020',
            'session_image'    => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'session_date'     => 'required|date',
            'session_time'     => 'required|string|max:255',
            'trainer_id'       => 'nullable|exists:trainers,id',
            'create_user_id'   => 'nullable|exists:users,id',
            'update_user_id'   => 'nullable|exists:users,id'
        ]);

        if ($request->hasFile('session_image')) {
            $imagePath = $request->file('session_image')->store('public/session_images');
        } else {
            $imagePath = null; 
        }

        $bookedSession = new BookedSession();
        $bookedSession->session_title  = $request->session_title;
        $bookedSession->description    = $request->description;
        $bookedSession->session_image  = $imagePath;
        $bookedSession->session_date   = $request->session_date;
        $bookedSession->session_time   = $request->session_time;
        $bookedSession->trainer_id     = $request->trainer_id;
        $bookedSession->create_user_id = auth()->user()->id;
        $bookedSession->update_user_id = null;

        $bookedSession->save();

        // Trigger the event
        event(new \App\Events\SessionBooked($bookedSession));

        return redirect()->route('book-session.create')->with('success', 'Session booked successfully!');
    }

    public function destroy($id)
    {
        $bookedSession = BookedSession::find($id);

        if (!$bookedSession) {
            return redirect()->route('book-session.create')->with('error', 'Session not found.');
        }

        if ($bookedSession->session_image && \Storage::exists($bookedSession->session_image)) {
            \Storage::delete($bookedSession->session_image);
        }

        $bookedSession->delete();

        return redirect()->route('profileuser.show', ['username' => auth()->user()->username])->with('success', 'Session deleted successfully!');
    }
}
