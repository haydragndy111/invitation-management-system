<x-filament::card class="p-6 space-y-4">

    {{-- Header Section --}}
    <div class="flex items-center justify-between mb-4">
        <div class="flex items-center space-x-2">
            <x-heroicon-o-users class="h-6 w-6" style="color: #f59e0b;" />
            <h3 class="text-lg font-semibold">{{ $getGroupName() }}</h3>
        </div>
        <x-filament::actions :actions="[$getAction('sendInvitation')]" />
    </div>

    {{-- Card Content with Fixed Height --}}
    <div class="p-4 border rounded-lg space-y-4" style="min-height: 180px;">
        @if ($getInvitation() != null)
            <div class="flex items-start space-x-4">
                <div class="rounded-full bg-gray-200 h-12 w-12 flex items-center justify-center">
                    <x-filament::avatar
                        src="{{ asset('storage/images/avatar.png') }}"
                        alt="Avatar"
                        size="md"
                    />
                </div>
                <div class="space-y-1">
                    <p class="text-lg font-semibold">{{ $getInvitation()->email }}</p>

                    <p class="text-sm">
                        <span class="font-semibold">{{ __('translations.components.evaluation_invitations.status') }}:</span>
                        <span class="text-gray-500">{{ $getInvitationStatus() }}</span>
                    </p>

                    <p class="text-sm">
                        <span class="font-semibold">{{ __('translations.components.evaluation_invitations.num_of_sends') }}:</span>
                        <span class="text-gray-500">{{ $getInvitation()->num_of_sends ?? 0 }}</span>
                    </p>

                    <p class="text-sm">
                        <span class="font-semibold">{{ __('translations.components.evaluation_invitations.sending_date') }}:</span>
                        <span class="text-gray-500">{{ $getInvitationDate() }}</span>
                    </p>
                </div>
            </div>

            <div class="flex space-x-2 mt-4">
                <x-filament::actions :actions="[$getAction('resend'), $getAction('move'), $getAction('delete')]" />
            </div>
        @else
            <div class="flex items-center justify-center h-full">
                <p class="text-gray-500">{{ __('translations.components.evaluation_invitations.empty_invitation') }}</p>
            </div>
        @endif
    </div>

</x-filament::card>
