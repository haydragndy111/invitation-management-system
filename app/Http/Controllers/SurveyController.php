<?php

namespace App\Http\Controllers;

use App\Constants\InvitationConstants;
use App\Models\Invitation;
use App\Models\Survey;
use App\Models\User;
use Illuminate\Support\Str;

class SurveyController extends Controller
{
    /**
     * Display the survey details.
     */
    public function show(Survey $survey, Invitation $invitation)
    {
        $user = $invitation->user;
        $updatedData = [];

        if($invitation->status == InvitationConstants::STATUS_INACTIVE){
            $updatedData['status'] = InvitationConstants::STATUS_OPENED;
        }

        if(!$user){
            $existUser = User::where('email', $invitation->email)->first();
            if(!$existUser){
                $user = User::create([
                    'email' => $invitation->email,
                    'name' => 'User ' . Str::random(5)
                ]);
            }else{
                $user = $existUser;
            }

            $updatedData['user_id'] = $user->id;
        }

        $user->groups()->syncWithoutDetaching([$invitation->group_id]);

        if(!empty($updatedData)){
            $invitation->update($updatedData);
        }

        return view('surveys.show', compact('survey', 'invitation'));
    }

    public function acceptInvitation(Survey $survey, Invitation $invitation)
    {
        try {

            $invitation->update([
                'status' => InvitationConstants::STATUS_COMPLETED
            ]);

            return view('surveys.accepted', compact('survey', 'invitation'));
        } catch (\Throwable $th) {
            // Log::error($th->getMessage());

            return redirect()->route('surveys.show', [
                        'survey' => $survey->id,
                        'invitation' => $invitation->id,
                    ])->with('error', 'Something went wrong while accepting the invitation.');
        }
    }
}
